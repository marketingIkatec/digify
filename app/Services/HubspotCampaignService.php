<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Setting;
use App\Models\LeadContato;
use App\Models\LeadWhatsApp;
use App\Models\LeadCustomContato;
use App\Models\FormHubSpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class HubspotCampaignService
{
    protected $token;
    protected $portalId;
    protected $formIdExpGratis;        // digisac-teste-grátis-lp    

    public function __construct()
    {
        $lang = app()->getLocale();

        $this->token                = getSettings('hubspot_token');
        $this->portalId             = getSettings('hubspot_portal_id');               
    }

    public function listarCampanhasTeste($limit = 50, $offset = null)
    {
        $baseUrl = 'https://api.hubapi.com/email/public/v1/campaigns';
        $query = [
            'limit' => $limit,
        ];

        if ($offset) {
            $query['offset'] = $offset;
        }

        $response = Http::withToken($this->token)->get($baseUrl, $query);

        if ($response->failed()) {
            return [
                'error' => true,
                'message' => 'Erro na API HubSpot: ' . $response->body(),
            ];
        }

        return $response->json();
    }

    public function findContactByEmail($email)
    {
        $token = $this->token;

        $payload = [
            "filterGroups" => [
                [
                    "filters" => [
                        [
                            "propertyName" => "email",
                            "operator" => "EQ",
                            "value" => $email
                        ]
                    ]
                ]
            ],
            "properties" => [
                "firstname",
                "lastname",
                "email",
                "mobilephone",
                "createdate"
            ],
            "limit" => 1
        ];

        $response = Http::withToken($token)
            ->post(
                "https://api.hubapi.com/crm/v3/objects/contacts/search",
                $payload
            );

        return $response->json();
    }

    /*
        $response = $hubspot->listContact();
        return $response; 
    */
    public function listContactTest($criarCampo = false){
        $portalId = $this->portalId;
        $token    = $this->token;

        $payload = [
            "properties" => [
                "firstname",
                "lastname",
                "email",
                "mobilephone",
                "quantidade_de_colaboradores",
                "name",
                "cnpj",
                "createdate",
                "utm_term",            
            ],
            "sorts" => ["-createdate"],
            "limit" => 20
        ];
        
        $url = "https://api.hubapi.com/crm/v3/objects/contacts/search";
        if($criarCampo){
            $payload = [
                "name" => "cnpj",
                "label" => "CNPJ",
                "type" => "string",
                "fieldType" => "text",
                "groupName" => "contactinformation",
                "description" => "Número de CNPJ do contato",
                "hidden" => false,
                "formField" => true
            ];
            $url = "https://api.hubapi.com/crm/v3/properties/contacts";
        }
        $response = Http::withToken($token)
        ->post($url, $payload);

        return $response->json();
    }

    /*
        $response = $hubspot->listFormsTeste($form);
        return $response; 
    */
    public function listFormJson($formId = ''){ 
        $limit = 1000;                        
        $baseUrl = 'https://api.hubapi.com/forms/v2/fields/'.$formId;        
        $query['formTypes'] = "ALL";        
        $response = Http::withToken($this->token)->get($baseUrl, $query);
       return $response->json();
    }   
    public function listForm($formHubSpotId = ''){
        if($formHubSpotId){
            $formHubSpot = FormHubSpot::find($formHubSpotId);
            if(!empty($formHubSpot)){
                if(empty($formHubSpot->form_fields)){
                    $limit = 1000;
                        
                    $baseUrl = 'https://api.hubapi.com/forms/v2/fields/'.$formHubSpot->form_id;
                    
                    $query['formTypes'] = "ALL";
                    
                    $response = Http::withToken($this->token)->get($baseUrl, $query);

                    $fields = $response->json();

                    $formHubSpot->form_fields = $fields;
                    $formHubSpot->save();
                }else{
                    $fields = $formHubSpot->form_fields;
                }            

                $saidaFields = [];
                $saidaHtml = '';
                foreach ($fields as $field) {
                
                    $name  = $field['name'] ?? '';

                    $value = request()->$name ?? '';

                    if($name == 'url_inteligencia_comercial'){
                        $value = route('hubspot.login');
                    }

                    $class = "";

                    $saidaFields[] =  $name;
                    $label = $field['label'] ?? '';
                    $objectTypeId = $field['objectTypeId'] ?? '';
                    $type  = $field['fieldType'] ?? 'text';
                    $required = !empty($field['required']) ? 'required' : '';
                    $required = ''; // removendo obrigatoriedade para teste

                    $true = true;
                    $Name = $objectTypeId.'/'.$name;

                    if($name == 'website'){
                        $saidaHtml .= "<div class='form-group'>";
                        $saidaHtml .= "  <label for='{$Name}'>". __('forms.company_website') ."</label>";
                        $saidaHtml .= "  <input type='text' aria-label='". __('forms.company_website') ."' id='url' name='{$Name}' class='url' placeholder='". __('forms.placeholder_website') ."'>";
                        $saidaHtml .= "  <label class='checkbox-row'>";
                        $saidaHtml .= "      <input type='checkbox' class='nao_tem_site' name='nao_tem_site' value='1'> ". __('forms.no_website');
                        $saidaHtml .= "      <span class='website_error error-message'>". __('forms.validation_url') ."</span>";
                        $saidaHtml .= "  </label>";
                        $saidaHtml .= "</div>";
                        $true = false;
                    }else if($name == 'mobilephone'){
                        $saidaHtml .= "  <div class='form-group'>";
                        $saidaHtml .= "    <label for='whatsapp'>". __('forms.whatsapp') ."</label>";
                        $saidaHtml .= "    <input type='tel' aria-label='". __('forms.whatsapp') ."' id='whatsapp' name='{$Name}' class='whatsaap' placeholder='". __('forms.placeholder_phone') ."'>";
                        $saidaHtml .= "  </div>";
                        $true = false;
                    }else if($name == 'outros_segmento' || $name == 'lastname'){
                        $true = false;
                    }

                    $placeholder = $label;

                    switch($name){
                        case 'firstname' : 
                            $label       = __('forms.name'); 
                            $placeholder = __('forms.placeholder_full_name'); 
                            break;

                        case 'email' : 
                            $label = __('forms.email');
                            if($formHubSpot->form_corporate_email){
                                $label = __('forms.corporate_email');
                                if(strpos($formHubSpot->form_name, 'whatsapp') !== false){
                                   $label = __('forms.corporate_email_form_contato'); 
                                }
                            }
                            $placeholder = ($formHubSpot->form_corporate_email ? __('forms.placeholder_corporate_email') :__('forms.placeholder_email')); 
                            $class = "email";
                            break;
                        case 'pais__mkt____espanhol' : 
                            $class="pais-mkt-espanhol"; 
                        break;
                    }

                    if($true){
                        
                        if($name == 'origem___contato'){
                            if($formHubSpot->form_name == 'digify-botão-whatsapp-site'){
                                $value= 'Digify - Botão WhatsApp';
                            }else if($formHubSpot->form_name == 'digify-contato-site'){
                                $value= 'Digify - Forms site';
                            }
                        }

                        if(substr($name, 0, 4) !== 'utm_' && $name != 'gclid' && $name != 'url_inteligencia_comercial' && $name != 'origem___contato'){

                            $saidaHtml .= "<div class='form-group'>";
                            $saidaHtml .= "<label for='{$Name}'>{$label}</label>";

                            switch ($type) {

                                case 'textarea':
                                    $saidaHtml .= "<textarea class='{$class}' aria-label='{$label}' name='{$Name}' id='{$Name}' {$required}></textarea>";
                                break;

                                case 'select':
                                case 'radio':

                                    $saidaHtml .= "<select class='{$class}' aria-label='{$label}' name='{$Name}' id='{$Name}' ". (($name == 'qual_segmento_representa_melhor_seu_negocio') ? 'class="segmentos"' : 'class="'.$class.'"') .">";
                                    $saidaHtml .= "<option value='' selected>".__('forms.select_option')."</option>";    
                                    if(!empty($field['options'])){
                                        foreach ($field['options'] as $option) {
                                            $saidaHtml .= "<option value='{$option['value']}'>{$option['label']}</option>";
                                        }
                                    }

                                    $saidaHtml .= "</select>";

                                break;

                                case 'checkbox':

                                    if(!empty($field['options'])){

                                        foreach ($field['options'] as $option) {
                                            $saidaHtml .= "<label>";
                                            $saidaHtml .= "<input type='checkbox' class='{$class}' aria-label='{$label}' name='{$Name}[]' value='{$option['value']}'> ";
                                            $saidaHtml .= $option['label'];
                                            $saidaHtml .= "</label>";
                                        }

                                    } else {

                                        $saidaHtml .= "<input type='checkbox' aria-label='{$label}' name='{$Name}' value='true'>";

                                    }

                                break;

                                case 'number':
                                    $saidaHtml .= "<input type='number' class='{$class}' aria-label='{$label}' name='{$Name}' id='{$Name}' {$required}>";
                                break;

                                case 'date':
                                    $saidaHtml .= "<input type='date' class='{$class}' aria-label='{$label}' name='{$Name}' id='{$Name}' {$required}>";
                                break;

                                default:
                                    $saidaHtml .= "<input type='text' class='{$class}' aria-label='{$name}' name='{$Name}' id='{$Name}' placeholder='{$placeholder}' {$required}>";
                            }

                            $saidaHtml .= "</div>";

                            if($name == 'qual_segmento_representa_melhor_seu_negocio'){
                                $saidaHtml .= " <div class='form-group' style='display:none;'>";  
                                $saidaHtml .= "   <input type='text' aria-label='". __('forms.enter_segmento') ."' name='0-2/outros_segmento' id='0-2/outros_segmento' placeholder='". __('forms.enter_segmento') ."'>";
                                $saidaHtml .= " </div>";
                            }            

                        }else{
                            $saidaHtml .= "<input type='hidden' name='{$Name}' id='{$Name}' value='{$value}'>";
                        }
                    }                
                }
                return ['saidaHtml' => $saidaHtml, 'saidaFields' => implode(',', $saidaFields)];
                
                return $response->json();
            }
        }
        return ['saidaHtml' => '', 'saidaFields' => ''];
    }

    public function atualizaContatoTeste(){
      $contactId = '164963967912'; 
      
      $update = Http::withToken($this->token)->patch(
            "https://api.hubapi.com/crm/v3/objects/contacts/{$contactId}",
            [
                "properties" => [
                    "usuario" => "jorge.donizete.nunes@gmail.com",
                    "senha" => "ponto@app",
                    "codigo_da_empresa" => "032027",                    
                ]
            ]
        )->json();

        return $update;
    }

    public function enviarContatoTeste($firstname = null, $lastname = null, $email = null, $celular = null, $empresa = null, $cnpj = null, $colaboradores = null)
    {
        $data = [
            "properties" => [
                "firstname"                   => $firstname,
                "lastname"                    => $lastname,
                "email"                       => $email,
                "phone"                       => preg_replace('/\D/', '', $celular),
                "company"                     => $empresa,
                "cnpj"                        => preg_replace('/\D/', '', $cnpj),
                "quantidade_de_colaboradores" => preg_replace('/\D/', '', $colaboradores)
            ]
        ];

        $response = Http::withToken($this->token)
            ->post('https://api.hubapi.com/crm/v3/objects/contacts', $data);

        if ($response->failed()) {

            //Tratamento de erros
            $json = $response->json();

            //Tratamento de erros
            $error = trim(($json['message'] ?? '') . ' ' . ($json['erro'] ?? ''));

            // Se veio lista de errors
            if (isset($json['errors']) && is_array($json['errors'])) {
                $mensagens = collect($json['errors'])->map(fn($err) => $err['message'])->toArray();
                throw new Exception(implode(" | ", $mensagens));
            }
            if(empty($json['message'])){
                $json['message'] = 'Erro desconhecido ao enviar contato.';
            }
            // Mensagem genérica
            throw new Exception($json['message']);
        }

        return $response->json();
    }

    public function listEmailTeste($formIdExpGratis = false){
       //facilitaponto-contato-site
       //193529102970 email
       //campanhas: 383882737, 383853876, 383916648


        $limit = 1000;
        $baseUrl = 'https://api.hubapi.com/marketing/v3/emails/193529102970';
        //$baseUrl = 'https://api.hubapi.com/marketing/v3/campaigns/383882737';
        //$baseUrl = 'https://api.hubapi.com/marketing/v3/campaigns/48569772/associated/emails';
        //if($formIdExpGratis){
        //  $baseUrl = 'https://api.hubapi.com/forms/v2/fields/'.$this->formIdExpGratis;
        //}

        $baseUrl = 'https://api.hubapi.com/crm/v3/properties/contacts';
        
        $query = [];

        $response = Http::withToken($this->token)->get($baseUrl, $query);
        return $response->json();
    }
    
    public function enviarLeadCustomForm($lead)
    {                                

        $formId = FormHubSpot::where(['form_name' => $lead->form_type])->first()->form_id ?? null;
      
        if($formId){
            $url = "https://api.hsforms.com/submissions/v3/integration/submit/{$this->portalId}/{$formId}";
        
            $dados = $this->montarCampos($lead);     

            $response = Http::withToken($this->token)->post($url,$dados);

            if ($response->failed()) {
                //Tratamento de erros
                $json = $response->json();

                $error = trim(($json['message'] ?? '') . ' ' . ($json['erro'] ?? ''));
                Log::info('Erro ao enviar formulário a HubSpot:', ['lead_id' => $lead->id, 'error-message' => $error]);
                throw new Exception($error);
            }else{
                $lead->status = 1;
                $lead->save(); 
            }

            return response()->json([
                'hubspot_response' => $response->json()
            ]);
        }

    }

    public function montarCampos($lead){        
        $request = app(Request::class);

        $dadosLead = [];

        if($lead['extra_data']){
            $json = json_decode($lead['extra_data']);
            foreach($json as $key => $field){
                $extra_data[$key] = $field;
               // if($lead instanceof LeadCustomContato){     
                    if($field != '' and substr($key, 0, 2) == '0-'){
                        $dadosLead[$key] = $field; 
                    }
               // }
            }    
        }    


        if(!empty($lead->nome)){
            $dadosLead['0-1/firstname'] = $lead->nome;
        }

        if($lead->locale == 'pt' && !empty($lead->nome)){
            $nameParts = $this->splitName($lead->nome);
            $dadosLead['0-1/firstname'] = $nameParts['name'];
            $dadosLead['0-1/lastname']  = $nameParts['lastname'];
        }   

        if(!empty($lead->email)){
            $dadosLead['0-1/email'] = $lead->email;   
        }

        if(!empty($lead->whatsapp)){
            $dadosLead['0-1/mobilephone'] = preg_replace('/\D/', '', $lead->whatsapp);   
        }

        if(!empty($lead->url)){
            $dadosLead['0-2/website'] = $lead->url;   
        }
    

        if(!empty($extra_data['qual_segmento_representa_melhor_seu_negocio_outro'])){
            $dadosLead['0-2/outros_segmento'] = $extra_data['qual_segmento_representa_melhor_seu_negocio_outro']; 
        }

        if(!empty($extra_data['0-1/url_inteligencia_comercial'])){
            if(!empty($lead->url) && $urlInt = $lead->url){
                $alvo = parse_url($urlInt, PHP_URL_HOST);
                $alvo = preg_replace('/^www\./i', '', $alvo);                
                $dadosLead['0-1/url_inteligencia_comercial'] = $extra_data['0-1/url_inteligencia_comercial'].'?alvo='.$alvo;
            }else{
                $dadosLead['0-1/url_inteligencia_comercial'] = '';
            }
        }

        if(!empty($extra_data['qual_segmento_representa_melhor_seu_negocio'])){
            $dadosLead['0-2/qual_segmento_representa_melhor_seu_negocio'] = $extra_data['qual_segmento_representa_melhor_seu_negocio'];            
        }

        if(!empty($lead->mensagem)){
            $dadosLead['0-2/descricao_da_necessidade'] = $lead->mensagem;   
        }

        if($request->input('utm_id')){
            $dadosLead['0-1/utm_id'] = $request->input('utm_id');   
        }

        if($request->input('utm_campaign')){
            $dadosLead['0-1/utm_campaign'] = $request->input('utm_campaign');   
        }

        if($request->input('utm_term')){
            $dadosLead['0-1/utm_term'] = $request->input('utm_term');   
        }   

        if($request->input('utm_source')){
            $dadosLead['0-1/utm_source'] = $request->input('utm_source');   
        }
        
        if($request->input('utm_content')){
            $dadosLead['0-1/utm_content'] = $request->input('utm_content');   
        }
        
        if($request->input('utm_medium')){
            $dadosLead['0-1/utm_medium'] = $request->input('utm_medium');   
        }

        if($request->input('gclid')){
            $dadosLead['0-1/gclid'] = $request->input('gclid');   
        }

        $dados['fields'] = $this->montarCamposHubspot($dadosLead); 

        $dados['context']['pageUri']   = $request->input('pageUri');
        $dados['context']['pageName']  = $request->input('pageName');
        $dados['context']['ipAddress'] = (($_SERVER['REMOTE_ADDR'] != '127.0.0.1') ? $_SERVER['REMOTE_ADDR'] : null);        
        
        return $dados;
    }

    function montarCamposHubspot(array $data): array
    {
        $fields = [];

        foreach ($data as $name => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            $fields[] = [
                'name'  => $name,
                'value' => $value,
            ];
        }

        return $fields;
    }

      function splitName(string $nome): array
    {
        $nome = trim(preg_replace('/\s+/', ' ', $nome));
        $partes = explode(' ', $nome);

        return [
            'name'     => $partes[0],
            'lastname' => !empty($partes[1]) ? implode(' ', array_slice($partes, 1)) : '-',
        ];
    }
}
