<main id="main">

        <!-- ================= HERO ================= -->
        <section class="hero">
            <div class="hero__bg" aria-hidden="true">
                <span class="blob blob--1"></span>
                <span class="blob blob--2"></span>
                <span class="blob blob--3"></span>
            </div>

            <div class="container">
                <div class="hero__inner">
                    <div class="hero__copy">
                        <p class="hero__badge">
                            <span class="hero__badge-dot" aria-hidden="true"></span>
                            <span class="hero__badge-text">Implantação em minutos</span>
                        </p>

                        <h1 class="hero__title">O CRM para organizar suas vendas e <span class="text-grad">fechar mais negócios</span></h1>

                        <p class="hero__lead">Gerencie leads, oportunidades, tarefas e propostas em uma plataforma simples, intuitiva e pronta para usar.</p>

                        <div class="hero__actions">
                            <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">
                                Comece grátis
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </a>
                            <a href="{{route('home')}}#falar-com-especialista" class="button button--outline button--lg">Falar com consultor</a>
                        </div>

                        <div class="hero__proof">
                            <span class="hero__proof-item">
                                <svg class="hero__proof-check" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                                Sem cartão de crédito
                            </span>
                            <span class="hero__proof-item">
                                <svg class="hero__proof-check" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                                Use no mesmo dia
                            </span>
                            <span class="hero__proof-item">
                                <svg class="hero__proof-check" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                                Cancele quando quiser
                            </span>
                        </div>
                    </div>

                    <div class="hero__visual" aria-hidden="true">
                        <img class="home-hero__screen" src="{{asset('storage/site/home-negocios.png')}}" alt="" loading="eager">
                        <div class="home-hero__card home-hero__card--dist"><img src="{{asset('storage/site/home-card-dist.png')}}" alt="" loading="eager"></div>
                        <div class="home-hero__card home-hero__card--conv"><img src="{{asset('storage/site/home-card-conv.png')}}" alt="" loading="eager"></div>
                        <img class="home-hero__phone" src="{{asset('storage/site/home-phone.png')}}" alt="" loading="eager">
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= RECURSOS ================= -->
        <section class="features" id="recursos">
            <div class="container">
                <div class="tabs" role="tablist" aria-label="Recursos da Digify">
                    <button type="button" class="tabs__tab js-feature-tab is-active" role="tab" aria-selected="true" data-target="tab-leads">Gerencie leads e negócios</button>
                    <button type="button" class="tabs__tab js-feature-tab" role="tab" aria-selected="false" data-target="tab-followup">Follow-up e atividades</button>
                    <button type="button" class="tabs__tab js-feature-tab" role="tab" aria-selected="false" data-target="tab-pipeline">Pipeline visual</button>
                    <button type="button" class="tabs__tab js-feature-tab" role="tab" aria-selected="false" data-target="tab-metas">Metas e relatórios</button>
                </div>

                <!-- Aba: Leads -->
                <div class="features__panel is-active" id="tab-leads" role="tabpanel">
                    <div class="features__panel-head">
                        <h3 class="features__panel-title">Gerencie leads e negócios com tranquilidade</h3>
                        <p class="features__desc">Organize interações e dados de clientes em uma ferramenta simples e tome decisões ágeis quando a oportunidade surgir.</p>
                    </div>
                    <div class="features__panel-visual shot">
                        <img src="{{asset('storage/site/recurso-leads.png')}}" alt="Tela de leads do Digify com detalhes de contato, atividades e próximos passos" loading="lazy">
                    </div>
                    <ul class="feature-list">
                        <li class="feature-item">
                            <span class="feature-item__icon"><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></span>
                            <span><strong class="feature-item__title">Registre e acompanhe cada oportunidade</strong><span class="feature-item__text">Reúna responsável, etapa, score, histórico e valor de cada lead em uma única visão para toda a equipe.</span></span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-item__icon"><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></span>
                            <span><strong class="feature-item__title">Etiquetas de temperatura e prioridade</strong><span class="feature-item__text">Classifique os leads por temperatura e prioridade para concentrar o time nas melhores oportunidades.</span></span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-item__icon"><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></span>
                            <span><strong class="feature-item__title">Converta leads em negócios com um clique</strong><span class="feature-item__text">Avance oportunidades pelo funil sem perder o histórico completo de interações e o contexto de cada negociação.</span></span>
                        </li>
                    </ul>
                    <div class="features__actions"><a href="#falar-com-especialista" class="button button--primary">Saiba mais</a></div>
                </div>

                <!-- Aba: Follow-up -->
                <div class="features__panel" id="tab-followup" role="tabpanel">
                    <div class="features__panel-head">
                        <h3 class="features__panel-title">Um espaço para todas as suas atividades de vendas</h3>
                        <p class="features__desc">Mantenha o ritmo comercial com tarefas, lembretes e próximos passos visíveis para cada oportunidade em andamento.</p>
                    </div>
                    <div class="features__panel-visual shot">
                        <img src="{{asset('storage/site/recurso-followup.png')}}" alt="Tela de atividades do Digify com tarefas, ligações e reuniões do time" loading="lazy">
                    </div>
                    <ul class="feature-list">
                        <li class="feature-item">
                            <span class="feature-item__icon"><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></span>
                            <span><strong class="feature-item__title">Acompanhe cada retorno no prazo</strong><span class="feature-item__text">Crie tarefas de follow-up vinculadas a cada lead e receba alertas automáticos quando uma atividade vencer.</span></span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-item__icon"><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></span>
                            <span><strong class="feature-item__title">Histórico completo de interações</strong><span class="feature-item__text">Registre ligações, reuniões e e-mails em uma linha do tempo clara, sem depender de memória ou anotações soltas.</span></span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-item__icon"><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></span>
                            <span><strong class="feature-item__title">Visão consolidada de atividades do time</strong><span class="feature-item__text">O gestor acompanha atividades pendentes, atrasadas e concluídas em uma única visão de toda a equipe.</span></span>
                        </li>
                    </ul>
                    <div class="features__actions"><a href="#falar-com-especialista" class="button button--primary">Saiba mais</a></div>
                </div>

                <!-- Aba: Pipeline -->
                <div class="features__panel" id="tab-pipeline" role="tabpanel">
                    <div class="features__panel-head">
                        <h3 class="features__panel-title">Visualize cada negociação no pipeline</h3>
                        <p class="features__desc">Veja o que entrou, o que avançou e onde estão os gargalos, tudo em um quadro visual que o time atualiza em segundos.</p>
                    </div>
                    <div class="features__panel-visual shot">
                        <img src="{{asset('storage/site/recurso-pipeline.png')}}" alt="Pipeline de negócios do Digify em formato Kanban com etapas e valores" loading="lazy">
                    </div>
                    <ul class="feature-list">
                        <li class="feature-item">
                            <span class="feature-item__icon"><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></span>
                            <span><strong class="feature-item__title">Pipeline Kanban com etapas personalizáveis</strong><span class="feature-item__text">Personalize as etapas do funil, mova os negócios conforme avançam e acompanhe o valor previsto de cada fase.</span></span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-item__icon"><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></span>
                            <span><strong class="feature-item__title">Identifique gargalos rapidamente</strong><span class="feature-item__text">Detecte onde os negócios param, quais etapas acumulam oportunidades paradas e qual vendedor precisa de suporte.</span></span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-item__icon"><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></span>
                            <span><strong class="feature-item__title">Visão de valor total por etapa</strong><span class="feature-item__text">Acompanhe o volume financeiro em cada fase do funil para priorizar as negociações de maior impacto.</span></span>
                        </li>
                    </ul>
                    <div class="features__actions"><a href="#falar-com-especialista" class="button button--primary">Saiba mais</a></div>
                </div>

                <!-- Aba: Metas -->
                <div class="features__panel" id="tab-metas" role="tabpanel">
                    <div class="features__panel-head">
                        <h3 class="features__panel-title">Insights de vendas instantâneos</h3>
                        <p class="features__desc">Acompanhe metas, desempenho e resultados do time sem precisar montar relatórios manualmente ou consolidar dados espalhados por diferentes fontes.</p>
                    </div>
                    <div class="features__panel-visual shot">
                        <img src="{{asset('storage/site/recurso-propostas.png')}}" alt="Tela de propostas do Digify com status, valores e responsáveis" loading="lazy">
                    </div>
                    <ul class="feature-list">
                        <li class="feature-item">
                            <span class="feature-item__icon"><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></span>
                            <span><strong class="feature-item__title">Metas com progresso em tempo real</strong><span class="feature-item__text">Defina metas por vendedor ou time e acompanhe o avanço sem precisar pedir atualizações para ninguém.</span></span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-item__icon"><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></span>
                            <span><strong class="feature-item__title">Relatórios prontos, sem configuração</strong><span class="feature-item__text">Taxas de conversão, tempo médio por etapa, negócios ganhos e perdidos, todos disponíveis com apenas um clique.</span></span>
                        </li>
                        <li class="feature-item">
                            <span class="feature-item__icon"><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></span>
                            <span><strong class="feature-item__title">Decisões baseadas em dados</strong><span class="feature-item__text">Identifique o que está funcionando, corrija rapidamente o que está travado e dê previsibilidade à operação.</span></span>
                        </li>
                    </ul>
                    <div class="features__actions"><a href="#falar-com-especialista" class="button button--primary">Saiba mais</a></div>
                </div>
            </div>
        </section>

        <!-- ================= PERFORMANCE ================= -->
        <section class="performance" id="performance">
            <div class="performance__glow" aria-hidden="true"></div>
            <div class="container">
                <div class="performance__inner">
                    <div class="performance__head">
                        <span class="section-label">Performance comercial</span>
                        <h2 class="performance__title">Inteligência para vender com<br>mais previsibilidade</h2>
                        <p class="performance__text">Acompanhe metas, antecipe resultados e tome decisões com base em dados reais da operação, não em estimativas ou controles desatualizados.</p>
                    </div>

                    <div class="performance__showcase shot">
                        <img src="{{asset('storage/site/performance-analytics.png')}}" alt="Painel de analytics do funil do Digify com distribuição por etapa e conversão" loading="lazy">
                    </div>

                    <div class="perf-points">
                        <div class="perf-point">
                            <span class="perf-point__dot" aria-hidden="true"></span>
                            <span><strong class="perf-point__title">Objetivos comerciais</strong><span class="perf-point__text">Defina metas por vendedor ou equipe e acompanhe o progresso em tempo real. Saiba quem está no ritmo e quem precisa de suporte antes do fim do mês.</span></span>
                        </div>
                        <div class="perf-point">
                            <span class="perf-point__dot perf-point__dot--mint" aria-hidden="true"></span>
                            <span><strong class="perf-point__title">Forecast</strong><span class="perf-point__text">Projete a receita do período com base nas oportunidades em aberto e na probabilidade de fechamento de cada etapa do funil.</span></span>
                        </div>
                        <div class="perf-point">
                            <span class="perf-point__dot perf-point__dot--amber" aria-hidden="true"></span>
                            <span><strong class="perf-point__title">Pipeline Analytics</strong><span class="perf-point__text">Analise taxa de conversão, ciclo médio de vendas, ticket médio e gargalos por etapa. Dados concretos que mostram onde a operação pode melhorar.</span></span>
                        </div>
                        <div class="perf-point">
                            <span class="perf-point__dot perf-point__dot--rose" aria-hidden="true"></span>
                            <span><strong class="perf-point__title">Dashboards personalizados</strong><span class="perf-point__text">Monte painéis com os indicadores que importam para o seu negócio. Receita, leads ativos, desempenho por vendedor e muito mais reunidos em uma única tela.</span></span>
                        </div>
                    </div>

                    <div class="performance__actions">
                        <a href="#falar-com-especialista" class="button button--white">Conhecer módulos de performance</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= FUNCIONALIDADES (MÓDULOS) ================= -->
        <section class="modules" id="modules">
            <div class="container">
                <div class="modules__head section-head--center">
                    <span class="section-label">Módulos</span>
                    <h2 class="section-title">Tudo que você precisa para vender com processo</h2>
                    <p class="section-lead">A Digify reúne CRM, automação, relatórios e inteligência comercial em uma plataforma modular. Comece com o essencial e expanda conforme sua operação cresce.</p>
                </div>

                <div class="modules__group">
                    <div class="modules__grid">
                        <article class="module-card">
                            <div class="module-card__icon"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg></div>
                            <h3 class="module-card__name">CRM Kanban</h3>
                            <p class="module-card__desc">Gerencie negócios em um funil visual com etapas personalizáveis.</p>
                        </article>
                        <article class="module-card">
                            <div class="module-card__icon"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
                            <h3 class="module-card__name">Leads e Contatos</h3>
                            <p class="module-card__desc">Cadastro completo de leads, empresas e pessoas com histórico unificado.</p>
                        </article>
                        <article class="module-card">
                            <div class="module-card__icon"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>
                            <h3 class="module-card__name">Atividades</h3>
                            <p class="module-card__desc">Tarefas, follow-ups e lembretes vinculados a cada lead ou negócio.</p>
                        </article>
                        <article class="module-card">
                            <div class="module-card__icon"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
                            <h3 class="module-card__name">Agenda e Calendário</h3>
                            <p class="module-card__desc">Visualize compromissos e atividades do time em um calendário comercial.</p>
                        </article>
                        <article class="module-card">
                            <div class="module-card__icon"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
                            <h3 class="module-card__name">Feed e Notas</h3>
                            <p class="module-card__desc">Linha do tempo de interações e anotações por oportunidade ou contato.</p>
                        </article>
                        <article class="module-card">
                            <div class="module-card__icon"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></div>
                            <h3 class="module-card__name">Relatórios</h3>
                            <p class="module-card__desc">Conversão, desempenho e resultados disponíveis sem configuração manual.</p>
                        </article>
                        <article class="module-card">
                            <div class="module-card__icon"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg></div>
                            <h3 class="module-card__name">Campos personalizados</h3>
                            <p class="module-card__desc">Adapte o CRM ao seu processo com campos e informações específicas do negócio.</p>
                        </article>
                        <article class="module-card">
                            <div class="module-card__icon"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg></div>
                            <h3 class="module-card__name">Dashboards</h3>
                            <p class="module-card__desc">Painéis configuráveis com os indicadores que importam para a sua gestão.</p>
                        </article>
                        <article class="module-card">
                            <div class="module-card__icon"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
                            <h3 class="module-card__name">Equipes</h3>
                            <p class="module-card__desc">Gerencie permissões, times e visibilidade de dados por grupo de usuários.</p>
                        </article>
                    </div>
                </div>

                <!--<div class="cta-strip">
                    <a href="#falar-com-especialista" class="button button--outline">Conhecer todos os módulos</a>
                </div>-->
            </div>
        </section>

        <!-- ================= FLUXO (CARROSSEL 3D) ================= -->
        <section class="showcase" id="fluxo">
            <div class="container">
                <div class="showcase__head">
                    <span class="section-label">Funcionalidades</span>
                    <h2 class="section-title">Do lead ao fechamento,<br><span class="text-grad">cada etapa no lugar certo</span></h2>
                    <p class="section-lead">Conduza o processo comercial de ponta a ponta em um CRM integrado à Digify.</p>
                </div>

                <div class="carousel-3d" role="region" aria-roledescription="carrossel" aria-label="Fluxo do lead ao fechamento">
                    <div class="carousel-3d__track">
                        <article class="carousel-card is-center js-carousel-card" data-index="0" aria-label="Slide 1 de 5">
                            <div class="carousel-card__chrome" aria-hidden="true">
                                <span class="carousel-card__dot carousel-card__dot--1"></span>
                                <span class="carousel-card__dot carousel-card__dot--2"></span>
                                <span class="carousel-card__dot carousel-card__dot--3"></span>
                            </div>
                            <div class="carousel-card__screen"><img src="{{asset('storage/site/recurso-leads.png')}}" alt="Captura e organização de leads no Digify" loading="lazy"></div>
                            <div class="carousel-card__footer">
                                <strong class="carousel-card__title">01 — Capture e organize leads</strong>
                                <span class="carousel-card__caption">Transforme contatos em oportunidades acompanháveis.</span>
                            </div>
                        </article>

                        <article class="carousel-card is-right-1 js-carousel-card" data-index="1" aria-label="Slide 2 de 5">
                            <div class="carousel-card__chrome" aria-hidden="true">
                                <span class="carousel-card__dot carousel-card__dot--1"></span>
                                <span class="carousel-card__dot carousel-card__dot--2"></span>
                                <span class="carousel-card__dot carousel-card__dot--3"></span>
                            </div>
                            <div class="carousel-card__screen"><img src="{{asset('storage/site/recurso-pipeline.png')}}" alt="Funil de vendas do Digify em formato Kanban" loading="lazy"></div>
                            <div class="carousel-card__footer">
                                <strong class="carousel-card__title">02 — Controle o funil de vendas</strong>
                                <span class="carousel-card__caption">Veja em qual etapa cada negociação está.</span>
                            </div>
                        </article>

                        <article class="carousel-card is-right-2 js-carousel-card" data-index="2" aria-label="Slide 3 de 5">
                            <div class="carousel-card__chrome" aria-hidden="true">
                                <span class="carousel-card__dot carousel-card__dot--1"></span>
                                <span class="carousel-card__dot carousel-card__dot--2"></span>
                                <span class="carousel-card__dot carousel-card__dot--3"></span>
                            </div>
                            <div class="carousel-card__screen"><img src="{{asset('storage/site/recurso-followup.png')}}" alt="Atividades e próximos passos no Digify" loading="lazy"></div>
                            <div class="carousel-card__footer">
                                <strong class="carousel-card__title">03 — Defina os próximos passos</strong>
                                <span class="carousel-card__caption">Registre atividades, lembretes e follow-ups.</span>
                            </div>
                        </article>

                        <article class="carousel-card is-left-2 js-carousel-card" data-index="3" aria-label="Slide 4 de 5">
                            <div class="carousel-card__chrome" aria-hidden="true">
                                <span class="carousel-card__dot carousel-card__dot--1"></span>
                                <span class="carousel-card__dot carousel-card__dot--2"></span>
                                <span class="carousel-card__dot carousel-card__dot--3"></span>
                            </div>
                            <div class="carousel-card__screen"><img src="{{asset('storage/site/recurso-propostas.png')}}" alt="Acompanhamento de propostas no Digify" loading="lazy"></div>
                            <div class="carousel-card__footer">
                                <strong class="carousel-card__title">04 — Acompanhe propostas</strong>
                                <span class="carousel-card__caption">Mantenha controle sobre negociações abertas.</span>
                            </div>
                        </article>

                        <article class="carousel-card is-left-1 js-carousel-card" data-index="4" aria-label="Slide 5 de 5">
                            <div class="carousel-card__chrome" aria-hidden="true">
                                <span class="carousel-card__dot carousel-card__dot--1"></span>
                                <span class="carousel-card__dot carousel-card__dot--2"></span>
                                <span class="carousel-card__dot carousel-card__dot--3"></span>
                            </div>
                            <div class="carousel-card__screen"><img src="{{asset('storage/site/performance-analytics.png')}}" alt="Analytics do funil de vendas no Digify" loading="lazy"></div>
                            <div class="carousel-card__footer">
                                <strong class="carousel-card__title">05 — Analise a operação</strong>
                                <span class="carousel-card__caption">Dados para entender gargalos, avanços e prioridades.</span>
                            </div>
                        </article>
                    </div>
                </div>

                <nav class="carousel-nav" aria-label="Controles do carrossel">
                    <button type="button" class="carousel-nav__btn js-carousel-prev" aria-label="Slide anterior">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>
                    </button>
                    <div class="carousel-dots" role="tablist" aria-label="Slides">
                        <button type="button" class="carousel-dot is-active js-carousel-dot" data-dot="0" aria-label="Ir para o slide 1"></button>
                        <button type="button" class="carousel-dot js-carousel-dot" data-dot="1" aria-label="Ir para o slide 2"></button>
                        <button type="button" class="carousel-dot js-carousel-dot" data-dot="2" aria-label="Ir para o slide 3"></button>
                        <button type="button" class="carousel-dot js-carousel-dot" data-dot="3" aria-label="Ir para o slide 4"></button>
                        <button type="button" class="carousel-dot js-carousel-dot" data-dot="4" aria-label="Ir para o slide 5"></button>
                    </div>
                    <button type="button" class="carousel-nav__btn js-carousel-next" aria-label="Próximo slide">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                </nav>
            </div>
        </section>

        <!-- ================= PARA QUEM ================= -->
        <section class="segments" id="para-quem">
            <div class="container">
                <div class="segments__head">
                    <span class="section-label">Para quem</span>
                    <h2 class="section-title">Para equipes que precisam de controle, não de complexidade</h2>
                    <p class="section-lead">Digify é pensada para times enxutos que vendem com processo, sem precisar de um CRM corporativo para isso.</p>
                </div>

                <div class="segments__grid">
                    <article class="segment-card">
                        <div class="segment-card__icon"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg></div>
                        <div>
                            <h3 class="segment-card__title">Pequenas empresas</h3>
                            <p class="segment-card__text">Organize leads, negócios e atividades sem adotar uma ferramenta pesada ou gastar tempo treinando o time.</p>
                        </div>
                    </article>
                    <article class="segment-card">
                        <div class="segment-card__icon"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
                        <div>
                            <h3 class="segment-card__title">Times SDR e closer enxutos</h3>
                            <p class="segment-card__text">Mantenha responsáveis, próximos passos e negociações visíveis para toda a equipe sem reunião de alinhamento.</p>
                        </div>
                    </article>
                    <article class="segment-card">
                        <div class="segment-card__icon"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></div>
                        <div>
                            <h3 class="segment-card__title">Gestores comerciais</h3>
                            <p class="segment-card__text">Acompanhe metas, resultados e o funil sem precisar coletar informações em vários lugares ou pedir status para cada vendedor.</p>
                        </div>
                    </article>
                    <article class="segment-card">
                        <div class="segment-card__icon"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
                        <div>
                            <h3 class="segment-card__title">Empresas em fase de estruturação comercial</h3>
                            <p class="segment-card__text">Implante um processo de vendas real sem curva de aprendizado longa. Comece a operar no mesmo dia, com estrutura para crescer.</p>
                        </div>
                    </article>
                </div>

                <div class="cta-strip">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary">Começar agora</a>
                </div>
            </div>
        </section>

        <!-- ================= INTEGRAÇÕES ================= -->
        <section class="integrations" id="integracoes">
            <div class="container">
                <div class="section-head--center">
                    <span class="section-label">Integrações</span>
                    <h2 class="section-title">Conecte a Digify à sua operação</h2>
                    <p class="section-lead">Leve organização para os canais que já fazem parte da sua rotina. API aberta para criar fluxos personalizados entre sistemas.</p>
                </div>

                <div class="integrations__grid">
                    <span class="integration-chip"><span class="integration-chip__dot"></span>WhatsApp</span>
                    <span class="integration-chip"><span class="integration-chip__dot"></span>E-mail</span>
                    <span class="integration-chip"><span class="integration-chip__dot"></span>Instagram</span>
                    <span class="integration-chip"><span class="integration-chip__dot"></span>Digify</span>
                    <span class="integration-chip"><span class="integration-chip__dot"></span>Zapier</span>
                    <span class="integration-chip"><span class="integration-chip__dot"></span>API Aberta</span>
                    <span class="integration-chip"><span class="integration-chip__dot"></span>Webhooks</span>
                    <span class="integration-chip"><span class="integration-chip__dot"></span>Formulários Web</span>
                </div>

                <a href="#falar-com-especialista" class="button button--outline">Saiba mais sobre integrações</a>
            </div>
        </section>

        <!-- ================= FAQ ================= -->
        <section class="faq" id="faq">
            <div class="container">
                <div class="section-head--center">
                    <h2 class="section-title">Perguntas frequentes</h2>
                </div>

                <div class="faq__grid">
                    <article class="faq__item">
                        <h3 class="faq__question">O que é a Digify?</h3>
                        <p class="faq__answer">A Digify é um CRM comercial moderno e fácil de adotar, pensado para equipes que precisam organizar leads, follow-ups, propostas e negociações em um só lugar, sem complexidade de configuração.</p>
                    </article>
                    <article class="faq__item">
                        <h3 class="faq__question">Preciso ter experiência com CRM para usar?</h3>
                        <p class="faq__answer">Não. A Digify foi criada para ser fácil de entender e adotar. Seu time começa a operar no mesmo dia, sem treinamentos longos ou onboarding técnico.</p>
                    </article>
                    <article class="faq__item">
                        <h3 class="faq__question">A Digify é indicada para empresas que ainda não têm um processo comercial estruturado?</h3>
                        <p class="faq__answer">Sim. A Digify foi pensada para equipes que estão estruturando a operação comercial e precisam de uma ferramenta que organiza leads, atividades e negócios desde o primeiro dia, sem complexidade de implantação.</p>
                    </article>
                    <article class="faq__item">
                        <h3 class="faq__question">A Digify serve para times com poucos vendedores?</h3>
                        <p class="faq__answer">Sim. A Digify é especialmente indicada para equipes enxutas, inclusive times SDR e closer com 2 a 15 pessoas.</p>
                    </article>
                    <article class="faq__item">
                        <h3 class="faq__question">Posso testar antes de contratar?</h3>
                        <p class="faq__answer">Sim. Você tem 30 dias grátis para explorar todos os recursos, sem precisar de cartão de crédito e sem compromisso.</p>
                    </article>
                    <article class="faq__item">
                        <h3 class="faq__question">A Digify tem integração com WhatsApp?</h3>
                        <p class="faq__answer">Sim. A Digify se integra com WhatsApp, e-mail, Instagram e outras ferramentas da sua operação via API aberta e conectores nativos.</p>
                    </article>
                </div>
            </div>
        </section>

        <!-- ══════════════════════════════════════
         FORM
        ══════════════════════════════════════ -->
        <!--<section class="section form-section" id="cta" aria-labelledby="form-title">
            <div class="wrap" id="falar-com-especialista">
                <div class="form-grid">
                    <div class="form-copy reveal-left">
                        <span class="kicker">Fale com a equipe</span>
                        <h2 class="section-title" id="form-title">
                        Pronto para organizar<br>
                        <span class="grad">seu comercial</span>?
                        </h2>
                        <p>Comece hoje a organizar leads, follow-ups e negociações, sem configurações complexas ou treinamentos demorados.</p>

                        <div class="form-feats">
                            <div class="form-feat">
                                <div class="fi">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                    <polyline points="22 4 12 14.01 9 11.01"/>
                                </svg>
                                </div>
                                <span>Demo personalizada para o seu negócio</span>
                            </div>
                            <div class="form-feat">
                                <div class="fi">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                </svg>
                                </div>
                                <span>Integração nativa com a Digify</span>
                            </div>
                            <div class="form-feat">
                                <div class="fi">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                </div>
                                <span>Retorno em até 1 dia útil</span>
                            </div>
                            </div>
                        </div>

                        <div class="form-card reveal-right">
                            
                            
                            <form id="form-contact" name="form-digify" data-action="{{route('lead.leadContato.store')}}" method="POST">
                                @csrf
                                <input type="hidden" name="pageUri" value="{{url()->current()}}">
                                <input type="hidden" name="pageName" value="{{SEOTools::getTitle()}}">
                                <input type="hidden" name="form_type" value="demonstracao">
                                
                                <input type="hidden" name="utm_id"       value="{{ request()->utm_id }}">
                                <input type="hidden" name="utm_campaign" value="{{ request()->utm_campaign }}">
                                <input type="hidden" name="utm_term"     value="{{ request()->utm_term }}">
                                <input type="hidden" name="utm_source"   value="{{ request()->utm_source }}">
                                <input type="hidden" name="utm_content"  value="{{ request()->utm_content }}">
                                <input type="hidden" name="utm_content"  value="{{ request()->utm_content }}">
                                <input type="hidden" name="utm_medium"   value="{{ request()->utm_medium }}">
                                <input type="hidden" name="gclid"        value="{{ request()->gclid }}"> 
                                    
                                <h3>Solicitar demonstração</h3>
                                <p class="sub">30 dias grátis · Sem cartão de crédito · Cancele quando quiser</p>
    
                            
                               <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" id="nome" name="nome" placeholder="Digite seu nome">
                                </div>

                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="text" id="email" name="email" placeholder="Digite seu e-mail">
                                </div>

                                <div class="form-group">
                                    <label>WhatsApp</label>
                                    <input type="text" name="whatsaap" id="whatsaap" class="whatsaap">
                                </div>
                                <div class="form-group">
                                    <label for="empresa">Empresa</label>
                                    <input type="text" id="empresa" name="empresa" placeholder="Nome da sua organização">
                                </div>
                                <div class="form-group">
                                    <label for="colaboradores">Nº de colaboradores</label>
                                    <select id="colaboradores" name="colaboradores">
                                        <option value="" disabled="" selected="">Selecione uma opção</option>
                                        <option value="1">1</option>
                                        <option value="2 - 3">2 - 3</option>
                                        <option value="4 - 10">4 - 10</option>
                                        <option value="11 - 50">11 - 50</option>
                                        <option value="51 - 200">51 - 200</option>
                                        <option value="Mais de 200">Mais de 200</option>    
                                    </select>
                                </div>

                                <div id="error-message"></div>

                                <div class="form-group-checkbox">
                                    <input type="checkbox" id="termos" name="termos" value="1">
                                    <label for="termos">
                                        Para prosseguir com o atendimento, confirme sua concordância em receber comunicações. Leia nossa
                                        
                                        @php
                                        $page = getPageById(2); //Privacidade
                                        @endphp
                                        @if (!empty($page))
                                            <a href="{{ route('site.show', $page->slug) }}">{{$page->titulo}}</a>
                                        @endif

                                        @php
                                            $page = getPageById(3); //Termos de Uso
                                        @endphp
                                        @if (!empty($page))
                                            <a href="{{ route('site.show', $page->slug) }}">{{$page->titulo}}</a>
                                        @endif
                                    </label>
                                </div>

                                <button class="btn-primary form-submit" data-sending="Enviando..." data-original-text="Falar com especialista">Falar com especialista
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="arrow-right" aria-hidden="true" class="lucide lucide-arrow-right w-5 h-5 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                                    <div class="shine"></div>
                                </button>
                            </form>
                       
                        <div id="form-success" class="form-success" role="status" aria-live="polite">
                            <div class="s-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 6 9 17l-5-5"/>
                                </svg>
                            </div>
                            <strong>Mensagem enviada!</strong>
                            <span>Nossa equipe entrará em contato em breve.</span>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

    </main>