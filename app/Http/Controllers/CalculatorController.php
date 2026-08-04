<?php

namespace App\Http\Controllers;

use App\Models\BudgetFeature;
use App\Models\BudgetModule;
use App\Models\BudgetPlan;

class CalculatorController extends Controller
{
    public function index()
    {
        $plans = BudgetPlan::query()
            ->with([
                'extraPrices' => function ($query) {
                    $query->orderBy('sort_order');
                },
                'modules' => function ($query) {
                    $query->orderBy('sort_order');
                },
                'features' => function ($query) {
                    $query->orderBy('sort_order');
                },
            ])
            ->orderBy('sort_order')
            ->get();

        $modules = BudgetModule::query()
            ->with(['plans' => function ($query) {
                $query->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get();

        $features = BudgetFeature::query()
            ->with(['plans' => function ($query) {
                $query->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get();

        $plansData = $plans->mapWithKeys(function ($plan) {
            return [
                $plan->key => [
                    'name' => $plan->name,
                    'price' => $plan->price === null ? null : (float) $plan->price,
                    'details' => $plan->details ?? [],
                ],
            ];
        });

        $extraPrices = $plans->mapWithKeys(function ($plan) {
            return [
                $plan->key => $plan->extraPrices->mapWithKeys(function ($extra) {
                    return [$extra->key => (float) $extra->price];
                })->all(),
            ];
        });

        $modulesData = $modules->map(function ($module) {
            return [
                'id' => $module->key,
                'name' => $module->name,
                'price' => (float) $module->price,
                'included' => $module->plans->pluck('key')->values()->all(),
            ];
        })->values();

        $featuresData = $features->map(function ($feature) {
            return [
                'label' => $feature->name,
                'plans' => $feature->plans->pluck('key')->values()->all(),
            ];
        })->values();

        return view('pages.calculadora', [
            'plans' => $plans,
            'modules' => $modules,
            'features' => $features,
            'plansData' => $plansData,
            'extraPrices' => $extraPrices,
            'modulesData' => $modulesData,
            'featuresData' => $featuresData,
        ]);
    }
}
