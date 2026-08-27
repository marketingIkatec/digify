<main id="main">
    <section class="recurso-hero" aria-labelledby="funil-title">
        <div class="recurso-hero__bg" aria-hidden="true">
            <span class="blob blob--1"></span>
            <span class="blob blob--2"></span>
            <span class="blob blob--3"></span>
        </div>

        <div class="container recurso-hero__inner">
            <div class="recurso-hero__copy">
                <span class="section-label">Funil de Vendas</span>
                <h1 class="recurso-hero__title" id="funil-title">Cada negociação clara do <span class="text-grad">início ao fechamento</span></h1>
                <p class="recurso-hero__lead">Visualize oportunidades, acompanhe o avanço das vendas e saiba onde sua equipe precisa agir para manter o funil em movimento.</p>

                <div class="recurso-hero__actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">
                        Comece gratuitamente
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <div class="recurso-hero__visual">
                <img class="recurso-hero__screen" src="{{ asset('storage/site/home-negocios.png') }}" alt="Pipeline de vendas do Digify em Kanban com oportunidades, valores e responsáveis distribuídos por etapa" width="1672" height="941" loading="eager">

                <div class="recurso-hero__float recurso-hero__float--a" aria-hidden="true">
                    <span class="recurso-hero__float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg></span>
                    <span>
                        <strong class="recurso-hero__float-value">5 etapas</strong>
                        <span class="recurso-hero__float-label">Pipeline comercial</span>
                    </span>
                </div>

                <div class="recurso-hero__float recurso-hero__float--b" aria-hidden="true">
                    <span class="recurso-hero__float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2 11 13"/><path d="M22 2 15 22l-4-9-9-4Z"/></svg></span>
                    <span>
                        <strong class="recurso-hero__float-value">R$ 18.300,00</strong>
                        <span class="recurso-hero__float-label">Em proposta enviada</span>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <section class="recurso-block" aria-labelledby="funil-kanban-title">
        <div class="container">
            <div class="recurso-split">
            <div class="recurso-split__copy">
                <span class="section-label">Visão em Kanban</span>
                <h2 class="section-title" id="funil-kanban-title">Veja seu comercial acontecendo em tempo real</h2>
                <p class="section-lead">O Kanban organiza as oportunidades por etapa e transforma o andamento das vendas em uma visão simples de acompanhar. Em poucos segundos, você identifica:</p>

                <div class="form-feats recurso-feats-2col">
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Quais negociações estão avançando</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Onde estão os maiores valores em aberto</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Quais oportunidades precisam de atenção</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Quem é responsável por cada negócio</span>
                    </div>
                </div>

                <div class="recurso-actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece grátis</a>
                </div>
            </div>

            <!-- O Kanban sustenta três das quatro leituras da lista ao lado:
                    avanço por etapa, tempo parado em "há N dias" e responsável
                    nomeado. NÃO mostra valor — a leitura "onde estão os maiores
                    valores em aberto" ficou sem evidência na própria dobra depois
                    que o cliente pediu para tirar home-card-dist.png daqui. Quem
                    cobre isso na página é o screenshot do hero (home-negocios.png,
                    com valor por etapa) e o Pipeline Analytics na dobra 3. Se um
                    dia aparecer um Kanban de oportunidades com valor no card, é
                    essa a troca certa. -->
            <div class="recurso-split__visual recurso-split__visual--float">
                <!-- Em .shot e não em .recurso-split__bare: o PNG é um recorte de
                        borda dura, e a última fileira de cards fica cortada. Solto,
                        com drop-shadow, o corte lê como imagem quebrada; dentro da
                        moldura lê como quadro que continua além dela. -->
                <div class="shot">
                    <img src="{{ asset('storage/site/leads-kanban.png') }}" alt="Kanban do Digify com as etapas Novo, Contatado e Qualificado, mostrando há quantos dias cada oportunidade está na etapa e quem é o responsável" width="1003" height="572" loading="lazy">
                </div>

                <p class="media-float">
                    <span class="media-float__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></span>
                    <span>O funil acompanha o ritmo real das vendas, sem depender de controles paralelos.</span>
                </p>
            </div>
            </div>

            <p class="recurso-note recurso-note--intro">E conforme a negociação evolui, a oportunidade avança sozinha no pipeline:</p>

            <!-- Cada momento com a ação que ele dispara, como na copy. Era um
                    .recurso-flow--vertical só com os rótulos. -->
            <div class="recurso-bridge recurso-bridge--row">
                <div class="recurso-bridge__node">
                    <span class="recurso-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2 11 13"/><path d="M22 2 15 22l-4-9-9-4Z"/></svg></span>
                    <span>
                        <strong class="recurso-bridge__name">Proposta enviada</strong>
                        <span class="recurso-bridge__desc">Avance a oportunidade</span>
                    </span>
                </div>

                <div class="recurso-bridge__link" aria-hidden="true"></div>

                <div class="recurso-bridge__node">
                    <span class="recurso-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg></span>
                    <span>
                        <strong class="recurso-bridge__name">Cliente voltou para negociar</strong>
                        <span class="recurso-bridge__desc">Atualize a etapa</span>
                    </span>
                </div>

                <div class="recurso-bridge__link" aria-hidden="true"></div>

                <div class="recurso-bridge__node">
                    <span class="recurso-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></span>
                    <span>
                        <strong class="recurso-bridge__name">Venda concluída</strong>
                        <span class="recurso-bridge__desc">Registre o resultado</span>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Etapas personalizadas e Múltiplos pipelines: as duas tratam de moldar o
            funil ao jeito de vender da operação. -->
    <section class="recurso-block recurso-block--dark" aria-labelledby="funil-etapas-title">
        <div class="performance__glow" aria-hidden="true"></div>

        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Etapas e múltiplos pipelines</span>
                <h2 class="section-title" id="funil-etapas-title">Monte um funil que acompanhe o seu jeito de vender</h2>
                <p class="section-lead">Adapte as etapas à realidade da sua operação e conduza o time por um processo comercial claro, do primeiro contato até o fechamento.</p>
            </div>

            <!-- Um ícone por etapa: o fluxo era cinco pastilhas de texto puro.
                    O teto de 1040px do .recurso-flow já foi dimensionado para os
                    cinco passos COM ícone caberem numa linha só. -->
            <div class="recurso-flow">
                <span class="recurso-flow__step"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>Novo contato</span>
                <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                <span class="recurso-flow__step"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>Diagnóstico</span>
                <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                <span class="recurso-flow__step"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>Proposta</span>
                <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                <span class="recurso-flow__step"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>Negociação</span>
                <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                <span class="recurso-flow__step"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>Fechamento</span>
            </div>

            <!-- Screenshot à esquerda (a dobra anterior tem a imagem à direita).
                    A evidência das duas funções da dobra está nos próprios filtros
                    da tela: "Pipeline: Todos os pipelines" e "Etapa: Todas". -->
            <div class="recurso-split recurso-split--reverse">
                <div class="recurso-split__copy">
                    <p class="recurso-note recurso-note--intro">E quando a operação tem frentes com dinâmicas diferentes, cada uma ganha o seu próprio pipeline:</p>

                    <div class="form-feats recurso-feats-2col">
                        <div class="form-feat">
                            <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                            <span>Novos negócios</span>
                        </div>
                        <div class="form-feat">
                            <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                            <span>Renovações</span>
                        </div>
                        <div class="form-feat">
                            <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                            <span>Produtos ou serviços</span>
                        </div>
                        <div class="form-feat">
                            <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                            <span>Unidades comerciais</span>
                        </div>
                        <div class="form-feat">
                            <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                            <span>Equipes com processos distintos</span>
                        </div>
                    </div>

                    <p class="recurso-note">Tudo permanece organizado sem perder a visão geral da operação.</p>
                </div>

                <div class="recurso-split__visual recurso-split__visual--float">
                    <div class="shot">
                        <img src="{{ asset('storage/site/funil-pipeline-analytics.png') }}" alt="Painel Pipeline Analytics do Digify com os filtros de pipeline e etapa e os indicadores de valor, negócios, ticket médio, tempo médio no funil e conversão" width="652" height="262" loading="lazy">
                    </div>

                    <!-- Azul: branco sobre #0a50ff dá 5,83:1. Em branco o card
                            competia com o screenshot claro que ele morde. -->
                    <p class="media-float media-float--brand">
                        <span class="media-float__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></span>
                        <span>Cada avanço passa a representar um momento real da venda, facilitando o acompanhamento e reduzindo diferenças na forma como cada vendedor conduz suas oportunidades.</span>
                    </p>
                </div>
            </div>

            <div class="cta-strip">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Começar agora gratuitamente</a>
            </div>
        </div>
    </section>

    <section class="recurso-block" aria-labelledby="funil-obrigatorias-title">
        <div class="container recurso-split">
            <div class="recurso-split__copy">
                <span class="section-label">Informações obrigatórias por etapa</span>
                <h2 class="section-title" id="funil-obrigatorias-title">Padronize o processo sem engessar sua equipe</h2>
                <p class="section-lead">Defina quais informações precisam estar registradas antes que uma oportunidade avance. Assim, cada etapa reúne o contexto necessário para dar continuidade à negociação. Você pode exigir informações como:</p>

                <!-- Checklist que controla o medidor ao lado: cada informação
                        marcada aproxima a oportunidade de poder avançar. Sem JS
                        continuam sendo cinco caixas comuns, marcáveis. -->
                <div class="form-feats recurso-feats-2col">
                    <label class="form-feat form-feat--check">
                        <input class="form-feat__input" type="checkbox" data-gauge-check checked>
                        <span class="fi" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>
                        <span>Valor da oportunidade</span>
                    </label>
                    <label class="form-feat form-feat--check">
                        <input class="form-feat__input" type="checkbox" data-gauge-check checked>
                        <span class="fi" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>
                        <span>Necessidade identificada</span>
                    </label>
                    <label class="form-feat form-feat--check">
                        <input class="form-feat__input" type="checkbox" data-gauge-check checked>
                        <span class="fi" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>
                        <span>Previsão de fechamento</span>
                    </label>
                    <label class="form-feat form-feat--check">
                        <input class="form-feat__input" type="checkbox" data-gauge-check checked>
                        <span class="fi" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>
                        <span>Solução de interesse</span>
                    </label>
                    <label class="form-feat form-feat--check">
                        <input class="form-feat__input" type="checkbox" data-gauge-check>
                        <span class="fi" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>
                        <span>Próximo passo</span>
                    </label>
                </div>

                <p class="recurso-note">Mais consistência no processo e menos oportunidades avançando sem informação suficiente.</p>

                <div class="recurso-actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece grátis</a>
                </div>
            </div>

            <div class="recurso-split__visual">
                <!-- Medidor: espelha o checklist ao lado. Sem JS fica estático
                        no estado inicial do markup (4 de 5 informações). -->
                <div class="gauge" data-gauge data-band="warm" data-gauge-unit="informações preenchidas">
                    <!-- Arco de raio 140 centrado em (200,200): 0 = 180°, 100 = 0°.
                            pathLength="100" faz o dasharray falar direto em pontos,
                            sem precisar do comprimento real (π × 140). -->
                    <svg class="gauge__svg" viewBox="0 0 400 258" aria-hidden="true" focusable="false">
                        <defs>
                            <linearGradient id="gaugeRamp" gradientUnits="userSpaceOnUse" x1="60" y1="0" x2="340" y2="0">
                                <stop offset="0" stop-color="#f4556d"/>
                                <stop offset="0.2455" stop-color="#f4556d"/>
                                <stop offset="0.3681" stop-color="#fa8346"/>
                                <stop offset="0.5" stop-color="#ffb01f"/>
                                <stop offset="0.7545" stop-color="#ffb01f"/>
                                <stop offset="0.8536" stop-color="#88c060"/>
                                <stop offset="0.9304" stop-color="#10cfa0"/>
                                <stop offset="1" stop-color="#10cfa0"/>
                            </linearGradient>
                        </defs>

                        <path class="gauge__track" d="M60 200A140 140 0 0 1 340 200"/>
                        <path class="gauge__fill" data-gauge-fill pathLength="100" stroke-dasharray="100" stroke-dashoffset="20" d="M60 200A140 140 0 0 1 340 200"/>

                        <g class="gauge__edge gauge__edge--cold" transform="translate(44 222) scale(1.15)">
                            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                        </g>
                        <g class="gauge__edge gauge__edge--hot" transform="translate(328 222) scale(1.15)">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                        </g>

                        <line class="gauge__needle" data-gauge-needle x1="200" y1="200" x2="316" y2="200" transform="rotate(-36 200 200)"/>
                        <circle class="gauge__hub" cx="200" cy="200" r="26"/>
                        <circle class="gauge__hub-dot" cx="200" cy="200" r="10"/>
                    </svg>

                    <p class="gauge__readout" aria-live="polite">
                        <strong class="gauge__score" data-gauge-score>80</strong>
                        <span class="gauge__status" data-gauge-status>Quase pronta</span>
                        <span class="gauge__count" data-gauge-count>4 de 5 informações preenchidas</span>
                    </p>

                    <ul class="gauge__legend">
                        <li class="gauge__legend-item gauge__legend-item--cold" data-band-legend="cold" data-band-upto="2"><span class="gauge__dot" aria-hidden="true"></span>Faltam informações</li>
                        <li class="gauge__legend-item gauge__legend-item--warm is-active" data-band-legend="warm" data-band-upto="4"><span class="gauge__dot" aria-hidden="true"></span>Quase pronta</li>
                        <li class="gauge__legend-item gauge__legend-item--hot" data-band-legend="hot"><span class="gauge__dot" aria-hidden="true"></span>Pronta para avançar</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--alt" aria-labelledby="funil-motivos-title">
        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Motivos de ganho e perda</span>
                <h2 class="section-title" id="funil-motivos-title">Entenda o que está por trás dos seus resultados</h2>
                <p class="section-lead">Registre por que cada negociação foi ganha ou perdida e use esse histórico para melhorar as próximas decisões comerciais.</p>
            </div>

            <!-- Comparativo: o mesmo construtor de relatório, dois resultados
                    opostos. Os dois recortes saem de "Criar Relatório Personalizado"
                    (relatório de ganhos.png / relatório de perdas.png) cortados nas
                    colunas que mudam — a data ("Ganho em" contra "Perda em"), o
                    negócio e o valor — e remontados sem o vão morto que a tela
                    original deixa entre "Nome" e "Valor": 645px em vez de 813,
                    que é o que faz o texto ficar legível dentro do card. Os dois
                    cards ficam claros de propósito: um escuro leria como
                    hierarquia, e não como comparação.
                    Sem .recurso-duo-cards: o teto de 880px daquela classe existe
                    para o texto quebrar em duas linhas, e aqui apertava a tabela. -->
            <div class="segments__grid">
                <article class="planos-highlight planos-highlight--win">
                    <span class="planos-highlight__icon" aria-hidden="true"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></span>
                    <h3>Vendas ganhas</h3>
                    <p>Identifique padrões, abordagens e condições que favorecem o fechamento.</p>
                    <div class="shot planos-highlight__report">
                        <img src="{{ asset('storage/site/funil-relatorio-ganhos.png') }}" alt="Relatório de vendas ganhas do Digify, com a data do ganho, o negócio e o valor de cada negociação fechada" width="645" height="483" loading="lazy">
                    </div>
                </article>
                <article class="planos-highlight planos-highlight--loss">
                    <span class="planos-highlight__icon" aria-hidden="true"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg></span>
                    <h3>Vendas perdidas</h3>
                    <p>Enxergue objeções, concorrentes, questões de preço e outros fatores que reduzem a conversão.</p>
                    <div class="shot planos-highlight__report">
                        <img src="{{ asset('storage/site/funil-relatorio-perdas.png') }}" alt="Relatório de vendas perdidas do Digify, com a data da perda, o negócio e o valor de cada negociação encerrada sem fechamento" width="645" height="483" loading="lazy">
                    </div>
                </article>
            </div>

            <p class="recurso-note">Mais contexto para ajustar o processo com base no que realmente acontece nas vendas.</p>
        </div>
    </section>

    <section class="performance" aria-labelledby="funil-tempo-title">
        <div class="performance__glow" aria-hidden="true"></div>

        <div class="container performance__inner">
            <div class="performance__head">
                <span class="section-label">Tempo em cada etapa</span>
                <h2 class="performance__title" id="funil-tempo-title">Encontre gargalos antes que eles custem uma venda</h2>
                <p class="performance__text">Veja há quanto tempo cada oportunidade permanece na mesma etapa e identifique rapidamente negociações que perderam ritmo.</p>
            </div>

            <!-- Recorte de gerenciar-fila-leads-qualificação.png. Cortado na base
                    da primeira fileira de cards por dois motivos: o Kanban completo
                    já aparece na dobra 2 (leads-kanban.png é um recorte desta mesma
                    tela), e o que sustenta esta dobra está na faixa de cima — a
                    contagem por etapa (Novo: 14 contra Contatado: 7 e Qualificado: 6,
                    ou seja, etapa acumulando negócios), "Sem responsável: 11" e o
                    "há N dias" de cada oportunidade. -->
            <div class="performance__showcase shot">
                <img src="{{ asset('storage/site/funil-fila-leads.png') }}" alt="Fila de oportunidades do Digify com a contagem por etapa, o total sem responsável e há quantos dias cada negociação está parada na mesma etapa" width="1657" height="542" loading="lazy">
            </div>

            <p class="recurso-note recurso-note--intro">Essa visão ajuda o gestor a perceber:</p>

            <div class="perf-points">
                <div class="perf-point">
                    <span class="perf-point__dot" aria-hidden="true"></span>
                    <strong class="perf-point__title">Oportunidades sem movimentação</strong>
                </div>
                <div class="perf-point">
                    <span class="perf-point__dot perf-point__dot--mint" aria-hidden="true"></span>
                    <strong class="perf-point__title">Etapas que estão acumulando negócios</strong>
                </div>
                <div class="perf-point">
                    <span class="perf-point__dot perf-point__dot--amber" aria-hidden="true"></span>
                    <strong class="perf-point__title">Negociações com ciclos acima do esperado</strong>
                </div>
                <div class="perf-point">
                    <span class="perf-point__dot perf-point__dot--rose" aria-hidden="true"></span>
                    <strong class="perf-point__title">Pontos do processo que precisam de ajuste</strong>
                </div>
            </div>

            <p class="recurso-note">Em vez de descobrir o problema no fim do mês, sua equipe consegue agir enquanto a venda ainda está em andamento.</p>

            <div class="performance__actions">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Comece grátis</a>
            </div>
        </div>
    </section>

    <section class="recurso-block" aria-labelledby="funil-carteira-title">
        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Visão da carteira comercial</span>
                <h2 class="section-title" id="funil-carteira-title">Saiba onde estão as oportunidades do seu time</h2>
                <p class="section-lead">Acompanhe a distribuição da carteira e tenha uma leitura mais clara do volume de negócios sob responsabilidade de cada vendedor. Uma visão compartilhada, para que todos trabalhem sobre as mesmas prioridades.</p>
            </div>

            <div class="segments__grid recurso-duo">
                <article class="planos-highlight">
                    <img class="planos-highlight__photo" src="{{ asset('storage/site/leads-vendedor.png') }}" alt="Vendedor acompanhando sua carteira de negociações no Digify" width="1672" height="941" loading="lazy">
                    <h3>Para quem vende</h3>
                    <ul class="plan-card__features">
                        <li>Prioridades mais claras</li>
                        <li>Negociações em andamento</li>
                        <li>Próximos passos</li>
                        <li>Oportunidades que precisam avançar</li>
                    </ul>
                </article>
                <article class="planos-highlight planos-highlight--dark">
                    <img class="planos-highlight__photo" src="{{ asset('storage/site/leads-gestor.png') }}" alt="Gestora analisando a distribuição da carteira comercial no Digify" width="1672" height="941" loading="lazy">
                    <h3>Para quem gerencia</h3>
                    <ul class="plan-card__features">
                        <li>Volume por responsável</li>
                        <li>Valores em negociação</li>
                        <li>Distribuição da carteira</li>
                        <li>Oportunidades paradas</li>
                        <li>Necessidade de apoio ao time</li>
                    </ul>
                </article>
            </div>

            <div class="cta-strip">
                <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece agora gratuitamente</a>
            </div>
        </div>
    </section>

    <section class="planos-cta" aria-labelledby="funil-cta-title">
        <div class="container planos-cta__inner">
            <h2 id="funil-cta-title">Coloque mais clareza e ritmo no seu processo de vendas</h2>
            <p>Organize as etapas, acompanhe cada oportunidade e dê ao seu time uma visão mais precisa do que precisa acontecer para a venda avançar.</p>
            <div class="planos-cta__actions">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Comece grátis</a>
            </div>
        </div>
    </section>
</main>