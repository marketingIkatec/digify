@php
    $page = getPageById(6); //Planos
@endphp
<main id="main">
    <section class="recurso-hero" aria-labelledby="api-title">
        <div class="recurso-hero__bg" aria-hidden="true">
            <span class="blob blob--1"></span>
            <span class="blob blob--2"></span>
            <span class="blob blob--3"></span>
        </div>

        <div class="container recurso-hero__inner">
            <div class="recurso-hero__copy">
                <span class="section-label">API e Integrações</span>
                <h1 class="recurso-hero__title" id="api-title">Conecte a Digify às ferramentas da <span class="text-grad">sua operação</span></h1>
                <p class="recurso-hero__lead">Integre sistemas, automatize a troca de informações e mantenha os dados comerciais circulando entre as soluções que fazem parte do seu negócio.</p>

                <div class="recurso-hero__actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">
                        Comece agora gratuitamente
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
            <div class="recurso-hero__visual">
                <img class="recurso-hero__screen" src="{{asset('storage/site/api-referencia.png')}}" alt="Referência da API do Digify com a lista de endpoints do CRM, a URL base de produção e as formas de autenticação" width="1672" height="941" loading="eager">

                <div class="recurso-hero__float recurso-hero__float--a" aria-hidden="true">
                    <span class="recurso-hero__float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg></span>
                    <span>
                        <strong class="recurso-hero__float-value">API Key</strong>
                        <span class="recurso-hero__float-label">Autenticação por header</span>
                    </span>
                </div>

                <div class="recurso-hero__float recurso-hero__float--b" aria-hidden="true">
                    <span class="recurso-hero__float-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></span>
                    <span>
                        <strong class="recurso-hero__float-value">openapi.yaml</strong>
                        <span class="recurso-hero__float-label">Especificação para baixar</span>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <section class="recurso-block" aria-labelledby="api-visao-title">
        <div class="container recurso-split">
            <div class="recurso-split__copy">
                <span class="section-label">Visão geral das integrações</span>
                <h2 class="section-title" id="api-visao-title">Faça seu CRM trabalhar conectado à operação</h2>
                <p class="section-lead">A Digify pode fazer parte de um ecossistema maior de ferramentas, reduzindo processos isolados e facilitando a circulação de informações entre sistemas.</p>

                <div class="form-feats">
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span><strong>Conecte</strong> — aproxime o CRM das ferramentas que sua empresa já utiliza.</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span><strong>Automatize</strong> — crie fluxos para reduzir ações manuais entre sistemas.</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span><strong>Centralize</strong> — mantenha as informações comerciais disponíveis para apoiar diferentes processos.</span>
                    </div>
                </div>

                <div class="recurso-actions">
                    <a href="{{route('home')}}#integracoes" class="button button--outline button--lg">Explorar integrações</a>
                </div>
            </div>

            
            <div class="recurso-split__visual">
                <div class="recurso-orbit">
                    <article class="planos-highlight recurso-orbit__core">
                        <span class="planos-highlight__icon" aria-hidden="true"><img src="{{asset('storage/site/Icone.svg')}}" alt="" width="20" height="26"></span>
                        <p class="planos-highlight__title">Digify</p>
                        <p>O CRM no centro da sua operação comercial.</p>
                    </article>

                    <span class="recurso-orbit__link" aria-hidden="true"></span>

                    <ul class="recurso-orbit__satellites">
                        <li class="integration-chip"><span class="integration-chip__dot" aria-hidden="true"></span>WhatsApp</li>
                        <li class="integration-chip"><span class="integration-chip__dot" aria-hidden="true"></span>E-mail</li>
                        <li class="integration-chip"><span class="integration-chip__dot" aria-hidden="true"></span>Instagram</li>
                        <li class="integration-chip"><span class="integration-chip__dot" aria-hidden="true"></span>Digisac</li>
                        <li class="integration-chip"><span class="integration-chip__dot" aria-hidden="true"></span>Zapier</li>
                        <li class="integration-chip"><span class="integration-chip__dot" aria-hidden="true"></span>API Aberta</li>
                        <li class="integration-chip"><span class="integration-chip__dot" aria-hidden="true"></span>Webhooks</li>
                        <li class="integration-chip"><span class="integration-chip__dot" aria-hidden="true"></span>Formulários Web</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <section class="recurso-block recurso-block--dark" aria-labelledby="api-webhooks-title">
        <div class="performance__glow" aria-hidden="true"></div>

        <div class="container">
            <div class="section-head--center">
                <span class="section-label">Webhooks e ferramentas de automação</span>
                <h2 class="section-title" id="api-webhooks-title">Faça seus sistemas reagirem ao que acontece no CRM</h2>
                <p class="section-lead">Use webhooks para acionar processos externos a partir de eventos registrados na Digify. A troca acontece a partir do evento, sem depender de verificações manuais constantes.</p>
            </div>

            <div class="recurso-flow">
                <span class="recurso-flow__step">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    Evento na Digify
                </span>
                <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                <span class="recurso-flow__step">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                    Webhook acionado
                </span>
                <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                <span class="recurso-flow__step">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 2 11 13"/><path d="M22 2 15 22l-4-9-9-4Z"/></svg>
                    Informação enviada
                </span>
                <span class="recurso-flow__arrow" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></span>
                <span class="recurso-flow__step">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    Processo externo
                </span>
            </div>

            <p class="recurso-note recurso-note--intro">Conectada a ferramentas de automação, a mesma mecânica amplia seus fluxos:</p>

            <div class="perf-points perf-points--3">
                <div class="perf-point">
                    <span class="perf-point__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg></span>
                    <span>
                        <strong class="perf-point__title">Novo dado no CRM</strong>
                        <span class="perf-point__text">Acione outro sistema.</span>
                    </span>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--mint" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 2v6h6"/><path d="M21 12A9 9 0 0 0 6 5.3L3 8"/><path d="M21 22v-6h-6"/><path d="M3 12a9 9 0 0 0 15 6.7l3-2.7"/></svg></span>
                    <span>
                        <strong class="perf-point__title">Informação atualizada</strong>
                        <span class="perf-point__text">Continue um fluxo.</span>
                    </span>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--amber" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg></span>
                    <span>
                        <strong class="perf-point__title">Evento registrado</strong>
                        <span class="perf-point__text">Inicie uma nova ação.</span>
                    </span>
                </div>
            </div>

            <p class="recurso-note">Integrações e <a class="link" href="{{route('home')}}/funcionalidades/automacoes">automações</a> trabalham juntas para reduzir etapas operacionais.</p>

            <div class="cta-strip">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Comece gratuitamente</a>
            </div>
        </div>
    </section>

    
    <section class="recurso-block" aria-labelledby="api-api-title">
        <div class="container recurso-split recurso-split--reverse">
            <div class="recurso-split__copy">
                <span class="section-label">API e integrações personalizadas</span>
                <h2 class="section-title" id="api-api-title">Leve os dados da Digify para onde precisar</h2>
                <p class="section-lead">Use a API para conectar a Digify a outros sistemas e desenvolver experiências alinhadas às necessidades do seu negócio. Quando a operação exige uma conexão específica, ela é construída sobre os mesmos recursos.</p>

                <div class="form-feats">
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span><strong>Consulte dados</strong> — acesse informações do CRM.</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span><strong>Integre sistemas</strong> — conecte diferentes pontos da operação.</span>
                    </div>
                    <div class="form-feat">
                        <div class="fi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg></div>
                        <span><strong>Crie novos fluxos</strong> — desenvolva soluções a partir dos recursos disponíveis.</span>
                    </div>
                </div>

                <p class="recurso-note">Mais flexibilidade para integrar o CRM à estrutura tecnológica da empresa sem precisar adaptar toda a operação à ferramenta.</p>

                <div class="recurso-actions">
                    <a href="https://app.digify.com.br/login?signup" class="button button--primary button--lg">Comece agora</a>
                </div>
            </div>

            <div class="recurso-split__visual">
                <div class="recurso-bridge">
                    <div class="recurso-bridge__node">
                        <span class="recurso-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></span>
                        <span>
                            <strong class="recurso-bridge__name">Seu sistema</strong>
                            <span class="recurso-bridge__desc">A ferramenta que sua operação já usa</span>
                        </span>
                    </div>

                    <div class="recurso-bridge__link">
                        <span class="recurso-bridge__chip"><span aria-hidden="true">↔</span> API</span>
                    </div>

                    <div class="recurso-bridge__node">
                        <span class="recurso-icon" aria-hidden="true"><img src="{{asset('storage/site/Icone.svg')}}" alt="" width="16" height="21"></span>
                        <span>
                            <strong class="recurso-bridge__name">Digify</strong>
                            <span class="recurso-bridge__desc">O CRM no meio do fluxo</span>
                        </span>
                    </div>

                    <div class="recurso-bridge__link">
                        <span class="recurso-bridge__chip"><span aria-hidden="true">↔</span> Webhooks</span>
                    </div>

                    <div class="recurso-bridge__node">
                        <span class="recurso-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7h-9"/><path d="M14 17H5"/><circle cx="17" cy="17" r="3"/><circle cx="7" cy="7" r="3"/></svg></span>
                        <span>
                            <strong class="recurso-bridge__name">Seu processo comercial</strong>
                            <span class="recurso-bridge__desc">O trabalho continua onde precisa</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="performance" aria-labelledby="api-dados-title">
        <div class="performance__glow" aria-hidden="true"></div>

        <div class="container performance__inner">
            <div class="performance__head">
                <span class="section-label">Importação e exportação de dados</span>
                <h2 class="performance__title" id="api-dados-title">Seus dados entram e saem quando você precisar</h2>
                <p class="performance__text">Traga informações para a Digify ou exporte dados para apoiar outras rotinas da operação — mais autonomia para trabalhar com sua base sem deixá-la presa a um único ambiente.</p>
            </div>

            <!-- PNG de fundo transparente: entra sem .shot, e os cartões brancos
                    do produto ganham contraste alto sobre a dobra escura. -->
            <div class="recurso-showcase recurso-showcase--bare recurso-showcase--wide">
                <img src="{{asset('storage/site/leads-importar-contatos.png')}}" alt="Lista de contatos do Digify com as ações de importar CSV e cadastrar novo contato" width="1697" height="897" loading="lazy">
            </div>

            <div class="perf-points perf-points--3">
                <div class="perf-point">
                    <span class="perf-point__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg></span>
                    <span>
                        <strong class="perf-point__title">Importe</strong>
                        <span class="perf-point__text">Leve bases existentes para o CRM.</span>
                    </span>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--mint" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg></span>
                    <span>
                        <strong class="perf-point__title">Organize</strong>
                        <span class="perf-point__text">Trabalhe os dados dentro do processo comercial.</span>
                    </span>
                </div>
                <div class="perf-point">
                    <span class="perf-point__icon perf-point__icon--amber" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></span>
                    <span>
                        <strong class="perf-point__title">Exporte</strong>
                        <span class="perf-point__text">Use as informações em outras análises e processos.</span>
                    </span>
                </div>
            </div>

            <div class="performance__actions">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Comece grátis</a>
            </div>
        </div>
    </section>

    <section class="planos-cta" aria-labelledby="api-cta-title">
        <div class="container planos-cta__inner">
            <h2 id="api-cta-title">Conecte a Digify à sua operação</h2>
            <p>Integre sistemas, automatize a troca de dados e crie fluxos que acompanham as necessidades do seu negócio.</p>
            <div class="planos-cta__actions">
                <a href="https://app.digify.com.br/login?signup" class="button button--white button--lg">Comece grátis</a>
                <a href="{{route('home')}}#integracoes" class="button button--outline button--lg">Ver integrações</a>
            </div>
        </div>
    </section>
</main>