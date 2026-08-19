@php
    $page = getPageById(6); //Planos
@endphp
<link rel="stylesheet" href="/build/assets/main.css?cache=<?=date('His');?>">
<main id="main">
    <section class="recurso-hero" aria-labelledby="crm-title">
        <div class="recurso-hero__bg" aria-hidden="true">
            <span class="blob blob--1"></span>
            <span class="blob blob--2"></span>
            <span class="blob blob--3"></span>
        </div>

        <div class="container recurso-hero__inner">
            <div class="recurso-hero__copy">
                <span class="section-label">CRM de Vendas</span>
                <h1 class="recurso-hero__title" id="crm-title">Organize seu comercial em um <span class="text-grad">CRM simples de usar</span></h1>
                <p class="recurso-hero__lead">Centralize leads, contatos, empresas, oportunidades e atividades. Sua equipe acompanha cada venda do primeiro contato ao fechamento, sem depender de planilhas ou informações espalhadas.</p>

                <div class="recurso-hero__actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">
                        Comece grátis
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>

                <div class="hero__proof">
                    <span class="hero__proof-item">
                        <svg class="hero__proof-check" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        Sem cartão de crédito
                    </span>
                    <span class="hero__proof-item">
                        <svg class="hero__proof-check" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        Pronto para usar
                    </span>
                    <span class="hero__proof-item">
                        <svg class="hero__proof-check" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                        Cancele quando quiser
                    </span>
                </div>
            </div>

            <div class="recurso-hero__visual">
                <img class="recurso-hero__screen" src="{{asset('storage/site/home-negocios.png')}}" alt="Tela de negócios do Digify com oportunidades organizadas por etapa, valor e responsável" width="1672" height="941" loading="eager">

                <div class="recurso-hero__float recurso-hero__float--a" aria-hidden="true">
                    <span class="recurso-hero__float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Z"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg></span>
                    <span>
                        <strong class="recurso-hero__float-value">R$ 128.400</strong>
                        <span class="recurso-hero__float-label">Em negociação</span>
                    </span>
                </div>

                <div class="recurso-hero__float recurso-hero__float--b" aria-hidden="true">
                    <span class="recurso-hero__float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span>
                    <span>
                        <strong class="recurso-hero__float-value">8 pendentes</strong>
                        <span class="recurso-hero__float-label">Atividades de hoje</span>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <section class="recurso-block" aria-labelledby="crm-visao-title">
        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Visão geral do CRM</span>
                <h2 class="section-title" id="crm-visao-title">Tenha uma visão clara da sua operação comercial</h2>
                <p class="section-lead">A Digify reúne as informações e atividades que fazem parte das vendas. O time sabe o que precisa fazer e o gestor acompanha o andamento das negociações sem pedir atualizações a todo momento.</p>
            </div>

            <!-- Sem .shot: o PNG já é uma composição de fundo transparente, com
                    cantos arredondados e sombra embutida — a moldura branca viraria
                    um retângulo em volta dela. É panorâmica (2276x760), por isso
                    usa a largura cheia do container em vez do teto de 900px. -->
            <div class="recurso-showcase recurso-showcase--bare recurso-showcase--wide">
                <img src="{{asset('storage/site/crm-visao-geral.png')}}" alt="Visão geral do Digify com o pipeline de negócios, a lista de leads e as atividades pendentes da equipe" width="2276" height="760" loading="lazy">
            </div>

            <p class="recurso-note recurso-note--intro">Em um único CRM, você acompanha:</p>

            <ul class="feature-list">
                <li class="feature-item">
                    <span class="feature-item__icon"><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></span>
                    <span class="feature-item__title">Leads em atendimento</span>
                </li>
                <li class="feature-item">
                    <span class="feature-item__icon"><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></span>
                    <span class="feature-item__title">Oportunidades em negociação</span>
                </li>
                <li class="feature-item">
                    <span class="feature-item__icon"><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></span>
                    <span class="feature-item__title">Atividades pendentes</span>
                </li>
                <li class="feature-item">
                    <span class="feature-item__icon"><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></span>
                    <span class="feature-item__title">Responsáveis por cada contato</span>
                </li>
                <li class="feature-item">
                    <span class="feature-item__icon"><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></span>
                    <span class="feature-item__title">Movimentações do time</span>
                </li>
                <li class="feature-item">
                    <span class="feature-item__icon"><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></span>
                    <span class="feature-item__title">Próximos passos</span>
                </li>
            </ul>
        </div>
    </section>

    <section class="performance" aria-labelledby="crm-central-title">
        <div class="performance__glow" aria-hidden="true"></div>

        <div class="container performance__inner">
            <div class="performance__head">
                <span class="section-label">Centralização das informações</span>
                <h2 class="performance__title" id="crm-central-title">Pare de procurar informações em vários lugares</h2>
                <p class="performance__text">Planilhas, anotações e mensagens soltas dificultam o acompanhamento das vendas. Na Digify, os dados permanecem relacionados e disponíveis para toda a equipe.</p>
            </div>

            <div class="perf-points">
                <div class="perf-point">
                    <span class="perf-point__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg></span>
                    <span><strong class="perf-point__title">Lead</strong><span class="perf-point__text">Dados de entrada, origem e qualificação.</span></span>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--mint" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M5 21V7l7-4 7 4v14"/><path d="M9 9h.01"/><path d="M9 13h.01"/><path d="M15 9h.01"/><path d="M15 13h.01"/></svg></span>
                    <span><strong class="perf-point__title">Empresa e contato</strong><span class="perf-point__text">Informações das pessoas e organizações envolvidas.</span></span>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--amber" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></span>
                    <span><strong class="perf-point__title">Oportunidade</strong><span class="perf-point__text">Valor, etapa, responsável e andamento da negociação.</span></span>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--rose" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/><polyline points="9 15 11 17 15 13"/></svg></span>
                    <span><strong class="perf-point__title">Atividades</strong><span class="perf-point__text">Tarefas, reuniões, ligações e próximos passos.</span></span>
                </div>
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--alt" aria-labelledby="crm-leads-title">
        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Gestão de leads</span>
                <h2 class="section-title" id="crm-leads-title">Organize cada lead desde a entrada</h2>
                <p class="section-lead">Cadastre novos contatos, registre sua origem, defina responsáveis e reúna as informações necessárias para iniciar a abordagem comercial.</p>
            </div>

            <p class="recurso-note recurso-note--intro">Fluxo do lead na Digify:</p>

            <div class="recurso-flow">
                <span class="recurso-flow__step"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>Cadastro</span>
                <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                <span class="recurso-flow__step"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11 3 2 12h6l-1 9 9-9h-6l1-9z"/></svg>Qualificação</span>
                <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                <span class="recurso-flow__step"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.6" y1="10.5" x2="15.4" y2="6.5"/><line x1="8.6" y1="13.5" x2="15.4" y2="17.5"/></svg>Distribuição</span>
                <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                <span class="recurso-flow__step"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15.5 14"/></svg>Acompanhamento</span>
                <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                <span class="recurso-flow__step"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>Conversão</span>
            </div>

            <p class="recurso-note">O time visualiza quem precisa de contato, quais leads já foram trabalhados e quais estão prontos para avançar.</p>

            <div class="cta-strip">
                <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Começar gratuitamente</a>
            </div>
        </div>
    </section>

    <section class="recurso-block" aria-labelledby="crm-oportunidades-title">
        <div class="container recurso-split">
            <div class="recurso-split__copy">
                <span class="section-label">Gestão de oportunidades</span>
                <h2 class="section-title" id="crm-oportunidades-title">Acompanhe cada negociação até o fechamento</h2>
                <p class="section-lead">Ao identificar uma possibilidade de venda, transforme o lead em oportunidade e acompanhe sua evolução no processo comercial.</p>

                <p class="recurso-note">Assim, o gestor visualiza o que está em andamento e o vendedor mantém suas prioridades no radar.</p>

                <div class="recurso-actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece agora gratuitamente</a>
                </div>
            </div>

            <div class="recurso-split__visual">
                <!-- Carrossel: cada passo que era item do checklist virou um slide.
                        As cinco imagens são recortes 678x382 (~16:9), proporção que a
                        .slider__frame acompanha para entrarem sem tarja. -->
                <div class="slider" data-slider>
                    <div class="slider__viewport">
                        <ul class="slider__track" data-slider-track>
                            <li class="slider__slide" data-slider-slide>
                                <div class="slider__frame">
                                    <img src="{{asset('storage/site/crm-oportunidade-valor.png')}}" alt="Pipeline do Digify com o valor de cada negócio nas etapas de atendimento e proposta enviada" width="676" height="381" loading="lazy">
                                </div>
                                <p class="slider__caption">Registre o valor da negociação</p>
                            </li>
                            <li class="slider__slide" data-slider-slide>
                                <div class="slider__frame">
                                    <img src="{{asset('storage/site/crm-oportunidade-responsavel.png')}}" alt="Ficha de um lead no Digify com o campo Responsável preenchido" width="678" height="382" loading="lazy">
                                </div>
                                <p class="slider__caption">Defina o responsável</p>
                            </li>
                            <li class="slider__slide" data-slider-slide>
                                <div class="slider__frame">
                                    <img src="{{asset('storage/site/crm-oportunidade-etapa.png')}}" alt="Ficha de um lead no Digify mostrando o estágio atual, o status e a próxima atividade agendada" width="678" height="382" loading="lazy">
                                </div>
                                <p class="slider__caption">Acompanhe a etapa atual</p>
                            </li>
                            <li class="slider__slide" data-slider-slide>
                                <div class="slider__frame">
                                    <img src="{{asset('storage/site/crm-oportunidade-proximo-passo.png')}}" alt="Painel Pipeline Analytics do Digify com valor do pipeline, ticket médio, tempo médio no funil e conversão" width="678" height="382" loading="lazy">
                                </div>
                                <p class="slider__caption">Planeje o próximo passo</p>
                            </li>
                            <li class="slider__slide" data-slider-slide>
                                <div class="slider__frame">
                                    <img src="{{asset('storage/site/crm-oportunidade-paradas.png')}}" alt="Pipeline do Digify com as oportunidades paradas nas etapas de qualificação e novo lead" width="676" height="381" loading="lazy">
                                </div>
                                <p class="slider__caption">Identifique oportunidades paradas</p>
                            </li>
                        </ul>
                    </div>

                    <div class="slider__controls">
                        <button class="slider__arrow" type="button" data-slider-prev aria-label="Slide anterior">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
                        </button>
                        <div class="slider__dots" data-slider-dots role="tablist" aria-label="Escolher slide"></div>
                        <button class="slider__arrow" type="button" data-slider-next aria-label="Próximo slide">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--alt" aria-labelledby="crm-empresas-title">
        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Empresas e contatos</span>
                <h2 class="section-title" id="crm-empresas-title">Entenda quem participa de cada negociação</h2>
                <p class="section-lead">Uma empresa pode ter vários contatos envolvidos na compra. Na Digify, essas relações ficam organizadas no mesmo cadastro.</p>
            </div>

            <div class="segments__grid">
                <article class="segment-card">
                    <div class="segment-card__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 21h18"/><path d="M5 21V7l7-4 7 4v14"/><path d="M9 9h.01"/><path d="M9 13h.01"/><path d="M9 17h.01"/><path d="M15 9h.01"/><path d="M15 13h.01"/></svg></div>
                    <div>
                        <h3 class="segment-card__title">Empresa</h3>
                        <ul class="segment-card__list">
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Razão social</li>
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Segmento</li>
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Localização</li>
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Informações comerciais</li>
                        </ul>
                    </div>
                </article>
                <article class="segment-card">
                    <div class="segment-card__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
                    <div>
                        <h3 class="segment-card__title">Contatos</h3>
                        <ul class="segment-card__list">
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Nome</li>
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Cargo</li>
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Telefone e e-mail</li>
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>Participação na negociação</li>
                        </ul>
                    </div>
                </article>
            </div>

            <p class="recurso-note">Sua equipe identifica rapidamente quem decide, quem acompanha e com quem deve falar em cada etapa.</p>

            <div class="cta-strip">
                <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece agora gratuitamente</a>
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--dark" aria-labelledby="crm-historico-title">
        <div class="performance__glow" aria-hidden="true"></div>

        <div class="container recurso-split recurso-split--reverse">
            <div class="recurso-split__copy">
                <span class="section-label">Histórico de interações</span>
                <h2 class="section-title" id="crm-historico-title">Continue de onde a negociação parou</h2>
                <p class="section-lead">Tudo o que acontece fica registrado:</p>

                <div class="form-feats">
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Atividades realizadas</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Observações da equipe</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Mudanças de responsável</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Movimentações no processo</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Atualizações de dados</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Próximos passos definidos</span>
                    </div>
                </div>

                <p class="recurso-note">Se outra pessoa assumir o contato, ela encontra o contexto necessário para dar continuidade sem começar a conversa do zero.</p>
            </div>

            <div class="recurso-split__visual">
                <!-- Histórico em vetor, mesmo componente da página de leads,
                        na variante escura desta dobra. Sem casco em volta. -->
                <div class="timeline">
                    <div class="timeline__tabs" aria-hidden="true">
                        <span class="timeline__tab">Dados</span>
                        <span class="timeline__tab is-active">Histórico</span>
                        <span class="timeline__tab">Propostas</span>
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
                                <p class="timeline__desc">Alinhamento técnico com o time do cliente</p>
                                <p class="timeline__meta">Camila Marques • Hoje, 14:00</p>
                            </div>
                        </li>
                        <li class="timeline__item">
                            <span class="timeline__icon timeline__icon--stage" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                            <div class="timeline__card">
                                <div class="timeline__head">
                                    <h3 class="timeline__title">Movimentação no processo</h3>
                                </div>
                                <p class="timeline__desc">Oportunidade movida de Proposta para Negociação</p>
                                <p class="timeline__meta">Sistema • Hoje, 11:20</p>
                            </div>
                        </li>
                    </ul>

                    <p class="timeline__day">Ontem</p>
                    <ul class="timeline__list">
                        <li class="timeline__item">
                            <span class="timeline__icon timeline__icon--task" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="3"/><polyline points="16 9 10.5 15 8 12.5"/></svg></span>
                            <div class="timeline__card">
                                <div class="timeline__head">
                                    <h3 class="timeline__title">Atividade realizada</h3>
                                    <span class="timeline__badge">Concluída</span>
                                </div>
                                <p class="timeline__desc">Enviar proposta revisada ao cliente</p>
                                <p class="timeline__meta">João Dias • Ontem, 17:10</p>
                            </div>
                        </li>
                        <li class="timeline__item">
                            <span class="timeline__icon timeline__icon--note" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 4H4a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h9l8-8V5a1 1 0 0 0-1-1z"/><path d="M21 12h-6a2 2 0 0 0-2 2v6"/><line x1="7" y1="9" x2="15" y2="9"/><line x1="7" y1="13" x2="11" y2="13"/></svg></span>
                            <div class="timeline__card">
                                <div class="timeline__head">
                                    <h3 class="timeline__title">Observação da equipe</h3>
                                </div>
                                <p class="timeline__desc">Cliente pediu prazo maior para a implantação.</p>
                                <p class="timeline__meta">João Dias • Ontem, 15:45</p>
                            </div>
                        </li>
                    </ul>

                    <p class="timeline__day">12 ago. 2026</p>
                    <ul class="timeline__list">
                        <li class="timeline__item">
                            <span class="timeline__icon timeline__icon--owner" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
                            <div class="timeline__card">
                                <div class="timeline__head">
                                    <h3 class="timeline__title">Mudança de responsável</h3>
                                </div>
                                <p class="timeline__desc">Responsável alterado de Lucas Mendes para João Dias</p>
                                <p class="timeline__meta">Sistema • 12 ago. 2026, 09:30</p>
                            </div>
                        </li>
                        <li class="timeline__item">
                            <span class="timeline__icon timeline__icon--next" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15.5 14"/></svg></span>
                            <div class="timeline__card">
                                <div class="timeline__head">
                                    <h3 class="timeline__title">Próximo passo definido</h3>
                                    <span class="timeline__badge timeline__badge--soft">Agendado</span>
                                </div>
                                <p class="timeline__desc">Retomar contato após a aprovação interna</p>
                                <p class="timeline__meta">Camila Marques • 12 ago. 2026, 09:05</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="recurso-block" aria-labelledby="crm-campos-title">
        <div class="container recurso-split">
            <div class="recurso-split__copy">
                <span class="section-label">Campos personalizados</span>
                <h2 class="section-title" id="crm-campos-title">Registre as informações que realmente importam para a sua operação</h2>
                <p class="section-lead">Cada processo comercial exige dados diferentes. Na Digify, você pode criar campos personalizados para leads, contatos, empresas e oportunidades, mantendo as informações importantes dentro do próprio CRM.</p>
            </div>

            <div class="recurso-split__visual recurso-split__visual--float">
                <!-- PNG de fundo transparente com cantos arredondados: entra sem
                        moldura, a sombra vem do drop-shadow do .recurso-split__bare. -->
                <img class="recurso-split__bare" src="{{asset('storage/site/campos-personalizados.png')}}" alt="Criação de um campo personalizado no Digify e a ficha de uma organização exibindo os campos já preenchidos" width="1148" height="839" loading="lazy">

                <p class="media-float">
                    <span class="media-float__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg></span>
                    <em>Assim, a equipe trabalha com cadastros mais completos e reduz a dependência de planilhas ou controles separados.</em>
                </p>
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--alt" aria-labelledby="crm-equipe-title">
        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Organização da equipe</span>
                <h2 class="section-title" id="crm-equipe-title">Cada negociação com um responsável definido</h2>
                <p class="section-lead">Distribua leads e oportunidades entre os vendedores e mantenha as responsabilidades visíveis.</p>
            </div>

            <!-- Fotos: os mesmos PNGs de vendedor/gestor usados na página de
                    leads. Ambos têm fundo transparente, então entram sem moldura. -->
            <div class="segments__grid recurso-duo">
                <article class="planos-highlight">
                    <img class="planos-highlight__photo" src="{{asset('storage/site/leads-vendedor.png')}}" alt="Vendedor acompanhando sua carteira de negociações no Digify" width="1672" height="941" loading="lazy">
                    <h3>Para o vendedor</h3>
                    <ul class="plan-card__features">
                        <li>Carteira organizada</li>
                        <li>Atividades prioritárias</li>
                        <li>Negociações em andamento</li>
                        <li>Próximos passos</li>
                    </ul>
                </article>
                <article class="planos-highlight planos-highlight--dark">
                    <img class="planos-highlight__photo" src="{{asset('storage/site/leads-gestor.png')}}" alt="Gestora analisando a distribuição da carteira comercial no Digify" width="1672" height="941" loading="lazy">
                    <h3>Para o gestor</h3>
                    <ul class="plan-card__features">
                        <li>Distribuição da carteira</li>
                        <li>Volume por responsável</li>
                        <li>Andamento das oportunidades</li>
                        <li>Visão do trabalho da equipe</li>
                    </ul>
                </article>
            </div>

            <p class="recurso-note">Todos trabalham sobre a mesma base de informações.</p>

            <div class="cta-strip">
                <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece agora gratuitamente</a>
            </div>
        </div>
    </section>

    <section class="planos-cta" aria-labelledby="crm-cta-title">
        <div class="container planos-cta__inner">
            <h2 id="crm-cta-title">Comece a organizar suas vendas com a Digify</h2>
            <p>Crie sua conta, cadastre seus primeiros leads e acompanhe as negociações em um CRM preparado para a rotina da sua equipe.</p>
            <p><strong>Teste a Digify gratuitamente por 30 dias.</strong></p>
            <div class="planos-cta__actions">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Comece grátis</a>
                @if (!empty($page))
                    <a href="{{ route('site.show', $page->slug) }}" class="button button--outline button--lg">Conheça os planos</a>
                @endif                
            </div>
        </div>
    </section>
</main>
