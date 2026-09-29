@extends('admin.app')

@section('content')

    @include('admin.layouts.tabmenu')

    @include('admin.search.leads')

    <style>
        .lead-list-header {
            background: linear-gradient(135deg, #111827, #1f5f75);
            border-radius: 18px;
            color: #fff;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, .18);
        }

        .lead-summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 10px;
            margin-top: 18px;
        }

        .lead-summary-card {
            background: rgba(255, 255, 255, .1);
            border: 1px solid rgba(255, 255, 255, .16);
            border-radius: 14px;
            padding: 12px;
            backdrop-filter: blur(8px);
        }

        .lead-summary-card strong {
            display: block;
            font-size: 1.35rem;
            line-height: 1;
            color: #fff;
        }

        .lead-summary-card span {
            display: block;
            color: rgba(255, 255, 255, .72);
            font-size: .78rem;
            font-weight: 700;
            margin-top: 6px;
        }

        .lead-card {
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            background: #fff;
            box-shadow: 0 10px 28px rgba(15, 23, 42, .08);
            overflow: hidden;
            transition: transform .18s ease, box-shadow .18s ease;
        }

        .lead-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 38px rgba(15, 23, 42, .12);
        }

        .lead-card__top {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 20px 22px;
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
            cursor: pointer;
        }

        .lead-card__body {
            padding: 20px 22px;
        }

        .lead-card:not(.is-open) .lead-card__body {
            display: none;
        }

        .lead-card__hint {
            color: #64748b;
            font-size: .78rem;
            margin-top: 8px;
        }

        .lead-name {
            font-size: 1.1rem;
            font-weight: 800;
            color: #111827;
            margin-bottom: 4px;
        }

        .lead-muted {
            color: #64748b;
            font-size: .88rem;
        }

        .lead-badge {
            display: inline-flex;
            align-items: center;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 700;
            padding: 5px 10px;
            margin: 2px;
            white-space: nowrap;
        }

        .lead-badge--corporate {
            background: #dcfce7;
            color: #166534;
        }

        .lead-badge--free {
            background: #fef3c7;
            color: #92400e;
        }

        .lead-badge--none {
            background: #e5e7eb;
            color: #374151;
        }

        .lead-badge--campaign {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .lead-badge--organic {
            background: #ede9fe;
            color: #6d28d9;
        }

        .lead-section-title {
            font-size: .78rem;
            letter-spacing: .04em;
            text-transform: uppercase;
            color: #64748b;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .lead-info-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .lead-info-box {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 14px;
            min-height: 100%;
        }

        .lead-detail {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            padding: 6px 0;
            border-bottom: 1px dashed #e5e7eb;
            font-size: .88rem;
        }

        .lead-detail:last-child {
            border-bottom: 0;
        }

        .lead-detail strong {
            color: #475569;
        }

        .lead-detail span {
            color: #0f172a;
            text-align: right;
            word-break: break-word;
        }

        .lead-query-list {
            display: flex;
            flex-direction: column;
            gap: 4px;
            max-width: 100%;
            text-align: left;
        }

        .lead-query-list code {
            display: block;
            background: #eef2ff;
            border-radius: 8px;
            color: #334155;
            font-size: .76rem;
            padding: 4px 6px;
            white-space: normal;
            word-break: break-word;
        }

        .lead-timeline {
            border-left: 2px solid #38bdf8;
            padding-left: 14px;
            margin-top: 8px;
        }

        .lead-timeline__item {
            position: relative;
            padding-bottom: 12px;
            font-size: .88rem;
        }

        .lead-timeline__item:before {
            content: '';
            position: absolute;
            left: -20px;
            top: 4px;
            width: 10px;
            height: 10px;
            background: #0ea5e9;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 0 0 2px #bae6fd;
        }

        .lead-extra {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 10px 12px;
            margin-top: 12px;
        }

        .lead-extra summary {
            cursor: pointer;
            font-weight: 800;
            color: #334155;
        }

        .lead-intel {
            display: grid;
            grid-template-columns: 64px 1fr;
            gap: 14px;
            align-items: start;
            background: linear-gradient(135deg, #fff, #f8fbff);
            border: 1px solid #dbeafe;
            border-radius: 16px;
            padding: 16px;
            margin-top: 16px;
        }

        .lead-intel__logo {
            width: 64px;
            height: 64px;
            border-radius: 14px;
            background: #eef2ff;
            color: #1e3a8a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            overflow: hidden;
        }

        .lead-intel__logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: #fff;
        }

        .lead-intel__title {
            font-size: 1rem;
            font-weight: 900;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .lead-intel__domain {
            color: #64748b;
            font-size: .86rem;
            margin-bottom: 8px;
        }

        .lead-intel__desc {
            color: #334155;
            font-size: .9rem;
            margin-bottom: 8px;
        }

        .lead-intel__chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
        }

        .lead-intel__chip {
            border-radius: 999px;
            padding: 5px 10px;
            font-size: .78rem;
            font-weight: 800;
            background: #eff6ff;
            color: #1d4ed8;
        }

        .lead-intel__chip.green {
            background: #dcfce7;
            color: #15803d;
        }

        .lead-intel__chip.dark {
            background: #e0f2fe;
            color: #075985;
        }

        .lead-intel__chip.amber {
            background: #ffedd5;
            color: #c2410c;
        }

        .lead-intel__chip.gray {
            background: #f1f5f9;
            color: #475569;
        }

        @media (max-width: 991px) {
            .lead-card__top {
                flex-direction: column;
            }

            .lead-info-grid {
                grid-template-columns: 1fr;
            }

            .lead-intel {
                grid-template-columns: 1fr;
            }

            .lead-summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 575px) {
            .lead-summary-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="lead-list-header">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <div class="lead-muted text-white-50">Central de análise comercial</div>
                <h1 class="h3 mb-1">Leads recebidos</h1>
                <div class="text-white-50">Confira contato, origem, qualidade do e-mail e navegação antes da conversão.</div>
            </div>
            <div class="text-end">
                <div class="display-6 fw-bold">{{ $resumoLeads['total'] ?? $leads->total() }}</div>
                <div class="text-white-50">leads encontrados</div>
            </div>
        </div>
        <div class="lead-summary-grid">
            <div class="lead-summary-card">
                <strong>{{ $resumoLeads['organico'] ?? 0 }}</strong>
                <span>Orgânicos</span>
            </div>
            <div class="lead-summary-card">
                <strong>{{ $resumoLeads['nao_organico'] ?? 0 }}</strong>
                <span>Campanhas</span>
            </div>
            <div class="lead-summary-card">
                <strong>{{ $resumoLeads['email_corporativo'] ?? 0 }}</strong>
                <span>E-mails corporativos</span>
            </div>
            <div class="lead-summary-card">
                <strong>{{ $resumoLeads['email_gratuito'] ?? 0 }}</strong>
                <span>E-mails gratuitos</span>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column gap-4">
        @forelse($leads as $lead)
            @php
                $domain = strtolower(substr(strrchr($lead->email ?? '', '@') ?: '', 1));
                $tipoEmail = in_array($domain, $freeEmailDomains ?? []) ? 'Gratuito' : 'Corporativo';
                $origem = empty($lead->visita)
                    ? 'Não identificado'
                    : (!empty(trim($lead->visita->url_query ?? ''))
                        ? 'Campanha'
                        : 'Orgânico');
                $historicoVisitas = $visitasPorLead->get($lead->visita_id, collect());
                $badgeEmailClass =
                    $tipoEmail === 'Corporativo'
                        ? 'lead-badge--corporate'
                        : ($tipoEmail === 'Gratuito'
                            ? 'lead-badge--free'
                            : 'lead-badge--none');
                $badgeOrigemClass =
                    $origem === 'Campanha'
                        ? 'lead-badge--campaign'
                        : ($origem === 'Orgânico'
                            ? 'lead-badge--organic'
                            : 'lead-badge--none');

                if (request()->route()->getName() == 'admin.lead.contato') {
                    $routeName = 'admin.send-contato-hubspot';
                } elseif (request()->route()->getName() == 'admin.lead.whatsapp') {
                    $routeName = 'admin.send-whatsapp-hubspot';
                } else {
                    $routeName = 'admin.send-custom-hubspot';
                }

                $extraData = collect($lead->extra_data_label ?? [])->reject(
                    fn($value, $key) => in_array($key, [
                        'nome',
                        'email',
                        'whatsapp',
                        'form_type',
                        'url',
                        'locale',
                        'data',
                        'status',
                        'cf-turnstile-response',
                    ]),
                );
                $inteligencia = $inteligenciasPorLead[$lead->id] ?? null;

                $formatQuery = function (?string $query) {
                    if (empty($query)) {
                        return '—';
                    }

                    parse_str($query, $params);
                    if (empty($params)) {
                        return e($query);
                    }

                    return '<div class="lead-query-list">' .
                        collect($params)
                            ->map(function ($value, $key) {
                                $displayValue = is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value;
                                return '<code>' . e($key) . '=' . e($displayValue) . '</code>';
                            })
                            ->implode('') .
                        '</div>';
                };
            @endphp

            <article class="lead-card">
                <div class="lead-card__top" data-lead-toggle>
                    <div>
                        <div class="lead-name">#{{ $lead->id }}
                            {{ trim(($lead->nome ?? '') . ' ' . ($lead->sobrenome ?? '')) ?: 'Lead sem nome' }}</div>
                        <div class="lead-muted">{{ $lead->created_at_br }} · {!! $lead->form_type ?: 'Formulário não informado' !!}</div>
                        <div class="lead-card__hint">Clique para ver contato, visita, inteligência comercial e navegação.
                        </div>
                    </div>
                    <div class="text-md-end">
                        <span class="lead-badge {{ $badgeEmailClass }}">{{ $tipoEmail }}</span>
                        <span class="lead-badge {{ $badgeOrigemClass }}">{{ $origem }}</span>
                        <div class="mt-2">{!! $lead->status_label !!}</div>
                    </div>
                </div>

                <div class="lead-card__body">
                    <div class="lead-info-grid">
                        <div class="lead-info-box">
                            <div class="lead-section-title">Contato</div>
                            <div class="lead-detail"><strong>E-mail</strong><span>{{ $lead->email ?: '—' }}</span></div>
                            <div class="lead-detail">
                                <strong>Telefone</strong><span>{{ $lead->celular }}{{ $lead->whatsapp ?: '—' }}</span>
                            </div>
                            <div class="lead-detail"><strong>Domínio</strong><span>{{ $domain ?: '—' }}</span></div>
                            @if (!empty($lead->url))
                                <div class="lead-detail"><strong>URL</strong><span>{{ $lead->url }}</span></div>
                            @endif
                        </div>

                        <div class="lead-info-box">
                            <div class="lead-section-title">Visita de conversão</div>
                            <div class="lead-detail"><strong>Visita ID</strong><span>{{ $lead->visita_id ?: '—' }}</span>
                            </div>
                            <div class="lead-detail">
                                <strong>Página</strong>
                                <span>
                                    @php
                                        $paginaConversao = !empty($lead->visita?->pagina)
                                            ? getPageBySlug($lead->visita->pagina)
                                            : null;
                                        $paginaConversaoUrl = $paginaConversao ? getRouteUrl($paginaConversao) : null;
                                    @endphp

                                    @if (!empty($paginaConversaoUrl['slug']))
                                        <a href="{{ $paginaConversaoUrl['slug'] }}" target="_blank"
                                            class="text-primary fw-bold">
                                            {{ $lead->visita->pagina_nome ?? ($paginaConversaoUrl['title'] ?? $lead->visita->pagina) }}
                                        </a>
                                    @else
                                        {{ $lead->visita->pagina_nome ?? ($lead->visita->pagina ?? '—') }}
                                    @endif
                                </span>
                            </div>
                            <div class="lead-detail"><strong>Data</strong><span>{{ $lead->visita->data_br ?? '—' }}</span>
                            </div>
                            <div class="lead-detail"><strong>IP</strong><span>{{ $lead->visita->ip ?? '—' }}</span></div>
                        </div>

                        <div class="lead-info-box">
                            <div class="lead-section-title">Localização e origem</div>
                            <div class="lead-detail"><strong>País</strong><span>{{ $lead->visita->pais ?? '—' }}</span>
                            </div>
                            <div class="lead-detail"><strong>Região</strong><span>{{ $lead->visita->regiao ?? '—' }}</span>
                            </div>
                            <div class="lead-detail"><strong>Cidade</strong><span>{{ $lead->visita->cidade ?? '—' }}</span>
                            </div>
                            <div class="lead-detail"><strong>Campanha</strong><span>{!! $formatQuery($lead->visita->url_query ?? null) !!}</span></div>
                        </div>
                    </div>

                    @if (!empty($inteligencia))
                        <div class="lead-intel">
                            <div class="lead-intel__logo">
                                @if (!empty($inteligencia['logo']))
                                    <img src="{{ $inteligencia['logo'] }}" alt="Logo {{ $inteligencia['titulo'] }}">
                                @else
                                    {{ strtoupper(substr($inteligencia['titulo'] ?? $inteligencia['alvo'], 0, 2)) }}
                                @endif
                            </div>
                            <div>
                                <div class="d-flex flex-wrap justify-content-between gap-2">
                                    <div>
                                        <div class="lead-section-title mb-1">Inteligência comercial</div>
                                        <div class="lead-intel__title">{{ $inteligencia['titulo'] }}</div>
                                        <div class="lead-intel__domain">
                                            {{ $inteligencia['alvo'] }} · baseado em {{ $inteligencia['baseado_em'] }}
                                        </div>
                                    </div>
                                </div>

                                <div class="lead-intel__desc">
                                    {{ \Illuminate\Support\Str::limit($inteligencia['descricao'], 180) }}</div>

                                @if (!empty($inteligencia['resumo_linkedin']))
                                    <div class="lead-intel__desc"><strong>Resumo LinkedIn:</strong>
                                        {{ \Illuminate\Support\Str::limit($inteligencia['resumo_linkedin'], 160) }}</div>
                                @endif

                                <div class="lead-intel__chips">
                                    <span class="lead-intel__chip">{{ $inteligencia['rota'] }}</span>
                                    <span class="lead-intel__chip green">{{ $inteligencia['potencial'] }}</span>
                                    <span class="lead-intel__chip dark">Enterprise Score:
                                        {{ $inteligencia['enterprise_score'] ?? 'N/D' }}</span>
                                    <span class="lead-intel__chip amber">Confiança:
                                        {{ $inteligencia['confidence_score'] ?? 'N/D' }}</span>
                                    <span class="lead-intel__chip gray">Fonte: {{ $inteligencia['baseado_em'] }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <details class="lead-extra">
                        <summary>Páginas navegadas nesta sessão ({{ $historicoVisitas->count() }})</summary>
                        @if ($historicoVisitas->isNotEmpty())
                            <div class="lead-timeline">
                                @foreach ($historicoVisitas as $visita)
                                    @php
                                        $paginaVisitada = !empty($visita->pagina)
                                            ? getPageBySlug($visita->pagina)
                                            : null;
                                        $paginaVisitadaUrl = $paginaVisitada ? getRouteUrl($paginaVisitada) : null;
                                    @endphp
                                    <div class="lead-timeline__item">
                                        <div>
                                            @if (!empty($paginaVisitadaUrl['slug']))
                                                <a href="{{ $paginaVisitadaUrl['slug'] }}" target="_blank"
                                                    class="text-primary fw-bold">
                                                    {{ $visita->pagina_nome ?? ($paginaVisitadaUrl['title'] ?? $visita->pagina) }}
                                                </a>
                                            @else
                                                <strong>{{ $visita->pagina_nome ?? ($visita->pagina ?? 'N/A') }}</strong>
                                            @endif
                                        </div>
                                        <div class="lead-muted">
                                            {{ $visita->data_br }}{{ $visita->cidade ? ' · ' . $visita->cidade : '' }}{{ $visita->regiao ? ' - ' . $visita->regiao : '' }}
                                        </div>
                                        @if (!empty($visita->url_query))
                                            <div class="text-break mt-1"><strong>Query:</strong> {!! $formatQuery($visita->url_query) !!}
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="lead-muted mt-2">Nenhuma visita encontrada para este lead.</div>
                        @endif
                    </details>

                    @if ($extraData->isNotEmpty())
                        <details class="lead-extra">
                            <summary>Dados enviados no formulário</summary>
                            <div class="row mt-2">
                                @foreach ($extraData as $key => $value)
                                    @php
                                        $displayValue = is_array($value)
                                            ? json_encode($value, JSON_UNESCAPED_UNICODE)
                                            : $value;
                                    @endphp
                                    <div class="col-md-6 mb-2">
                                        <div class="lead-detail">
                                            <strong>{{ ucwords(str_replace('_', ' ', $key)) }}</strong>
                                            <span>{!! $displayValue ?: '—' !!}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </details>
                    @endif

                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-3">
                        <div class="lead-muted">Lead cadastrado em {{ $lead->created_at_br }}</div>
                        <a href="{{ route($routeName, $lead->id) }}" class="btn btn-outline-primary btn-sm"
                            title="Enviar lead para a HubSpot" target="_blank">
                            Enviar para HubSpot
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="bg-white shadow rounded p-5 text-center">
                <h2 class="h5 mb-2">Nenhum lead encontrado</h2>
                <p class="text-muted mb-0">Ajuste os filtros e tente novamente.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $leads->links('pagination::bootstrap-5') }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-lead-toggle]').forEach(function(header) {
                header.addEventListener('click', function() {
                    header.closest('.lead-card').classList.toggle('is-open');
                });
            });
        });
    </script>
@endsection
