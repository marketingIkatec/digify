<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AccountDigifyHubspot;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\HubspotCampaignService;
use App\Services\DigifyHubspotService;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Api\createAccountDigifyRequest;
use App\Http\Requests\Api\accountActionsRequest;
use App\Http\Requests\Api\accountLoggedInRequest;

class AccountDigifyHubspotController extends Controller
{
    /*
      verifica se o email já existe no tabela, se não existir precisa criar esta conta, 
      vinculando o account_id do digify com o account_id da hubspot
      chamar o post abaixo na tela de Criar Conta
      https://app.digify.com.br/login?signup

      POST https://digify.com.br/api/app-digify/create-account
      Bearer Token: ****
      {
        "event": "create-account",             //evento
        "digify_account_id": "",              // id do account da conta app.digify.com.br
        "email": "jorge.nunes@ikatec.com.br" // email preenchido no formulário de criaçao de conta
      }

    */
    public function createAccountDigifyStore(createAccountDigifyRequest $request, DigifyHubspotService $digifyService): JsonResponse
    {        
        if($request->validated()){
            $data = $request->all();  

            $response = $digifyService->verifyDigifyAccount($data);
            if($response['success']){
                return $this->returnSuccessJson($data, $response['account']);
            }        
            return response()->json([$response], 422);    
        }
    }

    /*
    POST https://digify.com.br/api/app-digify/account-logged-in
      Bearer Token: ****
      {
        "event": "account_logged_in",            //evento
        "digify_account_id": "1234567",         // id do account da conta app.digify.com.br
        "email": "jorge.nunes@ikatec.com.br"   // opcional
      }
    */
    public function accountLoggedInStore(accountLoggedInRequest $request, DigifyHubspotService $digifyService): JsonResponse
    {        
        if($request->validated()){
            $data = $request->all();  

            $response  = $digifyService->verifyDigifyAccount($data);
            if($response['success']){
                $response = $digifyService->loggedInAccount($response['account']);
            
                if($response['success']){
                    return $this->returnSuccessJson($data, $response['account']);
                }   
            }        
                 
            return response()->json([$response], 422);
                     
        }
    }

    /*
    POST https://digify.com.br/api/app-digify/account-actions
      Bearer Token: ****
      {
        "event": "account-actions",            //evento        
        "digify_account_id": "1234567",
        "digify_pipeline_edited": "",         // se vier vazio eu assumo um valor
      }
    */
    public function accountActionsStore(accountActionsRequest $request, DigifyHubspotService $digifyService): JsonResponse
    {        
        if($request->validated()){
            $data = $request->all();  

            $response  = $digifyService->verifyDigifyAccount($data);
            if($response['success']){        
                $response  = $digifyService->accountActions($response['account'], $data);

                if($response['success']){
                    return $this->returnSuccessJson($data, $response['account']);
                }        
            }        
            return response()->json([$response], 422);
        }
    }

    private function returnSuccessJson(array $data, AccountDigifyHubspot $account): JsonResponse {
        return response()->json([
            'success' => true,
            'event'   => $data['event'],
            'message' => 'Informação recebida com sucesso!',
            'data'    => $account,
        ], 200);
    }

