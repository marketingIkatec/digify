document.addEventListener("DOMContentLoaded", () => {
  setupTabs(".js-feature-tab", ".features__panel");
  setupHeaderShrink();
  setupSiteNavigation();
  setupCarousel();
  setupSmoothScrolling();
  setupSectionSpy();

  function setupSectionSpy() {
    var sections = [].slice.call(document.querySelectorAll(".privacy-section[id]"));
    var links = [].slice.call(document.querySelectorAll('.privacy-sidebar a[href^="#"]'));
    if (!sections.length || !links.length || !window.IntersectionObserver) return;

    var linksById = links.reduce(function (acc, link) {
      var id = link.getAttribute("href").slice(1);
      acc[id] = link;
      return acc;
    }, {});

    function setActive(id) {
      links.forEach(function (link) {
        link.classList.toggle("is-active", link === linksById[id]);
      });
    }

    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            setActive(entry.target.id);
          }
        });
      },
      {
        rootMargin: "-28% 0px -62% 0px",
        threshold: 0,
      },
    );

    sections.forEach(function (section) {
      observer.observe(section);
    });
  }

  function setupSmoothScrolling() {
    document.querySelectorAll('a[href*="#"]').forEach(function (link) {
      link.addEventListener("click", function (event) {
        var href = link.getAttribute("href");
        if (!href || href === "#") return;

        var url;
        try {
          url = new URL(href, window.location.href);
        } catch (error) {
          return;
        }

        if (!url.hash || url.origin !== window.location.origin) return;

        var currentPath = normalizePath(window.location.pathname);
        var targetPath = normalizePath(url.pathname);
        if (currentPath !== targetPath) return;

        var target = document.querySelector(url.hash);
        if (!target) return;

        event.preventDefault();

        var header = document.querySelector(".site-header");
        var offset = header ? header.offsetHeight + 18 : 0;
        var top = target.getBoundingClientRect().top + window.scrollY - offset;

        window.history.pushState(null, "", url.hash);
        window.scrollTo({ top: top, behavior: "smooth" });
      });
    });

    function normalizePath(path) {
      return path.replace(/\/index\.php$/, "").replace(/\/$/, "") || "/";
    }
  }

  /* ── Abas (seção Recursos) ── */
  function setupTabs(triggerSelector, panelSelector) {
    var triggers = document.querySelectorAll(triggerSelector);
    if (!triggers.length) return;

    triggers.forEach(function (trigger) {
      trigger.addEventListener("click", function () {
        var panel = document.getElementById(
          trigger.getAttribute("data-target"),
        );
        if (!panel) return;

        document.querySelectorAll(triggerSelector).forEach(function (el) {
          el.classList.remove("is-active");
          el.setAttribute("aria-selected", "false");
        });
        document.querySelectorAll(panelSelector).forEach(function (el) {
          el.classList.remove("is-active");
        });

        trigger.classList.add("is-active");
        trigger.setAttribute("aria-selected", "true");
        panel.classList.add("is-active");
        updateFeatureHead(panel);
      });
    });

    function updateFeatureHead(panel) {
      var title = panel.querySelector(".features__panel-title");
      var desc = panel.querySelector(".features__desc");
      var activeTitle = document.querySelector(".js-feature-title");
      var activeDesc = document.querySelector(".js-feature-desc");

      if (title && activeTitle) activeTitle.textContent = title.textContent;
      if (desc && activeDesc) activeDesc.textContent = desc.textContent;
    }
  }

  /* ── Encolher o header ao rolar ── */
  function setupHeaderShrink() {
    var header = document.querySelector(".site-header");
    if (!header) return;
    var onScroll = function () {
      header.classList.toggle("is-scrolled", window.scrollY > 40);
    };
    window.addEventListener("scroll", onScroll, { passive: true });
    onScroll();
  }

  /* ── Menu principal com submenu ── */
  function setupSiteNavigation() {
    var header = document.querySelector(".site-header");
    if (!header) return;

    var menuCheck = header.querySelector(".site-header__menu-check");
    var toggle = header.querySelector(".site-header__menu-toggle");
    var nav = header.querySelector(".site-nav");
    var submenuToggles = [].slice.call(
      header.querySelectorAll(".site-nav__submenu-toggle"),
    );
    var mobileQuery = window.matchMedia("(max-width: 1060px)");

    if (!toggle || !nav) return;

    function closeSubmenus() {
      submenuToggles.forEach(function (button) {
        button.setAttribute("aria-expanded", "false");
        var item = button.closest(".site-nav__item--has-children");
        if (item) item.classList.remove("is-submenu-open");
      });
    }

    function setOpen(open) {
      header.classList.toggle("is-menu-open", open);
      if (menuCheck) menuCheck.checked = open;
      toggle.setAttribute("aria-expanded", String(open));
      if (!open) closeSubmenus();
    }

    if (menuCheck) {
      menuCheck.addEventListener("change", function () {
        setOpen(menuCheck.checked);
      });
    } else {
      toggle.addEventListener("click", function () {
        setOpen(!header.classList.contains("is-menu-open"));
      });
    }

    submenuToggles.forEach(function (button) {
      button.addEventListener("click", function () {
        var item = button.closest(".site-nav__item--has-children");
        if (!item) return;

        var open = !item.classList.contains("is-submenu-open");
        item.classList.toggle("is-submenu-open", open);
        button.setAttribute("aria-expanded", String(open));
      });
    });

    document.addEventListener("click", function (event) {
      if (!header.contains(event.target)) {
        setOpen(false);
      }
    });

    document.addEventListener("keydown", function (event) {
      if (event.key === "Escape") {
        setOpen(false);
      }
    });

    nav.addEventListener("click", function (event) {
      if (mobileQuery.matches && event.target.closest("a.site-nav__link")) {
        setOpen(false);
      }
    });

    function syncMode() {
      if (!mobileQuery.matches) setOpen(false);
    }

    if (mobileQuery.addEventListener) {
      mobileQuery.addEventListener("change", syncMode);
    } else {
      mobileQuery.addListener(syncMode);
    }

    syncMode();
  }

  /* ── Carrossel 3D (seção "do lead ao fechamento") ── */
  function setupCarousel() {
    var stage = document.querySelector(".carousel-3d");
    if (!stage) return;
    var cards = [].slice.call(document.querySelectorAll(".js-carousel-card"));
    var dots = [].slice.call(document.querySelectorAll(".js-carousel-dot"));
    var total = cards.length;
    if (!total) return;

    var POS = [
      "is-center",
      "is-right-1",
      "is-right-2",
      "is-left-1",
      "is-left-2",
      "is-hidden",
    ];
    var current = 0;
    var timer = null;
    var reduce =
      window.matchMedia &&
      window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    function posClass(i, active) {
      var diff = (i - active + total) % total;
      if (diff === 0) return "is-center";
      if (diff === 1) return "is-right-1";
      if (diff === 2) return "is-right-2";
      if (diff === total - 1) return "is-left-1";
      if (diff === total - 2) return "is-left-2";
      return "is-hidden";
    }

    function goTo(idx) {
      current = ((idx % total) + total) % total;
      cards.forEach(function (card, i) {
        POS.forEach(function (c) {
          card.classList.remove(c);
        });
        var p = posClass(i, current);
        card.classList.add(p);
        card.setAttribute("aria-hidden", p === "is-center" ? "false" : "true");
      });
      dots.forEach(function (d, i) {
        d.classList.toggle("is-active", i === current);
        d.setAttribute("aria-selected", i === current ? "true" : "false");
      });
    }

    function restartAuto() {
      if (reduce) return;
      clearInterval(timer);
      timer = setInterval(function () {
        goTo(current + 1);
      }, 5500);
    }

    var prev = document.querySelector(".js-carousel-prev");
    var next = document.querySelector(".js-carousel-next");
    if (prev)
      prev.addEventListener("click", function () {
        goTo(current - 1);
        restartAuto();
      });
    if (next)
      next.addEventListener("click", function () {
        goTo(current + 1);
        restartAuto();
      });

    dots.forEach(function (d) {
      d.addEventListener("click", function () {
        goTo(parseInt(d.getAttribute("data-dot"), 10));
        restartAuto();
      });
    });

    cards.forEach(function (card, i) {
      card.addEventListener("click", function () {
        if (i !== current) {
          goTo(i);
          restartAuto();
        }
      });
    });

    stage.addEventListener("mouseenter", function () {
      clearInterval(timer);
    });
    stage.addEventListener("mouseleave", restartAuto);

    goTo(0);
    restartAuto();
  }

  // ======= LÓGICA DO BLOCO WEBSITE ========

  function isValidURL(url) {
    const pattern = new RegExp(
      "^(https?:\\/\\/)?" +
        "([a-zA-Z0-9_-]+\\.)+[a-zA-Z]{2,}" +
        "(\\/[a-zA-Z0-9_./-]*)*$",
      "i",
    );
    return pattern.test(url);
  }

    /**
     * Detecta o país do usuário através do navegador
     * e define automaticamente o DDI correspondente.
     *
     * Exemplos:
     * - pt-BR -> br (+55)
     * - pt-PT -> pt (+351)
     * - en-US -> us (+1)
     */
    function definirDDIPorPais() {
        const locale = navigator.language || navigator.userLanguage || "en-US";

        let codigoPais = "br"; // fallback padrão

        // Obtém a rota atual
        const rota = window.location.pathname.toLowerCase();
            
        // Define o país com base na rota
        if (rota.startsWith("/es")) {
            codigoPais = "co"; // Espanhol -> Colômbia (+57)
        }else if(rota.startsWith("/en")){
            codigoPais = "us"; // Estados Unidos (+1)
        }

        // Extrai o código do país da locale (ex: "pt-BR" => "BR")
        if (locale.includes("-")) {
            //codigoPais = locale.split("-")[1].toLowerCase();
        }

        // Mapeamento dos países mais utilizados
        const paisesSuportados = [
            "br", "pt", "us", "ar", "es", "co", "mx", "ve"
        ];

        // Se não estiver na lista, verifica a rota
        if (!paisesSuportados.includes(codigoPais)) { 
            // Define o país com base na rota
            if (rota.startsWith("/es")) {
                codigoPais = "co"; // Espanhol -> Colômbia (+57)
            }else if(rota.startsWith("/en")){
                codigoPais = "us"; // Estados Unidos (+1)
            }
        }

        // Define o país no intl-tel-input
        return codigoPais;
    }

    window.definirDDIPorPais = definirDDIPorPais;

    const campos = document.querySelectorAll(".whatsaap");
    if(campos){

        // Mapa de países do select -> código ISO do intl-tel-input
        const mapaPaisesParaISO = {
            "Argentina": "ar",
            "Bolívia": "bo",
            "Chile": "cl",
            "Colômbia": "co",
            "Costa Rica": "cr",
            "Equador": "ec",
            "Espanha": "es",
            "Emirados Árabes Unidos": "ae",
            "Estados Unidos da América": "us",
            "Venezuela": "ve",
            "Índia": "in"
        };

        campos.forEach((input) => {

            input.addEventListener("countrychange", function() {
                input.value = '';
            });

            const iti = window.intlTelInput(input, {
                initialCountry: definirDDIPorPais(),
                separateDialCode: true,
                preferredCountries: ["br", "pt", "us", "ar", "es", "co", "mx", "ve"],
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
            });

            /**
             * Procura o select de país dentro do mesmo container do input.
             * Adicione a classe "pais-mkt-espanhol" ao seu <select>.
             */
            const selectPaises = document.querySelectorAll(".pais-mkt-espanhol");
            selectPaises.forEach((selectPais) => {        
                selectPais.addEventListener("change", function () {
                    const paisSelecionado = this.value;
                    const codigoISO = mapaPaisesParaISO[paisSelecionado];

                    if (codigoISO) {
                        // Atualiza o DDI
                        iti.setCountry(codigoISO);

                        // Limpa o telefone
                        input.value = "";

                        // Dispara o evento para manter o comportamento existente
                        input.dispatchEvent(new Event("countrychange"));
                    }
                });
            });


            input.addEventListener('input', function (e) {
                let v = e.target.value;

                const country = iti.getSelectedCountryData().iso2;

                // remove +55 antes de processar
                v = v.replace('+55', '').replace(/\D/g, '');

                if (country === 'br') {

                    if (v.length > 11) v = v.slice(0, 11);

                    if (v.length > 10) {
                        v = v.replace(/^(\d{2})(\d{5})(\d{4})$/, "($1) $2-$3");
                    } else if (v.length > 6) {
                        v = v.replace(/^(\d{2})(\d{4,5})(\d{0,4})$/, "($1) $2-$3");
                    } else if (v.length > 2) {
                        v = v.replace(/^(\d{2})(\d{0,5})$/, "($1) $2");
                    } else {
                        v = v.replace(/^(\d*)$/, "($1");
                    }

                    v = '+55 ' + v;
                }

                e.target.value = v;
            });

            // Ao sair do campo (blur)
            input.addEventListener("blur", function() {
                const country = iti.getSelectedCountryData().iso2;

                const numeroCompleto = iti.getNumber(); 

                if (!iti.isValidNumber()) {
                    input.classList.add("is-invalid");
                } else {
                    input.classList.remove("is-invalid");
                    if (country != 'br') {
                        input.value = numeroCompleto; // formato internacional
                    }
                }
            });

        });
    }
    /* ====== Whatsapp ====== */

    document.querySelectorAll('form[id^="custom-form-"]').forEach(form => {

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const nome = form.id.replace('custom-form-', '');
            const btn = form.querySelector('.submit');
            const errorMensagem = document.getElementById(`error-message-${nome}`);

            bloquearBotao(btn);

            const formData = new FormData(form);
            const url = form.dataset.action;
            const token = document.querySelector('meta[name="csrf-token"]').content;

            // 🔥 ESSENCIAL
            formData.append('_token', token);

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    credentials: 'include',
                    headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
                    body: formData
                });

                const data = await response.json();
                console.log(data);

                saveCookie(formData);
                limparErros(form);

                if (response.ok || data.success) {
                    if(data.success){
                        pushFormSuccessEvent(nome, formDataToObject(formData));
                        if(data.localStorage){
                            localStorage.setItem(data.localStorage, "true"); 
                        } 

                        if(data.hideDiv){
                            document.getElementById(data.hideDiv)?.classList.add('hidden');
                        }

                        if(data.showDiv){
                            document.getElementById(data.showDiv)?.classList.remove('hidden');
                        }

                        if(data.thanksPage){
                            handleSuccess(nome, form, data);
                        }
                        if(data.redirectUri){
                            window.open(data.redirectUri, '_blank');
                        }
                        form.reset();   
                        document.getElementById("whatsappCommercialModal")?.classList.remove("active");
                    }else{
                        errorMensagem.innerHTML = data.message;
                    }                    
                }
                else if (response.status === 422) {
                   /* let html = '';

                    Object.values(data.errors).forEach(messages => {
                        messages.forEach(msg => {
                            html += `<p>${msg}</p>`;
                        });
                    });

                    errorMensagem.innerHTML = html; */   


                    form.scrollIntoView({ behavior: 'smooth' });                    
                    exibirErrosValidacao(form, data.errors);
                }else if(response.status == 409){ // já existe cadastro
                    handleAlert(nome);
                }
                else {
                    errorMensagem.innerHTML = `<div class="error-message">Erro ao enviar. Tente novamente.</div>`;
                }
            } catch (err) {
                //errorMensagem.innerHTML = `<div class="error-message">Falha na conexão.</div>`;
            } finally {
                liberarBotao(btn);
            }
        });
    });


