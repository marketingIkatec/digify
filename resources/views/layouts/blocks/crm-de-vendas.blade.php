@php
    $page = getPageById(6); //Planos
@endphp
<link rel="stylesheet" href="/build/assets/main.css">
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

                <div class="recurso-showcase shot">
                    <img src="{{asset('storage/site/recurso-followup.png')}}" alt="Painel de atividades do Digify com tarefas, reuniões e follow-ups pendentes" width="1672" height="940" loading="lazy">
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
                        <span class="perf-point__dot" aria-hidden="true"></span>
                        <span><strong class="perf-point__title">Lead</strong><span class="perf-point__text">Dados de entrada, origem e qualificação.</span></span>
                    </div>
                    <div class="perf-point">
                        <span class="perf-point__dot perf-point__dot--mint" aria-hidden="true"></span>
                        <span><strong class="perf-point__title">Empresa e contato</strong><span class="perf-point__text">Informações das pessoas e organizações envolvidas.</span></span>
                    </div>
                    <div class="perf-point">
                        <span class="perf-point__dot perf-point__dot--amber" aria-hidden="true"></span>
                        <span><strong class="perf-point__title">Oportunidade</strong><span class="perf-point__text">Valor, etapa, responsável e andamento da negociação.</span></span>
                    </div>
                    <div class="perf-point">
                        <span class="perf-point__dot perf-point__dot--rose" aria-hidden="true"></span>
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
                    <span class="recurso-flow__step">Cadastro</span>
                    <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                    <span class="recurso-flow__step">Qualificação</span>
                    <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                    <span class="recurso-flow__step">Distribuição</span>
                    <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                    <span class="recurso-flow__step">Acompanhamento</span>
                    <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                    <span class="recurso-flow__step">Conversão</span>
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

                    <div class="form-feats">
                        <div class="form-feat">
                            <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                            <span>Registre o valor da negociação</span>
                        </div>
                        <div class="form-feat">
                            <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                            <span>Defina o responsável</span>
                        </div>
                        <div class="form-feat">
                            <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                            <span>Acompanhe a etapa atual</span>
                        </div>
                        <div class="form-feat">
                            <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                            <span>Planeje o próximo passo</span>
                        </div>
                        <div class="form-feat">
                            <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                            <span>Identifique oportunidades paradas</span>
                        </div>
                    </div>

                    <p class="recurso-note">Assim, o gestor visualiza o que está em andamento e o vendedor mantém suas prioridades no radar.</p>

                    <div class="recurso-actions">
                        <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece agora gratuitamente</a>
                    </div>
                </div>

                <div class="recurso-split__visual">
                    <div class="shot">
                        <img src="{{asset('storage/site/recurso-propostas.png')}}" alt="Tela de propostas do Digify com status, valores e etapa de cada negociação" width="1672" height="940" loading="lazy">
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
                            <p class="segment-card__text">Razão social, segmento, localização e informações comerciais.</p>
                        </div>
                    </article>
                    <article class="segment-card">
                        <div class="segment-card__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
                        <div>
                            <h3 class="segment-card__title">Contatos</h3>
                            <p class="segment-card__text">Nome, cargo, telefone, e-mail e participação na negociação.</p>
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
                    <div class="shot">
                        <img src="{{asset('storage/site/recurso-leads.png')}}" alt="Tela de leads do Digify com histórico de interações, atividades e próximos passos" width="1672" height="940" loading="lazy">
                    </div>
                </div>
            </div>
        </section>

        <section class="recurso-block" aria-labelledby="crm-campos-title">
            <div class="container">
                <div class="section-head--center">
                    <span class="section-label">Campos personalizados</span>
                    <h2 class="section-title" id="crm-campos-title">Registre as informações que realmente importam para a sua operação</h2>
                    <p class="section-lead">Cada processo comercial exige dados diferentes. Na Digify, você pode criar campos personalizados para leads, contatos, empresas e oportunidades, mantendo as informações importantes dentro do próprio CRM.</p>
                </div>

                <div class="recurso-callout">
                    <div class="privacy-notice">
                        <span class="privacy-notice__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg></span>
                        <p><em>Assim, a equipe trabalha com cadastros mais completos e reduz a dependência de planilhas ou controles separados.</em></p>
                    </div>
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

                <div class="segments__grid recurso-duo">
                    <article class="planos-highlight">
                        <span class="planos-highlight__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></span>
                        <h3>Para o vendedor</h3>
                        <ul class="plan-card__features">
                            <li>Carteira organizada</li>
                            <li>Atividades prioritárias</li>
                            <li>Negociações em andamento</li>
                            <li>Próximos passos</li>
                        </ul>
                    </article>
                    <article class="planos-highlight planos-highlight--dark">
                        <span class="planos-highlight__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></span>
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