@php
    $page = getPageById(6); //Planos
@endphp
<main id="main">
    <section class="recurso-hero" aria-labelledby="metas-title">
        <div class="recurso-hero__bg" aria-hidden="true">
            <span class="blob blob--1"></span>
            <span class="blob blob--2"></span>
            <span class="blob blob--3"></span>
        </div>

        <div class="container recurso-hero__inner">
            <div class="recurso-hero__copy">
                <span class="section-label">Metas e Forecast</span>
                <h1 class="recurso-hero__title" id="metas-title">Acompanhe metas e <span class="text-grad">antecipe</span> seus resultados</h1>
                <p class="recurso-hero__lead">Defina objetivos, acompanhe os resultados e use as oportunidades em andamento para ter mais clareza sobre a previsão de vendas.</p>

                <div class="recurso-hero__actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">
                        Comece grátis
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <!-- A vaga de imagem (.shot-slot) foi preenchida: metas-por-vendas.png
                    é 1672x941, a mesma proporção que o slot reservava. Os dois selos
                    só repetem o que está legível na tela: "Total de Metas 3" e os 79%
                    da "Meta Comercial Agosto/26". -->
            <div class="recurso-hero__visual">
                <img class="recurso-hero__screen" src="{{asset('storage/site/metas-por-vendas.png')}}" alt="Painel de metas de vendas do Digify com o total de metas, quantas foram atingidas, o progresso de cada uma e o ranking de usuários" width="1672" height="941" loading="eager">

                <div class="recurso-hero__float recurso-hero__float--a" aria-hidden="true">
                    <span class="recurso-hero__float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg></span>
                    <span>
                        <strong class="recurso-hero__float-value">3 metas</strong>
                        <span class="recurso-hero__float-label">No período</span>
                    </span>
                </div>

                <div class="recurso-hero__float recurso-hero__float--b" aria-hidden="true">
                    <span class="recurso-hero__float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg></span>
                    <span>
                        <strong class="recurso-hero__float-value">79%</strong>
                        <span class="recurso-hero__float-label">Meta comercial do mês</span>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Metas individuais, por equipe e por período vinham em três dobras, cada
            uma com duas frases e uma barra. Juntas formam a dobra "definir a meta". -->
    <section class="recurso-block" aria-labelledby="metas-definicao-title">
        <div class="container">
            <div class="recurso-split">
                <div class="recurso-split__copy">
                    <span class="section-label">Metas individuais e por equipe</span>
                    <h2 class="section-title" id="metas-definicao-title">Dê a cada vendedor um objetivo claro</h2>
                    <p class="section-lead">Defina metas individuais, acompanhe o progresso ao longo do período e veja como cada resultado contribui para o objetivo do time.</p>

                    <p class="recurso-note recurso-note--intro">A meta da equipe se desdobra em:</p>

                    <div class="form-feats">
                        <div class="form-feat">
                            <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                            <span>Resultados individuais</span>
                        </div>
                        <div class="form-feat">
                            <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                            <span>Progresso acumulado</span>
                        </div>
                        <div class="form-feat">
                            <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                            <span>Meta alcançada</span>
                        </div>
                    </div>

                    <div class="recurso-actions">
                        <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece grátis</a>
                    </div>
                </div>

                <!-- Entrou a tela real no lugar das barras em vetor. Ela cobre os
                        três itens da lista ao lado: as seis metas de Camila Marques
                        são os resultados individuais, cada linha traz a barra de
                        progresso acumulado, e "Reuniões realizadas 24/24 100%" é a
                        meta alcançada.
                        Recortada E REMONTADA em 695x585 (de 1672x941): ficaram as abas,
                        os filtros, a coluna Título e a coluna Progresso; saíram Tipo e
                        Período (que repetem "Usuário" e "Mensal 01/08 – 31/08" nas seis
                        linhas), a coluna de ícones de ação e o vazio embaixo da tabela.
                        O motivo é legibilidade: em 1480px de largura a tabela entrava
                        nesta coluna a 38% de escala, com o texto ilegível. Em 695px vai
                        a ~80%, e a imagem passa de 306px para 468px de altura, que é o
                        que equilibra a coluna de texto (~510px). -->
                <div class="recurso-split__visual">
                    <div class="shot">
                        <img src="{{asset('storage/site/metas-vendedor-tabela.png')}}" alt="Metas de um vendedor no Digify: receita mensal, novos negócios, propostas enviadas, reuniões realizadas, leads convertidos e ticket médio, cada uma com o realizado, o alvo e a barra de progresso" width="695" height="585" loading="lazy">
                    </div>
                </div>
            </div>

            <p class="recurso-note recurso-note--intro">E o objetivo acompanha o ciclo comercial da empresa:</p>

            <div class="recurso-flow">
                <span class="recurso-flow__step">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Mensal
                </span>
                <span class="recurso-flow__step">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                    Trimestral
                </span>
                <span class="recurso-flow__step">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    Anual
                </span>
            </div>

            <p class="recurso-note">Do ritmo de curto prazo à evolução do ciclo, até o objetivo maior do ano.</p>
        </div>
    </section>

    <!-- Previsão de vendas e Receita prevista diziam a mesma coisa em dois
            níveis: a mecânica e o valor que ela produz. -->
    <section class="recurso-block recurso-block--dark" aria-labelledby="metas-previsao-title">
        <div class="performance__glow" aria-hidden="true"></div>

        <div class="container recurso-split recurso-split--reverse">
            <div class="recurso-split__copy">
                <span class="section-label">Previsão de vendas</span>
                <h2 class="section-title" id="metas-previsao-title">Antecipe o que pode entrar antes do fechamento</h2>
                <p class="section-lead">Use as oportunidades abertas para construir uma visão do que está em negociação e estime quanto desse volume pode se transformar em receita no período.</p>

                <div class="recurso-flow recurso-flow--vertical">
                    <span class="recurso-flow__step">Oportunidades abertas</span>
                    <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                    <span class="recurso-flow__step">Probabilidade de fechamento</span>
                    <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                    <span class="recurso-flow__step">Receita prevista</span>
                </div>

                <div class="recurso-actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Comece gratuitamente</a>
                </div>
            </div>

            <!-- A tela do forecast no lugar do cartão de distribuição. Ela fecha o
                    fluxo da coluna ao lado: Closed + Commit somam o "Total Forecast",
                    e o painel "Forecast vs Meta" mostra meta, previsão e o gap entre
                    as duas — que é a receita prevista da copy.
                    Recortada em 833x585 (de 1666x944). O corte em x=833 cai no vão
                    entre as duas colunas do painel, então nada fica pela metade; e
                    para acima do "Forecast Waterfall", que no original já vinha com
                    as barras cortadas. Só a coluna esquerda também deixa a imagem
                    mais alta que larga, que é o que a coluna do split pede. -->
            <div class="recurso-split__visual recurso-split__visual--float">
                <div class="shot">
                    <img src="{{asset('storage/site/metas-forecast-resumo.png')}}" alt="Painel de forecast do Digify com os valores já fechados, os comprometidos, o total previsto e a comparação entre forecast e meta, com o gap destacado" width="833" height="585" loading="lazy">
                </div>

                <p class="media-float">
                    <span class="media-float__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></span>
                    <!-- Texto reescrito com a troca da imagem: o anterior falava de
                            "distribuído por etapa do funil", que era o que o cartão
                            antigo mostrava. A tela nova mostra fechado, comprometido e
                            o gap até a meta. -->
                    <span>O que já fechou, o que está comprometido e a diferença que falta para a meta — é daí que sai a receita prevista.</span>
                </p>
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--alt" aria-labelledby="metas-probabilidade-title">
        <div class="container recurso-split">
            <div class="recurso-split__copy">
                <span class="section-label">Probabilidade de fechamento</span>
                <h2 class="section-title" id="metas-probabilidade-title">Dê mais peso às oportunidades com maior chance</h2>
                <p class="section-lead">Nem toda negociação aberta tem o mesmo potencial de conversão. Associe probabilidades às oportunidades para construir previsões mais realistas.</p>

                <!-- As três barras desceram para a coluna de texto porque a coluna
                        visual passou a ser o screenshot. Ficaram sem o casco de card:
                        soltas, o .progress-meter já se resolve. Os percentuais vêm da
                        copy, não da tela — a tela classifica por categoria
                        (Commit / Best Case), que é como o produto expressa a mesma
                        ideia. -->
                <div class="progress-meter progress-meter--20">
                    <div class="progress-meter__head">
                        <span class="progress-meter__label">Negociação em estágio inicial</span>
                        <span class="progress-meter__value">20%</span>
                    </div>
                    <div class="progress-meter__track"><span class="progress-meter__fill"></span></div>
                </div>

                <div class="progress-meter progress-meter--60">
                    <div class="progress-meter__head">
                        <span class="progress-meter__label">Oportunidade avançada</span>
                        <span class="progress-meter__value">60%</span>
                    </div>
                    <div class="progress-meter__track"><span class="progress-meter__fill"></span></div>
                </div>

                <div class="progress-meter progress-meter--90">
                    <div class="progress-meter__head">
                        <span class="progress-meter__label">Fechamento próximo</span>
                        <span class="progress-meter__value">90%</span>
                    </div>
                    <div class="progress-meter__track"><span class="progress-meter__fill"></span></div>
                </div>
            </div>

            <!-- A aba "Oportunidades" do forecast: cada negócio com valor, categoria
                    (Commit ou Best Case), estágio, responsável e previsão de
                    fechamento. É a probabilidade da copy aplicada oportunidade por
                    oportunidade.
                    Recortada E REMONTADA em 730x485 (de 1672x941): ficaram Negócio,
                    Valor, Categoria e Previsão; saíram Organização, Estágio e
                    Responsável, que não dizem nada sobre probabilidade. Mesmo motivo
                    da dobra 2: em largura cheia a tabela entrava a 33% de escala,
                    ilegível. -->
            <div class="recurso-split__visual">
                <div class="shot">
                    <img src="{{asset('storage/site/metas-oportunidades.png')}}" alt="Oportunidades do forecast no Digify, cada negócio com o valor, a categoria Commit ou Best Case e a data prevista de fechamento" width="730" height="485" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <!-- Receita realizada e Acompanhamento dos resultados descreviam a mesma
            leitura: previsto, realizado e meta lado a lado. -->
    <section class="performance" aria-labelledby="metas-acompanhamento-title">
        <div class="performance__glow" aria-hidden="true"></div>

        <div class="container performance__inner">
            <div class="performance__head">
                <span class="section-label">Acompanhamento dos resultados</span>
                <h2 class="performance__title" id="metas-acompanhamento-title">Compare expectativa e resultado no mesmo lugar</h2>
                <p class="performance__text">Veja quanto já foi efetivamente vendido e acompanhe, em uma mesma visão, o que foi planejado, o que já foi realizado e o que ainda pode entrar no período.</p>
            </div>

            <!-- Mesma tela do hero, em OUTRO enquadramento: aqui é o recorte
                    metas-progresso.png (1672x640, de 1672x941), que começa na faixa
                    de indicadores e vai até o fim dos painéis — sem a barra de
                    navegação e sem o título da página, que é o que o hero mostra.
                    "Progresso por Meta" é o previsto contra o realizado, e o card
                    "Atingidas" é a meta batida: os três .perf-point abaixo.
                    A imagem dissolve na base, por isso a fileira sobe para dentro da
                    faixa apagada. -->
            <div class="performance__showcase shot performance__showcase--fade">
                <img src="{{asset('storage/site/metas-progresso.png')}}" alt="Painel de metas do Digify com o total de metas, as atingidas, as em progresso e o progresso de cada meta contra o objetivo, ao lado do ranking de usuários" width="1672" height="640" loading="lazy">
            </div>

            <div class="perf-points perf-points--3">
                <div class="perf-point">
                    <span class="perf-point__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg></span>
                    <span>
                        <strong class="perf-point__title">Previsto</strong>
                        <span class="perf-point__text">O que o pipeline indicava — o potencial das oportunidades ainda em andamento.</span>
                    </span>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--mint" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></span>
                    <span>
                        <strong class="perf-point__title">Realizado</strong>
                        <span class="perf-point__text">O que virou venda — o resultado efetivamente alcançado.</span>
                    </span>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--amber" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg></span>
                    <span>
                        <strong class="perf-point__title">Meta</strong>
                        <span class="perf-point__text">Onde a operação precisa chegar — a referência do período.</span>
                    </span>
                </div>
            </div>

            <div class="performance__actions">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Começar a acompanhar resultados</a>
            </div>
        </div>
    </section>

    <section class="planos-cta" aria-labelledby="metas-cta-title">
        <div class="container planos-cta__inner">
            <h2 id="metas-cta-title">Planeje com metas. Decida com previsibilidade.</h2>
            <p>Acompanhe o que já foi vendido, o que ainda pode fechar e quanto falta para alcançar seus objetivos comerciais.</p>
            <div class="planos-cta__actions">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Comece grátis</a>
            </div>
        </div>
    </section>
</main>