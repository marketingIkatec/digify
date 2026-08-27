@php
    $page = getPageById(6); //Planos
@endphp
<main id="main">
    <section class="recurso-hero" aria-labelledby="relatorios-title">
        <div class="recurso-hero__bg" aria-hidden="true">
            <span class="blob blob--1"></span>
            <span class="blob blob--2"></span>
            <span class="blob blob--3"></span>
        </div>

        <div class="container recurso-hero__inner">
            <div class="recurso-hero__copy">
                <span class="section-label">Relatórios de Vendas</span>
                <h1 class="recurso-hero__title" id="relatorios-title">Transforme&nbsp;dados comerciais&nbsp;em <span class="text-grad">decisões&nbsp;melhores</span></h1>
                <p class="recurso-hero__lead">Acompanhe o desempenho da operação, identifique gargalos e entenda o que está impulsionando ou travando suas vendas.</p>

                <div class="recurso-hero__actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">
                        Comece grátis
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <div class="recurso-hero__visual">
                <img class="recurso-hero__screen" src="{{asset('storage/site/performance-analytics.png')}}" alt="Painel de análise do Digify com indicadores do pipeline, distribuição e conversão por etapa" width="1672" height="940" loading="eager">

                <div class="recurso-hero__float recurso-hero__float--a" aria-hidden="true">
                    <span class="recurso-hero__float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg></span>
                    <span>
                        <strong class="recurso-hero__float-value">18,4%</strong>
                        <span class="recurso-hero__float-label">Conversão média</span>
                    </span>
                </div>

                <div class="recurso-hero__float recurso-hero__float--b" aria-hidden="true">
                    <span class="recurso-hero__float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></span>
                    <span>
                        <strong class="recurso-hero__float-value">R$ 48.732</strong>
                        <span class="recurso-hero__float-label">Valor do pipeline</span>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <section class="recurso-block" aria-labelledby="relatorios-dashboard-title">
        <div class="container recurso-split">
            <div class="recurso-split__copy">
                <span class="section-label">Dashboard comercial</span>
                <h2 class="section-title" id="relatorios-dashboard-title">Os principais números do comercial à vista</h2>
                <p class="section-lead">Reúna indicadores importantes em uma visão rápida para acompanhar o ritmo da operação sem depender de planilhas ou consolidações manuais — mais clareza para agir com base no que está acontecendo agora, no computador ou no celular.</p>

                <div class="form-feats recurso-feats-2col">
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Oportunidades em andamento</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Volume por etapa</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Valores em negociação</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Resultados do período</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Desempenho do time</span>
                    </div>
                </div>

                <div class="recurso-actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Começar agora</a>
                </div>
            </div>

            <div class="recurso-split__visual">
                <img class="recurso-split__bare recurso-split__bare--phone" src="{{asset('storage/site/home-phone.png')}}" alt="Aplicativo da Digify no celular com pipeline aberto, negócios ganhos, atividades do dia e taxa de conversão" width="345" height="786" loading="lazy">
            </div>
        </div>
    </section>

    <!-- Conversão do funil e Motivos de perda eram duas dobras magras contando a
            mesma coisa: onde o negócio trava e por quê. -->
    <section class="recurso-block recurso-block--dark" aria-labelledby="relatorios-conversao-title">
        <div class="performance__glow" aria-hidden="true"></div>

        <div class="container recurso-split recurso-split--reverse">
            <div class="recurso-split__copy">
                <span class="section-label">Conversão e motivos de perda</span>
                <h2 class="section-title" id="relatorios-conversao-title">Descubra onde as oportunidades avançam e onde travam</h2>
                <p class="section-lead">Acompanhe a conversão entre as etapas do funil e registre por que cada negociação foi perdida. Assim você enxerga o gargalo e a causa dele na mesma análise.</p>

                <p class="recurso-note recurso-note--intro">Os motivos que mais tiram vendas do funil:</p>

                <!-- --tight: os cinco cabem em uma linha só. No tamanho padrão
                        "Sem retorno" sobrava sozinho numa segunda linha, e
                        centralizado, o que dentro de coluna de texto lia como
                        desalinho. Aqui o fluxo também alinha à esquerda. -->
                <div class="recurso-flow recurso-flow--tight">
                    <span class="recurso-flow__step">Preço</span>
                    <span class="recurso-flow__step">Concorrência</span>
                    <span class="recurso-flow__step">Timing</span>
                    <span class="recurso-flow__step">Falta de aderência</span>
                    <span class="recurso-flow__step">Sem retorno</span>
                </div>

                <div class="recurso-actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Comece grátis</a>
                </div>
            </div>

            <div class="recurso-split__visual recurso-split__visual--float">
                <!-- Vetor do painel "Conversão por Etapa", substituindo
                        home-card-conv.png. Largura casada com a do .media-float
                        abaixo (mesma margem lateral), que era o desencontro.

                        Os dados NÃO vêm do PNG que saiu: vêm do painel real, que
                        aparece em performance-analytics.png — no hero desta página e
                        na dobra 7. Aquele PNG era um mock antigo, com etapas
                        ("Jurídico", "Contrato") que não existem em nenhuma outra tela
                        do produto e sem os percentuais. Estes nove pares e suas nove
                        taxas foram lidos direto do screenshot, com as cores dos
                        marcadores amostradas pixel a pixel. A décima linha do painel
                        ficou fora porque o botão "Ajuda" cobre o percentual dela.

                        Card branco em dobra escura NÃO contraria a regra 10: aquela
                        regra é sobre card de CONTEÚDO. Este é simulação de tela — a
                        imagem que ele substitui era exatamente um card branco aqui. -->
                <div class="conv-card">
                    <p class="conv-card__title">Conversão por Etapa</p>
                    <ul class="conv-rows">
                        <li class="conv-row conv-row--slate conv-row--77">
                            <span class="conv-row__dot" aria-hidden="true"></span>
                            <span class="conv-row__pair">Qualificação <span class="conv-row__arrow" aria-hidden="true">→</span> Qualificação</span>
                            <span class="conv-row__track" aria-hidden="true"><span class="conv-row__fill"></span></span>
                            <span class="conv-row__value">76,9%</span>
                        </li>
                        <li class="conv-row conv-row--gray conv-row--60">
                            <span class="conv-row__dot" aria-hidden="true"></span>
                            <span class="conv-row__pair">Qualificação <span class="conv-row__arrow" aria-hidden="true">→</span> Proposta</span>
                            <span class="conv-row__track" aria-hidden="true"><span class="conv-row__fill"></span></span>
                            <span class="conv-row__value">59,6%</span>
                        </li>
                        <li class="conv-row conv-row--blue conv-row--62">
                            <span class="conv-row__dot" aria-hidden="true"></span>
                            <span class="conv-row__pair">Proposta <span class="conv-row__arrow" aria-hidden="true">→</span> Novo Lead</span>
                            <span class="conv-row__track" aria-hidden="true"><span class="conv-row__fill"></span></span>
                            <span class="conv-row__value">61,5%</span>
                        </li>
                        <li class="conv-row conv-row--green conv-row--58">
                            <span class="conv-row__dot" aria-hidden="true"></span>
                            <span class="conv-row__pair">Novo Lead <span class="conv-row__arrow" aria-hidden="true">→</span> Negociação</span>
                            <span class="conv-row__track" aria-hidden="true"><span class="conv-row__fill"></span></span>
                            <span class="conv-row__value">58,3%</span>
                        </li>
                        <li class="conv-row conv-row--amber conv-row--47">
                            <span class="conv-row__dot" aria-hidden="true"></span>
                            <span class="conv-row__pair">Negociação <span class="conv-row__arrow" aria-hidden="true">→</span> Atendimento</span>
                            <span class="conv-row__track" aria-hidden="true"><span class="conv-row__fill"></span></span>
                            <span class="conv-row__value">46,7%</span>
                        </li>
                        <li class="conv-row conv-row--teal conv-row--38">
                            <span class="conv-row__dot" aria-hidden="true"></span>
                            <span class="conv-row__pair">Atendimento <span class="conv-row__arrow" aria-hidden="true">→</span> Fechamento</span>
                            <span class="conv-row__track" aria-hidden="true"><span class="conv-row__fill"></span></span>
                            <span class="conv-row__value">38,2%</span>
                        </li>
                        <li class="conv-row conv-row--green conv-row--64">
                            <span class="conv-row__dot" aria-hidden="true"></span>
                            <span class="conv-row__pair">Fechamento <span class="conv-row__arrow" aria-hidden="true">→</span> Proposta Enviada</span>
                            <span class="conv-row__track" aria-hidden="true"><span class="conv-row__fill"></span></span>
                            <span class="conv-row__value">64,3%</span>
                        </li>
                        <li class="conv-row conv-row--violet conv-row--42">
                            <span class="conv-row__dot" aria-hidden="true"></span>
                            <span class="conv-row__pair">Proposta Enviada <span class="conv-row__arrow" aria-hidden="true">→</span> Follow up</span>
                            <span class="conv-row__track" aria-hidden="true"><span class="conv-row__fill"></span></span>
                            <span class="conv-row__value">42,1%</span>
                        </li>
                        <li class="conv-row conv-row--pink conv-row--35">
                            <span class="conv-row__dot" aria-hidden="true"></span>
                            <span class="conv-row__pair">Follow up <span class="conv-row__arrow" aria-hidden="true">→</span> Negociação</span>
                            <span class="conv-row__track" aria-hidden="true"><span class="conv-row__fill"></span></span>
                            <span class="conv-row__value">35,4%</span>
                        </li>
                    </ul>
                </div>

                <p class="media-float">
                    <span class="media-float__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg></span>
                    <span>Use o histórico de perdas para corrigir gargalos e fortalecer as próximas oportunidades.</span>
                </p>
            </div>
        </div>
    </section>

    <!-- Desempenho por vendedor e por equipe eram duas dobras: a primeira era só
            uma fileira de métricas, sem imagem. Juntas, os retratos dão rosto às
            duas leituras e as métricas ficam abaixo. -->
    <section class="recurso-block" aria-labelledby="relatorios-desempenho-title">
        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Desempenho do time</span>
                <h2 class="section-title" id="relatorios-desempenho-title">Veja o resultado de cada um e do time como um todo</h2>
                <p class="section-lead">Compare resultados individuais, acompanhe a evolução de cada carteira e entenda como equipes, setores ou grupos contribuem para o resultado comercial.</p>
            </div>

            <div class="segments__grid recurso-duo">
                <article class="planos-highlight">
                    <img class="planos-highlight__photo" src="{{asset('storage/site/leads-vendedor.png')}}" alt="Vendedor acompanhando seus resultados individuais no Digify" width="1672" height="941" loading="lazy">
                    <h3>Visão individual</h3>
                    <p>Mostra a performance de cada vendedor.</p>
                </article>
                <article class="planos-highlight planos-highlight--dark">
                    <img class="planos-highlight__photo" src="{{asset('storage/site/leads-gestor.png')}}" alt="Gestora analisando o resultado conjunto da equipe comercial no Digify" width="1672" height="941" loading="lazy">
                    <h3>Visão da equipe</h3>
                    <p>Mostra o resultado conjunto.</p>
                </article>
            </div>

            <p class="recurso-note recurso-note--intro">Em qualquer uma das duas leituras, você acompanha:</p>

            <!-- .form-feat e não .perf-point: este é fundo claro, e o .perf-point
                    tem título branco — foi feito para as dobras escuras.
                    Em fileira única (--row) e sem o teto de 880px do
                    .recurso-duo-cards: em duas colunas o quinto item sobrava
                    sozinho numa terceira fileira. -->
            <div class="form-feats recurso-feats-row">
                <div class="form-feat">
                    <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                    <span>Oportunidades trabalhadas</span>
                </div>
                <div class="form-feat">
                    <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                    <span>Vendas realizadas</span>
                </div>
                <div class="form-feat">
                    <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                    <span>Taxa de conversão</span>
                </div>
                <div class="form-feat">
                    <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                    <span>Valores negociados</span>
                </div>
                <div class="form-feat">
                    <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                    <span>Atividades executadas</span>
                </div>
            </div>

            <div class="cta-strip">
                <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece agora gratuitamente</a>
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--alt" aria-labelledby="relatorios-origem-title">
        <div class="container recurso-split">
            <div class="recurso-split__copy">
                <span class="section-label">Origem das oportunidades</span>
                <h2 class="section-title" id="relatorios-origem-title">Saiba quais canais estão gerando negócios de verdade</h2>
                <p class="section-lead">Acompanhe de onde vêm as oportunidades e compare quais origens estão contribuindo mais para o funil e para os fechamentos.</p>

                <p class="recurso-note">Mais do que contar leads, a Digify ajuda a entender quais fontes estão chegando mais longe no processo comercial.</p>

                <div class="recurso-actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece agora</a>
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
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m3 11 18-5v12L3 14v-3z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg>
                        Campanhas
                    </li>
                    <li class="recurso-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        Eventos
                    </li>
                    <li class="recurso-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        Prospecção
                    </li>
                    <li class="recurso-label">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        Outras origens
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="recurso-block" aria-labelledby="relatorios-atividades-title">
        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Atividades comerciais</span>
                <h2 class="section-title" id="relatorios-atividades-title">Veja se a execução acompanha as metas de vendas</h2>
                <p class="section-lead">Acompanhe o volume de atividades realizadas pela equipe e entenda como o esforço comercial está distribuído ao longo do período.</p>
            </div>

            <!-- O checklist saiu da coluna estreita do .recurso-panel e virou
                    fileira de cards sobre a imagem, que agora ocupa a largura toda.
                    As coordenadas caem sobre as linhas da tabela e deixam de fora a
                    faixa de contadores por tipo (Tarefas 8, Ligações 1, Emails 0,
                    Reuniões 0), que é justamente a evidência dos quatro rótulos.
                    Sem rabicho: os quatro são leituras da tela inteira, não pontos
                    dela. -->
            <div class="recurso-showcase recurso-showcase--wide recurso-showcase--anchored">
                <div class="shot">
                    <img src="{{asset('storage/site/recurso-followup.png')}}" alt="Tela de atividades do Digify com o total por tipo: tarefas, ligações, e-mails e reuniões" width="1672" height="940" loading="lazy">
                </div>

                <p class="shot-balloon shot-balloon--plain shot-balloon--atv-1">
                    <strong class="shot-balloon__title">Ligações</strong>
                </p>

                <p class="shot-balloon shot-balloon--plain shot-balloon--atv-2">
                    <strong class="shot-balloon__title">Reuniões</strong>
                </p>

                <p class="shot-balloon shot-balloon--plain shot-balloon--atv-3">
                    <strong class="shot-balloon__title">Tarefas</strong>
                </p>

                <p class="shot-balloon shot-balloon--plain shot-balloon--atv-4">
                    <strong class="shot-balloon__title">Follow-ups</strong>
                </p>
            </div>

            <div class="cta-strip">
                <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece agora gratuitamente</a>
            </div>
        </div>
    </section>

    <!-- Filtros e períodos foi absorvido aqui: a própria tela do Pipeline Analytics
            mostra a régua de filtros (Período, Pipeline, Etapa, Responsável,
            Organização, Produto, Status) no topo. -->
    <section class="performance" aria-labelledby="relatorios-analytics-title">
        <div class="performance__glow" aria-hidden="true"></div>

        <div class="container performance__inner">
            <div class="performance__head">
                <span class="section-label">Pipeline Analytics</span>
                <h2 class="performance__title" id="relatorios-analytics-title">Encontre gargalos antes que eles afetem o resultado</h2>
                <p class="performance__text">Analise o comportamento das oportunidades dentro do funil e filtre por vendedor, equipe, pipeline, origem ou intervalo de tempo para investigar o cenário certo.</p>
            </div>

            <!-- A imagem dissolve na base em vez de terminar numa aresta reta
                    contra o fundo escuro; por isso a fileira de chips sobe para
                    dentro da faixa apagada. -->
            <div class="performance__showcase shot performance__showcase--fade">
                <img src="{{asset('storage/site/performance-analytics.png')}}" alt="Painel Pipeline Analytics do Digify com a régua de filtros no topo, tempo médio no funil e negócios parados" width="1672" height="940" loading="lazy">
            </div>

            <ul class="integrations__grid">
                <li class="integration-chip is-active"><span class="integration-chip__dot" aria-hidden="true"></span>Hoje</li>
                <li class="integration-chip"><span class="integration-chip__dot" aria-hidden="true"></span>Semana</li>
                <li class="integration-chip"><span class="integration-chip__dot" aria-hidden="true"></span>Mês</li>
                <li class="integration-chip"><span class="integration-chip__dot" aria-hidden="true"></span>Período personalizado</li>
            </ul>

            <p class="recurso-note recurso-note--intro">Dentro do recorte escolhido, acompanhe:</p>

            <div class="perf-points perf-points--auto">
                <div class="perf-point">
                    <span class="perf-point__dot" aria-hidden="true"></span>
                    <strong class="perf-point__title">Tempo médio por etapa</strong>
                </div>
                <div class="perf-point">
                    <span class="perf-point__dot perf-point__dot--mint" aria-hidden="true"></span>
                    <strong class="perf-point__title">Volume acumulado</strong>
                </div>
                <div class="perf-point">
                    <span class="perf-point__dot perf-point__dot--amber" aria-hidden="true"></span>
                    <strong class="perf-point__title">Taxa de avanço</strong>
                </div>
                <div class="perf-point">
                    <span class="perf-point__dot perf-point__dot--rose" aria-hidden="true"></span>
                    <strong class="perf-point__title">Pontos de queda</strong>
                </div>
                <div class="perf-point">
                    <span class="perf-point__dot" aria-hidden="true"></span>
                    <strong class="perf-point__title">Etapas com maior retenção</strong>
                </div>
            </div>

            <div class="performance__actions">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Comece grátis</a>
            </div>
        </div>
    </section>

    <section class="planos-cta" aria-labelledby="relatorios-cta-title">
        <div class="container planos-cta__inner">
            <h2 id="relatorios-cta-title">Tenha mais clareza para decidir o próximo passo</h2>
            <p>Acompanhe os números, encontre gargalos e entenda onde estão as melhores oportunidades para melhorar o desempenho comercial.</p>
            <div class="planos-cta__actions">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Comece grátis</a>
            </div>
        </div>
    </section>
</main>