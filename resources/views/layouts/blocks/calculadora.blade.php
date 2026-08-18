@php
    $plans = \App\Models\BudgetPlan::query()
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

    $modules = \App\Models\BudgetModule::query()
        ->with(['plans' => function ($query) {
            $query->orderBy('sort_order');
        }])
        ->orderBy('sort_order')
        ->get();

    $features = \App\Models\BudgetFeature::query()
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

@endphp

@extends('app')

@section('css_js')
<style>
    .calculator-page {
        padding: calc(var(--nav-h) + 36px) 0 var(--space-20);
    }

    .calculator-hero {
        margin-bottom: var(--space-10);
        max-width: 860px;
    }

    .calculator-kicker {
        display: inline-block;
        margin-bottom: var(--space-4);
        font-size: var(--font-size-2xs);
        font-weight: var(--font-weight-extrabold);
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--color-primary);
    }

    .calculator-title {
        margin-bottom: var(--space-4);
        font-size: clamp(2rem, 4vw, 3.5rem);
        font-weight: var(--font-weight-extrabold);
        letter-spacing: -0.03em;
        line-height: 1.08;
        color: var(--color-ink);
    }

    .calculator-lead {
        max-width: 760px;
        font-size: var(--font-size-lg);
        line-height: 1.7;
        color: var(--color-text-secondary);
    }

    .calculator-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: var(--space-4);
        flex-wrap: wrap;
        margin-bottom: var(--space-8);
        padding: var(--space-4) var(--space-5);
        background: var(--color-white);
        border: 1px solid var(--color-border);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
    }

    .calculator-bar__left {
        display: flex;
        align-items: center;
        gap: var(--space-3);
        flex-wrap: wrap;
    }

    .calculator-bar__label {
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-semibold);
        color: var(--color-text-secondary);
    }

    .calculator-bar__actions {
        display: flex;
        align-items: center;
        gap: var(--space-3);
        flex-wrap: wrap;
    }

    .btn-ghost {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 14px;
        border-radius: var(--radius-sm);
        border: 1px solid var(--color-border);
        background: var(--color-white);
        color: var(--color-text);
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-semibold);
        transition: all var(--transition-fast);
    }

    .btn-ghost:hover,
    .btn-ghost:focus-visible {
        border-color: var(--color-primary);
        color: var(--color-primary);
        background: var(--color-primary-light);
    }

    .btn-ghost svg {
        width: 14px;
        height: 14px;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        border-radius: var(--radius-sm);
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-semibold);
        cursor: pointer;
        border: 1.5px dashed var(--color-border);
        background: transparent;
        color: var(--color-text-secondary);
        transition: all var(--transition-fast);
    }

    .btn-add:hover {
        background: var(--color-white);
        border-color: var(--color-primary);
        color: var(--color-primary);
    }

    .columns-wrap {
        display: grid;
        gap: 14px;
        margin-bottom: var(--space-12);
    }

    .columns-wrap.cols-1 { grid-template-columns: minmax(0, 1fr); max-width: 520px; }
    .columns-wrap.cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .columns-wrap.cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }

    .scenario-card {
        background: var(--color-white);
        border-radius: var(--radius-xl);
        border: 1px solid var(--color-border);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        box-shadow: var(--shadow-sm);
    }

    .sc-color-0 { --sc: var(--color-primary); --sc-lt: var(--color-primary-light); }
    .sc-color-1 { --sc: #7c3aed; --sc-lt: #ede9fe; }
    .sc-color-2 { --sc: #0f6e56; --sc-lt: #e1f5ee; }

    .scenario-card.winner {
        border-color: var(--sc);
        box-shadow: 0 16px 38px rgba(10, 80, 255, 0.08);
    }

    .sc-header {
        padding: 18px 18px 14px;
        border-bottom: 1px solid var(--color-border);
    }

    .sc-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 10px;
    }

    .sc-name-input {
        font-size: var(--font-size-md);
        font-weight: var(--font-weight-bold);
        color: var(--color-ink);
        border: none;
        background: transparent;
        outline: none;
        width: 160px;
        padding: 2px 4px;
        border-radius: 4px;
        font-family: var(--font-family-display);
    }

    .sc-name-input:focus { background: var(--color-primary-light); }

    .sc-actions { display: flex; gap: 6px; }

    .sc-icon-btn {
        width: 28px;
        height: 28px;
        border: 1px solid var(--color-border);
        border-radius: 8px;
        background: var(--color-bg-2);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--color-text-secondary);
        transition: all var(--transition-fast);
    }

    .sc-icon-btn:hover {
        background: var(--color-white);
        color: var(--color-primary);
        border-color: var(--color-primary);
    }

    .sc-icon-btn.danger:hover {
        background: #fce8e8;
        border-color: #f4aaaa;
        color: #a02020;
    }

    .plan-pills { display: flex; gap: 5px; flex-wrap: wrap; }


    .plan-pill {
        padding: 4px 10px;
        border-radius: 999px;
        border: 1px solid var(--color-border);
        background: var(--color-bg-2);
        font-size: var(--font-size-2xs);
        font-weight: var(--font-weight-semibold);
        cursor: pointer;
        color: var(--color-text-secondary);
        transition: all var(--transition-fast);
    }

    .plan-pill:hover,
    .plan-pill.active {
        border-color: var(--sc);
        color: var(--sc);
        background: var(--sc-lt);
    }

    .plan-details {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 8px;
        margin-top: 10px;
        padding: 12px;
        background: var(--color-bg-2);
        border: 1px solid var(--color-border);
        border-radius: var(--radius-md);
    }

    .plan-detail {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .plan-detail .k {
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: var(--color-text-muted);
    }

    .plan-detail .v {
        font-size: var(--font-size-sm);
        font-weight: var(--font-weight-semibold);
        color: var(--color-text);
    }

    .sc-body {
        padding: 14px 18px;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .digisac-row {
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--color-bg-2);
        border: 1px solid var(--color-border);
        border-radius: var(--radius-sm);
        padding: 9px 12px;
        cursor: pointer;
    }

    .digisac-row input { accent-color: var(--color-primary); cursor: pointer; }
    .digisac-row .dg-label { font-size: var(--font-size-sm); font-weight: var(--font-weight-semibold); color: var(--color-text); flex: 1; }
    .digisac-row .dg-disc { font-size: var(--font-size-xs); color: var(--color-text-secondary); font-weight: var(--font-weight-medium); }

    .cfg-section-title {
        font-size: var(--font-size-2xs);
        font-weight: var(--font-weight-extrabold);
        text-transform: uppercase;
        letter-spacing: .09em;
        color: var(--color-text-muted);
        margin-bottom: 6px;
    }

    .cfg-row { display: flex; align-items: center; gap: 8px; margin-bottom: 7px; }
    .cfg-row label { flex: 1; font-size: var(--font-size-sm); color: var(--color-text); }
    .cfg-row .cfg-price { font-size: var(--font-size-2xs); color: var(--color-text-muted); min-width: 70px; text-align: right; }

    .mini-stepper { display: flex; align-items: center; gap: 4px; }
    .mini-btn {
        width: 24px;
        height: 24px;
        border: 1px solid var(--color-border);
        border-radius: 6px;
        background: var(--color-bg-2);
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--color-text);
        font-weight: var(--font-weight-semibold);
        line-height: 1;
        transition: all var(--transition-fast);
    }

    .mini-btn:disabled {
        opacity: .35;
        cursor: not-allowed;
    }

    .mini-btn:hover { background: var(--color-primary-light); border-color: var(--color-primary); color: var(--color-primary); }
    .mini-val { font-size: var(--font-size-sm); font-weight: var(--font-weight-bold); min-width: 22px; text-align: center; color: var(--color-ink); }

    .mods-wrap { display: flex; flex-wrap: wrap; gap: 5px; }

    .mod-chip {
        padding: 4px 9px;
        border-radius: 999px;
        border: 1px solid var(--color-border);
        background: var(--color-bg-2);
        font-size: var(--font-size-2xs);
        font-weight: var(--font-weight-medium);
        cursor: pointer;
        color: var(--color-text-secondary);
        transition: all var(--transition-fast);
        white-space: nowrap;
    }

    .mod-chip:hover { border-color: var(--sc); color: var(--sc); }
    .mod-chip.active { border-color: var(--sc); color: var(--sc); background: var(--sc-lt); }
    .mod-chip.included { border-color: var(--color-green-dark); color: var(--color-green-dark); background: #e8fbf4; cursor: default; }

    .sc-footer {
        border-top: 1px solid var(--color-border);
        padding: 14px 18px;
        background: var(--color-bg-2);
    }

    .sc-total-label { font-size: var(--font-size-2xs); color: var(--color-text-muted); margin-bottom: 4px; }
    .sc-total-val { font-size: 24px; font-weight: var(--font-weight-extrabold); color: var(--color-ink); }
    .sc-total-val.highlight { color: var(--sc); }
    .sc-breakdown { margin-top: 8px; display: flex; flex-direction: column; gap: 3px; }
    .sc-breakdown-row { display: flex; justify-content: space-between; font-size: var(--font-size-2xs); color: var(--color-text-muted); }
    .sc-breakdown-row .bv { color: var(--color-text); font-weight: var(--font-weight-medium); }

    .plan-yes { color: var(--color-green-dark); font-weight: var(--font-weight-semibold); }
    .plan-no { color: var(--color-text-muted); }

    .winner-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--sc);
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 999px;
        margin-top: 8px;
    }

    .compare-wrap { margin-bottom: var(--space-8); }
    .compare-wrap h2 {
        font-size: var(--font-size-xs);
        font-weight: var(--font-weight-extrabold);
        color: var(--color-ink);
        text-transform: uppercase;
        letter-spacing: .07em;
        margin-bottom: var(--space-4);
    }

    .compare-table-scroll { overflow-x: auto; }
    .compare-table {
        width: 100%;
        border-collapse: collapse;
        background: var(--color-white);
        border-radius: var(--radius-lg);
        overflow: hidden;
        border: 1px solid var(--color-border);
        box-shadow: var(--shadow-sm);
    }

    .compare-table th {
        padding: 12px 16px;
        font-size: var(--font-size-xs);
        font-weight: var(--font-weight-bold);
        text-align: left;
        border-bottom: 1px solid var(--color-border);
        background: var(--color-bg-2);
        color: var(--color-text-secondary);
    }

    .compare-table th:first-child { width: 180px; }
    .compare-table td {
        padding: 10px 16px;
        font-size: var(--font-size-xs);
        color: var(--color-text-secondary);
        border-bottom: .5px solid var(--color-border);
        vertical-align: middle;
    }

    .compare-table tr:last-child td { border-bottom: none; }
    .compare-table td:first-child { font-weight: var(--font-weight-medium); color: var(--color-text-secondary); }
    .compare-table .section-row td {
        background: var(--color-bg-2);
        font-size: 10px;
        font-weight: var(--font-weight-extrabold);
        text-transform: uppercase;
        letter-spacing: .08em;
        color: var(--color-text-muted);
        padding: 8px 16px;
        border-bottom: .5px solid var(--color-border);
    }

    .check-yes { color: var(--color-green-dark); font-size: 14px; }
    .check-no  { color: var(--color-border); font-size: 14px; }
    .check-add { color: var(--color-primary); font-size: 11px; font-weight: var(--font-weight-semibold); }
    .delta-chip { display: inline-block; padding: 2px 8px; border-radius: 12px; font-size: 11px; font-weight: 700; }
    .delta-pos  { background: #fce8e8; color: #a02020; }
    .delta-neg  { background: #e8fbf4; color: var(--color-green-dark); }
    .delta-zero { background: var(--color-bg-2); color: var(--color-text-muted); }
    @media (max-width: 900px) {
        .columns-wrap.cols-2,
        .columns-wrap.cols-3 { grid-template-columns: 1fr; }
    }

    @media (max-width: 640px) {
        .calculator-page { padding-top: 24px; }
        .calculator-title { font-size: clamp(1.8rem, 8vw, 2.8rem); }
    }

    @media print {
        body { background: #fff; padding: 0; }
        .site-header,
        .calculator-hero,
        .calculator-bar,
        .btn-add,
        .print-btn,
        .site-footer,
        .whatsapp-floating,
        .back-to-top,
        .modal-overlay {
            display: none !important;
        }

        .mini-btn {
            display: none !important;
        }

        .mini-stepper {
            gap: 0;
        }

        .columns-wrap {
            display: flex !important;
            flex-wrap: wrap;
            align-items: flex-start;
            max-width: none;
            gap: 12px;
            margin: 0;
        }

        .scenario-card {
            flex: 0 0 calc(50% - 6px);
            max-width: calc(50% - 6px);
            box-shadow: none;
            margin: 0;
            break-inside: avoid;
            page-break-inside: avoid;
        }

        .scenario-card:nth-child(2n) {
            break-after: page;
            page-break-after: always;
        }

        .scenario-card:last-child {
            break-after: auto;
            page-break-after: auto;
        }

        .compare-wrap {
            display: block !important;
            page-break-before: always;
            break-before: page;
            margin-top: 0;
        }

        .compare-table {
            box-shadow: none;
        }
    }
</style>
@endsection

@section('content')
<section class="calculator-page">
    <div class="container">
        <div class="calculator-hero">
            <span class="calculator-kicker">Calculadora de orçamento</span>
            <h1 class="calculator-title">Comparativo de Orçamento</h1>
        </div>

        <div class="calculator-bar">
            <div class="calculator-bar__left">
                <span class="calculator-bar__label">Cenários:</span>
                <button class="btn-add" id="addBtn" onclick="addScenario()">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Adicionar cenário
                </button>
            </div>
            <div class="calculator-bar__actions">
                <button class="btn-ghost print-btn" onclick="window.print()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                    Imprimir / PDF
                </button>
            </div>
        </div>

        <div class="columns-wrap cols-1" id="columnsWrap"></div>

        <div class="compare-wrap" id="compareWrap">
            <h2>Tabela Comparativa</h2>
            <div class="compare-table-scroll">
                <table class="compare-table" id="compareTable"></table>
            </div>
        </div>
    </div>
</section>

<script>
const PLANS = @json($plansData);
const EXTRA_PRICES = @json($extraPrices);
const MODULES = @json($modulesData);
const FEATURES = @json($featuresData);

let scenarios = [], nextId = 0;
function planMinUsers(plan) {
  const details = (PLANS[plan] && PLANS[plan].details) ? PLANS[plan].details : {};
  return Number(details.users_min || 1);
}

function planMaxUsers(plan) {
  const details = (PLANS[plan] && PLANS[plan].details) ? PLANS[plan].details : {};
  const max = details.users_max;
  return (max === null || max === undefined || max === '') ? null : Number(max);
}

function planPipelinesUnlimited(plan) {
  const details = (PLANS[plan] && PLANS[plan].details) ? PLANS[plan].details : {};
  return String(details.pipelines || '').toLowerCase() === 'ilimitados';
}

function planInitialCount(plan, key) {
  if (key === 'pipelines' && planPipelinesUnlimited(plan)) return 0;
  const details = (PLANS[plan] && PLANS[plan].details) ? PLANS[plan].details : {};
  const raw = details[key];
  if (raw === null || raw === undefined || raw === '') return 0;
  if (typeof raw === 'number') return raw;
  const text = String(raw).replace(',', '.');
  const parsed = parseFloat(text);
  if (Number.isFinite(parsed)) return parsed;
  const match = text.match(/\d+(?:\.\d+)?/);
  if (match) return Number(match[0]);
  return Number.isFinite(parsed) ? parsed : 0;
}

function extraQty(plan, key, value) {
  return Math.max(0, Number(value || 0) - planInitialCount(plan, key));
}

function initialPlanUsers(plan) {
  const max = planMaxUsers(plan);
  return max !== null ? max : planMinUsers(plan);
}

function newScenario(name, plan) {
  const initialPlan = plan || 'starter';
  const initialUsers = initialPlanUsers(initialPlan);
  return {
    id: nextId++,
    name,
    plan: initialPlan,
    users: initialUsers,
    digisac: false,
    workspaces: planInitialCount(initialPlan, 'workspaces'),
    pipelines: planInitialCount(initialPlan, 'pipelines'),
    dashboards: planInitialCount(initialPlan, 'dashboards'),
    automations: planInitialCount(initialPlan, 'automations'),
    storage: planInitialCount(initialPlan, 'storage'),
    modules: {},
  };
}
function addScenario() {
  if(scenarios.length>=3) return;
  const names=['Cenário A','Cenário B','Cenário C'], plans=['starter','growth','pro'];
  scenarios.push(newScenario(names[scenarios.length], plans[scenarios.length]));
  render();
}
function removeScenario(id) { scenarios=scenarios.filter(s=>s.id!==id); render(); }
function duplicateScenario(id) {
  if(scenarios.length>=3) return;
  const dup=JSON.parse(JSON.stringify(scenarios.find(s=>s.id===id)));
  dup.id=nextId++;
  dup.name+=' (cópia)';
  dup.users=initialPlanUsers(dup.plan);
  dup.workspaces=planInitialCount(dup.plan, 'workspaces');
  dup.pipelines=planInitialCount(dup.plan, 'pipelines');
  dup.dashboards=planInitialCount(dup.plan, 'dashboards');
  dup.automations=planInitialCount(dup.plan, 'automations');
  dup.storage=planInitialCount(dup.plan, 'storage');
  scenarios.push(dup);
  render();
}
function calcTotal(sc) {
  const p=PLANS[sc.plan]; if(!p||p.price===null) return null;
  const ep=EXTRA_PRICES[sc.plan] || {};
  const digisacPrice = Number((PLANS[sc.plan].details && PLANS[sc.plan].details.digisac_user_price) || 0);
  const disc=sc.digisac ? digisacPrice : 0;
  let total=Math.max(0,p.price-disc)*sc.users;
  if(sc.plan!=='free'){
    const workspaces = extraQty(sc.plan, 'workspaces', sc.workspaces);
    const pipelines = extraQty(sc.plan, 'pipelines', sc.pipelines);
    const dashboards = extraQty(sc.plan, 'dashboards', sc.dashboards);
    const automations = extraQty(sc.plan, 'automations', sc.automations);
    const storage = extraQty(sc.plan, 'storage', sc.storage);
    total+=(workspaces*(ep.workspaces||0))+(pipelines*(ep.pipelines||0))+(dashboards*(ep.dashboards||0))+(automations*(ep.automations||0))+(storage*(ep.storage||0));
  }
  MODULES.forEach(m=>{ if(!m.included.includes(sc.plan)&&sc.modules[m.id]&&m.price>0) total+=m.price; });
  return total;
}
function fmt(v){ return 'R$ '+v.toFixed(2).replace('.',',').replace(/\B(?=(\d{3})+(?!\d))/g,'.'); }

function detailLabel(key) {
  const labels = {
    annual_price: 'Preço anual',
    users_min: 'Usuários mínimos',
    users_max: 'Usuários máximos',
    leads: 'Leads',
    contacts: 'Contatos / Empresas',
    pipelines: 'Pipelines',
    pipeline_steps: 'Etapas por pipeline',
    dashboards: 'Dashboards',
    workspaces: 'Workspaces',
    storage: 'Armazenamento',
    automations: 'Automações',
    api_rest: 'API REST',
    webhooks: 'Webhooks',
    integrations: 'Integrações',
    permissions: 'Permissões',
    mobile_app: 'Aplicativo Mobile',
    support: 'Suporte',
    digisac_user_price: 'Usuário Digisac',
  };

  return labels[key] || key;
}

function detailValue(value) {
  if (value === null || value === undefined || value === '') return '—';
  if (typeof value === 'boolean') return value ? 'Sim' : 'Não';
  if (typeof value === 'number') return value === 0 ? '0' : value.toString();
  return String(value);
}

function detailDisplay(key, value) {
  if (key === 'annual_price') {
    return (value === null || value === undefined) ? 'Sob consulta' : `${fmt(Number(value))}/user`;
  }

  if (key === 'digisac_user_price') {
    return value === null || value === undefined ? '—' : `${fmt(Number(value))}/user`;
  }

  return detailValue(value);
}

function planDetailDisplay(plan, key, value) {
  return detailDisplay(key, value);
}

function compareExtraLabel(value) {
  if (value === null || value === undefined || value === '') return '—';
  const text = String(value);
  if (text.toLowerCase() === 'ilimitados' || text.toLowerCase() === 'ilimitado') return text;
  if (/^\d+(?:[.,]\d+)?\s*gb$/i.test(text)) return text;
  const parsed = Number(text);
  return Number.isFinite(parsed) ? text : text;
}

function compareStorageLabel(sc) {
  const value = compareExtraValue(sc, 'storage');
  if (value === null || value === undefined || value === '') return '—';
  const text = String(value);
  if (!Number.isFinite(Number(text))) return text;
  return /gb$/i.test(text) ? text : `${text} GB`;
}

function compareExtraValue(sc, key) {
  const d = (PLANS[sc.plan] && PLANS[sc.plan].details) ? PLANS[sc.plan].details : {};
  const raw = d[key];
  if (raw !== null && raw !== undefined && raw !== '') {
    const text = String(raw).trim();
    if (text !== '' && Number.isNaN(Number(text))) {
      return raw;
    }

    if (Number(sc[key]) === planInitialCount(sc.plan, key)) return raw;
  }
  return sc[key];
}

function compareSelectedModules(sc) {
  const names = [];
  MODULES.forEach((m) => {
    if (!m.included.includes(sc.plan) && sc.modules[m.id] && m.price > 0) {
      names.push(m.name);
    }
  });
  return names.length ? names.join(', ') : '—';
}

function renderPlanDetails(sc) {
  const d = (PLANS[sc.plan] && PLANS[sc.plan].details) ? PLANS[sc.plan].details : {};
  const keys = ['annual_price', 'users_min', 'users_max', 'leads', 'contacts', 'pipelines', 'pipeline_steps', 'dashboards', 'workspaces', 'storage', 'automations', 'api_rest', 'webhooks', 'integrations', 'permissions', 'mobile_app', 'support', 'digisac_user_price'];

  return `
    <div class="plan-details">
      ${keys.map((key) => `
        ${(key === 'digisac_user_price' && Number(d[key] || 0) === 0) ? '' : `
        <div class="plan-detail">
          <span class="k">${detailLabel(key)}</span>
          <span class="v">${planDetailDisplay(sc.plan, key, d[key])}</span>
        </div>
      `}
      `).join('')}
    </div>
  `;
}

function render() {
  renderColumns(); renderCompareTable();
  document.getElementById('addBtn').style.display=scenarios.length>=3?'none':'';
  const w=document.getElementById('columnsWrap');
  w.className='columns-wrap cols-'+Math.max(1,scenarios.length);
}

function renderColumns() {
  const wrap=document.getElementById('columnsWrap');
  const totals=scenarios.map(s=>calcTotal(s)).filter(v=>v!==null);
  const minTotal=totals.length?Math.min(...totals):null;
  wrap.innerHTML=scenarios.map((sc,idx)=>{
    const total=calcTotal(sc), isWinner=total!==null&&total===minTotal&&totals.length>1;
    const ep=EXTRA_PRICES[sc.plan]||EXTRA_PRICES.starter;
    const isConsult = PLANS[sc.plan].price === null;
    const planPills=Object.entries(PLANS).map(([k,v])=>`<button class="plan-pill${sc.plan===k?' active':''}" onclick="setPlan(${sc.id},'${k}')">${v.name}</button>`).join('');
    const modChips=MODULES.map(m=>{
      const isIncl=m.included.includes(sc.plan), isAct=sc.modules[m.id];
      const cls=isIncl?'included':isAct?'active':'';
      const oc=isIncl?'':` onclick="toggleMod(${sc.id},'${m.id}')"`;
      const priceL=isIncl?'✓ incluso':m.price===0?'grátis':fmt(m.price);
      return `<span class="mod-chip ${cls}"${oc} title="${priceL}">${m.name}</span>`;
    }).join('');
    const digisacPrice = Number((PLANS[sc.plan].details && PLANS[sc.plan].details.digisac_user_price) || 0);
    const disc=sc.digisac ? digisacPrice : 0;
    const netPPU=Math.max(0,(PLANS[sc.plan].price||0)-disc);
    const totalStr=total===null?'Sob consulta':fmt(total);
    let bRows = isConsult
      ? `<div class="sc-breakdown-row"><span>Valor</span><span class="bv">Sob consulta</span></div>`
      : `<div class="sc-breakdown-row"><span>Plano (${sc.users} user${sc.users>1?'s':''} × ${fmt(netPPU)})</span><span class="bv">${fmt(netPPU*sc.users)}</span></div>`;
    if(!isConsult && sc.digisac) bRows+=`<div class="sc-breakdown-row"><span>Desconto Digisac</span><span class="bv" style="color:var(--green)">−${fmt(disc*sc.users)}</span></div>`;
    if(!isConsult && sc.plan!=='free') {
      const workspaces = extraQty(sc.plan, 'workspaces', sc.workspaces);
      const pipelines = extraQty(sc.plan, 'pipelines', sc.pipelines);
      const dashboards = extraQty(sc.plan, 'dashboards', sc.dashboards);
      const automations = extraQty(sc.plan, 'automations', sc.automations);
      const storage = extraQty(sc.plan, 'storage', sc.storage);
      const extSub=(workspaces*(ep.workspaces||0))+(pipelines*(ep.pipelines||0))+(dashboards*(ep.dashboards||0))+(automations*(ep.automations||0))+(storage*(ep.storage||0));
      if(extSub>0) {
        const extNames=[];
        if(workspaces>0) extNames.push(`Workspaces +${workspaces}`);
        if(pipelines>0) extNames.push(`Pipelines +${pipelines}`);
        if(dashboards>0) extNames.push(`Dashboards +${dashboards}`);
        if(automations>0) extNames.push(`Automações +${automations}`);
        if(storage>0) extNames.push(`Armazenamento +${storage} GB`);
        bRows+=`<div class="sc-breakdown-row"><span>Adicionais${extNames.length ? `: ${extNames.join(', ')}` : ''}</span><span class="bv">${fmt(extSub)}</span></div>`;
      }
    }
    if(!isConsult) {
      let modSub=0;
      const modNames=[];
      MODULES.forEach(m=>{
        if(!m.included.includes(sc.plan)&&sc.modules[m.id]&&m.price>0) {
          modSub+=m.price;
          modNames.push(m.name);
        }
      });
      if(modSub>0) bRows+=`<div class="sc-breakdown-row"><span>Módulos extras${modNames.length ? `: ${modNames.join(', ')}` : ''}</span><span class="bv">${fmt(modSub)}</span></div>`;
    }
    const dupStyle=scenarios.length>=3?'display:none':'';
    return `
<div class="scenario-card sc-color-${idx}${isWinner?' winner':''}">
  <div class="sc-header">
    <div class="sc-top">
      <input class="sc-name-input" type="text" value="${sc.name}" onchange="setName(${sc.id},this.value)" />
      <div class="sc-actions">
        <button class="sc-icon-btn" style="${dupStyle}" title="Duplicar" onclick="duplicateScenario(${sc.id})">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
        </button>
        <button class="sc-icon-btn danger" title="Remover" onclick="removeScenario(${sc.id})">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
        </button>
      </div>
    </div>
    <div class="plan-pills">${planPills}</div>
    ${renderPlanDetails(sc)}
  </div>
  <div class="sc-body">
      ${(!isConsult && digisacPrice > 0) ? `
      <div class="digisac-row" onclick="toggleDigisac(${sc.id})">
        <input type="checkbox" ${sc.digisac?'checked':''} onchange="toggleDigisac(${sc.id})" onclick="event.stopPropagation()" />
        <span class="dg-label">Cliente Digisac</span>
        <span class="dg-disc">−${fmt(digisacPrice)}/user</span>
      </div>` : ''}
      <div>
      ${Number(PLANS[sc.plan].price || 0) > 0 ? `
      <div class="cfg-section-title">Usuários e adicionais</div>
      ${cfgRow(sc,'users','Usuários',ep,planMinUsers(sc.plan),planMaxUsers(sc.plan))}
      ${cfgRow(sc,'workspaces','Workspaces extras',ep,planInitialCount(sc.plan, 'workspaces'))}
      ${planPipelinesUnlimited(sc.plan) ? '' : cfgRow(sc,'pipelines','Pipelines extras',ep,planInitialCount(sc.plan, 'pipelines'))}
      ${cfgRow(sc,'dashboards','Dashboards extras',ep,planInitialCount(sc.plan, 'dashboards'))}
      ${cfgRow(sc,'automations','Automações extras',ep,planInitialCount(sc.plan, 'automations'))}
      ${cfgRow(sc,'storage','Armazenamento extra (GB)',ep,planInitialCount(sc.plan, 'storage'))}` : ''}
    </div>
    ${Number(PLANS[sc.plan].price || 0) > 0 ? `
    <div>
      <div class="cfg-section-title">Módulos</div>
      <div class="mods-wrap">${modChips}</div>
    </div>` : ''}
  </div>
  <div class="sc-footer">
    <div class="sc-total-label">Total mensal estimado</div>
    <div class="sc-total-val${isWinner?' highlight':''}">${totalStr}</div>
    <div class="sc-breakdown">${bRows}</div>
    ${isWinner?`<div class="winner-badge">✓ Menor custo</div>`:''}
  </div>
</div>`;
  }).join('');
}

function cfgRow(sc,key,label,ep,min,max){
  const val=sc[key];
  const unitP=key==='users'?null:(ep[key]||0);
  const pStr=unitP?`${fmt(unitP)}/un`:'';
  const disableDown = val <= min;
  const disableUp = max !== null && max !== undefined && val >= max;
  return `<div class="cfg-row"><label>${label}</label><span class="cfg-price">${pStr}</span><div class="mini-stepper"><button class="mini-btn" ${disableDown ? 'disabled' : ''} onclick="changeVal(${sc.id},'${key}',-1,${min},${max})">−</button><span class="mini-val">${val}</span><button class="mini-btn" ${disableUp ? 'disabled' : ''} onclick="changeVal(${sc.id},'${key}',1,${min},${max})">+</button></div></div>`;
}

function renderCompareTable(){
  const table=document.getElementById('compareTable');
  if(scenarios.length<2){document.getElementById('compareWrap').style.display='none';return;}
  document.getElementById('compareWrap').style.display='';
  const totals=scenarios.map(s=>calcTotal(s));
  const minT=Math.min(...totals.filter(v=>v!==null));
  const cols=scenarios.length+1;
  let h=`<thead><tr><th>Comparativo</th>`;
  const colors=['var(--c0)','var(--c1)','var(--c2)'];
  scenarios.forEach((sc,i)=>{ h+=`<th style="color:${colors[i]}">${sc.name}<br><span style="font-weight:400;color:var(--ink4)">${PLANS[sc.plan].name}</span></th>`; });
  h+=`</tr></thead><tbody>`;
  h+=`<tr class="section-row"><td colspan="${cols}">Custo mensal</td></tr>`;
  h+=`<tr><td>Total / mês</td>`;
  scenarios.forEach((sc,i)=>{
    const t=totals[i], str=t===null?'Sob consulta':fmt(t), isMin=t===minT&&scenarios.length>1;
    h+=`<td><strong style="font-size:14px;${isMin?`color:${colors[i]}`:''}">${str}</strong></td>`;
  });
  h+=`</tr>`;
  if(scenarios.length>1&&totals[0]!==null){
    h+=`<tr><td>Diferença vs. ${scenarios[0].name}</td>`;
    scenarios.forEach((sc,i)=>{
      if(i===0){h+=`<td><span class="delta-chip delta-zero">referência</span></td>`;return;}
      if(totals[i]===null){h+=`<td>—</td>`;return;}
       const delta=totals[i]-totals[0], cls=delta>0?'delta-pos':delta<0?'delta-neg':'delta-zero';
       h+=`<td><span class="delta-chip ${cls}">${delta>0?'+':''}${fmt(Math.abs(delta))}</span></td>`;
    });
    h+=`</tr>`;
  }
  h+=`<tr class="section-row"><td colspan="${cols}">Detalhes do plano</td></tr>`;
  const digisacVisible = scenarios.some(sc => Number((PLANS[sc.plan].details && PLANS[sc.plan].details.digisac_user_price) || 0) > 0);
  const detailKeys = ['annual_price', 'users_min', 'users_max', 'leads', 'contacts', 'pipeline_steps', 'webhooks', 'integrations', 'permissions', 'mobile_app', 'support'];
  if (digisacVisible) detailKeys.push('digisac_user_price');
  detailKeys.forEach((key) => {
    h+=`<tr><td>${detailLabel(key)}</td>`;
    scenarios.forEach((sc) => {
      const d = (PLANS[sc.plan] && PLANS[sc.plan].details) ? PLANS[sc.plan].details : {};
      const value = d[key];
      const txt = detailDisplay(key, value);
      const cell = (key === 'digisac_user_price' && Number(value || 0) === 0)
        ? '<span class="check-no">—</span>'
        : (typeof value === 'boolean' ? (value ? '<span class="plan-yes">✓</span>' : '<span class="plan-no">—</span>') : txt);
      h+=`<td>${cell}</td>`;
    });
    h+=`</tr>`;
  });
  h+=`<tr><td>Usuários</td>`;
  scenarios.forEach(sc=>{h+=`<td>${sc.users}</td>`;});
  h+=`</tr><tr><td>Desconto Digisac</td>`;
  scenarios.forEach(sc=>{h+=`<td>${sc.digisac?'<span class="check-yes">✓</span>':'<span class="check-no">—</span>'}</td>`;});
  h+=`</tr>`;
  ['workspaces','pipelines','dashboards','automations','storage'].forEach((key) => {
    h+=`<tr class="compare-extra-row compare-extra-${key}" id="compare-extra-${key}" data-extra-key="${key}"><td class="compare-extra-label">${detailLabel(key)}</td>`;
    scenarios.forEach((sc) => {
      h+=`<td class="compare-extra-value">${key === 'storage' ? compareStorageLabel(sc) : compareExtraLabel(compareExtraValue(sc, key))}</td>`;
    });
    h+=`</tr>`;
  });
  h+=`<tr class="section-row"><td colspan="${cols}">Funcionalidades do plano</td></tr>`;
  FEATURES.forEach(f=>{
    if (f.label === 'Forecast' || f.label === 'Projetos' || f.label === 'Documentos') return;
    h+=`<tr><td>${f.label}</td>`;
    scenarios.forEach(sc=>{h+=`<td>${f.plans.includes(sc.plan)?'<span class="check-yes">✓</span>':'<span class="check-no">—</span>'}</td>`;});
    h+=`</tr>`;
  });
  h+=`<tr class="compare-modules-extra-row" id="compare-modules-extra-row"><td class="compare-modules-extra-label">Módulos extras</td>`;
  scenarios.forEach(sc=>{ h+=`<td class="compare-modules-extra-value">${compareSelectedModules(sc)}</td>`; });
  h+=`</tr>`;
  h+=`<tr class="section-row"><td colspan="${cols}">Módulos</td></tr>`;
  const renderedModuleIds = new Set();
  MODULES.forEach(m=>{
    if (renderedModuleIds.has(m.id)) return;
    renderedModuleIds.add(m.id);
    if (m.name === 'Pipeline Analytics' && !scenarios.some(sc => m.included.includes(sc.plan) || sc.modules[m.id])) return;
    h+=`<tr><td>${m.name}</td>`;
    scenarios.forEach(sc=>{
      const isI=m.included.includes(sc.plan), isA=sc.modules[m.id];
      if(isI) h+=`<td><span class="check-yes">✓</span> <span style="font-size:10px;color:var(--ink4)">incluso</span></td>`;
      else if(isA) h+=`<td><span class="check-add">+ ${m.price===0?'grátis':fmt(m.price)}</span></td>`;
      else h+=`<td><span class="check-no">—</span></td>`;
    });
    h+=`</tr>`;
  });
  h+=`</tbody>`;
  table.innerHTML=h;
}

function setPlan(id,plan){
  const sc=scenarios.find(s=>s.id===id);
  if(sc){
    sc.plan=plan;
    sc.users=initialPlanUsers(plan);
    sc.workspaces=planInitialCount(plan, 'workspaces');
    sc.pipelines=planInitialCount(plan, 'pipelines');
    sc.dashboards=planInitialCount(plan, 'dashboards');
    sc.automations=planInitialCount(plan, 'automations');
    sc.storage=planInitialCount(plan, 'storage');
    render();
  }
}
function setName(id,name){const sc=scenarios.find(s=>s.id===id);if(sc){sc.name=name;renderCompareTable();}}
function toggleDigisac(id){const sc=scenarios.find(s=>s.id===id);if(sc){sc.digisac=!sc.digisac;render();}}
function changeVal(id,key,delta,min,max){const sc=scenarios.find(s=>s.id===id);if(sc){const next=Math.max(min,sc[key]+delta);sc[key]=max !== null && max !== undefined ? Math.min(max,next) : next;render();}}
function toggleMod(id,modId){const sc=scenarios.find(s=>s.id===id);if(sc){sc.modules[modId]=!sc.modules[modId];render();}}

scenarios.push(newScenario('Cenário A','starter'));
scenarios.push(newScenario('Cenário B','growth'));
render();
</script>
@endsection
