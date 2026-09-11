<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\HubspotCampaignService;
use App\Models\AccountDigifyHubspot;
use Exception;

class DigifyHubspotService
{

    protected $hubspotService;

    public function __construct()
    {
        $this->hubspotService = new \App\Services\HubspotCampaignService();
    }


    public function registerLog($data){
        Log::info('DIGIFY_EVENT_RECEIVED', [
            'payload'          => $data,
        ]);
    }

    public function verifyDigifyAccount($data){
        
        $this->registerLog($data);

        $account = '';

        if(!empty($data['email'])){
            $account = AccountDigifyHubspot::firstOrCreate(
                [
                    'email' => $data['email'],
                ],
                [
                    'digify_account_id' => $data['digify_account_id'],
                ]
            );
        }else if(!empty($data['digify_account_id'])){
            $account = AccountDigifyHubspot::where(['digify_account_id' => $data['digify_account_id']])->first();        
        }
        

        if(empty($account->hubspot_account_id)){
            $account->hubspot_account_id = $this->hubspotService->findContactByEmail($account->email);
            $account->hubspot_deal_id    = $this->hubspotService->findDealByAccount($account);
            
            $account->save();

            $properties['digify_account_id']      = $account->digify_account_id;
            $properties['digify_account_created'] = $account->created_at->format('d/m/Y H:i:s');
            
            try{                
                $this->hubspotService->updateDealByContact($account, $properties);
            }
            catch (\Exception $e) {
                return [
                    'success' => false,
                    'message' => str_replace("|", "<br>", $e->getMessage()),
                ];
            }
        }

        return [
            'success' => true,
            'account' => $account,
        ];
    }

    public function loggedInAccount(AccountDigifyHubspot $account){

        $this->registerLog($account);

        if(empty($account->first_login)){
            $account->first_login = date('Y-m-d H:i:s');
            $account->save();
            $properties['digify_first_login'] = $account->first_login->format('d/m/Y H:i:s'); 
        }else{
            $properties['digify_login'] = date('d/m/Y H:i:s');
        }

        try{                
            $this->hubspotService->updateDealByContact($account, $properties);
        }
        catch (\Exception $e) {
            return [
                'success' => false,
                'message' => str_replace("|", "<br>", $e->getMessage()),
            ];
        }
        
        return [
            'success' => true,
            'account' => $account,
        ];
    }


    public function accountActions(AccountDigifyHubspot $account, array $data): array {
        
        $this->registerLog($data);

        $event = $data['event_dispared'] ?? null;

        $eventDefinitions = $this->getEventDefinitions();

        if (!isset($eventDefinitions[$event])) {
            return [
                'success' => false,
                'message' => 'Evento não suportado.',
                'event'   => $event,
            ];
        }

        $properties = $this->buildEventProperties(
            $event,
            $data,
            $eventDefinitions
        );

        try {
            $this->hubspotService->updateDealByContact(
                $account,
                $properties
            );

            return [
                'success' => true,
                'account' => $account,
                'event'   => $event,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => str_replace('|', '<br>', $e->getMessage()),
                'event'   => $event,
            ];
        }
    }


