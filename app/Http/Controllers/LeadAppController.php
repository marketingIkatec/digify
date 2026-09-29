<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeadWhatsAppRequest;
use App\Http\Requests\LeadContatoAppRequest;
use App\Http\Requests\CustomFormHubSpotRequest;
use Illuminate\Support\Facades\Validator;
use App\Rules\TurnstileRule;
use App\Services\HubspotCampaignService;
use App\Services\LeadsService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\ContatoMail;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LeadsSheet;
use App\Exports\LeadsExport;
use Carbon\Carbon;
use App\Models\LeadWhatsApp;
use App\Models\LeadContato;
use App\Models\LeadCustomContato;
use App\Models\Visitas;
use App\Models\User;
use App\Models\Setting;
use App\Models\FormHubSpot;
use App\Events\LeadInteligeniaComercial;
use Exception;

class LeadAppController extends Controller
{
    
    public function index()
    {
        return view('pages.lead-contato');
    }

    public function whatsAppStore(LeadWhatsAppRequest $request, HubspotCampaignService $hubspot)
    {
        $whatsapp = '';

        // Se houver erro de validação, o Laravel interrompe aqui e retorna 422 com JSON
        if($request->validated()){

            $data = $request->all();    

            $fillable = (new LeadWhatsApp())->getFillable();
            $extraFields = collect($request->all())
                    ->except($fillable)
                    ->except(['_token']) // remove token do Laravel
                    ->except(['utm_id', 'utm_campaign', 'utm_term', 'utm_source', 'utm_content', 'utm_medium', 'gclid']) // remove campos de tracking
                    ->toArray();
            
            $data['extra_data'] = json_encode($extraFields);
            
            if (session()->has('visita_id')) {
                $data['visita_id']  = session('visita_id');
            }

            if(empty($data['mensagem']) && (!empty($data['necessidade']))){
                $data['mensagem'] = $data['necessidade'];
            }
            
            $lead = LeadWhatsApp::where(['whatsapp' => $request->input('whatsapp'), 'form_type' => $request->input('form_type')])->first();
            if(empty($lead)){ 
                $lead = LeadWhatsApp::create($data);
            }

            $site_name = getSettings('site_name_short');
           
            if($request->input('form_type') == 'whatsapp-commercial'){

                try {                
                   $data = $hubspot->enviaLeadWhatsapp($lead);
                }catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => str_replace("|", "<br>", $e->getMessage()),
                    ]);
                } 

                $whatsapp = getSettings('form_whatsapp_commercial_'.$lead->locale);

                $extraData = $lead->extra_data_label;

