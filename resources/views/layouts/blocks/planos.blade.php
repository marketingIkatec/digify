@php

$budgetPlans = $budgetPlans ?? collect();
$budgetModules = $budgetModules ?? collect();
$budgetFeatures = $budgetFeatures ?? collect();

$planOrder = ['free', 'starter', 'growth', 'pro', 'enterprise'];
$planCtas = [
    'free' => 'Começar grátis',
    'starter' => 'Começar Starter',
    'growth' => 'Escolher Growth',
    'pro' => 'Falar com vendas',
    'enterprise' => 'Solicitar proposta',
];

$planMap = $budgetPlans->keyBy('key');
$digisacDiscount = $planMap->map(fn ($plan) => (float) ($plan->details['digisac_user_price'] ?? 0))->filter(fn ($value) => $value > 0)->min();

$planos = [];
foreach ($planOrder as $key) {
    $plan = $planMap->get($key);
    if (!$plan) {
        continue;
    }

    $details = $plan->details ?? [];

    $priceLabel = is_null($plan->price) ? 'Sob consulta' : 'R$ ' . number_format((float) $plan->price, 0, ',', '.');
    $monthlySuffix = is_null($plan->price) ? '' : '/usuário mês*';
    $monthlyNote = '';

    $usersMin = (int) ($details['users_min'] ?? 1);
    $usersMax = $details['users_max'] ?? null;
    if ($usersMax !== null && $usersMax !== '') {
        $usersText = 'Até ' . $usersMax . ' usuários';
    } elseif ($key === 'enterprise') {
        $usersText = 'Mínimo de ' . $usersMin . ' usuários';
    } elseif ($key === 'free') {
        $usersText = 'Até ' . $usersMin . ' usuários';
    } else {
        $usersText = 'A partir de ' . $usersMin . ' usuários';
    }

    if (!is_null($plan->price) && in_array($key, ['starter', 'growth', 'pro'], true)) {
        $monthlyTotal = (float) $plan->price * $usersMin;
        $monthlyNote = '* R$ ' . number_format($monthlyTotal, 0, ',', '.') . '/mês por ' . $usersMin . ' usuários';
    }

    $leadText = $details['leads'] ?? '—';
    $pipelineText = $details['pipelines'] ?? '—';
    $dashboardText = $details['dashboards'] ?? '—';
    $supportText = $details['support'] ?? '—';

    $normalizeBullet = function ($label, $value) {
        $text = trim((string) $value);
        if ($text === '' || $text === '—') {
            return '—';
        }

        $lower = mb_strtolower($text);
        if (str_contains($lower, 'ilimit')) {
            return match (mb_strtolower($label)) {
                'leads' => 'Leads ilimitados',
                'pipelines' => 'Pipelines ilimitados',
                'dashboards' => 'Dashboards ilimitados',
                default => $label . ' ilimitados',
            };
        }

        $suffix = ((int) $text === 1) ? rtrim($label, 's') : $label;
        return $text . ' ' . $suffix;
    };

    $leadLabel = is_numeric(str_replace(['.', ','], '', (string) $leadText)) ? 'leads' : 'leads';
    $pipelineLabel = is_numeric($pipelineText) ? 'pipeline' : 'pipelines';
    $dashboardLabel = is_numeric($dashboardText) ? 'dashboard' : 'dashboards';
    $supportLabel = match (mb_strtolower((string) $supportText)) {
        'e-mail', 'email' => 'Suporte por e-mail',
        'prioritário' => 'Suporte prioritário',
        'premium' => 'Suporte premium',
        'dedicado' => 'Suporte dedicado',
        default => 'Suporte ' . $supportText,
    };

    $planos[] = [
        'name' => $plan->name,
        'price' => $priceLabel,
        'monthly_suffix' => $monthlySuffix,
        'monthly_note' => $monthlyNote,
        'users' => $usersText,
        'features' => [
            $normalizeBullet('Leads', $leadText),
            $normalizeBullet('Pipelines', $pipelineText),
            $normalizeBullet('Dashboards', $dashboardText),
            $supportLabel,
        ],
        'cta' => $planCtas[$key] ?? 'Saiba mais',
        'featured' => $key === 'growth',
    ];
}

$comparisonDefinitions = [
    ['Usuários - Mínimo', 'users_min'],
    ['Contatos / Empresas', 'contacts'],
    ['Etapas por Pipeline', 'pipeline_steps'],
    ['Workspaces', 'workspaces'],
    ['Armazenamento', 'storage'],
    ['Automações', 'automations'],
    ['API REST', 'api_rest'],
    ['Webhooks', 'webhooks'],
    ['Integrações', 'integrations'],
    ['Permissões', 'permissions'],
    ['Aplicativo Mobile', 'mobile_app'],
];

$comparisonRows = [];
foreach ($comparisonDefinitions as [$label, $key]) {
    $row = [$label];
    foreach ($planOrder as $planKey) {
        $plan = $planMap->get($planKey);
        $value = $plan ? ($plan->details[$key] ?? null) : null;
        if (is_bool($value)) {
            $row[] = $value ? 'Sim' : 'Não';
        } elseif ($value === null || $value === '') {
            $row[] = '—';
        } else {
            $row[] = (string) $value;
        }
    }
    $comparisonRows[] = $row;
}

$featureRows = [];
foreach ($budgetFeatures as $feature) {
    $row = [$feature->name];
    foreach ($planOrder as $planKey) {
        $row[] = $feature->plans->contains('key', $planKey) ? 'Sim' : 'Não';
    }
    $featureRows[] = $row;
}

