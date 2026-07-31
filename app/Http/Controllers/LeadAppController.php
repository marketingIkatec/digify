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
use App\Models\Setting;
use App\Models\FormHubSpot;
use Exception;

class LeadAppController extends Controller
{
    
    public function index()
    {
        return view('pages.lead-contato');
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

        $queryGroup = clone $query;
        
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

        // Filtro por status
        if ($request->filled('status') && $request->status !== 'todos') {
            $query->where('status', $request->status);
        }
        // Filtro por status
        if ($request->filled('form_type')) {
            $query->where('form_type', $request->form_type);
        }

        // Paginação com 10 por página
        // Ordenação
        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'desc');

        $leads = $query->orderBy($sortField, $sortDirection)
                    ->paginate(10)
                    ->appends($request->all());

        return view('admin.pages.leads.index')
                ->with('leads', $leads)
                ->with('formTypes', $formTypes)
                ->with('sortField', $sortField)
                ->with('sortDirection', $sortDirection);
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

                $leadsService = new LeadsService();
                $leadId = $leadsService->saveLead($data, $modelClass);

                $lead = $model::find($leadId);                 

                try {                
                    $hubspot->enviarLeadCustomForm($lead);
                }catch (\Exception $e) {
                    return response()->json([
                        'success' => false,
                        'message' => str_replace("|", "<br>", $e->getMessage()),
                    ]);
                }

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
            $start = $request->start_date ?? now()->subDays(30);
            $end   = $request->end_date ?? now();

            $tables = ['leadsWhatsapp', 'leadsContato', 'leadsCustomContato'];
            foreach($tables as $table){
                $return[$table]['title'] = $table == 'leadsWhatsapp' ? 'Leads via WhatsApp' : 'Leads via Contato';                
                // Total
                $return[$table]['total'] = DB::table($table)
                    ->whereBetween('created_at', [$start, $end])
                    ->count();

                // Leads por dia
                $return[$table]['leadsPorDia'] = DB::table($table)
                    ->select(DB::raw("DATE_FORMAT(created_at, '%d/%m/%Y') as date"), DB::raw('COUNT(*) as total'))
                    ->whereBetween('created_at', [$start, $end])
                    ->groupBy('date')
                    ->orderBy('date')
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
            }

            if($request->input('email') == ''){
                return response()->json($return);
            }else{
                
                $filePath = storage_path('app/leads.xlsx');
                
                $contato = DB::table('leadsContato')
                            ->select('*')
                            ->whereBetween('created_at', [$start, $end])
                            ->get();

                $whatsapp = DB::table('leadsWhatsapp')
                            ->select('*')
                            ->whereBetween('created_at', [$start, $end])
                            ->get();      

                Excel::store(new LeadsExport($contato, $whatsapp), 'leads.xlsx');

                $svgs = $request->svgs;
                $images = [];

                foreach ($svgs as $index => $svg) {
                    $path = storage_path("app/chart_{$index}.svg");
                    file_put_contents($path, $svg);
                    $images[] = $path;
                }

                Mail::send('emails.relatorio', [
                    'contato'  => $contato,
                    'whatsapp' => $whatsapp,
                    'count'    => count($contato) + count($whatsapp),
                    'start'    => Carbon::parse($start)->format('d/m/Y'),
                    'end'      => Carbon::parse($end)->format('d/m/Y'),
                    'images' => $images
                ], function ($message) use ($request, $filePath) {

                    $message->to($request->email)
                        ->subject('Relatório de Leads 📊')
                        ->attach($filePath);
                });

                return response()->json(['success' => true]);
            }
        }else{
            return view('admin.pages.leads.report');
        }
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