                $mensagem = __('whatsapp.lead_message', [
                    'site_name' => $site_name,
                    'nome'      => $lead->nome,
                    'email'     => $lead->email,
                    'whatsapp'  => $lead->whatsapp,
                    'site'      => $lead->url ?? __('forms.no_website'),
                    'segmento'  => $extraData['qual_segmento_representa_melhor_seu_negocio'] ?? __('forms.no_segment')
                
                ]);
                //'status'    => $lead->voce_e_cliente_label

            }else if($request->input('form_type') == 'whatsapp-support' || $request->input('form_type') == 'email-support' || $request->input('form_type') == 'ouvidoria'){

                if($request->input('form_type') != 'ouvidoria'){
                    $form_email_support = getSettings('form_email_support');   
                    Mail::to($form_email_support)->send(new ContatoMail($lead, 'Equipe de Suporte - ' . $site_name));

                    $whatsapp = getSettings('form_whatsapp_support');
                    $mensagem = "Olá, sou cliente da {$site_name} e estou precisando de atendimento. \n\n" 
                        ."*Dados do contato:*\n"
                        ."*Nome:* {$lead->nome}\n"
                        ."*E-mail:* {$lead->email}\n"
                        ."*WhatsApp:* {$lead->whatsapp}\n"
                        ."*URL:* {$lead->url}\n"
                        ."*Mensagem:* {$lead->mensagem}";
                }else if($request->input('form_type') == 'ouvidoria'){
                    $whatsapp = $mensagem = null;
                    $form_email_ouvidoria = getSettings('form_email_ouvidoria');
                    Mail::to($form_email_ouvidoria)->send(new ContatoMail($lead, 'Nova manifestação de ouvidoria - ' . $site_name));
                }        
            }

            // Retorna a URL do WhatsApp pronta
            return response()->json([
                'success'     => true,
                'thanksPage'  => true,
                'message'     => "Obrigado! Seus dados foram enviados com sucesso.",
                'redirectUri' => !empty($whatsapp) ? "https://wa.me/".preg_replace('/\D/', '', $whatsapp)."?text=" . urlencode($mensagem) : null,
            ]);
        }
    }

    public function leadContatoStore(LeadContatoAppRequest $request, HubspotCampaignService $hubspot)
    {
        $return = ['success' => true, 'thanksPage'  => true, 'message' => 'Formulário enviado com sucesso!'];
        
        if($request->validated()){

            $data = $request->all();    

            $fillable = (new LeadContato())->getFillable();
            $extraFields = collect($request->all())
                    ->except($fillable)
                    ->except(['_token']) // remove token do Laravel
                    ->except(['utm_id', 'utm_campaign', 'utm_term', 'utm_source', 'utm_content', 'utm_medium', 'gclid']) // remove campos de tracking
                    ->toArray();
            $data['extra_data'] = json_encode($extraFields);
            
            if (session()->has('visita_id')) {
                $data['visita_id']  = session('visita_id');
            }

            if(empty($data['mensagem']) && (!empty($data['necessidade']))){
                $data['mensagem'] = $data['necessidade'];
            }
                    
            $lead = LeadContato::where([
                'whatsapp'  => $data['whatsapp'], 
                'form_type' => $request->input('form_type'),
                'mensagem'  => $request->input('mensagem')
                ])->first();

            if(empty($lead)){  
                $lead = LeadContato::create($data);
            }

            if($request->input('form_type') == 'teste-gratis' || $request->input('form_type') == 'contato' || $request->input('form_type') == 'seja-um-parceiro'){
                try {                
                    $hubspot->enviarLeadForm($lead);
                }catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => str_replace("|", "<br>", $e->getMessage()),
                    ]);
                }

                $whatsapp = getSettings('form_whatsapp_commercial_'.$lead->locale);
                $extraData = $lead->extra_data_label; 
                $mensagem = __('whatsapp.lead_message', [
                    'site_name' => getSettings('site_name_short'),
                    'nome'      => $lead->nome,
                    'email'     => $lead->email,
                    'whatsapp'  => $lead->whatsapp,
                    'site'      => $lead->url ?? __('forms.no_website'),
                    'segmento'  => $extraData['qual_segmento_representa_melhor_seu_negocio'] ?? __('forms.no_segment')
                ]);

                $return['redirectUri'] = "https://wa.me/".preg_replace('/\D/', '', $whatsapp)."?text=" . urlencode($mensagem);

            }else if($request->input('form_type') == 'ouvidoria'){
                $form_email_ouvidoria = getSettings('form_email_ouvidoria');
                Mail::to($form_email_ouvidoria)->send(new ContatoMail($lead, 'Nova manifestação de ouvidoria - ' . getSettings('site_name_short')));
            }
        }

        return response()->json($return);
    }

    public function viewLead(Request $request){

        $routeName = request()->route()->getName();
        if($routeName == 'admin.lead.whatsapp'){
            $query = LeadWhatsApp::query();
        }else if($routeName == 'admin.lead.contato'){
            $query = LeadContato::query();
        }else if($routeName == 'admin.lead.custom'){
            $query = LeadCustomContato::query();
        }

        $query->with('visita');

        $queryGroup = clone $query;
        $freeEmailDomains = [
            'gmail.com',
            'gmail.com.br',
            'hotmail.com',
            'hotmail.com.br',
            'live.com',
            'live.com.br',
            'outlook.com',
            'outlook.com.br',
            'yahoo.com',
            'yahoo.com.br',
            'icloud.com',
            'bol.com.br',
            'uol.com.br',
            'terra.com.br',
            'msn.com',
        ];
        
        $formTypes = $queryGroup
            ->select('form_type')   // seleciona apenas a coluna
            ->groupBy('form_type')  // agrupa por form_type
            ->pluck('form_type');   // retorna somente os valores em uma Collection

        // Filtro por nome
        if ($request->filled('nome')) {
            $query->where('nome', 'like', '%' . $request->nome . '%');
        }

        // Filtro por email
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('dataInicial')) {
            $query->where('created_at', '>=', Carbon::parse($request->dataInicial)->startOfDay());
        }

        if ($request->filled('dataFinal')) {
            $query->where('created_at', '<=', Carbon::parse($request->dataFinal)->endOfDay());
        }

        if ($request->filled('tipo_email')) {
            if ($request->tipo_email === 'gratuito') {
                $query->whereIn(DB::raw("LOWER(SUBSTRING_INDEX(email, '@', -1))"), $freeEmailDomains);
            }

            if ($request->tipo_email === 'corporativo') {
                $query->whereNotNull('email')
                    ->whereRaw("TRIM(email) != ''")
                    ->whereNotIn(DB::raw("LOWER(SUBSTRING_INDEX(email, '@', -1))"), $freeEmailDomains);
            }
        }

        if ($request->filled('origem')) {
            if ($request->origem === 'campanha') {
                $query->whereHas('visita', function ($q) {
                    $q->whereNotNull('url_query')
                        ->whereRaw("TRIM(url_query) != ''");
                });
            }

            if ($request->origem === 'organico') {
                $query->whereHas('visita', function ($q) {
                    $q->where(function ($q) {
                        $q->whereNull('url_query')
                            ->orWhereRaw("TRIM(url_query) = ''");
                    });
                });
            }

        }

        // Filtro por status
        if ($request->filled('status') && $request->status !== 'todos') {
            $query->where('status', $request->status);
        }
        // Filtro por status
        if ($request->filled('form_type')) {
            $query->where('form_type', $request->form_type);
        }

        $summaryQuery = clone $query;
        $resumoLeads = [
            'total' => (clone $summaryQuery)->count(),
            'email_corporativo' => (clone $summaryQuery)
                ->whereNotNull('email')
                ->whereRaw("TRIM(email) != ''")
                ->whereNotIn(DB::raw("LOWER(SUBSTRING_INDEX(email, '@', -1))"), $freeEmailDomains)
                ->count(),
            'email_gratuito' => (clone $summaryQuery)
                ->whereIn(DB::raw("LOWER(SUBSTRING_INDEX(email, '@', -1))"), $freeEmailDomains)
                ->count(),
            'organico' => (clone $summaryQuery)
                ->whereHas('visita', function ($q) {
                    $q->where(function ($q) {
                        $q->whereNull('url_query')
                            ->orWhereRaw("TRIM(url_query) = ''");
                    });
                })
                ->count(),
            'nao_organico' => (clone $summaryQuery)
                ->whereHas('visita', function ($q) {
                    $q->whereNotNull('url_query')
                        ->whereRaw("TRIM(url_query) != ''");
                })
                ->count(),
        ];

        // Paginação com 10 por página
        // Ordenação
        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'desc');

        $leads = $query->orderBy($sortField, $sortDirection)
                    ->paginate(10)
                    ->appends($request->all());

        $visitaIds = $leads->getCollection()
            ->pluck('visita_id')
            ->filter()
            ->unique()
            ->values();

        $visitasPorLead = collect();
        if($visitaIds->isNotEmpty()){
            $visitasPorLead = Visitas::whereIn('id', $visitaIds)
                ->orWhereIn('visita_id', $visitaIds)
                ->orderBy('data')
                ->get()
                ->groupBy(fn($visita) => $visita->visita_id ?: $visita->id);
        }

        $leadAlvosInteligencia = [];
        $emailsInteligencia = [];
        $dominiosInteligencia = [];

        foreach($leads->getCollection() as $lead){
            $email = strtolower(trim((string) $lead->email));
            $dominioEmail = $this->extrairDominioDoEmail($email);
            $dominioSite = $this->extrairDominioDaUrl($lead->url ?? '');

            $leadAlvosInteligencia[$lead->id] = [
                'email' => $email,
                'dominio_email' => $dominioEmail,
                'dominio_site' => $dominioSite,
            ];

            if($email){
                $emailsInteligencia[] = $email;
            }

            if($dominioEmail){
                $dominiosInteligencia[] = $dominioEmail;
            }

            if($dominioSite){
                $dominiosInteligencia[] = $dominioSite;
            }
        }

        return view('admin.pages.leads.index')
                ->with('leads', $leads)
                ->with('formTypes', $formTypes)
                ->with('freeEmailDomains', $freeEmailDomains)
                ->with('visitasPorLead', $visitasPorLead)
                ->with('inteligenciasPorLead', [])
                ->with('resumoLeads', $resumoLeads)
                ->with('sortField', $sortField)
                ->with('sortDirection', $sortDirection);
    }

    private function extrairDominioDoEmail(?string $email): ?string
    {
        if(!$email || !str_contains($email, '@')){
            return null;
        }

        return strtolower(trim(substr(strrchr($email, '@'), 1))) ?: null;
    }

    private function extrairDominioDaUrl(?string $url): ?string
    {
        $url = trim((string) $url);
        if($url === ''){
            return null;
        }

        $host = parse_url(str_starts_with($url, 'http') ? $url : 'https://' . $url, PHP_URL_HOST);
        if(!$host){
            return null;
        }

        return strtolower(preg_replace('/^www\./', '', $host));
    }


    public function formCustomStore(CustomFormHubSpotRequest $request, HubspotCampaignService $hubspot)
    {
        $formHubSpot = FormHubSpot::where(['form_name' => $request->input('form_type')])->first();
        if(!empty($formHubSpot)){

            if ($formHubSpot->form_captcha == 1) {
                $request->validate([
                    'cf-turnstile-response' => ['required', new TurnstileRule()],
                ]);
            }

            if($request->validated()){
                $data = $request->all();                   
                    
                $modelClass = $formHubSpot->form_table;
                $model = new $modelClass;
                $fillable = $model->getFillable();

                $extraFields = collect($request->all())
                        ->except($fillable)
                        ->except(['_token']) // remove token do Laravel
                        ->toArray();
                $data['extra_data'] = json_encode($extraFields);

                if (session()->has('visita_id')) {
                    $data['visita_id']  = session('visita_id');
                }

                $leadsService = new LeadsService();
                $leadId = $leadsService->saveLead($data, $modelClass);

                $lead = $model::find($leadId);
                $lead->extra_data = $data['extra_data'];
                $lead->save();             

                try {                
                    $hubspot->enviarLeadCustomForm($lead);
                }catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => str_replace("|", "<br>", $e->getMessage()),
                    ]);
                }
                
                event(new LeadInteligeniaComercial($lead));
                
                $thanksPage = true;
                if($formHubSpot->form_sent == 'aba2'){ // abre uma nova aba do popup
                    return response()->json([
                        'success' => true,
                        'showDiv' => 'step-2',
                        'hideDiv' => 'step-1',
                        'localStorage' => 'popup-'.$request->input('form_type').'-converted',
                    ]);
                }
                
                elseif($formHubSpot->form_sent == 'step-success'){ // abre uma nova step
                    return response()->json([
                        'success' => true,
                        'showDiv' => 'step-success',
                        'hideDiv' => 'step-content',
                    ]);
                }
                
                else if($formHubSpot->form_sent == 'tela_obrigado_whatsapp' || $formHubSpot->form_sent == 'whatsapp'){ // redireciona para o whatsapp
                    $redirectUri = $leadsService->createWhatsAppMessage($lead, $formHubSpot);    
                    if($formHubSpot->form_sent == 'whatsapp'){
                        $thanksPage = false;
                    }
                }

                else if($formHubSpot->form_sent == 'url'){
                    $redirectUri = $formHubSpot->form_sent_url;  
                    $thanksPage = false;  
                }
                
                return response()->json([
                    'success'     => true,
                    'thanksPage'  => $thanksPage,
                    'redirectUri' => $redirectUri ?? '',
                ]);
            }
        }
    }

    public function dashboard(Request $request)
    {

        if($request->input('start_date')){ 
            $start = Carbon::parse($request->start_date ?? now()->subDays(30))->startOfDay();
            $end   = Carbon::parse($request->end_date ?? now())->endOfDay();

            $freeEmailDomains = [
                'gmail.com',
                'gmail.com.br',
                'hotmail.com',
                'hotmail.com.br',
                'live.com',
                'live.com.br',
                'outlook.com',
                'outlook.com.br',
                'yahoo.com',
                'yahoo.com.br',
                'icloud.com',
                'bol.com.br',
                'uol.com.br',
                'terra.com.br',
                'msn.com',
            ];

            $emailDomainList = "'" . implode("','", $freeEmailDomains) . "'";
            $geralPorTipoEmail = [];
            $geralPorOrigem = [];
            $geralPorUtmSource = [];
            $totalGeral = 0;

            $tables = ['leadsWhatsapp', 'leadsContato', 'leadsCustomContato'];
            foreach($tables as $table){
                $return[$table]['title'] = $table == 'leadsWhatsapp' ? 'Leads via WhatsApp' : 'Leads via Contato';                
                // Total
                $return[$table]['total'] = DB::table($table)
                    ->whereBetween('created_at', [$start, $end])
                    ->count();

                // Leads por dia
                $return[$table]['leadsPorDia'] = DB::table($table)
                    ->select(DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y') as date"), DB::raw("DATE(created_at) as order_date"), DB::raw('COUNT(*) as total'))
                    ->whereBetween('created_at', [$start, $end])
                    ->groupBy('date', 'order_date')
                    ->orderBy('order_date')
                    ->get();

                // Por locale
                $return[$table]['porLocale'] = DB::table($table)
                    ->select('locale', DB::raw('COUNT(*) as total'))
                    ->whereBetween('created_at', [$start, $end])
                    ->groupBy('locale')
                    ->get();

                // Por tipo de formulário
                $return[$table]['porFormType'] = DB::table($table)
                    ->select('form_type', DB::raw('COUNT(*) as total'))
                    ->whereBetween('created_at', [$start, $end])
                    ->groupBy('form_type')
                    ->get();

                $return[$table]['porTipoEmail'] = DB::table($table)
                    ->select(DB::raw("CASE
                        WHEN LOWER(SUBSTRING_INDEX(email, '@', -1)) IN ({$emailDomainList}) THEN 'E-mail gratuito'
                        ELSE 'Corporativo'
                    END as tipo"), DB::raw('COUNT(*) as total'))
                    ->whereBetween('created_at', [$start, $end])
                    ->groupBy('tipo')
                    ->get();

                $return[$table]['porOrigem'] = DB::table($table)
                    ->leftJoin('visitas', $table . '.visita_id', '=', 'visitas.id')
                    ->select(DB::raw("CASE
                        WHEN visitas.url_query IS NOT NULL AND TRIM(visitas.url_query) != '' THEN 'Campanha'
                        ELSE 'Orgânico'
                    END as origem"), DB::raw('COUNT(*) as total'))
                    ->whereBetween($table . '.created_at', [$start, $end])
                    ->whereNotNull('visitas.id')
                    ->groupBy('origem')
                    ->get();

                $return[$table]['porUtmSource'] = DB::table($table)
                    ->leftJoin('visitas', $table . '.visita_id', '=', 'visitas.id')
                    ->select(DB::raw("COALESCE(NULLIF(SUBSTRING_INDEX(SUBSTRING_INDEX(visitas.url_query, 'utm_source=', -1), '&', 1), visitas.url_query), 'Sem utm_source') as utm_source"), DB::raw('COUNT(*) as total'))
                    ->whereBetween($table . '.created_at', [$start, $end])
                    ->whereNotNull('visitas.url_query')
                    ->whereRaw("TRIM(visitas.url_query) != ''")
                    ->groupBy('utm_source')
                    ->get();

                $totalGeral += $return[$table]['total'];

                foreach($return[$table]['porTipoEmail'] as $item){
                    $geralPorTipoEmail[$item->tipo] = ($geralPorTipoEmail[$item->tipo] ?? 0) + $item->total;
                }

                foreach($return[$table]['porOrigem'] as $item){
                    $geralPorOrigem[$item->origem] = ($geralPorOrigem[$item->origem] ?? 0) + $item->total;
                }

                foreach($return[$table]['porUtmSource'] as $item){
                    $source = urldecode($item->utm_source ?: 'Sem utm_source');
                    $geralPorUtmSource[$source] = ($geralPorUtmSource[$source] ?? 0) + $item->total;
                }
            }

            $visitanteId = 'COALESCE(v.visita_id, v.id)';

            $totalVisitas = DB::table('visitas as v')
                ->whereBetween('v.data', [$start, $end])
                ->selectRaw("COUNT(DISTINCT {$visitanteId}) as total")
                ->value('total');

            $visitasPorOrigem = DB::table('visitas as v')
                ->leftJoin('visitas as raiz', DB::raw($visitanteId), '=', 'raiz.id')
                ->whereBetween('v.data', [$start, $end])
                ->selectRaw("COUNT(DISTINCT CASE WHEN raiz.url_query IS NOT NULL AND TRIM(raiz.url_query) != '' THEN {$visitanteId} END) as campanha")
                ->selectRaw("COUNT(DISTINCT CASE WHEN raiz.url_query IS NULL OR TRIM(raiz.url_query) = '' THEN {$visitanteId} END) as organico")
                ->first();

            $visitasCampanha = (int) ($visitasPorOrigem->campanha ?? 0);
            $visitasOrganicas = (int) ($visitasPorOrigem->organico ?? 0);

            $topPaginasVisitas = DB::table('visitas as v')
                ->leftJoin('visitas as raiz', DB::raw($visitanteId), '=', 'raiz.id')
                ->select('v.pagina')
                ->selectRaw("COUNT(DISTINCT {$visitanteId}) as total")
                ->selectRaw("COUNT(DISTINCT CASE WHEN raiz.url_query IS NULL OR TRIM(raiz.url_query) = '' THEN {$visitanteId} END) as organico")
                ->selectRaw("COUNT(DISTINCT CASE WHEN raiz.url_query IS NOT NULL AND TRIM(raiz.url_query) != '' THEN {$visitanteId} END) as campanha")
                ->whereBetween('v.data', [$start, $end])
                ->groupBy('pagina')
                ->orderByDesc('total')
                ->limit(10)
                ->get();

            $return['geral'] = [
                'total' => $totalGeral,
                'totalVisitas' => $totalVisitas,
                'visitasCampanha' => $visitasCampanha,
                'visitasCampanhaPercentual' => $totalVisitas > 0 ? round(($visitasCampanha / $totalVisitas) * 100, 1) : 0,
                'visitasOrganicas' => $visitasOrganicas,
                'visitasOrganicasPercentual' => $totalVisitas > 0 ? round(($visitasOrganicas / $totalVisitas) * 100, 1) : 0,
                'taxaConversao' => $totalVisitas > 0 ? round(($totalGeral / $totalVisitas) * 100, 2) : 0,
                'topPaginasVisitas' => $topPaginasVisitas,
                'porTipoEmail' => collect($geralPorTipoEmail)->map(fn($total, $tipo) => [
                    'tipo' => $tipo,
                    'total' => $total,
                ])->values(),
                'porOrigem' => collect($geralPorOrigem)->map(fn($total, $origem) => [
                    'origem' => $origem,
                    'total' => $total,
                ])->values(),
                'porUtmSource' => collect($geralPorUtmSource)->map(fn($total, $utmSource) => [
                    'utm_source' => $utmSource,
                    'total' => $total,
                ])->values(),
            ];

            if($request->boolean('download_excel')){
                $contato = $this->buscarLeadsRelatorio('leadsContato', $start, $end, $emailDomainList);
                $whatsapp = $this->buscarLeadsRelatorio('leadsWhatsapp', $start, $end, $emailDomainList);
                $custom = $this->buscarLeadsRelatorio('leadsCustomContato', $start, $end, $emailDomainList);

                return Excel::download(new LeadsExport($contato, $whatsapp, $custom), 'leads.xlsx');
            }

            if($request->input('email') == ''){
                return response()->json($return);
            }else{
                
                $filePath = storage_path('app/leads.xlsx');

                $contato = $this->buscarLeadsRelatorio('leadsContato', $start, $end, $emailDomainList);
                $whatsapp = $this->buscarLeadsRelatorio('leadsWhatsapp', $start, $end, $emailDomainList);
                $custom = $this->buscarLeadsRelatorio('leadsCustomContato', $start, $end, $emailDomainList);

                $montarResumoRelatorio = function ($leads) {
                    return [
                        'total' => $leads->count(),
                        'campanha' => $leads->where('origem', 'Campanha')->count(),
                        'organico' => $leads->where('origem', 'Orgânico')->count(),
                        'corporativo' => $leads->where('tipo_email', 'Corporativo')->count(),
                        'gratuito' => $leads->where('tipo_email', 'Gratuito')->count(),
                    ];
                };

                $resumoRelatorio = [
                    'contato' => $montarResumoRelatorio($contato),
                    'whatsapp' => $montarResumoRelatorio($whatsapp),
                    'custom' => $montarResumoRelatorio($custom),
                ];

                $resumoRelatorio['total'] = [
                    'total' => $resumoRelatorio['contato']['total'] + $resumoRelatorio['whatsapp']['total'] + $resumoRelatorio['custom']['total'],
                    'campanha' => $resumoRelatorio['contato']['campanha'] + $resumoRelatorio['whatsapp']['campanha'] + $resumoRelatorio['custom']['campanha'],
                    'organico' => $resumoRelatorio['contato']['organico'] + $resumoRelatorio['whatsapp']['organico'] + $resumoRelatorio['custom']['organico'],
                    'corporativo' => $resumoRelatorio['contato']['corporativo'] + $resumoRelatorio['whatsapp']['corporativo'] + $resumoRelatorio['custom']['corporativo'],
                    'gratuito' => $resumoRelatorio['contato']['gratuito'] + $resumoRelatorio['whatsapp']['gratuito'] + $resumoRelatorio['custom']['gratuito'],
                ];

                $resumoRelatorio['visitas'] = [
                    'total' => $totalVisitas,
                    'campanha' => $visitasCampanha,
                    'campanhaPercentual' => $totalVisitas > 0 ? round(($visitasCampanha / $totalVisitas) * 100, 1) : 0,
                    'organico' => $visitasOrganicas,
                    'organicoPercentual' => $totalVisitas > 0 ? round(($visitasOrganicas / $totalVisitas) * 100, 1) : 0,
                    'leads' => $resumoRelatorio['total']['total'],
                    'taxaConversao' => $totalVisitas > 0 ? round(($resumoRelatorio['total']['total'] / $totalVisitas) * 100, 2) : 0,
                    'visitasPorLead' => $resumoRelatorio['total']['total'] > 0 ? round($totalVisitas / $resumoRelatorio['total']['total'], 2) : 0,
                ];

                Excel::store(new LeadsExport($contato, $whatsapp, $custom), 'leads.xlsx');

                $svgs = $request->svgs;
                $images = [];

                foreach ($svgs as $index => $svg) {
                    $path = storage_path("app/chart_{$index}.svg");
                    file_put_contents($path, $svg);
                    $images[] = $path;
                }

                $emailsRelatorio = collect(preg_split('/[;,]+/', (string) $request->email))
                    ->map(fn($email) => trim($email))
                    ->filter(fn($email) => filter_var($email, FILTER_VALIDATE_EMAIL))
                    ->unique()
                    ->values()
                    ->all();

                if(empty($emailsRelatorio)){
                    return response()->json(['success' => false, 'message' => 'Informe ao menos um e-mail válido.'], 422);
                }

                Mail::send('emails.relatorio', [
                    'contato'  => $contato,
                    'whatsapp' => $whatsapp,
                    'custom'   => $custom,
                    'resumoRelatorio' => $resumoRelatorio,
                    'count'    => $resumoRelatorio['total']['total'],
                    'start'    => Carbon::parse($start)->format('d/m/Y'),
                    'end'      => Carbon::parse($end)->format('d/m/Y'),
                    'images' => $images
                ], function ($message) use ($emailsRelatorio, $filePath) {

                    $message->to($emailsRelatorio)
                        ->subject('Relatório de Leads 📊')
                        ->attach($filePath);
                });

                return response()->json(['success' => true]);
            }
        }else{
            $emailsUsuarios = User::query()
                ->whereNotNull('email')
                ->where('email', '!=', '')
                ->orderBy('name')
                ->get(['name', 'email']);

            return view('admin.pages.leads.report')
                ->with('emailsUsuarios', $emailsUsuarios);
        }
    }

    private function buscarLeadsRelatorio(string $table, $start, $end, string $emailDomainList)
    {
        return DB::table($table)
            ->leftJoin('visitas', $table . '.visita_id', '=', 'visitas.id')
            ->select($table . '.*')
            ->selectRaw('visitas.pagina as primeira_pagina')
            ->selectRaw('visitas.url_query as primeira_url_query')
            ->selectRaw("CASE
                WHEN visitas.id IS NULL THEN 'Não identificado'
                WHEN visitas.url_query IS NOT NULL AND TRIM(visitas.url_query) != '' THEN 'Campanha'
                ELSE 'Orgânico'
            END as origem")
            ->selectRaw("CASE
                WHEN LOWER(SUBSTRING_INDEX({$table}.email, '@', -1)) IN ({$emailDomainList}) THEN 'Gratuito'
                ELSE 'Corporativo'
            END as tipo_email")
            ->whereBetween($table . '.created_at', [$start, $end])
            ->get();
    }


    

public function validateStep(Request $request)
{
    if ($request->filled('locale')) {
        app()->setLocale($request->input('locale'));
    }

    $rules = (new CustomFormHubSpotRequest())->rules();
    $messages = (new CustomFormHubSpotRequest())->messages();

    $field = $request->field;
    $value = $request->value;

    $validator = Validator::make(
        [$field => $value],
        [$field => $rules[$field] ?? 'nullable'],
        $messages
    );

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first($field)
        ]);
    }

    return response()->json([
        'success' => true
    ]);
}
}