function renderPlanValue($value) {
    if ($value === 'Sim') {
        return '<span class="planos-check" aria-label="Incluso">✓</span>';
    }

    if ($value === 'Não') {
        return '<span class="planos-missing" aria-label="Não incluso">✕</span>';
    }

    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function renderPlanRow($row) {
    echo '<tr>';
    foreach ($row as $index => $value) {
        if ($index === 0) {
            echo '<th scope="row">' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '</th>';
        } else {
            echo '<td class="' . ($index === 3 ? 'is-featured' : '') . '">' . renderPlanValue($value) . '</td>';
        }
    }
    echo '</tr>';
}

@endphp

    <main id="main">
        <section class="planos-pricing" aria-labelledby="planos-title">
            <div class="container planos-pricing__wide">
                <div class="section-head--center">
                    <span class="section-label">Planos Digify</span>
                    <h1 class="section-title" id="planos-title">Planos para cada fase da operação</h1>
                    <p class="section-lead">Valores por usuário, cobrados mensalmente. Escolha o plano ideal para sua operação.</p>
                </div>

                <?php if ($digisacDiscount): ?>
                    <div class="planos-digisac-box" aria-label="Cliente Digisac">
                        <span class="planos-digisac-box__badge">Cliente Digisac</span>
                        <span class="planos-digisac-box__text">Desconto de R$ <?=number_format($digisacDiscount, 2, ',', '.');?> por usuário</span>
                    </div>
                <?php endif; ?>

                <div class="planos-grid">
                    <?php foreach ($planos as $plan): ?>
                        <article class="plan-card<?=$plan['featured'] ? ' plan-card--featured' : '';?>">
                            <?php if ($plan['featured']): ?>
                                <span class="plan-card__badge">Mais escolhido</span>
                            <?php endif; ?>
                            <div class="plan-card__head">
                                <h3 class="plan-card__name"><?=$plan['name'];?></h3>
                                <p class="plan-card__caption"><?php if ($plan['featured']): ?>O plano recomendado para operações em crescimento.<?php elseif ($plan['name'] === 'Free'): ?>Para começar a organizar o básico sem custo.<?php elseif ($plan['name'] === 'Starter'): ?>Para times pequenos que precisam vender com processo.<?php elseif ($plan['name'] === 'Pro'): ?>Para equipes que precisam de automação, API e controle avançado.<?php else: ?>Para empresas com regras, volume e suporte dedicados.<?php endif; ?></p>
                            </div>
                            <div class="plan-card__price">
                                <strong><?=$plan['price'];?></strong>
                                <?php if ($plan['monthly_suffix']): ?>
                                    <span><?=$plan['monthly_suffix'];?></span>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty(trim($plan['monthly_note']))): ?>
                                <p class="plan-card__note"><?=trim($plan['monthly_note']);?></p>
                            <?php elseif (!empty(trim($plan['users']))): ?>
                                <p class="plan-card__note"><?=trim($plan['users']);?></p>
                            <?php endif; ?>
                            <ul class="plan-card__features">
                                <?php foreach ($plan['features'] as $feature): ?>
                                    <li><?=$feature;?></li>
                                <?php endforeach; ?>
                            </ul>
                            <a href="https://app.digify.com.br/login?signup" class="button <?=$plan['featured'] ? 'button--white' : 'button--outline';?> plan-card__cta"><?=$plan['cta'];?></a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="planos-comparison" id="comparativo" aria-labelledby="comparison-title">
            <div class="container">
                <div class="section-head--center planos-comparison__head">
                    <span class="section-label">Comparativo completo</span>
                    <h2 class="section-title" id="comparison-title">Recursos por plano</h2>
                </div>

                <div class="planos-table-wrap planos-table-wrap--minimal" role="region" aria-label="Tabela de recursos por plano" tabindex="0">
                    <table class="planos-table planos-table--compact">
                        <thead>
                            <tr>
                                <th>Recursos</th>
                                <th>Free</th>
                                <th>Starter</th>
                                <th class="is-featured">Growth</th>
                                <th>Pro</th>
                                <th>Enterprise</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($comparisonRows as $row) renderPlanRow($row); ?>
                        </tbody>
                    </table>
                </div>

                <h2 class="planos-comparison__subtitle">Funcionalidades inclusas</h2>

                <div class="planos-table-wrap planos-table-wrap--minimal" role="region" aria-label="Tabela de funcionalidades inclusas" tabindex="0">
                    <table class="planos-table planos-table--compact">
                        <thead>
                            <tr>
                                <th>Funcionalidade</th>
                                <th>Free</th>
                                <th>Starter</th>
                                <th class="is-featured">Growth</th>
                                <th>Pro</th>
                                <th>Enterprise</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($featureRows as $row) renderPlanRow($row); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="planos-cta">
            <div class="container planos-cta__inner">
                <span class="section-label">Precisa de ajuda?</span>
                <h2>Não sabe qual plano escolher?</h2>
                <p>Conte sobre seu volume de leads, número de vendedores e nível de automação desejado. A equipe Digify indica o plano mais adequado para sua operação.</p>
                <div class="planos-cta__actions">
                    <a href="{{route('home')}}#falar-com-especialista" class="button button--white button--lg">Falar com consultor</a>
                    <a href="https://app.digify.com.br/login?signup" class="button button--outline button--lg">COMECE GRÁTIS</a>
                </div>
            </div>
        </section>
    </main>
