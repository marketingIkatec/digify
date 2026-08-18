<style>
    /* =========================================================
   Tour Guiado — Digify · CRM de Vendas
   style.css  ·  v3 — cara de app, design system Apple (HIG)
   Fonte de sistema (SF Pro / Segoe UI Variable) · pesos 400/600/700
   Paleta Digify: #041945 navy · #27DBFF cyan · #27FFB7 mint
   ========================================================= */

:root{
  /* Marca Digify */
  --navy:#041945;
  --navy-2:#0a2350;
  --blue:#0b4cd0;                                  /* tint (estilo iOS) */
  --grad:linear-gradient(90deg,#27dbff,#27ffb7);   /* assinatura: progresso + logo */

  /* Rótulos e superfícies estilo Apple (light) */
  --label:#1c1c1e;
  --label-2:rgba(60,60,67,.60);                    /* secondaryLabel */
  --label-3:rgba(60,60,67,.32);                    /* tertiaryLabel  */
  --sep:rgba(60,60,67,.14);                        /* separator      */
  --fill:#787880;                                  /* systemFill base */
  --bg:#f2f2f7;                                     /* systemGroupedBackground */
  --bg-2:#e9e9ef;                                   /* secondary fill */
  --card:#ffffff;

  --r-card:18px;
  --r-btn:12px;
  --r-sm:9px;
  --shadow-card:0 1px 2px rgba(4,25,69,.05),0 20px 44px -18px rgba(4,25,69,.24);
  --ring:0 0 0 3px rgba(11,76,208,.30);

  /* Fonte de sistema: SF Pro em Apple, Segoe UI Variable em Windows 11 */
  --sans:-apple-system,BlinkMacSystemFont,"SF Pro Text","SF Pro Display","Segoe UI Variable","Segoe UI",system-ui,Roboto,Helvetica,Arial,sans-serif;
  --mono:ui-monospace,"SF Mono","Cascadia Code",Consolas,monospace;
}

*{box-sizing:border-box}
html,body{margin:0;padding:0}
body{
  font-family:var(--sans);background:var(--bg);color:var(--label);
  -webkit-font-smoothing:antialiased;text-rendering:optimizeLegibility;
  letter-spacing:normal;
}
.is-hidden{display:none !important}

/* ---------- Logo ---------- */
.logo{display:inline-flex;align-items:center}
.logo .logo-img{height:32px;width:auto;display:block}
.logo.sm .logo-img{height:26px}
.logo-fallback{display:none;align-items:center;gap:9px;font-size:25px;font-weight:700;letter-spacing:-.02em;color:var(--navy)}
.logo.sm .logo-fallback{font-size:20px}
.logo-fallback .mark{width:23px;height:23px;border-radius:7px;background:var(--grad);flex:none}
.logo.sm .logo-fallback .mark{width:19px;height:19px}

/* ---------- Eyebrow (cabeçalho de seção, estilo iOS) ---------- */
.eyebrow{
  margin:0 0 10px;font-size:12.5px;font-weight:600;letter-spacing:.05em;text-transform:uppercase;color:var(--label-2);
}

/* =========================================================
   CAPA
   ========================================================= */
.cover{
  position:relative;min-height:100vh;display:flex;align-items:center;justify-content:center;
  background:var(--bg);overflow:hidden;padding:48px 24px;
}
.cover::after{
  content:"";position:absolute;left:50%;top:-160px;width:640px;height:400px;transform:translateX(-50%);
  background:radial-gradient(closest-side,rgba(39,219,255,.18),transparent 72%);filter:blur(6px);pointer-events:none;
}
.cover-inner{position:relative;max-width:560px;text-align:center}
.cover .eyebrow{margin:26px 0 14px;color:var(--blue)}
.cover h1{
  font-size:clamp(34px,5vw,52px);line-height:1.05;margin:0 0 18px;font-weight:700;letter-spacing:-.014em;color:var(--navy);
}
.lead{font-size:18px;line-height:1.5;color:var(--label-2);max-width:480px;margin:0 auto 34px;letter-spacing:.006em}
.cover-actions{display:flex;flex-direction:column;align-items:center;gap:16px}
.cover-meta{margin:0;font-size:13px;color:var(--label-3);font-weight:500}
.hint{margin-top:28px;font-size:13px;color:var(--label-3)}
kbd{
  background:var(--card);border:1px solid var(--sep);border-radius:6px;padding:1px 6px;
  font-family:var(--sans);font-size:12px;color:var(--label-2);font-weight:500;
}

/* =========================================================
   BOTOES  (estilo iOS: preenchido / cinza / texto)
   ========================================================= */
.btn-primary{
  background:var(--navy);color:#fff;border:0;border-radius:var(--r-btn);padding:12px 24px;
  font-size:15px;font-weight:600;cursor:pointer;transition:background .16s,transform .12s;font-family:var(--sans);letter-spacing:normal;
}
.btn-primary:hover{background:var(--navy-2)}
.btn-primary:active{transform:scale(.98)}
.btn-lg{padding:15px 46px;font-size:16px;border-radius:14px}
.btn-ghost{
  background:var(--bg-2);color:var(--label);border:0;border-radius:var(--r-btn);
  padding:12px 20px;font-size:15px;font-weight:600;cursor:pointer;transition:.14s;font-family:var(--sans);letter-spacing:normal;
}
.btn-ghost:hover{background:#e0e0e8}
.btn-ghost:active{transform:scale(.98)}
.btn-ghost:disabled{opacity:.4;cursor:not-allowed}
.btn-text{
  background:none;border:0;color:var(--blue);font-size:14px;font-weight:500;cursor:pointer;
  font-family:var(--sans);padding:8px 10px;text-align:left;transition:.14s;
}
.btn-text:hover{opacity:.7}
:focus-visible{outline:none;box-shadow:var(--ring);border-radius:10px}

/* =========================================================
   LAYOUT DO TOUR  (sidebar + painel, estilo macOS/iPad)
   ========================================================= */
.app{display:grid;grid-template-columns:270px 1fr;min-height:100vh}

/* ---------- Sidebar ---------- */
.sidebar{
  background:var(--card);border-right:1px solid var(--sep);
  padding:22px 12px 18px;display:flex;flex-direction:column;
  position:sticky;top:0;height:100vh;overflow-y:auto;
}
.brand{padding:2px 10px 18px}
.toc{flex:1;overflow-y:auto;margin-bottom:10px}
.toc h4{
  margin:20px 12px 4px;font-size:12px;letter-spacing:.05em;text-transform:uppercase;color:var(--label-3);font-weight:600;
}
.toc button{
  display:flex;align-items:baseline;gap:10px;width:100%;text-align:left;background:transparent;border:0;
  color:var(--label);font-size:14px;padding:8px 12px;border-radius:var(--r-sm);cursor:pointer;transition:.12s;
  font-family:var(--sans);line-height:1.3;font-weight:400;letter-spacing:normal;
}
.toc button .n{font-size:12px;color:var(--label-3);flex:none;width:18px;font-variant-numeric:tabular-nums}
.toc button:hover{background:var(--bg)}
.toc button.active{background:#eaf1ff;color:var(--blue);font-weight:600}
.toc button.active .n{color:var(--blue)}
.toc button.done .n::after{content:"·";margin-left:2px;color:#34c759}

/* ---------- Palco (ritmo de 8pt) ---------- */
.stage{padding:48px 56px 48px;max-width:1048px;width:100%;margin:0 auto}
.stage-head{display:flex;align-items:flex-start;justify-content:space-between;gap:24px;margin-bottom:28px}
.stage-head-main{min-width:0}
.stage-head h2{margin:0;font-size:28px;letter-spacing:-.006em;font-weight:700;color:var(--navy);line-height:1.12}
.stage-head .sub{margin:8px 0 0;color:var(--label-2);font-size:17px;line-height:1.4;letter-spacing:.006em;max-width:58ch}

/* toggle de marcações (fora da moldura, estilo app) */
.spots-toggle{
  flex:none;display:inline-flex;align-items:center;gap:8px;margin-top:6px;
  background:var(--bg-2);border:0;border-radius:980px;padding:8px 14px 8px 12px;
  font-family:var(--sans);font-size:13px;font-weight:600;color:var(--label);cursor:pointer;
  letter-spacing:normal;transition:background .14s,color .14s;
}
.spots-toggle:hover{background:#e0e0e8}
.spots-toggle:active{transform:scale(.97)}
.st-dot{width:8px;height:8px;border-radius:50%;background:var(--navy);box-shadow:0 0 0 3px rgba(4,25,69,.13);transition:.14s}
.spots-toggle.off{color:var(--label-2)}
.spots-toggle.off .st-dot{background:var(--label-3);box-shadow:none}

/* ---------- Moldura do screenshot (card branco) ---------- */
.shot-wrap{
  position:relative;z-index:1;border-radius:var(--r-card);box-shadow:var(--shadow-card);
  background:var(--card);border:1px solid var(--sep);
}
.browser-bar{
  display:flex;align-items:center;gap:7px;padding:11px 14px;background:#fbfbfd;
  border-bottom:1px solid var(--sep);border-radius:var(--r-card) var(--r-card) 0 0;
}
.dot{width:11px;height:11px;border-radius:50%;display:inline-block}
.dot.r{background:#ff5f57}.dot.y{background:#febc2e}.dot.g{background:#28c840}
.url{
  flex:1;margin-left:8px;background:var(--card);border:1px solid var(--sep);border-radius:7px;
  padding:5px 12px;font-size:12px;color:var(--label-2);overflow:hidden;text-overflow:ellipsis;
  white-space:nowrap;font-family:var(--mono);
}
.url::before{content:"🔒 ";filter:grayscale(1);opacity:.4}
.mini{
  background:transparent;border:1px solid var(--sep);border-radius:8px;font-size:12px;font-weight:500;
  color:var(--label-2);padding:5px 11px;cursor:pointer;font-family:var(--sans);transition:.14s;white-space:nowrap;
}
.mini:hover{background:var(--bg)}
.mini.off{opacity:.45}
.shot{position:relative;line-height:0}
.shot img{width:100%;display:block;border-radius:0 0 var(--r-card) var(--r-card)}

/* ---------- Hotspots (à frente de tudo, sem corte) ---------- */
.hotspots{position:absolute;inset:0}
.hotspots.hide{display:none}
.spot{
  position:absolute;transform:translate(-50%,-50%);
  width:24px;height:24px;border-radius:50%;
  background:var(--navy);color:#fff;border:2px solid #fff;
  font-size:11.5px;font-weight:600;display:flex;align-items:center;justify-content:center;
  cursor:default;box-shadow:0 2px 8px rgba(4,25,69,.35);transition:transform .14s;
}
.spot:hover{transform:translate(-50%,-50%) scale(1.14);z-index:40}
.spot .tip{
  position:absolute;left:50%;top:calc(100% + 10px);transform:translateX(-50%);
  background:rgba(28,28,30,.96);color:#fff;font-size:12.5px;font-weight:400;line-height:1.45;letter-spacing:.006em;
  padding:9px 12px;border-radius:11px;width:max-content;max-width:230px;text-align:left;z-index:50;
  opacity:0;visibility:hidden;transition:opacity .14s,visibility .14s;pointer-events:none;
  box-shadow:0 10px 30px rgba(0,0,0,.28);-webkit-backdrop-filter:blur(6px);backdrop-filter:blur(6px);
}
.spot .tip::before{content:"";position:absolute;left:50%;top:-5px;transform:translateX(-50%) rotate(45deg);width:9px;height:9px;background:rgba(28,28,30,.96)}
.spot:hover .tip{opacity:1;visibility:visible}
.spot.flip .tip{top:auto;bottom:calc(100% + 10px)}
.spot.flip .tip::before{top:auto;bottom:-5px}
/* balões próximos das bordas laterais nao saem da tela */
.spot.edge-l .tip{left:0;transform:none}
.spot.edge-l .tip::before{left:18px}
.spot.edge-r .tip{left:auto;right:0;transform:none}
.spot.edge-r .tip::before{left:auto;right:18px}

/* ---------- Descrição curta (visível) ---------- */
.blurb{
  margin:24px 0 0;font-size:15px;line-height:1.6;color:var(--label);max-width:66ch;letter-spacing:.012em;font-weight:400;
}

/* ---------- Como usar (recolhível, card iOS) ---------- */
.detail{margin-top:20px}
.detail-toggle{
  display:inline-flex;align-items:center;gap:6px;background:none;border:0;cursor:pointer;
  padding:6px 0;font-family:var(--sans);font-size:14px;font-weight:600;color:var(--blue);letter-spacing:normal;transition:.14s;
}
.detail-toggle:hover{opacity:.7}
.dt-chev{display:inline-block;transition:transform .2s;font-size:17px;line-height:1}
.detail-toggle[aria-expanded="true"] .dt-chev{transform:rotate(90deg)}
.detail-body{margin-top:10px;background:var(--card);border:1px solid var(--sep);border-radius:var(--r-card);padding:6px 18px;max-width:70ch;animation:fade .2s ease}
@keyframes fade{from{opacity:0;transform:translateY(-3px)}to{opacity:1;transform:none}}
.detail-body ul{margin:0;padding-left:0;list-style:none}
.detail-body li{font-size:15px;line-height:1.45;color:var(--label);padding:11px 0 11px 22px;position:relative;letter-spacing:.012em}
.detail-body li+li{border-top:1px solid var(--sep)}
.detail-body li::before{content:"";position:absolute;left:2px;top:17px;width:6px;height:6px;border-radius:50%;background:var(--blue)}

/* ---------- Controles ---------- */
.controls{display:flex;align-items:center;gap:18px;margin-top:36px;padding-top:24px;border-top:1px solid var(--sep)}
.progress-wrap{flex:1;display:flex;align-items:center;gap:14px}
.progress{flex:1;height:4px;background:var(--bg-2);border-radius:99px;overflow:hidden}
.bar{height:100%;width:0;border-radius:99px;background:var(--grad);transition:width .35s ease}
.counter{font-size:13px;color:var(--label-3);white-space:nowrap;font-variant-numeric:tabular-nums;font-weight:500}

/* =========================================================
   RESPONSIVO
   ========================================================= */
@media (max-width:1000px){
  .app{grid-template-columns:1fr}
  .sidebar{position:relative;height:auto;border-right:0;border-bottom:1px solid var(--sep)}
  .toc{max-height:220px}
  .stage{padding:28px 18px 34px}
  .stage-head{flex-wrap:wrap;gap:14px}
  .spots-toggle{margin-top:0}
  .spot{width:22px;height:22px;font-size:11px}
}
@media (prefers-reduced-motion:reduce){
  *{transition:none !important;animation:none !important}
}
@media print{
  .sidebar,.controls,.detail-toggle{display:none}
  .app{display:block}
  .detail-body[hidden]{display:block !important}
}
</style>

  <!-- ============ CAPA ============ -->
  <section id="cover" class="cover">
    <div class="cover-inner">
      <div class="logo">
        <img class="logo-img" alt="Digify" src="{{asset('storage/' . $config['logo_header'])}}">
        <span class="logo-fallback"><span class="mark"></span>digify</span>
      </div>
      <p class="eyebrow">CRM de vendas · Tour guiado</p>
      <h1>Do primeiro lead ao<br>negócio fechado.</h1>
      <p class="lead">
        Um passeio por 28 telas do Digify — captura de leads, pipeline,
        propostas, automações e performance, em um só lugar.
      </p>

      <div class="cover-actions">
        <button id="startBtn" class="btn-primary btn-lg">Iniciar tour</button>
        <p class="cover-meta">28 telas · 7 capítulos · ~10 min</p>
      </div>
      <p class="hint">Navegue com as setas <kbd>&larr;</kbd> <kbd>&rarr;</kbd></p>
    </div>
  </section>

  <!-- ============ TOUR ============ -->
  <div id="app" class="app is-hidden">

    <aside class="sidebar">
      <div class="brand">
        <div class="logo sm">
          <img class="logo-img" alt="Digify" src="{{asset('storage/' . $config['logo_header'])}}">
          <span class="logo-fallback"><span class="mark"></span>digify</span>
        </div>
      </div>
      <nav id="toc" class="toc"></nav>
      <button id="restart" class="btn-text">← Voltar à capa</button>
    </aside>

    <main class="stage">

      <header class="stage-head">
        <div class="stage-head-main">
          <p id="chapterTag" class="eyebrow"></p>
          <h2 id="stepTitle"></h2>
          <p id="stepSub" class="sub"></p>
        </div>
        <button id="toggleSpots" class="spots-toggle" title="Mostrar ou ocultar as marcações" aria-pressed="true">
          <span class="st-dot" aria-hidden="true"></span>Marcações
        </button>
      </header>

      <div class="shot-wrap" id="shotWrap">
        <div class="browser-bar">
          <i class="dot r"></i><i class="dot y"></i><i class="dot g"></i>
          <div id="urlBar" class="url"></div>
        </div>
        <div class="shot" id="shot">
          <img id="shotImg" alt="Captura de tela da plataforma Digify">
          <div id="hotspots" class="hotspots"></div>
        </div>
      </div>

      <p id="desc" class="blurb"></p>

      <section class="detail">
        <button id="detailToggle" class="detail-toggle" aria-expanded="false">
          <span class="dt-label">Como usar no dia a dia</span>
          <span class="dt-chev" aria-hidden="true">&rsaquo;</span>
        </button>
        <div id="detailBody" class="detail-body" hidden>
          <ul id="bullets"></ul>
        </div>
      </section>

      <footer class="controls">
        <button id="prev" class="btn-ghost">&larr; Anterior</button>
        <div class="progress-wrap">
          <div class="progress"><div id="bar" class="bar"></div></div>
          <span id="counter" class="counter"></span>
        </div>
        <button id="next" class="btn-primary">Próximo &rarr;</button>
      </footer>

    </main>
  </div>

<script>
/* =========================================================
   Tour Guiado — Digify · CRM de Vendas
   tour.js  —  roteiro + navegacao
   ========================================================= */

var BASE = "app.digify.com.br";

/* Cores por capitulo — passo cyan -> mint (paleta Digify, so decorativo) */
var CH_COLORS = {
  "Capítulo 1 · Comece por aqui":        "#27dbff",
  "Capítulo 2 · Pipeline de vendas":     "#27e1f3",
  "Capítulo 3 · Base comercial":         "#27e7e7",
  "Capítulo 4 · Rotina & operação":      "#27eddA",
  "Capítulo 5 · Conteúdo & colaboração": "#27f3cd",
  "Capítulo 6 · Performance & dados":    "#27f9c2",
  "Capítulo 7 · Administração":          "#27ffb7"
};

var STEPS = [

/* ---------- CAPITULO 1 — COMECE POR AQUI ---------- */
{
  chapter:"Capítulo 1 · Comece por aqui",
  title:"Home — Painel de vendas",
  sub:"A visão geral do seu pipeline logo na entrada",
  url:"/",
  img:"{{ asset('storage/tour/01-home.png')}}",
  desc:"A Home abre com o retrato do momento comercial. No topo, os indicadores-chave — pipeline aberto, negócios ganhos, atividades de hoje, tarefas atrasadas e taxa de conversão. Logo abaixo, o funil por probabilidade e os motivos de perda do período. É a tela onde o time começa o dia e a liderança confere o ritmo.",
  bullets:[
    "Troque a visão e o período nos seletores do topo para recortar os números.",
    "Comece pelas Atividades de hoje e pelas Atrasadas — é o que pede ação agora.",
    "Use o funil por probabilidade para ver onde o dinheiro está parado.",
    "Navegue por todos os módulos pelo menu superior: Vendas, Performance, Operação, Recursos e Administração."
  ],
  spots:[
    {x:50,y:5, t:"Menu principal — acesso a todos os módulos do CRM"},
    {x:14,y:16,t:"Recorte de visão e período dos indicadores"},
    {x:50,y:36,t:"KPIs do momento: pipeline, ganhos, atividades e conversão"},
    {x:26,y:66,t:"Funil por probabilidade e motivos de perda"}
  ]
},
{
  chapter:"Capítulo 1 · Comece por aqui",
  title:"Busca global",
  sub:"Encontre qualquer registro em segundos",
  url:"/#buscar",
  img:"{{ asset('storage/tour/02-busca.png')}}",
  desc:"A busca global é o atalho para chegar em qualquer lugar do CRM sem navegar pelos menus. Ela procura por negócios, contatos, organizações e propostas ao mesmo tempo e leva você direto ao registro. Um jeito rápido de abrir um cliente no meio de uma ligação.",
  bullets:[
    "Abra pela lupa no canto superior direito de qualquer tela.",
    "Digite o nome do negócio, do contato ou da empresa que procura.",
    "Clique no resultado para abrir o registro completo.",
    "Ideal durante um atendimento: ache o cliente sem perder o ritmo."
  ],
  spots:[
    {x:50,y:44,t:"Campo de busca — procura em negócios, contatos e empresas"},
    {x:50,y:54,t:"Resultados abrem o registro direto"}
  ]
},

/* ---------- CAPITULO 2 — PIPELINE DE VENDAS ---------- */
{
  chapter:"Capítulo 2 · Pipeline de vendas",
  title:"Leads",
  sub:"A fila de entrada, antes de virar negócio",
  url:"/leads",
  img:"{{ asset('storage/tour/03-leads.png')}}",
  desc:"Leads é onde chega e é qualificado todo contato novo antes de virar um negócio. A régua de status vai de Novo a Convertido, passando por Contatado, Qualificado e Desqualificado. Você trabalha a fila do jeito que preferir: caixa de entrada, kanban ou lista.",
  bullets:[
    "Cadastre uma entrada manual em Novo Lead ou deixe a captura automática trazer.",
    "Acompanhe a régua de qualificação pelos contadores de status no topo.",
    "Alterne entre Inbox, Kanban e Lista conforme o seu jeito de trabalhar.",
    "Filtre por responsável, período, status e origem para focar sua fila."
  ],
  spots:[
    {x:92,y:18,t:"Cadastrar um novo lead manualmente"},
    {x:26,y:27,t:"Régua de qualificação: do Novo ao Convertido"},
    {x:15,y:35,t:"Três visões da fila: Inbox, Kanban e Lista"},
    {x:16,y:69,t:"Filtros por responsável, período, status e origem"}
  ]
},
{
  chapter:"Capítulo 2 · Pipeline de vendas",
  title:"Captura de Leads",
  sub:"Formulários que enchem o funil sozinhos",
  url:"/lead-capture",
  img:"{{ asset('storage/tour/04-captura-leads.png')}}",
  desc:"Aqui você cria formulários públicos que entram direto na sua fila de leads. Compartilhe por link, incorpore no site ou integre por API — cada envio vira um lead no CRM, sem digitação manual. O painel acompanha quantos leads cada formulário trouxe.",
  bullets:[
    "Monte um formulário em Novo Formulário e escolha os campos que quer receber.",
    "Publique por link, embed no site ou integração via API.",
    "Cada resposta entra automaticamente na fila de Leads.",
    "Acompanhe o desempenho de cada formulário na aba Dashboard."
  ],
  spots:[
    {x:13,y:33,t:"Dashboard de desempenho e lista de formulários"},
    {x:49,y:83,t:"Criar um formulário público de captura"}
  ]
},
{
  chapter:"Capítulo 2 · Pipeline de vendas",
  title:"Negócios",
  sub:"O pipeline visual, arrastando etapa a etapa",
  url:"/deals",
  img:"{{ asset('storage/tour/05-negocios.png')}}",
  desc:"Negócios é o coração do CRM: um kanban do pipeline onde cada card é uma oportunidade. As colunas são as etapas — Novo Lead, Qualificação, Atendimento, Proposta Enviada, Follow up — e cada card mostra valor, probabilidade e responsável. Arraste o card para mover a venda de etapa.",
  bullets:[
    "Arraste os cards entre colunas para avançar o negócio no funil.",
    "Cada etapa tem uma probabilidade que alimenta o forecast de receita.",
    "Filtre por pipeline, estado (abertos/ganhos/perdidos) e responsável.",
    "Abra um card para ver histórico, atividades, propostas e documentos do negócio."
  ],
  spots:[
    {x:57,y:18,t:"Escolha o pipeline e filtre os negócios"},
    {x:94,y:18,t:"Abrir um novo negócio"},
    {x:10,y:26,t:"Cada coluna é uma etapa, com total e valor"},
    {x:12,y:45,t:"Card: valor, probabilidade e responsável"}
  ]
},
{
  chapter:"Capítulo 2 · Pipeline de vendas",
  title:"Propostas",
  sub:"Do rascunho ao aceite, com rastreio de abertura",
  url:"/proposals",
  img:"{{ asset('storage/tour/06-propostas.png')}}",
  desc:"Todas as propostas comerciais ficam aqui, ligadas ao negócio e ao cliente. Cada uma tem número, versão, validade e status — de rascunho a enviada, aceita ou cancelada. O contador de views mostra quantas vezes o cliente abriu a proposta, então você sabe a hora certa de fazer o follow up.",
  bullets:[
    "Crie a partir de um negócio em Nova Proposta, usando um template pronto.",
    "Acompanhe o status e a versão de cada documento na lista.",
    "A coluna de views revela se o cliente já abriu — o gatilho do follow up.",
    "Abra o Analytics para ver o desempenho das propostas no período."
  ],
  spots:[
    {x:90,y:18,t:"Gerar uma nova proposta"},
    {x:77,y:18,t:"Analytics de propostas do período"},
    {x:61,y:45,t:"Status e versão de cada proposta"},
    {x:77,y:45,t:"Views: quantas vezes o cliente abriu"}
  ]
},

/* ---------- CAPITULO 3 — BASE COMERCIAL ---------- */
{
  chapter:"Capítulo 3 · Base comercial",
  title:"Organizações",
  sub:"As empresas com quem você faz negócio",
  url:"/organizations",
  img:"{{ asset('storage/tour/07-organizacoes.png')}}",
  desc:"O cadastro das empresas — clientes, prospects e parceiros. Cada organização traz setor, domínio, contatos, responsável, tags e número de funcionários, e conecta todos os negócios e pessoas ligados a ela. É a base para segmentar a carteira.",
  bullets:[
    "Cadastre uma empresa em Nova organização ou traga tudo de uma vez com Importar CSV.",
    "Classifique por setor e tags para segmentar a carteira depois.",
    "O responsável define quem cuida da conta.",
    "Abra uma organização para ver seus contatos, negócios e histórico."
  ],
  spots:[
    {x:91,y:18,t:"Cadastrar uma nova empresa"},
    {x:78,y:18,t:"Importar empresas em massa por CSV"},
    {x:17,y:48,t:"Setor da empresa — usado para segmentar"}
  ]
},
{
  chapter:"Capítulo 3 · Base comercial",
  title:"Pessoas",
  sub:"Todos os contatos, em um só lugar",
  url:"/people",
  img:"{{ asset('storage/tour/08-pessoas.png')}}",
  desc:"O diretório de contatos do CRM: as pessoas com quem o time fala. Cada contato reúne cargo, empresa, e-mail, telefone, responsável e tags, e fica vinculado à organização e aos negócios. É de onde saem as ligações, os e-mails e as atividades.",
  bullets:[
    "Adicione um contato em Novo contato ou importe sua base por CSV.",
    "Vincule cada pessoa à organização para manter a carteira organizada.",
    "Use as tags para criar recortes (ex.: decisor, indicação, evento).",
    "Abra um contato para ver o histórico completo de interações."
  ],
  spots:[
    {x:92,y:18,t:"Cadastrar um novo contato"},
    {x:81,y:18,t:"Importar contatos por CSV"},
    {x:10,y:48,t:"Contato com empresa, cargo e responsável"}
  ]
},
{
  chapter:"Capítulo 3 · Base comercial",
  title:"Produtos",
  sub:"O catálogo que alimenta negócios e propostas",
  url:"/products",
  img:"{{ asset('storage/tour/09-produtos.png')}}",
  desc:"O catálogo de produtos e serviços que você vende. Cada item tem nome, descrição, SKU, categoria, preço e status. É daqui que os itens entram nos negócios e nas propostas, com preço padronizado — sem inventar valor a cada venda.",
  bullets:[
    "Cadastre um item em Novo produto ou suba o catálogo inteiro por CSV.",
    "Organize por categoria para achar rápido na hora de montar a proposta.",
    "Defina o preço padrão — ele é sugerido ao adicionar o item a um negócio.",
    "Desative itens fora de linha mantendo o histórico das vendas antigas."
  ],
  spots:[
    {x:92,y:18,t:"Adicionar um produto ao catálogo"},
    {x:66,y:41,t:"SKU, categoria e preço padrão"},
    {x:85,y:50,t:"Status ativo/inativo do item"}
  ]
},
{
  chapter:"Capítulo 3 · Base comercial",
  title:"Tabela de Preços",
  sub:"Preços diferentes para públicos diferentes",
  url:"/price-tables",
  img:"{{ asset('storage/tour/10-tabela-precos.png')}}",
  desc:"Quando o preço muda por região, canal ou tipo de cliente, as tabelas de preço resolvem. Você cria listas — parceiros, uma cidade, uma campanha, indicações — e aplica a tabela certa no negócio, sem sobrescrever o catálogo padrão.",
  bullets:[
    "Crie uma lista em Nova Tabela e defina os preços daquele público.",
    "Aplique a tabela no negócio para puxar os valores corretos.",
    "Mantenha várias tabelas ativas ao mesmo tempo (região, canal, parceiro).",
    "Cada tabela mostra quantos produtos ela cobre."
  ],
  spots:[
    {x:92,y:18,t:"Criar uma nova tabela de preços"},
    {x:72,y:48,t:"Tabela ativa e pronta para uso"},
    {x:80,y:48,t:"Quantos produtos a tabela cobre"}
  ]
},

/* ---------- CAPITULO 4 — ROTINA & OPERACAO ---------- */
{
  chapter:"Capítulo 4 · Rotina & operação",
  title:"Atividades",
  sub:"A lista de tarefas que move as vendas",
  url:"/activities",
  img:"{{ asset('storage/tour/11-atividades.png')}}",
  desc:"Atividades é a agenda de execução do time: tarefas, ligações, e-mails e reuniões, cada uma ligada a um negócio. Os cartões no topo separam por tipo e destacam as atrasadas. É por aqui que ninguém esquece de retornar um cliente.",
  bullets:[
    "Crie uma tarefa em Nova atividade e vincule ao negócio certo.",
    "Ataque primeiro o cartão Atrasadas — são compromissos vencidos.",
    "Marque a caixinha para concluir uma atividade direto na lista.",
    "Ligue Mostrar concluídas quando quiser revisar o que já foi feito."
  ],
  spots:[
    {x:91,y:18,t:"Criar uma nova atividade"},
    {x:40,y:36,t:"Cartões por tipo — e o alerta de atrasadas"},
    {x:73,y:18,t:"Mostrar também as atividades concluídas"},
    {x:4, y:60,t:"Conclua a atividade direto pela caixinha"}
  ]
},
{
  chapter:"Capítulo 4 · Rotina & operação",
  title:"Calendário",
  sub:"Atividades, projetos e negócios na mesma agenda",
  url:"/calendar",
  img:"{{ asset('storage/tour/12-calendario.png')}}",
  desc:"O calendário reúne, em uma única agenda, as atividades, os projetos e os prazos de negócios — cada um com sua cor. Dá para ver o mês inteiro ou fechar na semana e no dia, e enxergar de relance onde a semana está pesada.",
  bullets:[
    "Ligue e desligue as camadas: Atividades, Projetos e Negócios.",
    "Alterne entre Mês, Semana e Dia conforme o nível de detalhe.",
    "Use Hoje e as setas para navegar entre períodos.",
    "Clique em um evento para abrir o registro por trás dele."
  ],
  spots:[
    {x:63,y:21,t:"Camadas: atividades, projetos e negócios, por cor"},
    {x:90,y:21,t:"Visões de Mês, Semana e Dia"},
    {x:22,y:39,t:"Eventos do dia — clique para abrir"}
  ]
},
{
  chapter:"Capítulo 4 · Rotina & operação",
  title:"Projetos",
  sub:"O que acontece depois do negócio fechado",
  url:"/projects",
  img:"{{ asset('storage/tour/13-projetos.png')}}",
  desc:"Projetos acompanha as entregas ligadas a um negócio — implantação, ativação, onboarding do cliente. Cada projeto tem status, data de início, negócio de origem e responsável, ligando a venda à execução e ao pós-venda.",
  bullets:[
    "Abra um projeto em Novo projeto e vincule ao negócio de origem.",
    "Acompanhe pelo status: Planejamento, Em andamento e Concluído.",
    "O responsável é quem toca a entrega junto ao cliente.",
    "Use para dar continuidade ao que foi vendido, sem perder o fio."
  ],
  spots:[
    {x:93,y:18,t:"Criar um novo projeto"},
    {x:33,y:48,t:"Status: planejamento, em andamento, concluído"},
    {x:58,y:56,t:"Negócio de origem do projeto"}
  ]
},
{
  chapter:"Capítulo 4 · Rotina & operação",
  title:"Equipes",
  sub:"Como o time é organizado no CRM",
  url:"/teams",
  img:"{{ asset('storage/tour/14-equipes.png')}}",
  desc:"Equipes agrupa as pessoas por função — Comercial, SDR, CS, Suporte, Marketing. Os grupos organizam responsáveis, alimentam a distribuição de leads e os rankings de performance, e definem quem enxerga o quê.",
  bullets:[
    "Monte um grupo em Nova Equipe e adicione os membros.",
    "Defina os managers, que acompanham os resultados do grupo.",
    "As equipes servem de base para distribuir leads automaticamente.",
    "Rankings e metas podem ser lidos por equipe."
  ],
  spots:[
    {x:92,y:18,t:"Criar uma nova equipe"},
    {x:49,y:37,t:"Membros de cada equipe"},
    {x:63,y:37,t:"Managers responsáveis pelo grupo"}
  ]
},

/* ---------- CAPITULO 5 — CONTEUDO & COLABORACAO ---------- */
{
  chapter:"Capítulo 5 · Conteúdo & colaboração",
  title:"Manual de Vendas",
  sub:"Playbooks que aparecem na hora certa",
  url:"/playbooks",
  img:"{{ asset('storage/tour/15-manual-vendas.png')}}",
  desc:"O manual de vendas guarda os playbooks do time — SPIN Selling, BANT, roteiros de qualificação e fechamento. Padronizam o discurso e aparecem no contexto do CRM enquanto o vendedor trabalha o negócio, então a boa prática chega na hora de usar.",
  bullets:[
    "Escreva um roteiro em Novo Manual ou parta de um Template pronto.",
    "Publique como Ativo; deixe em Rascunho enquanto ajusta.",
    "Use tags e categorias para o playbook certo aparecer no negócio certo.",
    "As versões guardam o histórico de mudanças do roteiro."
  ],
  spots:[
    {x:88,y:22,t:"Criar um novo manual"},
    {x:76,y:22,t:"Começar a partir de um template"},
    {x:55,y:33,t:"Filtrar por status, categoria e tags"},
    {x:29,y:56,t:"Status: ativo ou rascunho, com versão"}
  ]
},
{
  chapter:"Capítulo 5 · Conteúdo & colaboração",
  title:"Documentos",
  sub:"Todos os arquivos do workspace, reunidos",
  url:"/documents",
  img:"{{ asset('storage/tour/16-documentos.png')}}",
  desc:"Documentos reúne, em um só lugar, os arquivos anexados aos registros — propostas em PDF, contratos, materiais. Cada documento mostra a qual negócio ou contato está ligado, o tamanho e a data, e a barra no topo acompanha o armazenamento usado.",
  bullets:[
    "Encontre qualquer arquivo pela busca por nome.",
    "A coluna Vinculado a leva ao negócio ou contato de origem.",
    "Baixe ou remova um arquivo pelas ações da linha.",
    "Acompanhe o espaço usado na barra de armazenamento."
  ],
  spots:[
    {x:50,y:30,t:"Armazenamento usado do workspace"},
    {x:53,y:58,t:"A qual negócio ou contato o arquivo pertence"},
    {x:93,y:58,t:"Baixar ou excluir o documento"}
  ]
},
{
  chapter:"Capítulo 5 · Conteúdo & colaboração",
  title:"Notas",
  sub:"O que foi combinado, registrado no contexto",
  url:"/notes",
  img:"{{ asset('storage/tour/17-notas.png')}}",
  desc:"Notas é o fluxo de anotações do workspace, ligadas a negócios e organizações. Cada nota traz autor, data e o registro a que pertence, e aceita @menções para chamar um colega. É a memória das conversas — o que ficou combinado não se perde no WhatsApp.",
  bullets:[
    "Escreva a nota no próprio negócio ou contato para manter o contexto.",
    "Use @menção para envolver um colega — ele recebe em Menções.",
    "Fixe as notas importantes para elas ficarem sempre à mão.",
    "Filtre por Fixadas ou pelas que mencionam você."
  ],
  spots:[
    {x:86,y:30,t:"Filtrar por fixadas ou que mencionam você"},
    {x:30,y:42,t:"Registro a que a nota pertence"},
    {x:6, y:63,t:"@menção chama um colega para a conversa"}
  ]
},
{
  chapter:"Capítulo 5 · Conteúdo & colaboração",
  title:"Menções",
  sub:"Onde te chamaram, sem procurar",
  url:"/mentions",
  img:"{{ asset('storage/tour/18-mencoes.png')}}",
  desc:"Menções é a sua caixa pessoal: reúne todas as notas em que alguém te marcou com @. Em vez de vasculhar cada negócio, você vê num só lugar o que pediram sua atenção — e responde de onde a conversa começou.",
  bullets:[
    "Passe por aqui para não deixar nenhum pedido de colega sem resposta.",
    "Filtre por tipo e por entidade para achar uma menção específica.",
    "Clique para abrir a nota no contexto original.",
    "Combine com Notas: um marca, o outro responde no mesmo lugar."
  ],
  spots:[
    {x:7, y:29,t:"Filtrar as menções por tipo e entidade"},
    {x:50,y:50,t:"Suas menções aparecem reunidas aqui"}
  ]
},
{
  chapter:"Capítulo 5 · Conteúdo & colaboração",
  title:"E-mails",
  sub:"A conversa por e-mail dentro do CRM",
  url:"/emails",
  img:"{{ asset('storage/tour/19-emails.png')}}",
  desc:"E-mails registra as mensagens trocadas no workspace, ligadas aos negócios e contatos. Assunto, remetente, destinatário e status ficam à vista, então a troca com o cliente vive junto do histórico da venda — não perdida na caixa de entrada pessoal.",
  bullets:[
    "Busque por assunto para achar uma conversa específica.",
    "O status mostra o que foi recebido e o que foi enviado.",
    "Cada e-mail fica ligado ao negócio ou contato correspondente.",
    "Assim qualquer pessoa da conta acompanha a conversa, sem depender de encaminhamento."
  ],
  spots:[
    {x:18,y:32,t:"Buscar e-mails por assunto"},
    {x:17,y:45,t:"Remetente e destinatário da mensagem"},
    {x:15,y:52,t:"Status: recebido ou enviado"}
  ]
},

/* ---------- CAPITULO 6 — PERFORMANCE & DADOS ---------- */
{
  chapter:"Capítulo 6 · Performance & dados",
  title:"Metas",
  sub:"O alvo do time e quanto já foi batido",
  url:"/goals",
  img:"{{ asset('storage/tour/20-metas.png')}}",
  desc:"Metas acompanha os objetivos comerciais e o quanto já foi atingido. Os cartões resumem metas totais, batidas, em progresso e atrasadas; abaixo, a barra de progresso por meta e o ranking de quem mais contribuiu. É o placar do período.",
  bullets:[
    "Defina metas por equipe ou por pessoa na aba Metas.",
    "Acompanhe o percentual atingido na barra de progresso.",
    "Fique de olho no cartão Atrasadas — metas fora do ritmo.",
    "O ranking mostra quem está puxando o resultado."
  ],
  spots:[
    {x:11,y:29,t:"Dashboard de acompanhamento e cadastro de metas"},
    {x:50,y:44,t:"Metas totais, batidas, em progresso e atrasadas"},
    {x:26,y:78,t:"Progresso por meta e ranking de contribuição"}
  ]
},
{
  chapter:"Capítulo 6 · Performance & dados",
  title:"Forecast",
  sub:"Quanto deve entrar, com base no pipeline",
  url:"/forecast",
  img:"{{ asset('storage/tour/21-forecast.png')}}",
  desc:"O forecast projeta a receita a partir do pipeline, separando o que é Closed (fechado), Commit (comprometido), Best Case (melhor cenário) e Pipeline. Compara a projeção com a meta e mostra a cobertura do pipeline — o quanto de funil você tem para bater o número.",
  bullets:[
    "Ajuste o período e o pipeline nos seletores do topo.",
    "Leia Closed + Commit como a base mais segura da projeção.",
    "Best Case mostra o teto se tudo der certo.",
    "A cobertura de pipeline sinaliza risco quando o funil está curto."
  ],
  spots:[
    {x:7, y:29,t:"Período, pipeline e recorte da projeção"},
    {x:50,y:53,t:"Closed, Commit, Best Case e Pipeline"},
    {x:57,y:93,t:"Cobertura de pipeline — alerta de risco"}
  ]
},
{
  chapter:"Capítulo 6 · Performance & dados",
  title:"Pipeline Analytics",
  sub:"O funil dissecado por todos os ângulos",
  url:"/pipeline-analytics",
  img:"{{ asset('storage/tour/22-pipeline-analytics.png')}}",
  desc:"Pipeline Analytics é a análise profunda do funil. Reúne valor do pipeline, ticket médio, tempo médio até fechar, conversão média e negócios parados ou perdidos, com filtros por período, etapa, responsável, produto e mais. Os gráficos mostram distribuição e conversão etapa a etapa — onde a venda emperra.",
  bullets:[
    "Combine os filtros do topo para isolar o que quer analisar.",
    "Ticket médio e tempo no funil dizem a saúde do processo.",
    "Negócios parados apontam onde o time precisa agir.",
    "A conversão por etapa revela o gargalo do funil."
  ],
  spots:[
    {x:50,y:34,t:"Sete filtros combináveis para recortar o funil"},
    {x:50,y:50,t:"KPIs: ticket médio, tempo no funil, conversão, perdas"},
    {x:74,y:74,t:"Conversão etapa a etapa — o gargalo aparece aqui"}
  ]
},
{
  chapter:"Capítulo 6 · Performance & dados",
  title:"Relatórios",
  sub:"Respostas prontas — ou do seu jeito",
  url:"/reports",
  img:"{{ asset('storage/tour/23-relatorios.png')}}",
  desc:"Relatórios traz uma biblioteca de análises prontas — vendas por vendedor, por produto, por canal, conversão por etapa, ticket médio, tempo de fechamento. Escolha um modelo pronto para uma resposta imediata, ou monte o seu na aba de personalizados.",
  bullets:[
    "Comece pelos Relatórios Prontos para respostas rápidas.",
    "Vendas por Vendedor e por Canal mostram o que traz resultado.",
    "Tempo de Fechamento indica quão ágil é o ciclo de venda.",
    "Monte análises sob medida em Relatórios Personalizados."
  ],
  spots:[
    {x:13,y:30,t:"Relatórios prontos e personalizados"},
    {x:62,y:43,t:"Vendas por canal, produto e vendedor"},
    {x:13,y:49,t:"Cada card é um relatório pronto para abrir"}
  ]
},

/* ---------- CAPITULO 7 — ADMINISTRACAO ---------- */
{
  chapter:"Capítulo 7 · Administração",
  title:"Central de Módulos",
  sub:"Ligue só o que o seu time usa",
  url:"/modules",
  img:"{{ asset('storage/tour/24-modulos.png')}}",
  desc:"A central de módulos é o marketplace interno do Digify. Cada funcionalidade — pipeline, dashboard, feed, automações, integrações — é um módulo que pode ser ligado ou desligado. Você monta o CRM do tamanho da operação, sem telas que ninguém abre.",
  bullets:[
    "Navegue por categoria: CRM, Vendas, Automação, Comunicação, Analytics, Integrações.",
    "Veja o que está incluído no plano e o que está ativo.",
    "Abra Detalhes para entender o que cada módulo entrega.",
    "Ligue apenas os módulos que fazem sentido para o time."
  ],
  spots:[
    {x:34,y:38,t:"Módulos por categoria"},
    {x:34,y:48,t:"Ativos, disponíveis e incluídos no plano"},
    {x:18,y:60,t:"Cada card é um módulo que você liga ou desliga"}
  ]
},
{
  chapter:"Capítulo 7 · Administração",
  title:"Configurações",
  sub:"Onde o CRM ganha a cara da operação",
  url:"/settings",
  img:"{{ asset('storage/tour/25-configuracoes.png')}}",
  desc:"Configurações é o painel de personalização do workspace. No menu lateral você ajusta a aparência (cor e layout do menu), as regras comerciais (pipelines, etapas, templates de proposta, status e origens de lead) e os dados (campos personalizados, tags e motivos de perda).",
  bullets:[
    "Em Aparência, defina a cor e o layout do menu para todo mundo.",
    "Em Pipelines, desenhe as etapas e as probabilidades do funil.",
    "Campos personalizados guardam o que é específico do seu negócio.",
    "Status e origens de lead alimentam os relatórios e a captura."
  ],
  spots:[
    {x:10,y:50,t:"Seções: aparência, comercial e dados"},
    {x:39,y:46,t:"Cor do menu para todo o workspace"},
    {x:40,y:83,t:"Layout de navegação: superior ou lateral"}
  ]
},
{
  chapter:"Capítulo 7 · Administração",
  title:"Automações",
  sub:"O CRM trabalhando enquanto você vende",
  url:"/automations",
  img:"{{ asset('storage/tour/26-automacoes.png')}}",
  desc:"Automações é o motor de regras do Digify: quando um gatilho acontece, uma ação dispara. Proposta aceita cria atividades; contato novo é distribuído para um responsável; negócio perdido muda de etapa. Você liga e desliga cada regra com um toque.",
  bullets:[
    "Monte uma regra em Nova Automação: gatilho, condição e ação.",
    "Ligue e desligue cada automação pelo interruptor de status.",
    "Use para distribuir leads, notificar o time e criar tarefas sozinho.",
    "O contador no topo mostra quantas automações você já usa."
  ],
  spots:[
    {x:88,y:21,t:"Criar uma nova automação"},
    {x:50,y:34,t:"Quantas automações estão em uso"},
    {x:36,y:55,t:"Gatilho que dispara a regra"},
    {x:77,y:55,t:"Liga e desliga a automação"}
  ]
},
{
  chapter:"Capítulo 7 · Administração",
  title:"Auditoria",
  sub:"Quem mudou o quê, e quando",
  url:"/audit",
  img:"{{ asset('storage/tour/27-auditoria.png')}}",
  desc:"Auditoria é o histórico de tudo o que muda no CRM. Cada registro mostra quem fez a alteração, em qual entidade e o que mudou — inclusive o valor antes e depois. Filtre por entidade, ação, usuário e período para investigar qualquer mudança com segurança.",
  bullets:[
    "Filtre por entidade, ação, usuário e intervalo de datas.",
    "Cada linha mostra o antes e o depois da alteração.",
    "Use para esclarecer 'quem mexeu nisso' sem achismo.",
    "O registro completo dá rastreabilidade para a operação."
  ],
  spots:[
    {x:23,y:50,t:"Filtros por entidade, ação, usuário e período"},
    {x:30,y:76,t:"Quem alterou e em qual registro"},
    {x:26,y:82,t:"O valor antes e depois da mudança"}
  ]
},
{
  chapter:"Capítulo 7 · Administração",
  title:"Minha Conta",
  sub:"Plano, cobrança e usuários",
  url:"/account",
  img:"{{ asset('storage/tour/28-conta.png')}}",
  desc:"Minha Conta concentra a assinatura do workspace: o plano atual e o valor, a forma de pagamento, os dados de nota fiscal e o número de usuários. É onde o administrador troca de plano ou adiciona lugares para novas pessoas do time.",
  bullets:[
    "Veja o plano atual e o valor da mensalidade.",
    "Use Trocar de plano para subir ou descer de faixa.",
    "Cadastre a forma de pagamento e os dados de nota fiscal.",
    "Adicione ou remova usuários conforme o time cresce."
  ],
  spots:[
    {x:9, y:38,t:"Plano atual e valor da assinatura"},
    {x:10,y:52,t:"Trocar de plano e gerenciar a assinatura"},
    {x:11,y:71,t:"Forma de pagamento e nota fiscal"}
  ]
}

];

/* =========================================================
   LOGICA DO TOUR
   ========================================================= */

var idx = 0;
var visited = {};
var showSpots = true;
var showDetail = false;

var el = function(id){ return document.getElementById(id); };

/* Placeholder mostrado ate o print real ser colocado em img/ */
function placeholder(title, path){
  var t = String(title).replace(/&/g,"&amp;").replace(/</g,"&lt;");
  var svg =
  '<svg xmlns="http://www.w3.org/2000/svg" width="1366" height="620">'+
    '<defs><linearGradient id="g" x1="0" y1="0" x2="1" y2="1">'+
      '<stop offset="0" stop-color="#27dbff"/><stop offset="1" stop-color="#27ffb7"/>'+
    '</linearGradient></defs>'+
    '<rect width="1366" height="620" fill="#f4f7fb"/>'+
    '<g fill="none" stroke="#27dbff" stroke-width="3" opacity=".7">'+
      '<path d="M40 40h46M40 40v46"/><path d="M1326 40h-46M1326 40v46"/>'+
      '<path d="M40 580h46M40 580v-46"/><path d="M1326 580h-46M1326 580v-46"/>'+
    '</g>'+
    '<rect x="623" y="250" width="120" height="120" rx="26" fill="url(#g)" opacity=".18"/>'+
    '<circle cx="683" cy="310" r="34" fill="none" stroke="url(#g)" stroke-width="4"/>'+
    '<path d="M708 335l24 24" stroke="#27dbff" stroke-width="4" stroke-linecap="round"/>'+
    '<text x="683" y="418" text-anchor="middle" font-family="Inter,system-ui,sans-serif" font-size="30" font-weight="800" fill="#041945">'+t+'</text>'+
    '<text x="683" y="452" text-anchor="middle" font-family="ui-monospace,Consolas,monospace" font-size="16" fill="#5b6a86">captura pendente &#183; salve o print em '+path+'</text>'+
  '</svg>';
  return "data:image/svg+xml;charset=utf-8," + encodeURIComponent(svg);
}

/* ---------- Logo com fallback ---------- */
function setupLogos(){
  var imgs = document.querySelectorAll(".logo-img");
  for (var i = 0; i < imgs.length; i++){
    (function(im){
      im.onerror = function(){
        if (im.getAttribute("data-alt") !== "1"){
          im.setAttribute("data-alt","1");
          im.src = "logotipo/digify.svg";           /* nome alternativo */
        } else if (im.getAttribute("data-alt") !== "2"){
          im.setAttribute("data-alt","2");
          im.src = "logotipo/digify.png";
        } else {
          im.onerror = null;
          var fb = im.parentNode.querySelector(".logo-fallback");
          im.style.display = "none";
          if (fb) fb.style.display = "inline-flex";  /* mostra o wordmark */
        }
      };
    })(imgs[i]);
  }
}

/* ---------- Sumario lateral ---------- */
function buildToc(){
  var toc = el("toc");
  toc.innerHTML = "";
  var lastChapter = null;

  STEPS.forEach(function(s, i){
    if (s.chapter !== lastChapter){
      var h = document.createElement("h4");
      h.textContent = s.chapter;
      toc.appendChild(h);
      lastChapter = s.chapter;
    }
    var b = document.createElement("button");
    b.type = "button";
    b.innerHTML = '<span class="n">' + (i+1) + '</span><span>' + s.title + '</span>';
    b.setAttribute("data-i", i);
    b.addEventListener("click", function(){ go(i); });
    toc.appendChild(b);
  });
}

function paintToc(){
  var btns = el("toc").querySelectorAll("button");
  for (var i = 0; i < btns.length; i++){
    var n = parseInt(btns[i].getAttribute("data-i"), 10);
    btns[i].classList.remove("active");
    if (visited[n]) btns[i].classList.add("done");
    if (n === idx){
      btns[i].classList.add("active");
      btns[i].scrollIntoView({ block: "nearest" });
    }
  }
}

/* ---------- Render de um passo ---------- */
function render(){
  var s = STEPS[idx];
  visited[idx] = true;

  el("chapterTag").textContent = s.chapter;
  el("stepTitle").textContent  = s.title;
  el("stepSub").textContent    = s.sub;
  el("urlBar").textContent     = BASE + s.url;
  el("counter").textContent    = (idx+1) + " / " + STEPS.length;
  el("desc").textContent       = s.desc;

  var img = el("shotImg");
  img.alt = "Tela: " + s.title;
  img.onerror = function(){
    this.onerror = null;
    this.src = placeholder(s.title, s.img);
  };
  img.src = s.img;

  var ul = el("bullets");
  ul.innerHTML = "";
  s.bullets.forEach(function(t){
    var li = document.createElement("li");
    li.textContent = t;
    ul.appendChild(li);
  });

  var hs = el("hotspots");
  hs.innerHTML = "";
  (s.spots || []).forEach(function(sp, i){
    var d = document.createElement("div");
    var cls = "spot" + (sp.y > 62 ? " flip" : "");
    if (sp.x < 16) cls += " edge-l";
    else if (sp.x > 84) cls += " edge-r";
    d.className = cls;
    d.style.left = sp.x + "%";
    d.style.top  = sp.y + "%";
    d.innerHTML = "<span>" + (i+1) + "</span>";
    var tip = document.createElement("span");
    tip.className = "tip";
    tip.textContent = sp.t;
    d.appendChild(tip);
    hs.appendChild(d);
  });
  hs.className = "hotspots" + (showSpots ? "" : " hide");

  /* estado do painel Detalhes (persiste entre telas) */
  el("detailBody").hidden = !showDetail;
  el("detailToggle").setAttribute("aria-expanded", showDetail ? "true" : "false");

  el("bar").style.width = (((idx+1) / STEPS.length) * 100) + "%";
  el("prev").disabled = (idx === 0);
  el("next").textContent = (idx === STEPS.length - 1) ? "Concluir tour" : "Próximo →";

  paintToc();
  window.scrollTo({ top: 0, behavior: "smooth" });
  if (history.replaceState) history.replaceState(null, "", "#passo-" + (idx+1));
}

function go(i){
  if (i < 0) i = 0;
  if (i > STEPS.length - 1) i = STEPS.length - 1;
  idx = i;
  render();
}

function start(){
  el("cover").classList.add("is-hidden");
  el("app").classList.remove("is-hidden");
  render();
}

function backToCover(){
  el("app").classList.add("is-hidden");
  el("cover").classList.remove("is-hidden");
  if (history.replaceState) history.replaceState(null, "", " ");
}

/* ---------- Eventos ---------- */
document.addEventListener("DOMContentLoaded", function(){
  setupLogos();
  buildToc();

  el("startBtn").addEventListener("click", start);
  el("restart").addEventListener("click", backToCover);
  el("prev").addEventListener("click", function(){ go(idx - 1); });
  el("next").addEventListener("click", function(){
    if (idx === STEPS.length - 1) { backToCover(); } else { go(idx + 1); }
  });

  el("toggleSpots").addEventListener("click", function(){
    showSpots = !showSpots;
    el("hotspots").className = "hotspots" + (showSpots ? "" : " hide");
    this.classList.toggle("off", !showSpots);
    this.setAttribute("aria-pressed", showSpots ? "true" : "false");
  });

  el("detailToggle").addEventListener("click", function(){
    showDetail = !showDetail;
    el("detailBody").hidden = !showDetail;
    this.setAttribute("aria-expanded", showDetail ? "true" : "false");
  });

  document.addEventListener("keydown", function(e){
    if (el("app").classList.contains("is-hidden")){
      if (e.key === "Enter" || e.key === " ") { start(); }
      return;
    }
    if (e.key === "ArrowRight") go(idx + 1);
    if (e.key === "ArrowLeft")  go(idx - 1);
    if (e.key === "Home")       go(0);
    if (e.key === "End")        go(STEPS.length - 1);
    if (e.key === "Escape")     backToCover();
  });

  /* deep link: index.html#passo-7 abre direto no passo 7 */
  var m = /^#passo-(\d+)$/.exec(location.hash);
  if (m){
    idx = Math.min(Math.max(parseInt(m[1], 10) - 1, 0), STEPS.length - 1);
    start();
  }
});

</script>
