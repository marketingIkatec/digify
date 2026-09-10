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

    public function verifyDigifyAccount($data){

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

    public function accountActions(AccountDigifyHubspot $account, array $Properties){
        
        $properties = $this->filterProperties($Properties);

        if(count($properties['properties']) > 1){        
            try{                
                $this->hubspotService->updateDealByContact($account, $properties['properties']);
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

        return [
            'success' => false,
            'message' => 'Erro ao processar informações, confira os dados abaixo: ',
            'properties' => $properties['propertiesNotKey']
        ];        
        
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

   public function acceptKey(): array {
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
}
