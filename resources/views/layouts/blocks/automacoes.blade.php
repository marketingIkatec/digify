@php
    $page = getPageById(6); //Planos
    $pageApi = getPageById(23); //API e Integrações 
@endphp
<main id="main">
    <section class="recurso-hero" aria-labelledby="automacoes-title">
        <div class="recurso-hero__bg" aria-hidden="true">
            <span class="blob blob--1"></span>
            <span class="blob blob--2"></span>
            <span class="blob blob--3"></span>
        </div>

        <div class="container recurso-hero__inner">
            <div class="recurso-hero__copy">
                <span class="section-label">Automações</span>
                <h1 class="recurso-hero__title" id="automacoes-title">Regras que mantêm o processo <span class="text-grad">em movimento</span></h1>
                <p class="recurso-hero__lead">Crie regras para distribuir leads, gerar atividades, atualizar responsáveis e movimentar oportunidades sem depender de ações manuais a cada etapa.</p>

                <div class="recurso-hero__actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">
                        Comece grátis
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <!-- A vaga de imagem (.shot-slot) foi preenchida: automacoes-lista.png
                    é 1918x1079, proporção 1,778 — a mesma que o slot reservava.
                    Os dois selos só repetem o que está legível na tela: o gatilho
                    "Novo negócio criado" e a ação "Criar atividades". -->
            <div class="recurso-hero__visual">
                <img class="recurso-hero__screen" src="{{asset('storage/site/automacoes-lista.png')}}" alt="Construtor de automações do Digify com o gatilho, as condições e as ações de uma regra, sobre a lista de automações já criadas" width="1918" height="1079" loading="eager">

                <div class="recurso-hero__float recurso-hero__float--a" aria-hidden="true">
                    <span class="recurso-hero__float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg></span>
                    <span>
                        <strong class="recurso-hero__float-value">Novo negócio criado</strong>
                        <span class="recurso-hero__float-label">Gatilho da regra</span>
                    </span>
                </div>

                <div class="recurso-hero__float recurso-hero__float--b" aria-hidden="true">
                    <span class="recurso-hero__float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="3"/><polyline points="16 9 10.5 15 8 12.5"/></svg></span>
                    <span>
                        <strong class="recurso-hero__float-value">Criar atividades</strong>
                        <span class="recurso-hero__float-label">Ação automática</span>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <section class="recurso-block" aria-labelledby="automacoes-anatomia-title">
        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Visão geral das automações</span>
                <h2 class="section-title" id="automacoes-anatomia-title">Menos tarefas repetitivas. Mais tempo para vender.</h2>
                <p class="section-lead">Automatize ações que fazem parte da rotina comercial e mantenha o processo funcionando mesmo quando o time está focado nas negociações.</p>
            </div>

            <!-- Sem imagem aqui de propósito: os três cards já carregam a dobra
                    com definição e exemplos. -->
            <p class="recurso-note recurso-note--intro">Na Digify, toda regra combina três peças:</p>

            <!-- Cada card carrega definição E exemplo: sem o exemplo, sobrava
                    um ícone e duas linhas dentro de uma caixa grande. -->
            <div class="planos-highlights__grid">
                <article class="planos-highlight">
                    <span class="planos-highlight__icon" aria-hidden="true">1</span>
                    <h3>Gatilho</h3>
                    <p>Define quando a automação começa.</p>
                    <ul class="plan-card__features">
                        <li>Novo lead cadastrado</li>
                        <li>Oportunidade mudou de etapa</li>
                        <li>Informação atualizada</li>
                    </ul>
                </article>
                <article class="planos-highlight">
                    <span class="planos-highlight__icon" aria-hidden="true">2</span>
                    <h3>Condição</h3>
                    <p>Determina quais critérios precisam ser atendidos.</p>
                    <ul class="plan-card__features">
                        <li>Lead de determinada origem</li>
                        <li>Oportunidade acima de um valor</li>
                        <li>Negócio em uma etapa específica</li>
                    </ul>
                </article>
                <article class="planos-highlight">
                    <span class="planos-highlight__icon" aria-hidden="true">3</span>
                    <h3>Ação</h3>
                    <p>Executa o próximo passo automaticamente.</p>
                    <ul class="plan-card__features">
                        <li>Criar tarefas</li>
                        <li>Distribuir leads</li>
                        <li>Movimentar negócios no pipeline</li>
                    </ul>
                </article>
            </div>

            <p class="recurso-note"><strong>Quando isso acontece → se essas condições forem atendidas → faça isso.</strong></p>

            <div class="cta-strip">
                <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Criar primeira automação</a>
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--alt" aria-labelledby="automacoes-gatilhos-title">
        <div class="container recurso-split">
            <div class="recurso-split__copy">
                <span class="section-label">Gatilhos e condições</span>
                <h2 class="section-title" id="automacoes-gatilhos-title">Defina o momento certo e o cenário certo</h2>
                <p class="section-lead">Escolha os eventos que colocam uma regra em ação e use condições para decidir quando ela deve continuar. Assim a Digify inicia o próximo passo sozinha, sem tratar todas as situações da mesma forma.</p>

                <div class="recurso-actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece agora</a>
                </div>
            </div>

            <!-- O fecho em itálico não fica solto na coluna de texto: vira um
                    card que morde a base do cartão de regra e compõe com ele. -->
            <div class="recurso-split__visual recurso-split__visual--float">
                <article class="rule-card">
                    <div class="rule-card__body">
                        <div class="rule-block">
                            <p class="rule-block__label"><span class="rule-block__dot" aria-hidden="true"></span>Gatilhos disponíveis</p>
                            <ul class="rule-fields">
                                <li class="rule-field">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
                                    Novo lead cadastrado
                                </li>
                                <li class="rule-field">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                    Oportunidade mudou de etapa
                                </li>
                                <li class="rule-field">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                    Informação atualizada
                                </li>
                            </ul>
                        </div>

                        <div class="rule-connector" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                        </div>

                        <div class="rule-block">
                            <p class="rule-block__label"><span class="rule-block__dot" aria-hidden="true"></span>Condições</p>
                            <ul class="rule-fields">
                                <li class="rule-field">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                                    Lead de determinada origem
                                    <span class="rule-field__meta">Equipe específica</span>
                                </li>
                                <li class="rule-field">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                                    Oportunidade acima de um valor
                                    <span class="rule-field__meta">Acompanhamento próprio</span>
                                </li>
                                <li class="rule-field">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                                    Negócio em uma etapa específica
                                    <span class="rule-field__meta">Só daquele momento</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </article>

                <p class="media-float">
                    <span class="media-float__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg></span>
                    <span>Mais precisão para automatizar: a mesma operação pode ter regras diferentes para origens, valores e etapas diferentes.</span>
                </p>
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--dark" aria-labelledby="automacoes-acoes-title">
        <div class="performance__glow" aria-hidden="true"></div>

        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Ações automáticas</span>
                <h2 class="section-title" id="automacoes-acoes-title">Transforme regras comerciais em ações práticas</h2>
                <p class="section-lead">Depois que o gatilho e as condições são atendidos, a Digify executa a ação definida — e o processo segue sem ninguém precisar lembrar.</p>
            </div>

            <div class="perf-points perf-points--3">
                <div class="perf-point">
                    <span class="perf-point__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="3"/><polyline points="16 9 10.5 15 8 12.5"/></svg></span>
                    <strong class="perf-point__title">Criar tarefas</strong>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--mint" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><polyline points="17 11 19 13 23 9"/></svg></span>
                    <strong class="perf-point__title">Alterar responsáveis</strong>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--amber" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7h-9"/><path d="M14 17H5"/><circle cx="17" cy="17" r="3"/><circle cx="7" cy="7" r="3"/></svg></span>
                    <strong class="perf-point__title">Distribuir leads</strong>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--rose" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg></span>
                    <strong class="perf-point__title">Atualizar oportunidades</strong>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg></span>
                    <strong class="perf-point__title">Movimentar negócios no pipeline</strong>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--mint" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg></span>
                    <strong class="perf-point__title">Enviar informações por webhook</strong>
                </div>
            </div>

            <div class="cta-strip">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Comece gratuitamente</a>
            </div>
        </div>
    </section>

    <section class="recurso-block" aria-labelledby="automacoes-tarefas-title">
        <div class="container recurso-split recurso-split--reverse">
            <div class="recurso-split__copy">
                <span class="section-label">Criação de tarefas</span>
                <h2 class="section-title" id="automacoes-tarefas-title">Faça o próximo passo aparecer na hora certa</h2>
                <p class="section-lead">Crie tarefas automaticamente a partir de eventos do processo comercial. Elas entram na agenda de quem é responsável, com o negócio já vinculado.</p>

                <ul class="rule-fields">
                    <li class="rule-field">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        Oportunidade avançou para proposta
                        <span class="rule-field__meta">Tarefa de follow-up</span>
                    </li>
                    <li class="rule-field">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
                        Novo lead foi atribuído
                        <span class="rule-field__meta">Primeiro contato</span>
                    </li>
                    <li class="rule-field">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        Negociação mudou de responsável
                        <span class="rule-field__meta">Revisão do histórico</span>
                    </li>
                </ul>

                <div class="recurso-actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Começar a automatizar tarefas</a>
                </div>
            </div>

            <!-- O que a tela sustenta desta dobra: o catálogo de gatilhos aberto
                    ("Novo negócio criado", "Negócio entra no estágio", "Negócio
                    marcado como ganho"…) é exatamente a lista de eventos ao lado,
                    e é o "a partir de eventos do processo comercial" da copy.
                    ⚠️ A AÇÃO visível aqui é "Criar negócio", não "Criar atividades".
                    Quem mostra a criação de tarefa é automacoes-lista.png, no hero.
                    Se aparecer um screenshot com "Criar atividades" selecionado, é
                    essa a troca certa para esta dobra.
                    Sem .shot: o PNG tem a base transparente (alpha 0), então entra
                    com drop-shadow. Numa moldura o degradê da base viraria branco. -->
            <div class="recurso-split__visual">
                <img class="recurso-split__bare" src="{{asset('storage/site/nova-automacao.png')}}" alt="Construtor de automações do Digify com a lista de gatilhos aberta, mostrando os eventos de negócio que podem disparar uma regra" width="1056" height="1059" loading="lazy">
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--alt" aria-labelledby="automacoes-pipeline-title">
        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Movimentação no pipeline</span>
                <h2 class="section-title" id="automacoes-pipeline-title">Atualize o funil conforme as regras da operação</h2>
                <p class="section-lead">Automatize mudanças de etapa quando uma oportunidade atender aos critérios definidos. Isso reduz situações em que o negócio evolui, mas continua parado na etapa anterior.</p>
            </div>

            <div class="recurso-showcase recurso-showcase--wide recurso-showcase--anchored">
                <!-- Azul: branco sobre #0a50ff dá 5,83:1. Em branco o balão
                        competia com o screenshot claro embaixo. -->
                <p class="shot-balloon shot-balloon--brand shot-balloon--pipeline">A regra acontece nos bastidores. O funil acompanha o processo.</p>

                <div class="shot">
                    <img src="{{asset('storage/site/home-negocios.png')}}" alt="Pipeline de negócios do Digify com oportunidades distribuídas entre as etapas da venda" width="1672" height="941" loading="lazy">
                </div>
            </div>

            <div class="cta-strip">
                <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece gratuitamente</a>
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--dark" aria-labelledby="automacoes-distribuicao-title">
        <div class="performance__glow" aria-hidden="true"></div>

        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Distribuição e responsáveis</span>
                <h2 class="section-title" id="automacoes-distribuicao-title">Cada negociação com a pessoa certa, desde o primeiro contato</h2>
                <p class="section-lead">Crie regras para direcionar cada contato ao vendedor ou equipe responsável assim que ele entra na operação — e para transferir a negociação conforme ela avança.</p>
            </div>

            <!-- O fecho em itálico da copy entra como card flutuando sobre a
                    base do screenshot — a tela mostra o campo "Responsável", que
                    é exatamente o que a frase afirma. -->
            <div class="recurso-showcase recurso-showcase--wide recurso-showcase--float">
                <div class="shot">
                    <img src="{{asset('storage/site/recurso-leads.png')}}" alt="Tela de leads do Digify com a fila de contatos, os totais por status e o responsável de cada lead" width="1672" height="940" loading="lazy">
                </div>

                <p class="media-float">
                    <span class="media-float__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><polyline points="17 11 19 13 23 9"/></svg></span>
                    <span>A Digify faz a transferência de forma automática e mantém claro quem conduz cada etapa — mais agilidade no atendimento, menos trabalho manual para o gestor.</span>
                </p>
            </div>

            <div class="perf-points">
                <div class="perf-point">
                    <span class="perf-point__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2 8 12 14 22 8"/></svg></span>
                    <strong class="perf-point__title">Lead recebido</strong>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--mint" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg></span>
                    <strong class="perf-point__title">Regra aplicada</strong>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--amber" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><polyline points="17 11 19 13 23 9"/></svg></span>
                    <strong class="perf-point__title">Responsável definido</strong>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--rose" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7h-9"/><path d="M14 17H5"/><circle cx="17" cy="17" r="3"/><circle cx="7" cy="7" r="3"/></svg></span>
                    <strong class="perf-point__title">Lead na carteira</strong>
                </div>
            </div>

            <p class="recurso-note recurso-note--intro">E conforme a oportunidade avança, o responsável acompanha o processo:</p>

            <div class="recurso-flow">
                <span class="recurso-flow__step">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    Pré-vendas qualifica
                </span>
                <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                <span class="recurso-flow__step">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Vendas negocia
                </span>
                <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                <span class="recurso-flow__step">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    Especialista apoia
                </span>
            </div>

            <div class="cta-strip">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Comece grátis</a>
            </div>
        </div>
    </section>

    <section class="recurso-block" aria-labelledby="automacoes-webhooks-title">
        <div class="container recurso-split">
            <div class="recurso-split__copy">
                <span class="section-label">Webhooks</span>
                <h2 class="section-title" id="automacoes-webhooks-title">Leve as automações além da Digify</h2>
                <p class="section-lead">Use webhooks para enviar informações da Digify para outros sistemas quando determinados eventos acontecerem. Uma mudança no CRM pode acionar processos externos e conectar diferentes etapas da sua operação.</p>

                <div class="recurso-actions">
                    @if($pageApi)
                        <a href="{{route('site.show', $pageApi->slug)}}" class="button button--outline button--lg">Saiba mais sobre integrações</a>
                    @endif
                </div>
            </div>

            <div class="recurso-split__visual">
                <div class="recurso-bridge">
                    <div class="recurso-bridge__node">
                        <span class="recurso-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg></span>
                        <span>
                            <strong class="recurso-bridge__name">Evento na Digify</strong>
                            <span class="recurso-bridge__desc">Algo mudou no CRM</span>
                        </span>
                    </div>

                    <div class="recurso-bridge__link">
                        <span class="recurso-bridge__chip">Webhook</span>
                    </div>

                    <div class="recurso-bridge__node">
                        <span class="recurso-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></span>
                        <span>
                            <strong class="recurso-bridge__name">Sistema externo</strong>
                            <span class="recurso-bridge__desc">O processo continua fora da Digify</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="planos-cta" aria-labelledby="automacoes-cta-title">
        <div class="container planos-cta__inner">
            <h2 id="automacoes-cta-title">Automatize o que pode ser automático</h2>
            <p>Reduza tarefas repetitivas, padronize ações do processo comercial e deixe sua equipe concentrada no que realmente exige atenção.</p>
            <div class="planos-cta__actions">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Começar agora gratuitamente</a>
                @if (!empty($page))
                    <a href="{{ route('site.show', $page->slug) }}" class="button button--outline button--lg">Conheça os planos</a>
                @endif 
            </div>
        </div>
    </section>
</main>