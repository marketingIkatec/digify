@extends('admin.app')

@section('content')

@include('admin.layouts.tabmenu')

@include('admin.search.leads')

@php
    $eventLabels = [
        'digify_account_created' => 'Conta criada',
        'digify_first_login' => 'Primeiro acesso',
        'digify_login' => 'Login recente',
        'digify_dashboard_viewed' => 'Dashboard visualizado',
        'digify_report_viewed' => 'Relatorio visualizado',
        'digify_pipeline_analytics_viewed' => 'Analise de funil',
        'digify_pipeline_created' => 'Pipeline criado',
        'digify_pipeline_edited' => 'Pipeline editado',
        'digify_stage_created' => 'Etapa criada',
        'digify_stage_edited' => 'Etapa editada',
        'digify_stage_deleted' => 'Etapa removida',
        'digify_dashboard_customized' => 'Dashboard customizado',
        'digify_user_created' => 'Usuario criado',
        'digify_permission_group_created' => 'Grupo de permissao',
        'digify_module_added' => 'Modulo adicionado',
        'digify_module_first_access' => 'Primeiro acesso ao modulo',
        'digify_module_used' => 'Modulo usado',
        'digify_person_created' => 'Pessoa criada',
        'digify_people_imported' => 'Pessoas importadas',
        'digify_organization_created' => 'Empresa criada',
        'digify_organizations_imported' => 'Empresas importadas',
        'digify_lead_created' => 'Lead criado',
        'digify_lead_imported' => 'Lead importado',
        'digify_lead_captured' => 'Lead capturado',
        'digify_import_completed' => 'Importacao concluida',
        'digify_deal_created' => 'Negocio criado',
        'digify_deal_stage_changed' => 'Negocio movimentado',
        'digify_deal_won' => 'Negocio ganho',
        'digify_deal_lost' => 'Negocio perdido',
        'digify_task_created' => 'Tarefa criada',
        'digify_task_completed' => 'Tarefa concluida',
        'digify_note_created' => 'Nota criada',
        'digify_proposal_created' => 'Proposta criada',
        'digify_proposal_sent' => 'Proposta enviada',
        'digify_document_uploaded' => 'Documento enviado',
        'digify_document_linked_to_deal' => 'Documento no negocio',
        'digify_automation_created' => 'Automacao criada',
        'digify_automation_activated' => 'Automacao ativada',
        'digify_automation_executed' => 'Automacao executada',
        'digify_payment_method_added' => 'Cartao cadastrado',
        'digify_first_payment_confirmed' => 'Primeiro pagamento confirmado',
        'digify_first_payment_failed' => 'Primeiro pagamento falhou',
        'digify_recurring_payment_confirmed' => 'Pagamento recorrente confirmado',
        'digify_recurring_payment_failed' => 'Pagamento recorrente falhou',
        'digify_subscription_cancelled' => 'Assinatura cancelada',
    ];

    $setupEvents = [
        'digify_pipeline_created', 'digify_pipeline_edited', 'digify_stage_created', 'digify_stage_edited',
        'digify_stage_deleted', 'digify_dashboard_customized', 'digify_user_created', 'digify_permission_group_created',
        'digify_module_added', 'digify_module_first_access',
    ];

    $dataEvents = [
        'digify_person_created', 'digify_people_imported', 'digify_organization_created', 'digify_organizations_imported',
        'digify_lead_created', 'digify_lead_imported', 'digify_lead_captured', 'digify_import_completed',
    ];

    $executionEvents = [
        'digify_deal_stage_changed', 'digify_task_created', 'digify_task_completed', 'digify_note_created',
    ];

    $strongAdoptionEvents = [
        'digify_deal_won', 'digify_deal_lost', 'digify_task_completed', 'digify_proposal_sent',
        'digify_document_linked_to_deal', 'digify_module_used', 'digify_automation_executed',
    ];

    $financialRiskEvents = [
        'digify_first_payment_failed', 'digify_recurring_payment_failed', 'digify_subscription_cancelled',
    ];

    $pageLeads = collect($leads->items());
    $totalAccounts = $pageLeads->count();
    $withProperties = $pageLeads->filter(fn ($lead) => !empty($lead->properties))->count();
    $activatedAccounts = $pageLeads->filter(function ($lead) use ($dataEvents, $executionEvents) {
        $properties = $lead->properties ?? [];
        return !empty($properties['digify_deal_created'])
            && count(array_intersect(array_keys($properties), array_merge($dataEvents, $executionEvents))) > 0;
    })->count();
    $riskAccounts = $pageLeads->filter(function ($lead) use ($financialRiskEvents) {
        return count(array_intersect(array_keys($lead->properties ?? []), $financialRiskEvents)) > 0;
    })->count();
@endphp

