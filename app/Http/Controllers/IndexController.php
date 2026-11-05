<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\PageBlock;
use App\Models\AccountDigifyHubspot;
use App\Services\HubspotCampaignService;

class IndexController extends Controller
{
    public function index(Request $request){
        $item = Page::where(['slug' => 'index',
                             'status' => true])->first();

        return view('pages.index', compact('item'));
    }

    /*public function atualizaApi(HubspotCampaignService $hubspotService){
        $accounts = AccountDigifyHubspot::all();
        foreach ($accounts as $account) {
            if($account->first_login){
                $properties['data_de_fim_do_trial__digify']    = $account->first_login->copy()->addDays(30)->format('Y-m-d'); 
                $hubspotService->updateDealByContact($account, $properties); 
            }
        }
    }*/
}
