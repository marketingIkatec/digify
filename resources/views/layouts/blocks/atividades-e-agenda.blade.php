@php
    $page = getPageById(6); //Planos
@endphp
<main id="main">
    <section class="recurso-hero" aria-labelledby="atividades-title">
        <div class="recurso-hero__bg" aria-hidden="true">
            <span class="blob blob--1"></span>
            <span class="blob blob--2"></span>
            <span class="blob blob--3"></span>
        </div>

        <div class="container recurso-hero__inner">
            <div class="recurso-hero__copy">
                <span class="section-label">Atividades e Agenda</span>
                <h1 class="recurso-hero__title" id="atividades-title">Mantenha cada <span class="text-grad">próximo passo</span> no radar</h1>
                <p class="recurso-hero__lead">Organize tarefas, ligações, reuniões e follow-ups em uma agenda comercial conectada às suas negociações. Mais clareza sobre o que precisa ser feito, quando e para qual oportunidade.</p>

                <div class="recurso-hero__actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">
                        Comece grátis
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <div class="recurso-hero__visual">
                <img class="recurso-hero__screen" src="{{asset('storage/site/recurso-followup.png')}}" alt="Tela de atividades do Digify com contadores por tipo e a lista de tarefas com negócio, responsável e data" width="1672" height="940" loading="eager">

                <div class="recurso-hero__float recurso-hero__float--a" aria-hidden="true">
                    <span class="recurso-hero__float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="3"/><polyline points="16 9 10.5 15 8 12.5"/></svg></span>
                    <span>
                        <strong class="recurso-hero__float-value">9 pendentes</strong>
                        <span class="recurso-hero__float-label">Atividades abertas</span>
                    </span>
                </div>

                <div class="recurso-hero__float recurso-hero__float--b" aria-hidden="true">
                    <span class="recurso-hero__float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></span>
                    <span>
                        <strong class="recurso-hero__float-value">4 atrasadas</strong>
                        <span class="recurso-hero__float-label">Precisam de atenção</span>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <section class="recurso-block" aria-labelledby="atividades-agenda-title">
        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Agenda comercial</span>
                <h2 class="section-title" id="atividades-agenda-title">Veja seus compromissos de vendas em um só lugar</h2>
                <p class="section-lead">Centralize as atividades do dia e organize a rotina comercial sem depender de agendas paralelas ou anotações soltas.</p>
            </div>

            <!-- Calendário mensal da agenda. Os três recortes de tempo saíram do
                    checklist ao lado e viraram cards sobre a imagem, e cada um tem
                    evidência na própria tela: o dia 21 vem destacado com as atividades
                    do dia ("Hoje"), a semana seguinte traz os compromissos já marcados
                    ("Próximos dias") e há eventos rotulados "Retorno pendente — Lumen"
                    e "Follow-up pendente — Brava" ("Pendentes").
                    Balões SEM rabicho: os três são leituras do calendário inteiro, não
                    pontos dele — um rabicho apontaria para uma célula qualquer e
                    inventaria uma precisão que não existe. As coordenadas deixam de
                    fora justamente as células que servem de evidência. -->
            <div class="recurso-showcase recurso-showcase--wide recurso-showcase--anchored">
                <div class="shot">
                    <img src="{{asset('storage/site/agenda-comercial-calendario.png')}}" alt="Calendário da agenda comercial do Digify em agosto de 2026, com o dia atual destacado e as reuniões, propostas, retornos e follow-ups distribuídos pelos dias do mês" width="1665" height="945" loading="lazy">
                </div>

                <p class="shot-balloon shot-balloon--plain shot-balloon--agenda-1">
                    <strong class="shot-balloon__title">Hoje</strong>
                    O que precisa ser feito agora.
                </p>

                <p class="shot-balloon shot-balloon--plain shot-balloon--agenda-2">
                    <strong class="shot-balloon__title">Próximos dias</strong>
                    O que já está programado.
                </p>

                <p class="shot-balloon shot-balloon--plain shot-balloon--agenda-3">
                    <strong class="shot-balloon__title">Pendentes</strong>
                    O que precisa voltar para o radar.
                </p>
            </div>

            <div class="cta-strip">
                <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece agora</a>
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--alt" aria-labelledby="atividades-tarefas-title">
        <div class="container recurso-split">
            <div class="recurso-split__copy">
                <span class="section-label">Tarefas</span>
                <h2 class="section-title" id="atividades-tarefas-title">Transforme próximos passos em ações claras</h2>
                <p class="section-lead">Crie tarefas para tudo o que precisa acontecer durante uma negociação e defina responsável, prazo e contexto.</p>

                <ul class="recurso-labels">
                    <li class="recurso-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        Retornar um contato
                    </li>
                    <li class="recurso-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="9" y1="15" x2="15" y2="15"/></svg>
                        Revisar uma proposta
                    </li>
                    <li class="recurso-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 2 11 13"/><path d="M22 2 15 22l-4-9-9-4Z"/></svg>
                        Enviar informações
                    </li>
                    <li class="recurso-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        Confirmar uma decisão
                    </li>
                    <li class="recurso-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                        Preparar a próxima abordagem
                    </li>
                </ul>

                <div class="recurso-actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Começar gratuitamente</a>
                </div>
            </div>

            <!-- Justificativa da imagem: a ficha traz o painel "Próxima atividade"
                    com data e hora e a ação "Agendar", além do campo Responsável — que
                    são exatamente responsável, prazo e contexto da copy. -->
            <div class="recurso-split__visual recurso-split__visual--float">
                <!-- Em .shot e não em .recurso-split__bare: este PNG é opaco de
                        borda reta (alpha 255 nos cantos), então solto com drop-shadow
                        ficava um retângulo de canto vivo. A moldura dá o raio. -->
                <div class="shot">
                    <img src="{{asset('storage/site/leads-cadastro.png')}}" alt="Ficha de um lead no Digify com responsável, observações e o painel de próxima atividade com data e a ação de agendar" width="1106" height="533" loading="lazy">
                </div>

                <p class="media-float">
                    <span class="media-float__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="3"/><polyline points="16 9 10.5 15 8 12.5"/></svg></span>
                    <span>Cada vendedor sabe o que precisa fazer e o gestor acompanha a execução sem depender de cobranças constantes.</span>
                </p>
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--dark" aria-labelledby="atividades-contatos-title">
        <div class="performance__glow" aria-hidden="true"></div>

        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Ligações e reuniões</span>
                <h2 class="section-title" id="atividades-contatos-title">Cada contato registrado no contexto da venda</h2>
                <p class="section-lead">Planeje os contatos por telefone, organize os compromissos comerciais e mantenha cada registro associado ao lead ou à oportunidade correspondente.</p>
            </div>

            <!-- .perf-point e não .planos-highlight: em dobra escura o card branco
                    é justamente o que o main.css desaconselha. -->
            <div class="perf-points perf-points--auto recurso-duo-cards">
                <div class="perf-point">
                    <span class="perf-point__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 2 16 8 22 8"/><line x1="22" y1="2" x2="16" y2="8"/><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg></span>
                    <span>
                        <strong class="perf-point__title">Antes da ligação</strong>
                        <span class="perf-point__text">Veja o contexto e saiba o que precisa ser tratado.</span>
                    </span>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--mint" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg></span>
                    <span>
                        <strong class="perf-point__title">Depois da ligação</strong>
                        <span class="perf-point__text">Registre o que aconteceu e defina o próximo passo.</span>
                    </span>
                </div>
            </div>

            <p class="recurso-note recurso-note--intro">Com as reuniões acontece o mesmo — cada uma leva a negociação para mais perto do próximo avanço:</p>

            <div class="recurso-flow">
                <span class="recurso-flow__step">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Reunião agendada
                </span>
                <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                <span class="recurso-flow__step">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Reunião realizada
                </span>
                <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                <span class="recurso-flow__step">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15.5 14"/></svg>
                    Próxima ação
                </span>
            </div>

            <p class="recurso-note">Responsáveis definidos, contexto registrado e continuidade planejada — menos informações dispersas entre calendário, anotações e CRM.</p>

            <div class="cta-strip">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Comece grátis</a>
            </div>
        </div>
    </section>

    <section class="recurso-block" aria-labelledby="atividades-followups-title">
        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Follow-ups</span>
                <h2 class="section-title" id="atividades-followups-title">Não deixe uma boa oportunidade esfriar</h2>
                <p class="section-lead">Programe os retornos ao longo da negociação e mantenha o relacionamento ativo até que exista uma definição.</p>
            </div>

            <!-- Em split, a coluna de texto era curta e sobrava um vazio grande ao
                    lado dos três cartões. Em fileira eles ocupam a dobra inteira. -->
            <div class="planos-highlights__grid">
                    <article class="planos-highlight">
                        <span class="planos-highlight__icon" aria-hidden="true"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 2 11 13"/><path d="M22 2 15 22l-4-9-9-4Z"/></svg></span>
                        <h3>Proposta enviada</h3>
                        <p><span aria-hidden="true">→</span> Agende o retorno.</p>
                    </article>
                    <article class="planos-highlight">
                        <span class="planos-highlight__icon" aria-hidden="true"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15.5 14"/></svg></span>
                        <h3>Cliente pediu mais tempo</h3>
                        <p><span aria-hidden="true">→</span> Defina uma nova data.</p>
                    </article>
                    <article class="planos-highlight">
                        <span class="planos-highlight__icon" aria-hidden="true"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></span>
                        <h3>Decisão ficou pendente</h3>
                        <p><span aria-hidden="true">→</span> Mantenha o próximo contato programado.</p>
                    </article>
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--alt" aria-labelledby="atividades-lembretes-title">
        <div class="container recurso-split">
            <div class="recurso-split__copy">
                <span class="section-label">Lembretes</span>
                <h2 class="section-title" id="atividades-lembretes-title">Saiba o que precisa da sua atenção</h2>
                <p class="section-lead">Use lembretes para acompanhar compromissos e atividades que estão chegando ao prazo — no computador ou no celular.</p>

                <div class="form-feats">
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span><strong>Próxima atividade</strong> — mantenha a agenda sob controle.</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span><strong>Prazo chegando</strong> — priorize o que precisa acontecer.</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span><strong>Atividade pendente</strong> — retome antes que a negociação perca ritmo.</span>
                    </div>
                </div>

                <div class="recurso-actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece grátis</a>
                </div>
            </div>

            <!-- A tela traz o próprio recurso: "Lembrete — 30 minutos antes do
                    prazo", com data e hora de início e fim. É a evidência direta dos
                    três itens da lista ao lado.
                    Observação: era home-phone.png, que sustentava o "no celular" da
                    copy. Esta é a versão desktop — o trecho mobile ficou sem imagem. -->
            <div class="recurso-split__visual">
                <div class="shot-anchor">
                    <img class="recurso-split__bare" src="{{asset('storage/site/atividade-lembrete-tarefa.png')}}" alt="Formulário de nova atividade do Digify com título, tipo, datas de início e fim e o lembrete marcado para 30 minutos antes do prazo" width="720" height="737" loading="lazy">

                    <!-- Os dois selos só repetem o que está legível na tela:
                            "Data início / Hora início / Data fim / Hora fim" e
                            "Lembrete · 30 minutos antes do prazo". -->
                    <div class="media-badge media-badge--a" aria-hidden="true">
                        <span class="media-badge__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span>
                        <span>
                            <strong class="media-badge__value">Início e fim</strong>
                            <span class="media-badge__label">Prazo da atividade</span>
                        </span>
                    </div>

                    <div class="media-badge media-badge--b" aria-hidden="true">
                        <span class="media-badge__icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></span>
                        <span>
                            <strong class="media-badge__value">30 minutos antes</strong>
                            <span class="media-badge__label">Aviso do lembrete</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--dark" aria-labelledby="atividades-vinculadas-title">
        <div class="performance__glow" aria-hidden="true"></div>

        <div class="container recurso-split recurso-split--reverse">
            <div class="recurso-split__copy">
                <span class="section-label">Atividades vinculadas às oportunidades</span>
                <h2 class="section-title" id="atividades-vinculadas-title">Cada atividade no contexto da negociação</h2>
                <p class="section-lead">Vincule tarefas, ligações, reuniões e follow-ups diretamente às oportunidades. Ao abrir uma negociação, você encontra o que já aconteceu e o que ainda precisa acontecer — inclusive quando outras pessoas participaram do processo.</p>

                <div class="form-feats">
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span><strong>O que aconteceu</strong> — atividades e contatos realizados.</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span><strong>Quem realizou</strong> — responsáveis por cada ação.</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span><strong>Quando aconteceu</strong> — sequência da negociação.</span>
                    </div>
                </div>

                <p class="recurso-note">Tarefas, ligações, reuniões e follow-ups: tudo conectado ao negócio que sua equipe está tentando fechar.</p>

                <div class="recurso-actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Comece agora gratuitamente</a>
                </div>
            </div>

            <!-- Histórico em vetor, mesmo componente de CRM, Leads e Propostas, na
                    variante escura desta dobra. Substituiu leads-atividades.png: o
                    screenshot era de um lead, não de uma oportunidade, e em coluna de
                    split o texto dele ficava pequeno demais para ler.
                    O bloco cobre os três itens da lista ao lado — o que aconteceu
                    (reunião, ligação, tarefa), quem realizou (autor em cada meta) e
                    quando (dia e hora) — mais a participação de outras pessoas, na
                    mudança de responsável, e o que ainda vai acontecer, no follow-up
                    agendado. -->
            <div class="recurso-split__visual">
                <div class="timeline">
                    <div class="timeline__tabs" aria-hidden="true">
                        <span class="timeline__tab">Dados</span>
                        <span class="timeline__tab is-active">Atividades</span>
                        <span class="timeline__tab">Propostas</span>
                    </div>

                    <p class="timeline__day">A seguir</p>
                    <ul class="timeline__list">
                        <li class="timeline__item">
                            <span class="timeline__icon timeline__icon--next" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15.5 14"/></svg></span>
                            <div class="timeline__card">
                                <div class="timeline__head">
                                    <h3 class="timeline__title">Follow-up</h3>
                                    <span class="timeline__badge timeline__badge--soft">Agendado</span>
                                </div>
                                <p class="timeline__desc">Confirmar a decisão com o time de compras</p>
                                <p class="timeline__meta">Camila Marques • 26 ago. 2026, 09:00</p>
                            </div>
                        </li>
                    </ul>

                    <p class="timeline__day">Hoje</p>
                    <ul class="timeline__list">
                        <li class="timeline__item">
                            <span class="timeline__icon timeline__icon--meeting" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></span>
                            <div class="timeline__card">
                                <div class="timeline__head">
                                    <h3 class="timeline__title">Reunião</h3>
                                    <span class="timeline__badge">Concluída</span>
                                </div>
                                <p class="timeline__desc">Apresentação da proposta ao time do cliente</p>
                                <p class="timeline__meta">Camila Marques • Hoje, 15:00</p>
                            </div>
                        </li>
                        <li class="timeline__item">
                            <span class="timeline__icon timeline__icon--call" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg></span>
                            <div class="timeline__card">
                                <div class="timeline__head">
                                    <h3 class="timeline__title">Ligação</h3>
                                    <span class="timeline__badge">Realizada</span>
                                </div>
                                <p class="timeline__desc">Retorno sobre as condições comerciais</p>
                                <p class="timeline__meta">João Dias • Hoje, 10:20</p>
                            </div>
                        </li>
                    </ul>

                    <p class="timeline__day">Ontem</p>
                    <ul class="timeline__list">
                        <li class="timeline__item">
                            <span class="timeline__icon timeline__icon--task" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="3"/><polyline points="16 9 10.5 15 8 12.5"/></svg></span>
                            <div class="timeline__card">
                                <div class="timeline__head">
                                    <h3 class="timeline__title">Tarefa</h3>
                                    <span class="timeline__badge">Concluída</span>
                                </div>
                                <p class="timeline__desc">Enviar contrato revisado ao cliente</p>
                                <p class="timeline__meta">Camila Marques • Ontem, 16:40</p>
                            </div>
                        </li>
                        <li class="timeline__item">
                            <span class="timeline__icon timeline__icon--owner" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></span>
                            <div class="timeline__card">
                                <div class="timeline__head">
                                    <h3 class="timeline__title">Mudança de responsável</h3>
                                </div>
                                <p class="timeline__desc">Responsável alterado de Lucas Mendes para Camila Marques</p>
                                <p class="timeline__meta">Sistema • Ontem, 09:15</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="planos-cta" aria-labelledby="atividades-cta-title">
        <div class="container planos-cta__inner">
            <h2 id="atividades-cta-title">Transforme planejamento em vendas em movimento</h2>
            <p>Organize a rotina, mantenha os próximos passos visíveis e dê continuidade às oportunidades no momento certo.</p>
            <div class="planos-cta__actions">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Começar agora gratuitamente</a>
                @if (!empty($page))
                    <a href="{{ route('site.show', $page->slug) }}" class="button button--outline button--lg">Conheça os planos</a>
                @endif 
            </div>
        </div>
    </section>
</main>