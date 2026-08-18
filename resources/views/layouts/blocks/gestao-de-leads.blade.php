@php
    $page = getPageById(6); //Planos
@endphp
<link rel="stylesheet" href="/build/assets/main.css">
<main id="main">
    <section class="recurso-hero" aria-labelledby="leads-title">
        <div class="recurso-hero__bg" aria-hidden="true">
            <span class="blob blob--1"></span>
            <span class="blob blob--2"></span>
            <span class="blob blob--3"></span>
        </div>

        <div class="container recurso-hero__inner">
            <div class="recurso-hero__copy">
                <span class="section-label">Gestão de Leads</span>
                <h1 class="recurso-hero__title" id="leads-title">Organize seus leads desde o <span class="text-grad">primeiro contato</span></h1>
                <p class="recurso-hero__lead">Cadastre, distribua e acompanhe cada lead em um único lugar. Sua equipe sabe quem precisa de atenção, quais contatos já foram trabalhados e quais estão prontos para avançar.</p>

                <div class="recurso-hero__actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">
                        Comece grátis
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <div class="recurso-hero__visual">
                <img class="recurso-hero__screen" src="{{asset('storage/site/recurso-leads.png')}}" alt="Tela de leads do Digify com detalhes de contato, origem, responsável e atividades" width="1672" height="940" loading="eager">

                <div class="recurso-hero__float recurso-hero__float--a" aria-hidden="true">
                    <span class="recurso-hero__float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg></span>
                    <span>
                        <strong class="recurso-hero__float-value">24 novos leads</strong>
                        <span class="recurso-hero__float-label">Entraram hoje</span>
                    </span>
                </div>

                <div class="recurso-hero__float recurso-hero__float--b" aria-hidden="true">
                    <span class="recurso-hero__float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41 13.42 20.6a2 2 0 0 1-2.83 0L2 12V4a2 2 0 0 1 2-2h8l8.59 8.59a2 2 0 0 1 0 2.82Z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg></span>
                    <span>
                        <strong class="recurso-hero__float-value">Origem: Site</strong>
                        <span class="recurso-hero__float-label">62% já qualificados</span>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <section class="recurso-block" aria-labelledby="leads-cadastro-title">
        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Cadastro de leads</span>
                <h2 class="section-title" id="leads-cadastro-title">Registre novos contatos sem complicação</h2>
                <p class="section-lead">Adicione as informações necessárias para iniciar o acompanhamento comercial e mantenha cada lead disponível para toda a equipe.</p>
            </div>

            <div class="recurso-panel">
                <div class="recurso-panel__visual">
                    <img src="{{asset('storage/site/leads-cadastro.png')}}" alt="Cadastro de um lead no Digify com e-mail, telefone, origem, responsável, estágio, status e observações" width="1146" height="540" loading="lazy">
                </div>

                <div class="form-feats">
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Nome</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Empresa</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Telefone</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>E-mail</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Cargo</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Produto de interesse</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Observações</span>
                    </div>
                </div>
            </div>

            <p class="recurso-note">O cadastro serve como ponto de partida para atividades, qualificações e futuras oportunidades.</p>

            <div class="cta-strip">
                <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece agora gratuitamente</a>
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--dark" aria-labelledby="leads-importacao-title">
        <div class="performance__glow" aria-hidden="true"></div>

        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Importação de contatos</span>
                <h2 class="section-title" id="leads-importacao-title">Traga sua base para a Digify</h2>
            </div>

            <div class="recurso-showcase recurso-showcase--bare recurso-showcase--anchored">
                <p class="shot-balloon shot-balloon--csv">Importe contatos já existentes e reduza o trabalho de cadastrar cada lead manualmente.</p>
                <img src="{{asset('storage/site/leads-importar-contatos.png')}}" alt="Lista de pessoas do Digify com a ação de importar CSV e cadastrar novo contato" width="1697" height="897" loading="lazy">
            </div>

            <p class="section-lead recurso-showcase__note">Essa opção facilita a migração de planilhas e ajuda a começar com as informações comerciais que sua empresa já possui.</p>
        </div>
    </section>

    <section class="recurso-block recurso-block--alt" aria-labelledby="leads-origem-title">
        <div class="container recurso-split">
            <div class="recurso-split__copy">
                <span class="section-label">Origem dos leads</span>
                <h2 class="section-title" id="leads-origem-title">Saiba de onde cada oportunidade começou</h2>
                <p class="section-lead">Registre a origem dos leads para entender quais canais, campanhas ou ações comerciais estão gerando novos contatos.</p>

                <p class="recurso-note">Com essa informação, o gestor consegue analisar quais fontes trazem mais leads e quais avançam com maior frequência.</p>

                <div class="recurso-actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece grátis</a>
                </div>
            </div>

            <div class="recurso-split__visual">
                <ul class="recurso-labels">
                    <li class="recurso-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        Site
                    </li>
                    <li class="recurso-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        Indicação
                    </li>
                    <li class="recurso-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        Evento
                    </li>
                    <li class="recurso-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 11 18-5v12L3 14v-3z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg>
                        Campanha
                    </li>
                    <li class="recurso-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        Prospecção
                    </li>
                    <li class="recurso-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/><line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/></svg>
                        Redes sociais
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="recurso-block" aria-labelledby="leads-qualificacao-title">
        <div class="container recurso-split">
            <div class="recurso-split__copy">
                <span class="section-label">Qualificação</span>
                <h2 class="section-title" id="leads-qualificacao-title">Priorize os leads com maior potencial</h2>
                <p class="section-lead">Registre as informações levantadas durante o contato e diferencie quem ainda precisa ser trabalhado de quem já demonstra interesse em avançar.</p>
                <p class="section-lead">A qualificação ajuda o vendedor a direcionar tempo e abordagem de acordo com o perfil de cada lead.</p>

                <!-- Checklist que controla o medidor ao lado: cada critério
                        marcado empurra o ponteiro. Sem JS continuam sendo seis
                        caixas comuns, marcáveis, só sem o medidor reagindo. -->
                <div class="form-feats recurso-feats-2col">
                    <label class="form-feat form-feat--check">
                        <input class="form-feat__input" type="checkbox" data-gauge-check checked>
                        <span class="fi" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>
                        <span>Necessidade</span>
                    </label>
                    <label class="form-feat form-feat--check">
                        <input class="form-feat__input" type="checkbox" data-gauge-check checked>
                        <span class="fi" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>
                        <span>Interesse</span>
                    </label>
                    <label class="form-feat form-feat--check">
                        <input class="form-feat__input" type="checkbox" data-gauge-check checked>
                        <span class="fi" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>
                        <span>Momento de compra</span>
                    </label>
                    <label class="form-feat form-feat--check">
                        <input class="form-feat__input" type="checkbox" data-gauge-check checked>
                        <span class="fi" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>
                        <span>Perfil da empresa</span>
                    </label>
                    <label class="form-feat form-feat--check">
                        <input class="form-feat__input" type="checkbox" data-gauge-check>
                        <span class="fi" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>
                        <span>Aderência à solução</span>
                    </label>
                    <label class="form-feat form-feat--check">
                        <input class="form-feat__input" type="checkbox" data-gauge-check>
                        <span class="fi" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></span>
                        <span>Próximo passo</span>
                    </label>
                </div>

                <div class="recurso-actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece grátis</a>
                </div>
            </div>

            <div class="recurso-split__visual">
                <!-- Medidor: espelha o checklist ao lado. Sem JS fica estático
                        no estado inicial do markup (4 de 6 critérios). -->
                <div class="gauge" data-gauge data-band="warm" data-gauge-unit="critérios marcados">
                    <!-- Arco de raio 140 centrado em (200,200): 0 = 180°, 100 = 0°.
                            pathLength="100" faz o dasharray falar direto em pontos,
                            sem precisar do comprimento real (π × 140). -->
                    <svg class="gauge__svg" viewBox="0 0 400 258" aria-hidden="true" focusable="false">
                        <defs>
                            <!-- Degradê horizontal em coordenadas do próprio SVG. Como
                                    x = 200 + 140·cos(θ), cada parada foi posicionada no x
                                    do valor que ela representa — assim a cor acompanha a
                                    curva e não a projeção reta do arco. -->
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
                        <path class="gauge__fill" data-gauge-fill pathLength="100" stroke-dasharray="100" stroke-dashoffset="33" d="M60 200A140 140 0 0 1 340 200"/>

                        <g class="gauge__edge gauge__edge--cold" transform="translate(44 222) scale(1.15)">
                            <line x1="2" y1="12" x2="22" y2="12"/><line x1="12" y1="2" x2="12" y2="22"/>
                            <path d="m20 16-4-4 4-4"/><path d="m4 8 4 4-4 4"/>
                            <path d="m16 4-4 4-4-4"/><path d="m8 20 4-4 4 4"/>
                        </g>
                        <g class="gauge__edge gauge__edge--hot" transform="translate(328 222) scale(1.15)">
                            <path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.07-2.14-.22-4.05 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.15.43-2.29 1-3a2.5 2.5 0 0 0 2.5 2.5z"/>
                        </g>

                        <line class="gauge__needle" data-gauge-needle x1="200" y1="200" x2="316" y2="200" transform="rotate(-59.4 200 200)"/>
                        <circle class="gauge__hub" cx="200" cy="200" r="26"/>
                        <circle class="gauge__hub-dot" cx="200" cy="200" r="10"/>
                    </svg>

                    <p class="gauge__readout" aria-live="polite">
                        <strong class="gauge__score" data-gauge-score>67</strong>
                        <span class="gauge__status" data-gauge-status>Demonstra interesse</span>
                        <span class="gauge__count" data-gauge-count>4 de 6 critérios marcados</span>
                    </p>

                    <!-- As faixas vivem aqui: `data-band-upto` é o maior número
                            de critérios marcados que ainda cai na faixa (a última
                            é aberta). O JS lê daqui, não tem nada fixo nele. -->
                    <ul class="gauge__legend">
                        <li class="gauge__legend-item gauge__legend-item--cold" data-band-legend="cold" data-band-upto="2"><span class="gauge__dot" aria-hidden="true"></span>Precisa ser trabalhado</li>
                        <li class="gauge__legend-item gauge__legend-item--warm is-active" data-band-legend="warm" data-band-upto="4"><span class="gauge__dot" aria-hidden="true"></span>Demonstra interesse</li>
                        <li class="gauge__legend-item gauge__legend-item--hot" data-band-legend="hot"><span class="gauge__dot" aria-hidden="true"></span>Pronto para avançar</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--alt" aria-labelledby="leads-tags-title">
        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Tags e campos personalizados</span>
                <h2 class="section-title" id="leads-tags-title">Organize os leads de acordo com o seu processo</h2>
                <p class="section-lead">Use tags para identificar grupos, situações e prioridades. Crie campos personalizados para registrar dados específicos da sua operação.</p>
            </div>

            <div class="segments__grid recurso-duo-cards">
                <article class="recurso-media">
                    <img src="{{asset('storage/site/leads-tags.png')}}" alt="Janela de nova tag no Digify com nome, tipo e seleção de cor" width="581" height="720" loading="lazy">
                    <h3>Tags</h3>
                    <p>Facilitam a identificação rápida de perfis e contextos.</p>
                </article>
                <article class="recurso-media">
                    <img src="{{asset('storage/site/leads-campos-personalizados.png')}}" alt="Janela de novo campo personalizado no Digify com nome, módulo, tipo e máscara" width="581" height="720" loading="lazy">
                    <h3>Campos personalizados</h3>
                    <p>Permitem guardar informações que não fazem parte do cadastro padrão.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--dark" aria-labelledby="leads-distribuicao-title">
        <div class="performance__glow" aria-hidden="true"></div>

        <div class="container recurso-split">
            <div class="recurso-split__copy">
                <span class="section-label">Distribuição de responsáveis</span>
                <h2 class="section-title" id="leads-distribuicao-title">Cada lead com uma pessoa responsável</h2>
                <p class="section-lead">Direcione os contatos para os vendedores e deixe claro quem deve conduzir cada atendimento.</p>
                <p class="recurso-note">A distribuição evita leads sem acompanhamento e reduz dúvidas sobre responsabilidades dentro da equipe.</p>

                <div class="recurso-actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Comece agora gratuitamente</a>
                </div>
            </div>

            <div class="recurso-split__visual">
                <div class="recurso-stack">
                    <div class="perf-point">
                        <img class="recurso-stack__photo" src="{{asset('storage/site/leads-vendedor.png')}}" alt="Vendedor acompanhando seu pipeline de negócios no Digify" width="1672" height="941" loading="lazy">
                        <span><strong class="perf-point__title">Para o vendedor</strong><span class="perf-point__text">Carteira definida e prioridades visíveis.</span></span>
                    </div>
                    <div class="perf-point">
                        <img class="recurso-stack__photo" src="{{asset('storage/site/leads-gestor.png')}}" alt="Gestora analisando o funil comercial no painel de Pipeline Analytics do Digify" width="1672" height="941" loading="lazy">
                        <span><strong class="perf-point__title">Para o gestor</strong><span class="perf-point__text">Visão da quantidade de leads por responsável.</span></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="recurso-block" aria-labelledby="leads-historico-title">
        <div class="container recurso-split recurso-split--reverse">
            <div class="recurso-split__copy">
                <span class="section-label">Histórico do lead</span>
                <h2 class="section-title" id="leads-historico-title">Consulte tudo o que já aconteceu</h2>
                <p class="section-lead">Atividades, observações, alterações e contatos realizados permanecem registrados no histórico. Com isso, a equipe consegue retomar o atendimento com contexto, mesmo quando o responsável muda ou outra pessoa precisa participar da conversa.</p>

                <p class="recurso-note recurso-note--intro"><strong>Reúna no histórico:</strong></p>

                <div class="form-feats">
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Ligações</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Reuniões</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Tarefas</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Observações</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Mudanças de responsável</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Atualizações no cadastro</span>
                    </div>
                </div>

                <div class="recurso-actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece grátis</a>
                </div>
            </div>

            <div class="recurso-split__visual">
                <!-- Histórico em vetor (era um PNG). Sem casco em volta: só a
                        régua de abas, os marcos de dia e os cartões de atividade. -->
                <div class="timeline">
                    <div class="timeline__tabs" aria-hidden="true">
                        <span class="timeline__tab">Notas</span>
                        <span class="timeline__tab is-active">Atividades</span>
                        <span class="timeline__tab">Negócios</span>
                    </div>

                    <p class="timeline__day">Hoje</p>
                    <ul class="timeline__list">
                        <li class="timeline__item">
                            <span class="timeline__icon timeline__icon--meeting" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span>
                            <div class="timeline__card">
                                <div class="timeline__head">
                                    <h3 class="timeline__title">Reunião</h3>
                                    <span class="timeline__badge">Concluída</span>
                                </div>
                                <p class="timeline__desc">Apresentação da proposta comercial</p>
                                <p class="timeline__meta">Camila Marques • Hoje, 10:30</p>
                            </div>
                        </li>
                        <li class="timeline__item">
                            <span class="timeline__icon timeline__icon--owner" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
                            <div class="timeline__card">
                                <div class="timeline__head">
                                    <h3 class="timeline__title">Mudança de responsável</h3>
                                </div>
                                <p class="timeline__desc">Responsável alterado de João Dias para Camila Marques</p>
                                <p class="timeline__meta">Sistema • Hoje, 09:15</p>
                            </div>
                        </li>
                    </ul>

                    <p class="timeline__day">Ontem</p>
                    <ul class="timeline__list">
                        <li class="timeline__item">
                            <span class="timeline__icon timeline__icon--call" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg></span>
                            <div class="timeline__card">
                                <div class="timeline__head">
                                    <h3 class="timeline__title">Ligação</h3>
                                    <span class="timeline__badge">Realizada</span>
                                </div>
                                <p class="timeline__desc">Contato para alinhamento das necessidades</p>
                                <p class="timeline__meta">João Dias • Ontem, 16:40</p>
                            </div>
                        </li>
                        <li class="timeline__item">
                            <span class="timeline__icon timeline__icon--task" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="3"/><polyline points="16 9 10.5 15 8 12.5"/></svg></span>
                            <div class="timeline__card">
                                <div class="timeline__head">
                                    <h3 class="timeline__title">Tarefa</h3>
                                    <span class="timeline__badge">Concluída</span>
                                </div>
                                <p class="timeline__desc">Enviar proposta comercial</p>
                                <p class="timeline__meta">João Dias • Ontem, 14:20</p>
                            </div>
                        </li>
                    </ul>

                    <p class="timeline__day">12 ago. 2026</p>
                    <ul class="timeline__list">
                        <li class="timeline__item">
                            <span class="timeline__icon timeline__icon--note" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 4H4a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h9l8-8V5a1 1 0 0 0-1-1z"/><path d="M21 12h-6a2 2 0 0 0-2 2v6"/><line x1="7" y1="9" x2="15" y2="9"/><line x1="7" y1="13" x2="11" y2="13"/></svg></span>
                            <div class="timeline__card">
                                <div class="timeline__head">
                                    <h3 class="timeline__title">Observação</h3>
                                </div>
                                <p class="timeline__desc">Cliente demonstrou interesse no plano empresarial.</p>
                                <p class="timeline__meta">Camila Marques • 12 ago. 2026, 11:05</p>
                            </div>
                        </li>
                        <li class="timeline__item">
                            <span class="timeline__icon timeline__icon--edit" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.83 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5z"/><line x1="15" y1="5" x2="19" y2="9"/></svg></span>
                            <div class="timeline__card">
                                <div class="timeline__head">
                                    <h3 class="timeline__title">Atualização no cadastro</h3>
                                </div>
                                <p class="timeline__desc">Telefone e organização atualizados</p>
                                <p class="timeline__meta">Carla Menezes • 12 ago. 2026, 09:30</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--alt" aria-labelledby="leads-conversao-title">
        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Conversão em oportunidade</span>
                <h2 class="section-title" id="leads-conversao-title">Transforme interesse em negociação</h2>
                <p class="section-lead">Quando o lead estiver qualificado, converta o cadastro em uma oportunidade e continue o acompanhamento dentro do funil de vendas. As informações já registradas acompanham essa mudança, evitando retrabalho e perda de contexto.</p>
            </div>

            <div class="recurso-flow">
                <span class="recurso-flow__step">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Lead
                </span>
                <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                <span class="recurso-flow__step">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                    Qualificação
                </span>
                <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                <span class="recurso-flow__step">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    Conversão
                </span>
                <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                <span class="recurso-flow__step">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Z"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
                    Oportunidade
                </span>
                <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                <span class="recurso-flow__step">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    Negociação
                </span>
            </div>

            <div class="cta-strip">
                <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece grátis</a>
            </div>
        </div>
    </section>

    <section class="planos-cta" aria-labelledby="leads-cta-title">
        <div class="container planos-cta__inner">
            <h2 id="leads-cta-title">Dê um próximo passo para cada lead</h2>
            <p>Centralize seus contatos, organize a distribuição e acompanhe quem está pronto para avançar.</p>
            <div class="planos-cta__actions">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Comece grátis</a>
                @if (!empty($page))
                    <a href="{{ route('site.show', $page->slug) }}" class="button button--outline button--lg">Conheça os planos</a>
                @endif  
            </div>
        </div>
    </section>
</main>