    /**
     * Mapeia os eventos recebidos do Digify
     * para as propriedades correspondentes no HubSpot.
     */
    private function getEventDefinitions(): array
    {
        return [
            // Conta
            'account.created' => [
                'property' => 'digify_account_created',
                'default'  => date('d/m/Y H:i:s'),
            ],
            'account.updated' => [
                'property' => 'digify_account_updated',
                'default'  => date('d/m/Y H:i:s'),
            ],
            'account_receipt.created' => [
                'property' => 'digify_account_receipt_created',
                'default'  => true,
            ],

            // Acesso
            'first_login' => [
                'property' => 'digify_first_login',
                'default'  => date('d/m/Y H:i:s'),
            ],
            'login' => [
                'property' => 'digify_login',
                'default'  => date('d/m/Y H:i:s'),
            ],
            'user_created' => [
                'property' => 'digify_user_created',
                'default'  => true,
            ],
            'permission_group_created' => [
                'property' => 'digify_permission_group_created',
                'default'  => true,
            ],

            // Configuração
            'pipeline_created' => [
                'property' => 'digify_pipeline_created',
                'default'  => date('d/m/Y H:i:s'),
            ],
            'pipeline_edited' => [
                'property' => 'digify_pipeline_edited',
                'default'  => date('d/m/Y H:i:s'),
            ],
            'stage_created' => [
                'property' => 'digify_stage_created',
                'default'  => true,
            ],
            'stage_edited' => [
                'property' => 'digify_stage_edited',
                'default'  => true,
            ],
            'stage_deleted' => [
                'property' => 'digify_stage_deleted',
                'default'  => true,
            ],
            'dashboard_customized' => [
                'property' => 'digify_dashboard_customized',
                'default'  => true,
            ],
            'proposal_template_created' => [
                'property' => 'digify_proposal_template_created',
                'default'  => true,
            ],
            'lead_status_configured' => [
                'property' => 'digify_lead_status_configured',
                'default'  => true,
            ],
            'lead_source_configured' => [
                'property' => 'digify_lead_source_configured',
                'default'  => true,
            ],
            'loss_reason_configured' => [
                'property' => 'digify_loss_reason_configured',
                'default'  => true,
            ],
            'call_outcome_configured' => [
                'property' => 'digify_call_outcome_configured',
                'default'  => true,
            ],

            // Módulos
            'module_added' => [
                'property' => 'digify_module_added',
                'default'  => true,
            ],
            'module_removed' => [
                'property' => 'digify_module_removed',
                'default'  => true,
            ],
            'module_first_access' => [
                'property' => 'digify_module_first_access',
                'default'  => true,
            ],
            'module_used' => [
                'property' => 'digify_module_used',
                'default'  => true,
            ],

            // Cadastros e importações
            'person_created' => [
                'property' => 'digify_person_created',
                'default'  => true,
            ],
            'people_imported' => [
                'property' => 'digify_people_imported',
                'default'  => true,
            ],
            'organization_created' => [
                'property' => 'digify_organization_created',
                'default'  => true,
            ],
            'organizations_imported' => [
                'property' => 'digify_organizations_imported',
                'default'  => true,
            ],
            'product_created' => [
                'property' => 'digify_product_created',
                'default'  => true,
            ],
            'products_imported' => [
                'property' => 'digify_products_imported',
                'default'  => true,
            ],
            'lead_created' => [
                'property' => 'digify_lead_created',
                'default'  => true,
            ],
            'lead_imported' => [
                'property' => 'digify_lead_imported',
                'default'  => true,
            ],
            'lead_captured' => [
                'property' => 'digify_lead_captured',
                'default'  => true,
            ],
            'import_completed' => [
                'property' => 'digify_import_completed',
                'default'  => true,
            ],

            // Vendas
            'deal_created' => [
                'property' => 'digify_deal_created',
                'default'  => true,
            ],
            'deal_stage_changed' => [
                'property' => 'digify_deal_stage_changed',
                'default'  => true,
            ],
            'deal_won' => [
                'property' => 'digify_deal_won',
                'default'  => true,
            ],
            'deal_lost' => [
                'property' => 'digify_deal_lost',
                'default'  => true,
            ],
            'loss_reason_selected' => [
                'property' => 'digify_loss_reason_selected',
                'default'  => true,
            ],
            'task_created' => [
                'property' => 'digify_task_created',
                'default'  => true,
            ],
            'task_completed' => [
                'property' => 'digify_task_completed',
                'default'  => true,
            ],
            'note_created' => [
                'property' => 'digify_note_created',
                'default'  => true,
            ],
            'mention_created' => [
                'property' => 'digify_mention_created',
                'default'  => true,
            ],

            // Propostas e preços
            'proposal_created' => [
                'property' => 'digify_proposal_created',
                'default'  => true,
            ],
            'proposal_sent' => [
                'property' => 'digify_proposal_sent',
                'default'  => true,
            ],
            'proposal_viewed' => [
                'property' => 'digify_proposal_viewed',
                'default'  => true,
            ],
            'proposal_accepted' => [
                'property' => 'digify_proposal_accepted',
                'default'  => true,
            ],
            'proposal_rejected' => [
                'property' => 'digify_proposal_rejected',
                'default'  => true,
            ],
            'price_table_created' => [
                'property' => 'digify_price_table_created',
                'default'  => true,
            ],
            'price_table_applied' => [
                'property' => 'digify_price_table_applied',
                'default'  => true,
            ],

            // Documentos e projetos
            'document_uploaded' => [
                'property' => 'digify_document_uploaded',
                'default'  => true,
            ],
            'document_linked_to_deal' => [
                'property' => 'digify_document_linked_to_deal',
                'default'  => true,
            ],
            'project_created' => [
                'property' => 'digify_project_created',
                'default'  => true,
            ],
            'project_linked_to_deal' => [
                'property' => 'digify_project_linked_to_deal',
                'default'  => true,
            ],

            // Analytics
            'dashboard_viewed' => [
                'property' => 'digify_dashboard_viewed',
                'default'  => true,
            ],
            'report_viewed' => [
                'property' => 'digify_report_viewed',
                'default'  => true,
            ],
            'pipeline_analytics_viewed' => [
                'property' => 'digify_pipeline_analytics_viewed',
                'default'  => true,
            ],
            'forecast_viewed' => [
                'property' => 'digify_forecast_viewed',
                'default'  => true,
            ],
            'sales_goal_created' => [
                'property' => 'digify_sales_goal_created',
                'default'  => true,
            ],

            // Automação, manuais e API
            'automation_created' => [
                'property' => 'digify_automation_created',
                'default'  => true,
            ],
            'automation_activated' => [
                'property' => 'digify_automation_activated',
                'default'  => true,
            ],
            'automation_executed' => [
                'property' => 'digify_automation_executed',
                'default'  => true,
            ],
            'business_manual_created' => [
                'property' => 'digify_business_manual_created',
                'default'  => true,
            ],
            'business_manual_used' => [
                'property' => 'digify_business_manual_used',
                'default'  => true,
            ],
            'api_token_created' => [
                'property' => 'digify_api_token_created',
                'default'  => true,
            ],
            'api_request_success' => [
                'property' => 'digify_api_request_success',
                'default'  => true,
            ],
            'webhook_created' => [
                'property' => 'digify_webhook_created',
                'default'  => true,
            ],
            'webhook_triggered' => [
                'property' => 'digify_webhook_triggered',
                'default'  => true,
            ],

            // Integrações
            'digisac_connected' => [
                'property' => 'digify_digisac_connected',
                'default'  => true,
            ],
        ];
    }


