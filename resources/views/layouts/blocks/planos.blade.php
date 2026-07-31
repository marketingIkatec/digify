@php

$planos = [
    [
        'name' => 'Free',
        'price' => 'R$ 0',
        'caption' => 'Para começar a organizar o básico sem custo.',
        'users' => 'Até 3 usuários',
        'leads' => '500 leads',
        'pipelines' => '1 pipeline',
        'dashboards' => '1 dashboard',
        'support' => 'Suporte por e-mail',
        'cta' => 'Começar grátis',
        'featured' => false,
    ],
    [
        'name' => 'Starter',
        'price' => 'R$ 49',
        'caption' => 'Para times pequenos que precisam vender com processo.',
        'users' => '* R$ 196/mês por 4 usuários  ',
        'leads' => '10.000 leads',
        'pipelines' => 'Até 3 pipelines',
        'dashboards' => '3 dashboards',
        'support' => 'Suporte por e-mail',
        'cta' => 'Começar Starter',
        'featured' => false,
    ],
    [
        'name' => 'Growth',
        'price' => 'R$ 69',
        'caption' => 'O plano recomendado para operações em crescimento.',
        'users' => '* R$ 276/mês por 4 usuários',
        'leads' => '100.000 leads',
        'pipelines' => 'Pipelines ilimitados',
        'dashboards' => '5 dashboards',
        'support' => 'Suporte prioritário',
        'cta' => 'Escolher Growth',
        'featured' => true,
    ],
    [
        'name' => 'Pro',
        'price' => 'R$ 99',
        'caption' => 'Para equipes que precisam de automação, API e controle avançado.',
        'users' => '* R$ 276/mês por 4 usuários',
        'leads' => 'Leads ilimitados',
        'pipelines' => 'Pipelines ilimitados',
        'dashboards' => '8 dashboards',
        'support' => 'Suporte premium',
        'cta' => 'Falar com vendas',
        'featured' => false,
    ],
    [
        'name' => 'Enterprise',
        'price' => 'Sob consulta',
        'caption' => 'Para empresas com regras, volume e suporte dedicados.',
        'users' => 'Mínimo de 10 usuários',
        'leads' => 'Leads ilimitados',
        'pipelines' => 'Pipelines ilimitados',
        'dashboards' => 'Dashboards ilimitados',
        'support' => 'Suporte dedicado',
        'cta' => 'Solicitar proposta',
        'featured' => false,
    ],
];

$comparisonRows = [
    ['Usuários - Mínimo', '1', '4', '4', '4', '10'],
    ['Contatos / Empresas', '500', '10.000', '100.000', 'Ilimitado', 'Ilimitado'],
    ['Etapas por Pipeline', 'Até 5', 'Até 15', 'Até 25', 'Ilimitadas', 'Ilimitadas'],
    ['Workspaces', '1', '1', '3', '5', 'Ilimitados'],
    ['Armazenamento', '0', '5 GB', '20 GB', '100 GB', 'Custom'],
    ['Automações', '—', '5', '20', '80', 'Ilimitadas'],
    ['API REST', 'Não', 'Não', 'Não', 'Sim', 'Sim'],
    ['Webhooks', 'Não', 'Não', 'Até 20', 'Ilimitados', 'Ilimitados'],
    ['Integrações', 'Não', 'Sim', 'Sim', 'Sim', 'Sim'],
    ['Permissões', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'],
    ['Aplicativo Mobile', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'],
];

$featureRows = [
    ['CRM Kanban', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'],
    ['Cadastro de Leads', 'Não', 'Sim', 'Sim', 'Sim', 'Sim'],
    ['Agenda / Calendário', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'],
    ['Atividades', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'],
    ['Feed', 'Não', 'Sim', 'Sim', 'Sim', 'Sim'],
    ['Notas', 'Não', 'Sim', 'Sim', 'Sim', 'Sim'],
    ['Produtos', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'],
    ['Propostas Comerciais', 'Não', 'Sim', 'Sim', 'Sim', 'Sim'],
    ['Tabelas de Preços', 'Não', 'Não', 'Sim', 'Sim', 'Sim'],
    ['Relatórios', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'],
    ['Campos Personalizados', 'Sim', 'Sim', 'Sim', 'Sim', 'Sim'],
    ['Captura de Leads', 'Não', 'Sim', 'Sim', 'Sim', 'Sim'],
    ['E-mails', 'Não', 'Não', 'Sim', 'Sim', 'Sim'],
    ['Forecast', 'Não', 'Não', 'Sim', 'Sim', 'Sim'],
    ['Metas Comerciais', 'Não', 'Não', 'Sim', 'Sim', 'Sim'],
    ['Equipes', 'Não', 'Não', 'Sim', 'Sim', 'Sim'],
    ['Projetos', 'Não', 'Não', 'Sim', 'Sim', 'Sim'],
    ['Documentos', 'Não', 'Não', 'Sim', 'Sim', 'Sim'],
    ['Auditoria', 'Não', 'Não', 'Não', 'Sim', 'Sim'],
    ['API Completa', 'Não', 'Não', 'Não', 'Sim', 'Sim'],
    ['Multiempresa', 'Não', 'Não', 'Não', 'Sim', 'Sim'],
    ['Pipeline Analytics', 'Não', 'Não', 'Não', 'Sim', 'Sim'],
    ['Manual de negócios', 'Não', 'Não', 'Não', 'Sim', 'Sim'],
];

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

                <div class="planos-grid">
                    <?php foreach ($planos as $plan): ?>
                        <article class="plan-card<?=$plan['featured'] ? ' plan-card--featured' : '';?>">
                            <?php if ($plan['featured']): ?>
                                <span class="plan-card__badge">Mais escolhido</span>
                            <?php endif; ?>
                            <div class="plan-card__head">
                                <h3 class="plan-card__name"><?=$plan['name'];?></h3>
                                <p class="plan-card__caption"><?=$plan['caption'];?></p>
                            </div>
                            <div class="plan-card__price">
                                <strong><?=$plan['price'];?></strong>
                                <?php if ($plan['price'] !== 'Sob consulta'): ?>
                                    <span>/usuário mês*</span>
                                <?php endif; ?>
                            </div>
                            <?php if (!empty(trim($plan['users']))): ?>
                                <p class="plan-card__note"><?=trim($plan['users']);?></p>
                            <?php endif; ?>
                            <ul class="plan-card__features">
                                <li><?=$plan['leads'];?></li>
                                <li><?=$plan['pipelines'];?></li>
                                <li><?=$plan['dashboards'];?></li>
                                <li><?=$plan['support'];?></li>
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