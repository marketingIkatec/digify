<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\PageBlock;
use App\Services\HubspotCampaignService;
use App\Models\BudgetPlan;
use App\Models\BudgetModule;
use App\Models\BudgetFeature;

class IndexController extends Controller
{
    public function index(Request $request){
        $item = Page::where(['slug' => 'index',
                             'status' => true])->first();

        $budgetPlans = BudgetPlan::query()
            ->with([
                'modules' => function ($query) {
                    $query->orderBy('sort_order');
                },
                'features' => function ($query) {
                    $query->orderBy('sort_order');
                },
                'extraPrices' => function ($query) {
                    $query->orderBy('sort_order');
                },
            ])
            ->orderBy('sort_order')
            ->get();

        $budgetModules = BudgetModule::query()
            ->with(['plans' => function ($query) {
                $query->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get();

        $budgetFeatures = BudgetFeature::query()
            ->with(['plans' => function ($query) {
                $query->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get();

        return view('pages.index', compact('item', 'budgetPlans', 'budgetModules', 'budgetFeatures'));
    }
}