/* SALVAR TRACKING */
    const params = new URLSearchParams(window.location.search);

    const trackingParams = [
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
        'utm_id',
        'gclid',
        'fbclid',
        'wbraid',
        'gbraid'
    ];

    /* CAPTURA E SALVA */
    trackingParams.forEach(param => {
        const value = params.get(param);
        if (value) {
            // localStorage
            localStorage.setItem(param, value);
            // cookie
            document.cookie =
                `${param}=${encodeURIComponent(value)}; path=/; max-age=2592000`;

        }
    });

    /* PREENCHER FORMS */
    trackingParams.forEach(param => {
        const savedValue =
            localStorage.getItem(param) ||
            getCookie(param) ||
            '';

        const inputs = document.querySelectorAll(`
            input[id="0-1/${param}"],
            input[name="0-1/${param}"],
            input[name="${param}"]
        `);

        inputs.forEach(input => {
            input.value = savedValue;
        });

    });

  /* GET COOKIE */
  function getCookie(name) {
      const cookies = document.cookie.split(';');
      for (let cookie of cookies) {
          cookie = cookie.trim();
          if (cookie.startsWith(name + '=')) {
              return decodeURIComponent(
                  cookie.substring(name.length + 1)
              );
          }
      }
      return null;
  }

  function bloquearBotao(botao, texto = "Envío...") {
    botao.dataset.originalText = botao.textContent;
    botao.disabled = true;
    botao.textContent = texto;
    botao.classList.add("loading");
  }

  function liberarBotao(botao) {
    botao.classList.remove("loading");
    botao.disabled = false;
    botao.textContent = botao.dataset.originalText;
  }

  function limparErros(form) {
    form.querySelectorAll(".error-message, .is-invalid").forEach((el) => {
      el.classList?.remove("is-invalid");
      if (el.classList?.contains("error-message")) el.remove();
    });
  }

  function exibirErrosValidacao(form, errors) {
    Object.entries(errors).forEach(([campo, mensagens]) => {
      const input = form.querySelector(`[name="${campo}"]`);
      if (!input) return;

      input.classList.add("is-invalid");

      const div = document.createElement("div");
      div.classList.add("error-message");
      div.innerHTML = mensagens.join("<br>");
      input.insertAdjacentElement("afterend", div);

      input.addEventListener("input", () => limparErros(form), { once: true });
    });
  }

  function handleSuccess(nome, form, data) {
    // Caso seja formulário WhatsApp
    if (nome === "whatsapp") {
      window.open(data.whatsapp_url, "_blank");
      form.reset();
      document.getElementById("whatsappModal")?.classList.remove("active");
      return;
    }else{
        const formSuccess = document.getElementById(`form-success`);
        form.style.display = "none";
        formSuccess.style.display = "flex";
    }
  }

   function saveCookie(formData) {

        const ignoredFields = [
            '_token',
            'gclid',
            'fbclid',
            'wbraid',
            'gbraid',
            'termos'
        ];

        const ignoredPrefixes = [
            'utm_',
            '0-1/utm_',
            '0-2/utm_'
        ];

        for (const [name, value] of formData.entries()) {

            if (!name || !value) continue;

            /* IGNORAR TRACKING */
            const shouldIgnore =
                ignoredFields.includes(name) ||
                ignoredPrefixes.some(prefix => name.includes(prefix));

            if (shouldIgnore) continue;

            
            const fieldMap = {
                LeadFirstname: 'LeadNome',
                LeadMobilephone: 'LeadWhatsapp'
            };

            /* NORMALIZA O NOME */
            let key = normalizeLeadField(name);

            if (fieldMap[key]) {
                key = fieldMap[key];
            }

            /* SALVA LOCALSTORAGE */
            localStorage.setItem(key, value);

            /* SALVA COOKIE */
            document.cookie =
                `${key}=${encodeURIComponent(value)}; path=/; max-age=2592000`;

        }
    }

    /* NORMALIZA O NOME */
    function normalizeLeadField(name) {

        return 'Lead' +
            name
                // remove 0-1/ ou 0-2/
                .replace(/^0-\d+\//, '')

                // remove caracteres especiais
                .replace(/[^a-zA-Z0-9_]/g, '_')

                // PascalCase
                .split('_')
                .map(part =>
                    part.charAt(0).toUpperCase() + part.slice(1)
                )
                .join('');
    }

    /* GTM EVENT */
    function formDataToObject(formData) {
        const data = {};
        for (const [name, value] of formData.entries()) {
            const key = normalizeLeadField(name);
            data[key] = value;
        }
        return data;
    }

    function pushFormSuccessEvent(formName = '', leadData = {}) {

        window.dataLayer = window.dataLayer || [];

        window.dataLayer.push({

            event: 'form_digify_sucesso',
            form_name: formName,
            ...leadData,
            utm_source     : localStorage.getItem('utm_source') || '',
            utm_medium     : localStorage.getItem('utm_medium') || '',
            utm_campaign   : localStorage.getItem('utm_campaign') || '',
            utm_term       : localStorage.getItem('utm_term') || '',
            utm_content    : localStorage.getItem('utm_content') || '',

            gclid          : localStorage.getItem('gclid') || '',
            fbclid         : localStorage.getItem('fbclid') || '',

            page_location  : window.location.href,
            page_title     : document.title
        });

    }

     /* ====== Link pra subir pro topo da tela ====== */
    const backToTop = document.getElementById('backToTop');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 200) {
            backToTop.classList.add('visible');
        } else {
            backToTop.classList.remove('visible');
        }
    });

    backToTop.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    /* ====== Modal whatsappCommercialModal ====== */
    function initWhatsappModal({modalId, triggerClass}) {
        const modal = document.getElementById(modalId);
        if (!modal) return;

        const closeBtn = modal.querySelector('.modal-close');

        // Abrir modal
        document.querySelectorAll(triggerClass).forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                modal.classList.add('active');
            });
        });

        // Fechar no botão
        closeBtn?.addEventListener('click', () => {
            modal.classList.remove('active');
        });

        // Fechar clicando fora
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('active');
            }
        });
    }

        /* ===== Inicialização ===== */
    initWhatsappModal({
        modalId: 'whatsappCommercialModal',
        triggerClass: '.href-whatsapp-commercial'
    });

    /* ====== Modal whatsappSupportModal ====== */
});