<style>
    .digify-dashboard {
        background: #f4f7fb;
        border-radius: 22px;
        padding: 22px;
    }

    .digify-hero {
        background: linear-gradient(135deg, #111827 0%, #1d4ed8 55%, #06b6d4 100%);
        border-radius: 24px;
        color: #fff;
        margin-bottom: 20px;
        overflow: hidden;
        padding: 28px;
        position: relative;
    }

    .digify-hero:after {
        background: radial-gradient(circle, rgba(255,255,255,.25), rgba(255,255,255,0) 60%);
        content: '';
        height: 240px;
        position: absolute;
        right: -70px;
        top: -90px;
        width: 240px;
    }

    .digify-hero h2 {
        color: #fff;
        font-size: 28px;
        font-weight: 800;
        margin: 0 0 8px;
    }

    .digify-hero p {
        color: rgba(255,255,255,.82);
        margin: 0;
        max-width: 760px;
    }

    .digify-stats {
        display: grid;
        gap: 14px;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        margin-bottom: 20px;
    }

    .digify-stat {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 18px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, .06);
        padding: 18px;
    }

    .digify-stat span {
        color: #64748b;
        display: block;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .05em;
        text-transform: uppercase;
    }

    .digify-stat strong {
        color: #0f172a;
        display: block;
        font-size: 30px;
        line-height: 1;
        margin-top: 10px;
    }

    .digify-account-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 22px;
        box-shadow: 0 18px 45px rgba(15, 23, 42, .07);
        margin-bottom: 18px;
        overflow: hidden;
    }

    .digify-card-header {
        align-items: center;
        border-bottom: 1px solid #edf2f7;
        display: flex;
        gap: 14px;
        justify-content: space-between;
        padding: 18px 20px;
    }

    .digify-account-title {
        min-width: 0;
    }

    .digify-account-title h3 {
        color: #0f172a;
        font-size: 18px;
        font-weight: 800;
        margin: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .digify-account-title small {
        color: #64748b;
        display: block;
        margin-top: 4px;
    }

    .digify-status {
        border-radius: 999px;
        display: inline-flex;
        font-size: 12px;
        font-weight: 800;
        padding: 8px 12px;
        white-space: nowrap;
    }

    .digify-status.risk { background: #fee2e2; color: #991b1b; }
    .digify-status.strong { background: #dcfce7; color: #166534; }
    .digify-status.active { background: #dbeafe; color: #1e40af; }
    .digify-status.operation { background: #ede9fe; color: #5b21b6; }
    .digify-status.setup { background: #fef3c7; color: #92400e; }
    .digify-status.explore { background: #e0f2fe; color: #075985; }
    .digify-status.empty { background: #f1f5f9; color: #475569; }

    .digify-card-body {
        display: grid;
        gap: 20px;
        grid-template-columns: minmax(0, 1.5fr) minmax(280px, .9fr);
        padding: 20px;
    }

    .digify-flow {
        display: grid;
        gap: 10px;
        grid-template-columns: repeat(5, minmax(0, 1fr));
    }

    .digify-step {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        min-height: 100px;
        padding: 14px;
    }

    .digify-step.is-done {
        background: linear-gradient(180deg, #ecfeff, #fff);
        border-color: #67e8f9;
    }

    .digify-step b {
        color: #0f172a;
        display: block;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .digify-step span {
        color: #64748b;
        display: block;
        font-size: 12px;
        line-height: 1.35;
    }

    .digify-events {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 16px;
    }

    .digify-event {
        align-items: center;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 999px;
        color: #334155;
        display: inline-flex;
        font-size: 12px;
        font-weight: 700;
        gap: 7px;
        padding: 8px 11px;
    }

    .digify-event:before {
        background: #22c55e;
        border-radius: 999px;
        content: '';
        height: 8px;
        width: 8px;
    }

    .digify-properties {
        background: #0f172a;
        border-radius: 18px;
        color: #e2e8f0;
        max-height: 310px;
        overflow: auto;
        padding: 16px;
    }

    .digify-property {
        border-bottom: 1px solid rgba(148, 163, 184, .22);
        padding: 10px 0;
    }

    .digify-property:first-child { padding-top: 0; }
    .digify-property:last-child { border-bottom: 0; padding-bottom: 0; }

    .digify-property b {
        color: #93c5fd;
        display: block;
        font-size: 12px;
        word-break: break-word;
    }

    .digify-property span {
        color: #f8fafc;
        display: block;
        font-size: 13px;
        margin-top: 3px;
        word-break: break-word;
    }

    .digify-empty-state {
        background: #fff;
        border: 1px dashed #cbd5e1;
        border-radius: 18px;
        color: #64748b;
        padding: 28px;
        text-align: center;
    }

    @media (max-width: 992px) {
        .digify-stats,
        .digify-card-body,
        .digify-flow {
            grid-template-columns: 1fr;
        }

        .digify-card-header {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>

<div class="digify-dashboard">
    <div class="digify-hero">
        <h2>Fluxo Digify para HubSpot</h2>
        <p>Leitura das contas com base no campo <strong>properties</strong>, mostrando os eventos ja capturados e o estagio atual do account antes do envio/uso no HubSpot.</p>
    </div>

    <div class="digify-stats">
        <div class="digify-stat">
            <span>Contas nesta pagina</span>
            <strong>{{ $totalAccounts }}</strong>
        </div>
        <div class="digify-stat">
            <span>Com properties</span>
            <strong>{{ $withProperties }}</strong>
        </div>
        <div class="digify-stat">
            <span>Ativadas</span>
            <strong>{{ $activatedAccounts }}</strong>
        </div>
        <div class="digify-stat">
            <span>Risco financeiro</span>
            <strong>{{ $riskAccounts }}</strong>
        </div>
    </div>

    @forelse($leads as $lead)
        @php
            $properties = $lead->properties ?? [];
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
                $statusClass = 'risk';
                $statusLabel = 'Risco financeiro';
            } elseif ($hasStrongAdoption) {
                $statusClass = 'strong';
                $statusLabel = 'Adocao forte';
            } elseif ($isActivated) {
                $statusClass = 'active';
                $statusLabel = 'Ativado';
            } elseif ($hasDeal || $hasData) {
                $statusClass = 'operation';
                $statusLabel = 'Operacao inserida';
            } elseif ($hasSetup) {
                $statusClass = 'setup';
                $statusLabel = 'Setup';
            } elseif ($hasFirstLogin || !empty($properties['digify_login']) || !empty($properties['digify_dashboard_viewed'])) {
                $statusClass = 'explore';
                $statusLabel = 'Exploracao';
            } else {
                $statusClass = 'empty';
                $statusLabel = $hasAccountCreated ? 'Nao iniciado' : 'Sem eventos';
            }

            $flow = [
                ['label' => 'Entrada', 'done' => $hasAccountCreated, 'description' => 'Conta criada e identificada.'],
                ['label' => 'Primeiro acesso', 'done' => $hasFirstLogin, 'description' => 'Usuario entrou na Digify.'],
                ['label' => 'Setup', 'done' => $hasSetup, 'description' => 'Configuracao ou exploracao inicial.'],
                ['label' => 'Operacao', 'done' => $hasData || $hasDeal, 'description' => 'Dados reais, leads ou negocio.'],
                ['label' => 'Ativacao', 'done' => $isActivated, 'description' => 'Negocio com execucao comercial.'],
            ];
        @endphp

        <div class="digify-account-card">
            <div class="digify-card-header">
                <div class="digify-account-title">
                    <h3>{{ $lead->email ?: 'Conta sem e-mail' }}</h3>
                    <small>
                        ID #{{ $lead->id }}
                        @if(!empty($lead->digify_account_id))
                            - Account {{ $lead->digify_account_id }}
                        @endif
                        - Criado em {{ $lead->created_at_br }}
                    </small>
                </div>
                <span class="digify-status {{ $statusClass }}">{{ $statusLabel }}</span>
            </div>

            <div class="digify-card-body">
                <div>
                    <div class="digify-flow">
                        @foreach($flow as $step)
                            <div class="digify-step {{ $step['done'] ? 'is-done' : '' }}">
                                <b>{{ $step['done'] ? '[ok]' : '[ ]' }} {{ $step['label'] }}</b>
                                <span>{{ $step['description'] }}</span>
                            </div>
                        @endforeach
                    </div>

                    @if(!empty($properties))
                        <div class="digify-events">
                            @foreach($properties as $key => $value)
                                @if($key !== 'digify_account_id' && $value !== '' && $value !== null)
                                    <span class="digify-event">{{ $eventLabels[$key] ?? str_replace('_', ' ', $key) }}</span>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="digify-empty-state mt-3">
                            Nenhuma propriedade capturada para esta conta ainda.
                        </div>
                    @endif
                </div>

                <div class="digify-properties">
                    @forelse($properties as $key => $value)
                        <div class="digify-property">
                            <b>{{ $key }}</b>
                            <span>
                                @if(is_bool($value))
                                    {{ $value ? 'true' : 'false' }}
                                @elseif(is_array($value))
                                    {{ json_encode($value) }}
                                @else
                                    {{ $value }}
                                @endif
                            </span>
                        </div>
                    @empty
                        <div class="digify-property">
                            <b>properties</b>
                            <span>Sem dados para enviar ao HubSpot.</span>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    @empty
        <div class="digify-empty-state">
            Nenhuma conta encontrada para os filtros atuais.
        </div>
    @endforelse

    <div class="mt-4">
        <div class="flex-md-row justify-content-between align-items-center gap-2">
            <div>
                {{ $leads->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@endsection
