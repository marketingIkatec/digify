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
}