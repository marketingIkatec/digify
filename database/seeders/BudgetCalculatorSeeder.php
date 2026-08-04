<?php

namespace Database\Seeders;

use App\Models\BudgetFeature;
use App\Models\BudgetModule;
use App\Models\BudgetPlan;
use App\Models\BudgetPlanExtraPrice;
use Illuminate\Database\Seeder;

class BudgetCalculatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'key' => 'free',
                'name' => 'Free',
                'price' => 0,
                'details' => [
                    'annual_price' => 0,
                    'users_min' => 1,
                    'users_max' => 3,
                    'leads' => '500',
                    'contacts' => '500',
                    'pipelines' => 1,
                    'pipeline_steps' => 'Até 5',
                    'dashboards' => 1,
                    'workspaces' => 1,
                    'storage' => '0 GB',
                    'automations' => '—',
                    'api_rest' => false,
                    'webhooks' => false,
                    'integrations' => false,
                    'permissions' => true,
                    'mobile_app' => true,
                    'support' => 'E-mail',
                    'digisac_user_price' => 0,
                ],
                'sort_order' => 1,
            ],
            [
                'key' => 'starter',
                'name' => 'Starter',
                'price' => 49,
                'details' => [
                    'annual_price' => 46,
                    'users_min' => 4,
                    'users_max' => null,
                    'leads' => '10.000',
                    'contacts' => '10.000',
                    'pipelines' => 'Até 3',
                    'pipeline_steps' => 'Até 15',
                    'dashboards' => 3,
                    'workspaces' => 1,
                    'storage' => '5 GB',
                    'automations' => 5,
                    'api_rest' => false,
                    'webhooks' => false,
                    'integrations' => true,
                    'permissions' => true,
                    'mobile_app' => true,
                    'support' => 'E-mail',
                    'digisac_user_price' => 29.90,
                ],
                'sort_order' => 2,
            ],
            [
                'key' => 'growth',
                'name' => 'Growth ⭐',
                'price' => 69,
                'details' => [
                    'annual_price' => 62,
                    'users_min' => 4,
                    'users_max' => null,
                    'leads' => '100.000',
                    'contacts' => '100.000',
                    'pipelines' => 'Ilimitados',
                    'pipeline_steps' => 'Até 25',
                    'dashboards' => 5,
                    'workspaces' => 3,
                    'storage' => '20 GB',
                    'automations' => 20,
                    'api_rest' => false,
                    'webhooks' => 'Até 20',
                    'integrations' => true,
                    'permissions' => true,
                    'mobile_app' => true,
                    'support' => 'Prioritário',
                    'digisac_user_price' => 26.90,
                ],
                'sort_order' => 3,
            ],
            [
                'key' => 'pro',
                'name' => 'Pro',
                'price' => 99,
                'details' => [
                    'annual_price' => 85,
                    'users_min' => 4,
                    'users_max' => null,
                    'leads' => 'Ilimitado',
                    'contacts' => 'Ilimitado',
                    'pipelines' => 'Ilimitados',
                    'pipeline_steps' => 'Ilimitadas',
                    'dashboards' => 8,
                    'workspaces' => 5,
                    'storage' => '100 GB',
                    'automations' => 80,
                    'api_rest' => true,
                    'webhooks' => 'Ilimitados',
                    'integrations' => true,
                    'permissions' => true,
                    'mobile_app' => true,
                    'support' => 'Premium',
                    'digisac_user_price' => 24.21,
                ],
                'sort_order' => 4,
            ],
            [
                'key' => 'enterprise',
                'name' => 'Enterprise',
                'price' => null,
                'details' => [
                    'annual_price' => null,
                    'users_min' => 10,
                    'users_max' => null,
                    'leads' => 'Ilimitado',
                    'contacts' => 'Ilimitado',
                    'pipelines' => 'Ilimitados',
                    'pipeline_steps' => 'Ilimitadas',
                    'dashboards' => 'Custom',
                    'workspaces' => 'Ilimitados',
                    'storage' => 'Custom',
                    'automations' => 'Ilimitadas',
                    'api_rest' => true,
                    'webhooks' => 'Ilimitados',
                    'integrations' => true,
                    'permissions' => true,
                    'mobile_app' => true,
                    'support' => 'Dedicado',
                    'digisac_user_price' => 21.79,
                ],
                'sort_order' => 5,
            ],
        ];

        foreach ($plans as $plan) {
            BudgetPlan::updateOrCreate(['key' => $plan['key']], $plan);
        }

        $extraPrices = [
            'free' => ['workspaces' => 0, 'users' => 0, 'pipelines' => 0, 'dashboards' => 0, 'automations' => 0, 'storage' => 0],
            'starter' => ['workspaces' => 89.90, 'users' => 49.00, 'pipelines' => 9.90, 'dashboards' => 9.90, 'automations' => 19.90, 'storage' => 9.90],
            'growth' => ['workspaces' => 80.90, 'users' => 69.00, 'pipelines' => 8.90, 'dashboards' => 8.90, 'automations' => 17.90, 'storage' => 8.90],
            'pro' => ['workspaces' => 72.80, 'users' => 99.00, 'pipelines' => 8.00, 'dashboards' => 8.00, 'automations' => 16.10, 'storage' => 8.00],
            'enterprise' => ['workspaces' => 65.52, 'users' => 0, 'pipelines' => 7.20, 'dashboards' => 7.20, 'automations' => 14.49, 'storage' => 7.20],
        ];
        $extraNames = [
            'workspaces' => 'Workspaces Extras',
            'users' => 'Usuário',
            'pipelines' => 'Pipelines Extras',
            'dashboards' => 'Dashboards Extras',
            'automations' => 'Automação Extra',
            'storage' => 'Armazenamento +1GB',
        ];

        foreach ($extraPrices as $planKey => $prices) {
            $plan = BudgetPlan::where('key', $planKey)->firstOrFail();

            foreach ($prices as $key => $price) {
                BudgetPlanExtraPrice::updateOrCreate(
                    ['budget_plan_id' => $plan->id, 'key' => $key],
                    [
                        'name' => $extraNames[$key],
                        'price' => $price,
                        'sort_order' => array_search($key, array_keys($extraNames), true) + 1,
                    ]
                );
            }
        }

        $modules = [
            ['key' => 'ativ_av', 'name' => 'Atividades Avançadas', 'price' => 9.90, 'included' => []],
            ['key' => 'cal_com', 'name' => 'Calendário Comercial', 'price' => 0, 'included' => ['free', 'starter', 'growth', 'pro', 'enterprise']],
            ['key' => 'metas', 'name' => 'Metas de Vendas', 'price' => 89.90, 'included' => ['growth', 'pro', 'enterprise']],
            ['key' => 'forecast', 'name' => 'Forecast', 'price' => 89.90, 'included' => ['growth', 'pro', 'enterprise']],
            ['key' => 'propostas', 'name' => 'Propostas Comerciais', 'price' => 89.90, 'included' => ['starter', 'growth', 'pro', 'enterprise']],
            ['key' => 'projetos', 'name' => 'Projetos', 'price' => 19.90, 'included' => ['growth', 'pro', 'enterprise']],
            ['key' => 'docs', 'name' => 'Documentos', 'price' => 9.90, 'included' => ['growth', 'pro', 'enterprise']],
            ['key' => 'tab_prec', 'name' => 'Tabelas de Preços', 'price' => 19.90, 'included' => ['growth', 'pro', 'enterprise']],
            ['key' => 'pip_anal', 'name' => 'Pipeline Analytics', 'price' => 69.90, 'included' => ['pro', 'enterprise']],
            ['key' => 'audit', 'name' => 'Auditoria', 'price' => 19.90, 'included' => ['pro', 'enterprise']],
            ['key' => 'api', 'name' => 'API REST', 'price' => 29.90, 'included' => ['pro', 'enterprise']],
            ['key' => 'webhook', 'name' => 'Webhook', 'price' => 19.90, 'included' => ['growth', 'pro', 'enterprise']],
            ['key' => 'equipes', 'name' => 'Equipes', 'price' => 29.90, 'included' => ['growth', 'pro', 'enterprise']],
            ['key' => 'emails', 'name' => 'E-mails', 'price' => 29.90, 'included' => ['growth', 'pro', 'enterprise']],
            ['key' => 'manual_negocios', 'name' => 'Manual de Negócios', 'price' => 99.00, 'included' => ['pro', 'enterprise']],
        ];

        foreach ($modules as $index => $moduleData) {
            $module = BudgetModule::updateOrCreate(
                ['key' => $moduleData['key']],
                [
                    'name' => $moduleData['name'],
                    'price' => $moduleData['price'],
                    'sort_order' => $index + 1,
                    'active' => true,
                ]
            );

            $module->plans()->sync($this->planIds($moduleData['included']));
        }

        $features = [
            ['name' => 'CRM Kanban', 'plans' => ['free', 'starter', 'growth', 'pro', 'enterprise']],
            ['name' => 'Cadastro de Leads', 'plans' => ['starter', 'growth', 'pro', 'enterprise']],
            ['name' => 'Contatos / Empresas', 'plans' => ['free', 'starter', 'growth', 'pro', 'enterprise']],
            ['name' => 'Agenda / Calendário', 'plans' => ['free', 'starter', 'growth', 'pro', 'enterprise']],
            ['name' => 'Atividades', 'plans' => ['free', 'starter', 'growth', 'pro', 'enterprise']],
            ['name' => 'Feed', 'plans' => ['starter', 'growth', 'pro', 'enterprise']],
            ['name' => 'Notas', 'plans' => ['starter', 'growth', 'pro', 'enterprise']],
            ['name' => 'Produtos', 'plans' => ['free', 'starter', 'growth', 'pro', 'enterprise']],
            ['name' => 'Propostas Comerciais', 'plans' => ['starter', 'growth', 'pro', 'enterprise']],
            ['name' => 'Relatórios', 'plans' => ['free', 'starter', 'growth', 'pro', 'enterprise']],
            ['name' => 'Campos Personalizados', 'plans' => ['free', 'starter', 'growth', 'pro', 'enterprise']],
            ['name' => 'Dashboards', 'plans' => ['free', 'starter', 'growth', 'pro', 'enterprise']],
            ['name' => 'Captura de Leads', 'plans' => ['starter', 'growth', 'pro', 'enterprise']],
            ['name' => 'E-mails', 'plans' => ['growth', 'pro', 'enterprise']],
            ['name' => 'Integrações', 'plans' => ['starter', 'growth', 'pro', 'enterprise']],
            ['name' => 'Forecast', 'plans' => ['growth', 'pro', 'enterprise']],
            ['name' => 'Metas Comerciais', 'plans' => ['growth', 'pro', 'enterprise']],
            ['name' => 'Equipes', 'plans' => ['growth', 'pro', 'enterprise']],
            ['name' => 'Projetos', 'plans' => ['growth', 'pro', 'enterprise']],
            ['name' => 'Documentos', 'plans' => ['growth', 'pro', 'enterprise']],
            ['name' => 'Manual de Negócios', 'plans' => ['pro', 'enterprise']],
            ['name' => 'Auditoria', 'plans' => ['pro', 'enterprise']],
            ['name' => 'API Completa', 'plans' => ['pro', 'enterprise']],
            ['name' => 'Multiempresa', 'plans' => ['pro', 'enterprise']],
            ['name' => 'Pipeline Analytics', 'plans' => ['pro', 'enterprise']],
        ];

        foreach ($features as $index => $featureData) {
            $feature = BudgetFeature::updateOrCreate(
                ['name' => $featureData['name']],
                [
                    'sort_order' => $index + 1,
                    'active' => true,
                ]
            );

            $feature->plans()->sync($this->planIds($featureData['plans']));
        }
    }

    private function planIds(array $keys): array
    {
        return BudgetPlan::whereIn('key', $keys)->pluck('id')->all();
    }
}
