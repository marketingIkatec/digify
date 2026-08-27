@php
    $page = getPageById(6); //Planos
@endphp
<main id="main">
    <section class="recurso-hero" aria-labelledby="propostas-title">
        <div class="recurso-hero__bg" aria-hidden="true">
            <span class="blob blob--1"></span>
            <span class="blob blob--2"></span>
            <span class="blob blob--3"></span>
        </div>

        <div class="container recurso-hero__inner">
            <div class="recurso-hero__copy">
                <span class="section-label">Propostas Comerciais</span>
                <h1 class="recurso-hero__title" id="propostas-title">Crie propostas comerciais com <span class="text-grad">mais agilidade</span></h1>
                <p class="recurso-hero__lead">Monte ofertas personalizadas, organize produtos e condições comerciais e mantenha cada documento conectado à negociação dentro da Digify.</p>

                <div class="recurso-hero__actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">
                        Comece grátis
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <div class="recurso-hero__visual">
                <img class="recurso-hero__screen" src="{{asset('storage/site/recurso-propostas.png')}}" alt="Tela de propostas do Digify com número, negócio, cliente, valor, status, versão e validade de cada documento" width="1672" height="940" loading="eager">

                <div class="recurso-hero__float recurso-hero__float--a" aria-hidden="true">
                    <span class="recurso-hero__float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></span>
                    <span>
                        <strong class="recurso-hero__float-value">Proposta aceita</strong>
                        <span class="recurso-hero__float-label">Status atualizado</span>
                    </span>
                </div>

                <div class="recurso-hero__float recurso-hero__float--b" aria-hidden="true">
                    <span class="recurso-hero__float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg></span>
                    <span>
                        <strong class="recurso-hero__float-value">Versão 2</strong>
                        <span class="recurso-hero__float-label">Histórico preservado</span>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Modelos e Produtos vinham em duas dobras: a de modelos tinha só três
            frases curtas e não sustentava a tela sozinha. Juntas, viram a dobra
            de "montar a proposta". -->
    <section class="recurso-block" aria-labelledby="propostas-montagem-title">
        <div class="container recurso-split recurso-split--reverse">
            <div class="recurso-split__copy">
                <span class="section-label">Modelos, produtos e serviços</span>
                <h2 class="section-title" id="propostas-montagem-title">Ganhe velocidade sem perder consistência</h2>
                <p class="section-lead">Crie propostas a partir de modelos já estruturados e adicione os itens da venda diretamente ao documento, organizando escopo, quantidades e valores de forma clara.</p>

                <div class="form-feats recurso-feats-2col">
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Mais agilidade</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Oferta mais precisa</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Mais padrão</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Valores organizados</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Mais flexibilidade</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span>Menos retrabalho</span>
                    </div>
                </div>

                <p class="recurso-note">Parta de uma estrutura pronta, mantenha a apresentação comercial consistente e adapte conteúdo e condições para cada negociação.</p>
            </div>

            <div class="recurso-split__visual recurso-split__visual--float">
                <!-- A tela cobre a dobra inteira: "Template de Layout: Proposta
                        Comercial" é o modelo já estruturado, e "Itens do Negócio (2)"
                        traz Produto, Preço, Qtd, Desc. e Total — escopo, quantidades
                        e valores, na mesma ordem da copy. "Nova Versão" e "Duplicar"
                        sustentam "mais flexibilidade" e "menos retrabalho", e o campo
                        Negócio sustenta o card flutuante. Era recurso-propostas.png,
                        uma lista de propostas, que não mostrava nada disso. -->
                <div class="shot">
                    <img src="{{asset('storage/site/proposta-comercial.png')}}" alt="Edição de uma proposta comercial no Digify com o template de layout aplicado, o negócio vinculado e a tabela de itens com produto, preço, quantidade, desconto e total" width="1665" height="945" loading="lazy">
                </div>

                <p class="media-float">
                    <span class="media-float__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></span>
                    <span>Evite montar informações comerciais fora do CRM: cada proposta já nasce ligada ao negócio.</span>
                </p>
            </div>
        </div>
    </section>

    <section class="recurso-block recurso-block--alt" aria-labelledby="propostas-precos-title">
        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Tabelas de preços</span>
                <h2 class="section-title" id="propostas-precos-title">Aplique a condição comercial certa em cada venda</h2>
                <p class="section-lead">Use tabelas de preços para trabalhar diferentes cenários comerciais com mais rapidez e consistência.</p>
            </div>

            <div class="planos-highlights__grid">
                <article class="planos-highlight">
                    <span class="planos-highlight__icon" aria-hidden="true"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></span>
                    <h3>Preço padrão</h3>
                    <p>Mantenha valores de referência para o que a operação vende com mais frequência.</p>
                </article>
                <article class="planos-highlight">
                    <span class="planos-highlight__icon" aria-hidden="true"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/><line x1="1" y1="14" x2="7" y2="14"/><line x1="9" y1="8" x2="15" y2="8"/><line x1="17" y1="16" x2="23" y2="16"/></svg></span>
                    <h3>Condições específicas</h3>
                    <p>Trabalhe estratégias diferentes por operação, equipe ou tipo de negociação.</p>
                </article>
                <article class="planos-highlight">
                    <span class="planos-highlight__icon" aria-hidden="true"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg></span>
                    <h3>Aplicação rápida</h3>
                    <p>Leve a condição adequada para a proposta sem reconstruir valores a cada oferta.</p>
                </article>
            </div>

            <div class="cta-strip">
                <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece agora grátis</a>
            </div>
        </div>
    </section>

    <!-- Descontos e Histórico contam a mesma história: como a condição comercial
            muda ao longo da negociação. Separadas, eram duas dobras magras. -->
    <section class="recurso-block recurso-block--dark" aria-labelledby="propostas-evolucao-title">
        <div class="performance__glow" aria-hidden="true"></div>

        <div class="container">
            <div class="recurso-split recurso-split--reverse">
            <div class="recurso-split__copy">
                <span class="section-label">Descontos e histórico</span>
                <h2 class="section-title" id="propostas-evolucao-title">Acompanhe como a negociação evoluiu</h2>
                <p class="section-lead">Aplique descontos conforme a oportunidade avança e preserve o histórico de valores, condições e versões trabalhadas. Você tem mais clareza sobre o que foi negociado e sobre o valor efetivamente apresentado ao cliente.</p>

                <div class="recurso-flow recurso-flow--vertical">
                    <span class="recurso-flow__step">Valor original</span>
                    <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                    <span class="recurso-flow__step">Desconto aplicado</span>
                    <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                    <span class="recurso-flow__step">Condição final</span>
                </div>

            </div>

            <!-- Mesmo componente de linha do tempo do CRM, aqui contando VERSÕES
                    da proposta em vez de atividades. -->
            <div class="recurso-split__visual recurso-split__visual--float">
                <div class="timeline">
                    <div class="timeline__tabs" aria-hidden="true">
                        <span class="timeline__tab">Dados</span>
                        <span class="timeline__tab">Histórico</span>
                        <span class="timeline__tab is-active">Propostas</span>
                    </div>

                    <p class="timeline__day">Versões</p>
                    <ul class="timeline__list">
                        <li class="timeline__item">
                            <span class="timeline__icon timeline__icon--note" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></span>
                            <div class="timeline__card">
                                <div class="timeline__head">
                                    <h3 class="timeline__title">Primeira condição</h3>
                                </div>
                                <p class="timeline__desc">Escopo e valores apresentados ao cliente.</p>
                                <p class="timeline__meta">Versão 1</p>
                            </div>
                        </li>
                        <li class="timeline__item">
                            <span class="timeline__icon timeline__icon--edit" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg></span>
                            <div class="timeline__card">
                                <div class="timeline__head">
                                    <h3 class="timeline__title">Ajustes negociados</h3>
                                </div>
                                <p class="timeline__desc">Desconto aplicado e condições revisadas.</p>
                                <p class="timeline__meta">Versão 2</p>
                            </div>
                        </li>
                        <li class="timeline__item">
                            <span class="timeline__icon timeline__icon--stage" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></span>
                            <div class="timeline__card">
                                <div class="timeline__head">
                                    <h3 class="timeline__title">Versão atual</h3>
                                    <span class="timeline__badge">Vigente</span>
                                </div>
                                <p class="timeline__desc">Condição comercial que está valendo agora.</p>
                                <p class="timeline__meta">Versão 3</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <p class="media-float">
                    <span class="media-float__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 2v6h6"/><path d="M21 12A9 9 0 0 0 6 5.3L3 8"/><path d="M21 22v-6h-6"/><path d="M3 12a9 9 0 0 0 15 6.7l3-2.7"/></svg></span>
                    <span>Mais contexto para retomar conversas e entender a evolução comercial sem depender da memória de quem participou.</span>
                </p>
            </div>
            </div>

            <!-- O botão saiu da coluna de texto para uma faixa centralizada no
                    fim da dobra: na coluna ele encerrava só um dos dois lados. -->
            <div class="cta-strip">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Cadastre-se e comece agora</a>
            </div>
        </div>
    </section>

    <section class="recurso-block" aria-labelledby="propostas-documentos-title">
        <div class="container recurso-split">
            <div class="recurso-split__copy">
                <span class="section-label">Documentos vinculados</span>
                <h2 class="section-title" id="propostas-documentos-title">Mantenha cada material junto da negociação</h2>
                <p class="section-lead">Conecte arquivos importantes à proposta e evite que apresentações, especificações e documentos comerciais fiquem espalhados por e-mails e pastas.</p>

                <p class="recurso-note">A equipe encontra o material certo no contexto certo — inclusive quem entra na negociação depois.</p>

                <div class="recurso-actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece agora</a>
                </div>
            </div>

            <div class="recurso-split__visual">
                <div class="recurso-orbit">
                    <article class="planos-highlight recurso-orbit__core">
                        <span class="planos-highlight__icon" aria-hidden="true"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></span>
                        <h3>Proposta</h3>
                        <p>Tudo o que o cliente recebeu, reunido no mesmo documento.</p>
                    </article>

                    <span class="recurso-orbit__link" aria-hidden="true"></span>

                    <ul class="recurso-orbit__satellites">
                        <li class="integration-chip"><span class="integration-chip__dot" aria-hidden="true"></span>Apresentações</li>
                        <li class="integration-chip"><span class="integration-chip__dot" aria-hidden="true"></span>Arquivos complementares</li>
                        <li class="integration-chip"><span class="integration-chip__dot" aria-hidden="true"></span>Especificações</li>
                        <li class="integration-chip"><span class="integration-chip__dot" aria-hidden="true"></span>Documentos relacionados</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="performance" aria-labelledby="propostas-vinculacao-title">
        <div class="performance__glow" aria-hidden="true"></div>

        <div class="container performance__inner">
            <div class="performance__head">
                <span class="section-label">Vinculação com oportunidades</span>
                <h2 class="performance__title" id="propostas-vinculacao-title">Mantenha a proposta dentro do fluxo da venda</h2>
                <p class="performance__text">Conecte cada documento à oportunidade correspondente e acompanhe proposta, negociação e fechamento no mesmo contexto.</p>
            </div>

            <!-- A imagem dissolve na base em vez de terminar numa aresta reta
                    contra o fundo escuro. Por isso a fileira de cards sobe para
                    dentro da faixa apagada — ver .performance__showcase--fade. -->
            <div class="performance__showcase shot performance__showcase--fade">
                <img src="{{asset('storage/site/home-negocios.png')}}" alt="Pipeline de negócios do Digify com a etapa de proposta enviada entre as demais fases da venda" width="1672" height="941" loading="lazy">
            </div>

            <div class="perf-points">
                <div class="perf-point">
                    <span class="perf-point__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg></span>
                    <strong class="perf-point__title">Oportunidade</strong>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--mint" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></span>
                    <strong class="perf-point__title">Proposta</strong>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--amber" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></span>
                    <strong class="perf-point__title">Negociação</strong>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--rose" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></span>
                    <strong class="perf-point__title">Fechamento</strong>
                </div>
            </div>

            <div class="performance__actions">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Inicie gratuitamente</a>
            </div>
        </div>
    </section>

    <section class="planos-cta" aria-labelledby="propostas-cta-title">
        <div class="container planos-cta__inner">
            <h2 id="propostas-cta-title">Crie propostas com mais velocidade e controle</h2>
            <p>Organize produtos, preços e condições comerciais e mantenha todo o processo conectado à negociação.</p>
            <div class="planos-cta__actions">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Comece grátis</a>
            </div>
        </div>
    </section>
</main>