    public function viewLead(Request $request){        
    
        $query = AccountDigifyHubspot::query();       

        $propertyOptions = AccountDigifyHubspot::query()
            ->whereNotNull('properties')
            ->get()
            ->flatMap(function ($lead) {
                return collect($lead->properties ?? [])
                    ->filter(fn ($value) => $value !== '' && $value !== null)
                    ->keys();
            })
            ->unique()
            ->sort()
            ->values();

        if ($request->filled('emailAccountID')) {
            $query->where(function ($query) use ($request) {
                $query->where('email', 'like', '%' . $request->emailAccountID . '%')
                    ->orWhere('digify_account_id', 'like', '%' . $request->emailAccountID . '%');
            });
        }

        if ($request->filled('property')) {
            $query->where('properties', 'like', '%"' . $request->property . '"%');
        }

        $dataEvents = [
            'digify_person_created',
            'digify_people_imported',
            'digify_organization_created',
            'digify_organizations_imported',
            'digify_lead_created',
            'digify_lead_imported',
            'digify_lead_captured',
            'digify_import_completed',
        ];

        $executionEvents = [
            'digify_deal_stage_changed',
            'digify_task_created',
            'digify_task_completed',
            'digify_note_created',
        ];

        $financialRiskEvents = [
            'digify_first_payment_failed',
            'digify_recurring_payment_failed',
            'digify_subscription_cancelled',
        ];

        $strongAdoptionEvents = [
            'digify_deal_won',
            'digify_deal_lost',
            'digify_task_completed',
            'digify_proposal_sent',
            'digify_document_linked_to_deal',
            'digify_module_used',
            'digify_automation_executed',
        ];

        $setupEvents = [
            'digify_pipeline_created',
            'digify_pipeline_edited',
            'digify_stage_created',
            'digify_stage_edited',
            'digify_stage_deleted',
            'digify_dashboard_customized',
            'digify_user_created',
            'digify_permission_group_created',
            'digify_module_added',
            'digify_module_first_access',
        ];

        $statusOptions = [
            'risk' => 'Risco financeiro',
            'strong' => 'Adocao forte',
            'active' => 'Ativado',
            'operation' => 'Operacao inserida',
            'setup' => 'Setup',
            'explore' => 'Exploracao',
            'empty' => 'Nao iniciado / Sem eventos',
        ];

        $allLeads = (clone $query)->get();

        if ($request->filled('digifyStatus')) {
            $allLeads = $allLeads->filter(function ($lead) use ($request, $dataEvents, $executionEvents, $financialRiskEvents, $strongAdoptionEvents, $setupEvents) {
                return $this->resolveDigifyStatusClass(
                    $lead->properties ?? [],
                    $dataEvents,
                    $executionEvents,
                    $financialRiskEvents,
                    $strongAdoptionEvents,
                    $setupEvents
                ) === $request->digifyStatus;
            })->values();
        }

        $statsLeads = $allLeads;

        $dashboardStats = [
            'totalAccounts' => $statsLeads->count(),
            'withProperties' => $statsLeads->filter(fn ($lead) => !empty($lead->properties))->count(),
            'activatedAccounts' => $statsLeads->filter(function ($lead) use ($dataEvents, $executionEvents) {
                $properties = $lead->properties ?? [];

                return !empty($properties['digify_deal_created'])
                    && count(array_intersect(array_keys($properties), array_merge($dataEvents, $executionEvents))) > 0;
            })->count(),
            'riskAccounts' => $statsLeads->filter(function ($lead) use ($financialRiskEvents) {
                return count(array_intersect(array_keys($lead->properties ?? []), $financialRiskEvents)) > 0;
            })->count(),
        ];

        // Paginação com 10 por página
        // Ordenação
        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'desc');

        $allLeads = $sortDirection === 'asc'
            ? $allLeads->sortBy($sortField)
            : $allLeads->sortByDesc($sortField);

        $page = $request->get('page', 1);
        $perPage = 10;
        $leads = new \Illuminate\Pagination\LengthAwarePaginator(
            $allLeads->forPage($page, $perPage),
            $allLeads->count(),
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        
        $route = 'admin.pages.leads.api-digify'; 
        
        return view($route)
                ->with('leads', $leads)
                ->with('dashboardStats', $dashboardStats)
                ->with('propertyOptions', $propertyOptions)
                ->with('statusOptions', $statusOptions)
                ->with('formTypes', $formTypes ?? [])
                ->with('sortField', $sortField)
                ->with('sortDirection', $sortDirection);
    }

    private function resolveDigifyStatusClass(array $properties, array $dataEvents, array $executionEvents, array $financialRiskEvents, array $strongAdoptionEvents, array $setupEvents): string
    {
        $propertyKeys = array_keys($properties);

        $hasAccountCreated = !empty($properties['digify_account_created']);
        $hasFirstLogin = !empty($properties['digify_first_login']);
        $hasSetup = count(array_intersect($propertyKeys, $setupEvents)) > 0;
        $hasData = count(array_intersect($propertyKeys, $dataEvents)) > 0;
        $hasDeal = !empty($properties['digify_deal_created']);
        $hasExecution = count(array_intersect($propertyKeys, $executionEvents)) > 0;
        $hasStrongAdoption = count(array_intersect($propertyKeys, $strongAdoptionEvents)) > 0;
        $hasFinancialRisk = count(array_intersect($propertyKeys, $financialRiskEvents)) > 0;
        $isActivated = $hasDeal && ($hasData || $hasExecution);

        if ($hasFinancialRisk) {
            return 'risk';
        }

        if ($hasStrongAdoption) {
            return 'strong';
        }

        if ($isActivated) {
            return 'active';
        }

        if ($hasDeal || $hasData) {
            return 'operation';
        }

        if ($hasSetup) {
            return 'setup';
        }

        if ($hasFirstLogin || !empty($properties['digify_login']) || !empty($properties['digify_dashboard_viewed'])) {
            return 'explore';
        }

        return $hasAccountCreated ? 'empty' : 'empty';
    }
}