    /**
     * Constrói as propriedades que serão enviadas ao HubSpot
     * a partir do evento recebido pelo Digify.
     */
    private function buildEventProperties(
        string $event,
        array $data,
        array $eventDefinitions
    ): array {
        $definition = $eventDefinitions[$event];

        $property = $definition['property'];
        $default  = $definition['default'];

        $value = $data[$event] ?? null;

        if ($value === null || $value === '') {
            $value = $default;
        }

        return [
            $property => $value,
        ];
    }


    /**
     * Mantém somente propriedades permitidas pelo HubSpot/Digify.
     */
    public function filterAllowedProperties(array $properties): array
    {
        $allowedProperties = array_column(
            $this->getEventDefinitions(),
            'property'
        );

        return array_intersect_key(
            $properties,
            array_flip($allowedProperties)
        );
    }


    /*
    public function accountActions(AccountDigifyHubspot $account, array $data){
        
        $event_dispared = $data['event_dispared'];
        $event_value    = !empty($data[$event_dispared]) ? $data[$event_dispared] : '';

        $acceptedKeys = $this->acceptKey();

        if (!isset($acceptedKeys[$event_dispared])) {
            return [
                'success' => false,
                'message' => 'Erro ao processar informações, confira os dados abaixo: ',
                'event_dispared' => $event_dispared
            ]; 
        }

        $hubspotProperty = $acceptedKeys[$event_dispared];
        $acceptedKeysValues = $this->acceptKeyValue();

        $properties = [
            $hubspotProperty => $event_value ?? $acceptedKeysValues[$hubspotProperty],
        ];
                
        try{                
            $this->hubspotService->updateDealByContact($account, $properties);
            return [
                'success' => true,
                'account' => $account,
            ];
        }
        catch (\Exception $e) {
            return [
                'success' => false,
                'message' => str_replace("|", "<br>", $e->getMessage()),
            ];
        }     
        
    }

    public function filterProperties(array $properties): array
    {
        $acceptedProperties = $this->acceptKey();

        foreach ($properties as $key => $value) {

            // Remove propriedades que não são permitidas
            if (!array_key_exists($key, $acceptedProperties)) {
                $propertiesNotKey[] = $key; 
                unset($properties[$key]);
                continue;
            }

            // Se veio vazio, usa o valor padrão
            if ($value === '' || $value === null) {
                $properties[$key] = $acceptedProperties[$key];
            }
        }
        
        return ['properties' => $properties, 'propertiesNotKey' => $propertiesNotKey];
    }
   
    public function acceptKey(): array
    {
        return [
            // Conta
            'account.created'          => 'digify_account_created',
            'account.updated'          => 'digify_account_updated',
            'account_receipt.created'  => 'digify_account_receipt_created',

            // Acesso
            'first_login'              => 'digify_first_login',
            'login'                    => 'digify_login',
            'user_created'             => 'digify_user_created',
            'permission_group_created' => 'digify_permission_group_created',

            // Configuração
            'pipeline_created'         => 'digify_pipeline_created',
            'pipeline_edited'          => 'digify_pipeline_edited',
            'stage_created'            => 'digify_stage_created',
            'stage_edited'             => 'digify_stage_edited',
            'stage_deleted'            => 'digify_stage_deleted',
            'dashboard_customized'     => 'digify_dashboard_customized',
            'proposal_template_created'=> 'digify_proposal_template_created',
            'lead_status_configured'   => 'digify_lead_status_configured',
            'lead_source_configured'   => 'digify_lead_source_configured',
            'loss_reason_configured'   => 'digify_loss_reason_configured',
            'call_outcome_configured'  => 'digify_call_outcome_configured',

            // Módulos
            'module_added'             => 'digify_module_added',
            'module_removed'           => 'digify_module_removed',
            'module_first_access'      => 'digify_module_first_access',
            'module_used'              => 'digify_module_used',

            // Cadastros e importações
            'person_created'           => 'digify_person_created',
            'people_imported'          => 'digify_people_imported',
            'organization_created'     => 'digify_organization_created',
            'organizations_imported'   => 'digify_organizations_imported',
            'product_created'          => 'digify_product_created',
            'products_imported'        => 'digify_products_imported',
            'lead_created'             => 'digify_lead_created',
            'lead_imported'            => 'digify_lead_imported',
            'lead_captured'            => 'digify_lead_captured',
            'import_completed'         => 'digify_import_completed',

            // Vendas
            'deal_created'             => 'digify_deal_created',
            'deal_stage_changed'       => 'digify_deal_stage_changed',
            'deal_won'                 => 'digify_deal_won',
            'deal_lost'                => 'digify_deal_lost',
            'loss_reason_selected'     => 'digify_loss_reason_selected',
            'task_created'             => 'digify_task_created',
            'task_completed'           => 'digify_task_completed',
            'note_created'             => 'digify_note_created',
            'mention_created'          => 'digify_mention_created',

            // Propostas e preços
            'proposal_created'         => 'digify_proposal_created',
            'proposal_sent'            => 'digify_proposal_sent',
            'proposal_viewed'          => 'digify_proposal_viewed',
            'proposal_accepted'        => 'digify_proposal_accepted',
            'proposal_rejected'        => 'digify_proposal_rejected',
            'price_table_created'      => 'digify_price_table_created',
            'price_table_applied'      => 'digify_price_table_applied',

            // Documentos e projetos
            'document_uploaded'        => 'digify_document_uploaded',
            'document_linked_to_deal'  => 'digify_document_linked_to_deal',
            'project_created'          => 'digify_project_created',
            'project_linked_to_deal'   => 'digify_project_linked_to_deal',

            // Analytics
            'dashboard_viewed'         => 'digify_dashboard_viewed',
            'report_viewed'            => 'digify_report_viewed',
            'pipeline_analytics_viewed'=> 'digify_pipeline_analytics_viewed',
            'forecast_viewed'          => 'digify_forecast_viewed',
            'sales_goal_created'       => 'digify_sales_goal_created',

            // Automação, manuais e API
            'automation_created'       => 'digify_automation_created',
            'automation_activated'    => 'digify_automation_activated',
            'automation_executed'     => 'digify_automation_executed',
            'business_manual_created' => 'digify_business_manual_created',
            'business_manual_used'    => 'digify_business_manual_used',
            'api_token_created'       => 'digify_api_token_created',
            'api_request_success'     => 'digify_api_request_success',
            'webhook_created'         => 'digify_webhook_created',
            'webhook_triggered'       => 'digify_webhook_triggered',

            // Integrações
            'digisac_connected'        => 'digify_digisac_connected',
        ];
    }

    
   public function acceptKeyValue(): array {
        return [
            'digify_account_created' => true,
            'digify_account_id'      => null,
            'digify_first_login'     => true,
            'digify_login'           => true,

            'digify_pipeline_edited'  => date('d/m/Y H:i:s'),
            'digify_pipeline_created' => date('d/m/Y H:i:s'),
            'digify_stage_created'    => true,
            'digify_stage_edited'     => true,
            'digify_stage_deleted'    => true,

            'digify_dashboard_customized'      => true,
            'digify_proposal_template_created' => true,
            'digify_lead_status_configured'    => true,
            'digify_lead_source_configured'    => true,
            'digify_loss_reason_configured'    => true,
            'digify_call_outcome_configured'   => true,

            'digify_user_created'             => true,
            'digify_permission_group_created' => true,
            'digify_module_added'             => true,
            'digify_module_removed'           => true,
            'digify_module_first_access'      => true,
            'digify_module_used'              => true,
            'digify_person_created'           => true,
            'digify_people_imported'          => true,
            'digify_organization_created'     => true,
            'digify_organizations_imported'   => true,
            'digify_product_created'          => true,
            'digify_products_imported'        => true,
            'digify_lead_created'             => true,
            'digify_lead_imported'            => true,
            'digify_lead_captured'            => true,
            'digify_import_completed'         => true,

            'digify_deal_created'         => true,
            'digify_deal_stage_changed'   => true,
            'digify_deal_won'             => true,
            'digify_deal_lost'            => true,
            'digify_loss_reason_selected' => true,
            'digify_task_created'         => true,
            'digify_task_completed'       => true,
            'digify_note_created'         => true,
            'digify_mention_created'      => true,
            'digify_proposal_created'     => true,
            'digify_proposal_sent'        => true,
            'digify_proposal_viewed'      => true,
            'digify_proposal_accepted'    => true,
            'digify_proposal_rejected'    => true,
            'digify_price_table_created'  => true,
            'digify_price_table_applied'  => true,

            'digify_document_uploaded'         => true,
            'digify_document_linked_to_deal'   => true,
            'digify_project_created'           => true,
            'digify_project_linked_to_deal'    => true,
            'digify_dashboard_viewed'          => true,
            'digify_report_viewed'             => true,
            'digify_pipeline_analytics_viewed' => true,
            'digify_forecast_viewed'           => true,
            'digify_sales_goal_created'        => true,
            'digify_automation_created'        => true,
            'digify_automation_activated'      => true,
            'digify_automation_executed'       => true,
            'digify_business_manual_created'   => true,
            'digify_business_manual_used'      => true,
            'digify_api_token_created'         => true,
            'digify_api_request_success'       => true,
            'digify_webhook_created'           => true,
            'digify_webhook_triggered'         => true,
            'digify_digisac_connected'         => true,
            'digify_payment_method_added'      => true,
            'digify_first_payment_confirmed'   => true,
            'digify_first_payment_failed'      => true,

            'digify_recurring_payment_confirmed' => true,
            'digify_recurring_payment_failed'    => true,
            'digify_recurring_payment_recovered' => true,
            'digify_subscription_cancelled'      => true,

            'digify_active_days_7d'            => 0,
            'digify_active_users_7d'           => 0,
            'digify_days_since_last_key_event' => 0,
            'digify_key_events_7d'             => 0,
            'Digify_usage_drop_pct'            => 0,
        ];
    }

/*

Conta / faturamento (gatilhos de banco) 
account.created · account.updated · account_receipt.created

Acesso 
  first_login 
  login
  user_created 
  permission_group_created

Configuração 
  pipeline_created 
  pipeline_edited
  stage_created
  stage_edited
  stage_deleted
  dashboard_customized 
  proposal_template_created
  lead_status_configured 
  lead_source_configured 
  loss_reason_configured 
  call_outcome_configured

Módulos 
  module_added 
  module_removed 
  module_first_access 
  module_used

Cadastros e importações 
  person_created
  people_imported 
  organization_created 
  organizations_imported 
  product_created 
  products_imported 
  lead_created 
  lead_imported 
  lead_captured 
  import_completed

Vendas 
  deal_created 
  deal_stage_changed
  deal_won
  deal_lost
  loss_reason_selected 
  task_created
  task_completed 
  note_created
  mention_created

Propostas e preços 
  proposal_created 
  proposal_sent 
  proposal_viewed
  proposal_accepted 
  proposal_rejected
  price_table_created
  price_table_applied

Documentos e projetos 
  document_uploaded 
  document_linked_to_deal 
  project_created 
  project_linked_to_deal

Analytics dashboard_viewed 
  report_viewed
  pipeline_analytics_viewed 
  forecast_viewed
  sales_goal_created

Automação, manuais e API 
  automation_created
  automation_activated 
  automation_executed 
  business_manual_created 
  business_manual_used
  api_token_created
  api_request_success 
  webhook_created 
  webhook_triggered

Integrações
  digisac_connected
*/
}
