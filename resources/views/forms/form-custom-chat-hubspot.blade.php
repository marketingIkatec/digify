@php
  $apiHubspot = new \App\Services\HubspotCampaignService(); 
  $fields = $apiHubspot->listForm($formHubSpot->id ?? null);

  $ignoredFields = [
        'utm_campaign',
        'utm_source',
        'utm_medium',
        'utm_content',
        'utm_term',
        'utm_id',
        'gclid',
        'fbclid',
        'msclkid',
        'outros_segmento',
        'lastname'
    ];

    $chatFields = collect($formHubSpot['form_fields'])
        ->reject(fn($field) => in_array($field['name'], $ignoredFields))
        ->map(function ($field) {
            $translationKey = 'forms.hubspot_fields.' . $field['name'];
            $translatedLabel = __($translationKey);

            if ($translatedLabel !== $translationKey) {
                $field['label'] = $translatedLabel;
            }

            return $field;
        })
        ->values();

    $termos = __('forms.communication_consent_notice');
    //Política de Privacidade
    $pagePolitica = getPageById(__('pages.politica_de_privacidade'));
    //Termos de Uso
    $pageTermos = getPageById(__('pages.termos_de_uso'));
        
    if(!empty($pagePolitica)){
        $termos .= '<a href="'.route('site.show', $pagePolitica->slug).'" target="_blank">'.$pagePolitica->titulo.'</a> e ';
    } 
    if(!empty($pageTermos)){
        $termos .= '<a href="'.route('site.show', $pageTermos->slug).'" target="_blank">'.$pageTermos->titulo.'</a>.'; 
    } 

@endphp

<style>
    
</style>

@if(!empty($formHubSpot) && !empty($fields['saidaHtml']))
    <div class="chat">
        <div id="messages" class="chat-messages"></div>
        <div class="chat-footer">
            <input
                type="text"
                id="answer"
                placeholder="{{__('forms.enter_your_answer')}}"
                autocomplete="off">

            <select id="answerSelect" style="display:none"></select>

            <button id="send">{{__('forms.answer_btn')}} 
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="arrow-right" aria-hidden="true" class="lucide lucide-arrow-right w-5 h-5 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
            </button>
        </div>
    </div>
@endif


<script>
    const steps = @json($chatFields);

    function getQuestion(step){
        return step.label;
    }
</script>

<script>

    let currentStep = 0;
    let formData = {};

    const messages = document.getElementById('messages');
    const input = document.getElementById('answer');
    const button = document.getElementById('send');
    const defaultAnswerPlaceholder = input.getAttribute('placeholder');

    let whatsappInstance = null;
    let whatsappHandlers = null;
    let pendingOtherSegmentStep = null;

    const segmentFieldName = 'qual_segmento_representa_melhor_seu_negocio';
    const otherSegmentFieldKey = '0-2/outros_segmento';

    /*function addMessage(text, type, extraClass = ''){
        const div = document.createElement('div');

        div.className = `message ${type} ${extraClass}`;
        div.innerHTML = text;
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
    }*/

    function addMessage(
            text,
            type,
            extraClass = '',
            label = '',
            editable = false,
            stepIndex = null,
            fieldKey = null
        ){

            const div = document.createElement('div');
            const messageTime = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

            div.className = `message ${type} ${extraClass}`;

            if(type === 'user' && label){

                div.dataset.step = stepIndex;
                div.dataset.field = fieldKey;

                div.innerHTML = `
                    <div class="message-label">
                        ${label}
                    </div>

                    <div class="message-content">

                        <div class="message-value">
                            <span>${text}</span>
                        </div>

                        ${
                            editable
                            ? `
                                <div class="message-overlay">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24">

                                        <path d="M12 20h9"/>
                                        <path d="M16.5 3.5a2.1 2.1 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/>

                                    </svg>

                                    <span>{{__('forms.edit')}}</span>

                                </div>
                            `
                            : ''
                        }

                    </div>

                    <div class="message-meta message-meta-user" aria-label="Mensagem lida">
                        <span>${messageTime}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M18 7 9.5 15.5 6 12"/>
                            <path d="M22 7 13.5 15.5 13 15"/>
                        </svg>
                    </div>
                `;

            }else{

                div.innerHTML = `
                    <div>${text}</div>
                    <div class="message-meta message-meta-bot">
                        <span>${messageTime}</span>
                    </div>
                `;

            }

            messages.appendChild(div);
            messages.scrollTop = messages.scrollHeight;
        }

    function showTyping(){
        const div = document.createElement('div');

        div.className = 'message bot';
        div.id = 'typing';

        div.innerHTML = `
            <div class="typing">
                <span></span>
                <span></span>
                <span></span>
            </div>
        `;

        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
    }

    function hideTyping(){
        const typing = document.getElementById('typing');

        if(typing){
            typing.remove();
        }
    }

    function askQuestion(){
        if(currentStep === steps.length){
            renderTerms();
            return;
        }

        if(currentStep > steps.length){
            finishForm();
            return;
        }

        const step = steps[currentStep];

        
        resetInput();
        if (step.name === 'mobilephone') {
            initWhatsappInput();
        }

        fillInputFromSavedLead(step);

        input.focus();

        showTyping();

        setTimeout(() => {
            hideTyping();
            addMessage(
                step.label,
                'bot'
            );

            // SE FOR SELECT, RENDERIZA BOTÕES
            if(step.fieldType === 'select'){
                renderOptions(step);
            }

            if(step.name === 'website'){
                renderNoWebsiteOption(step);
            }

            input.focus();

        },500);
    }

    function configureField(step){
        const input = document.getElementById('answer');
        const select = document.getElementById('answerSelect');

        input.style.display = 'block';
        select.style.display = 'none';

        if(step.fieldType === 'select'){
            input.style.display = 'none';
            select.style.display = 'block';

            select.innerHTML = '';

            step.options.forEach(option => {

                const item = document.createElement('option');

                item.value = option.value;
                item.textContent = option.label;

                select.appendChild(item);

            });
        }
    }

    function getCurrentValue(){
        const step = steps[currentStep];

        if(step.fieldType === 'select')
        {
            return document
                .getElementById('answerSelect')
                .value;
        }

        if(step.name === 'mobilephone'){
            normalizeWhatsappValue();
        }

        return document
            .getElementById('answer')
            .value
            .trim();
    }

    function fillInputFromSavedLead(step){
        if(step.fieldType === 'select'){
            return;
        }

        const savedValue = getSavedLeadValue(step);

        if(!savedValue){
            return;
        }

        input.value = savedValue;

        if(step.name === 'mobilephone' && whatsappInstance){
            whatsappInstance.setNumber(savedValue);
            normalizeWhatsappValue();
        }
    }

    function getSavedLeadValue(step){
        const fieldKey = normalizeLeadFieldKey(step.name);
        const candidateKeys = [fieldKey];

        const fieldMap = {
            firstname: ['LeadNome', 'LeadFirstname'],
            mobilephone: ['LeadWhatsapp', 'LeadMobilephone'],
            website: ['LeadWebsite', 'LeadUrl']
        };

        if(fieldMap[step.name]){
            candidateKeys.unshift(...fieldMap[step.name]);
        }

        for(const key of candidateKeys){
            const value = localStorage.getItem(key) || getCookie(key);

            if(value){
                return value;
            }
        }

        return '';
    }

    function normalizeLeadFieldKey(name){
        return window.DigifyForms?.normalizeLeadField?.(name) || 'Lead' + name
            .replace(/^0-\d+\//, '')
            .replace(/[^a-zA-Z0-9_]/g, '_')
            .split('_')
            .map(part => part.charAt(0).toUpperCase() + part.slice(1))
            .join('');
    }

    function getCookie(name) {
        if(window.DigifyForms?.getCookie){
            return window.DigifyForms.getCookie(name);
        }

        const cookies = document.cookie.split(';');

        for (let cookie of cookies) {
            cookie = cookie.trim();

            if (cookie.startsWith(name + '=')) {
                return decodeURIComponent(cookie.substring(name.length + 1));
            }
        }

        return null;
    }

    function renderOptions(step){
        const wrapper = document.createElement('div');

        wrapper.className = 'options';

        step.options.forEach(option => {

            const btn = document.createElement('button');

            btn.className = 'option-btn';
            btn.textContent = option.label;

            btn.onclick = () => {
                const fieldKey = `${step.objectTypeId}/${step.name}`;

                if(step.name === segmentFieldName){
                    delete formData[otherSegmentFieldKey];
                }

                addMessage(
                    option.label,
                    'user',
                    '',
                    step.label,
                    true,
                    currentStep,
                    fieldKey
                );

                formData[fieldKey] = option.value;

                wrapper.remove();

                if(step.name === segmentFieldName && option.value === 'Outro segmento'){
                    pendingOtherSegmentStep = currentStep;
                    input.value = '';
                    input.focus();
                    addMessage("{{__('forms.enter_segmento')}}", 'bot');
                    return;
                }

                currentStep++;

                askQuestion();
            };

            wrapper.appendChild(btn);

        });

        messages.appendChild(wrapper);
        messages.scrollTop = messages.scrollHeight;
    }

    function renderNoWebsiteOption(step){
        const wrapper = document.createElement('div');

        wrapper.className = 'options';

        const btn = document.createElement('button');

        btn.className = 'option-btn';
        btn.textContent = "{{__('forms.no_website')}}";

        btn.onclick = () => {
            const fieldKey = `${step.objectTypeId}/${step.name}`;

            formData[fieldKey] = '';
            formData['nao_tem_site'] = '1';

            addMessage(
                "{{__('forms.no_website')}}",
                'user',
                '',
                step.label,
                true,
                currentStep,
                fieldKey
            );

            input.value = '';
            wrapper.remove();
            currentStep++;
            askQuestion();
        };

        wrapper.appendChild(btn);
        messages.appendChild(wrapper);
        messages.scrollTop = messages.scrollHeight;
    }

    async function submitAnswer(){
        if(pendingOtherSegmentStep !== null){
            const value = input.value.trim();

            if(!value){
                return;
            }

            formData[otherSegmentFieldKey] = value;

            addMessage(
                value,
                'user',
                '',
                "{{__('forms.enter_segmento')}}",
                true,
                pendingOtherSegmentStep,
                otherSegmentFieldKey
            );

            input.value = '';
            currentStep = pendingOtherSegmentStep + 1;
            pendingOtherSegmentStep = null;
            askQuestion();
            return;
        }

        const value = getCurrentValue();

        if(!value){
            return;
        }

        const step = steps[currentStep];

        if(step.fieldType === 'select'){
            return;
        }

        const result = await validateStep(step.objectTypeId + '/' +step.name, value);

        if(!result.success){
            input.classList.add('input-error');
            addMessage(
                result.message,
                'bot',
                'error'
            );

            setTimeout(() => {
                addMessage(
                    step.label,
                    'bot'
                );
            }, 700);
            return;
        }

        input.classList.remove('input-error');

        /*if(!validateField(step, value)){
            addMessage('Campo inválido','bot');
            return;
        }*/
        
        const fieldKey = `${step.objectTypeId}/${step.name}`;

        if(step.name === 'website'){
            delete formData['nao_tem_site'];
        }

        addMessage(
            value,
            'user',
            '',
            step.label,
            true,
            currentStep,
            fieldKey
        );

        formData[fieldKey] = value;
        document.querySelectorAll('#messages > .options').forEach(option => option.remove());
        input.value = '';
        currentStep++;
        askQuestion();
    }

   messages.addEventListener('click', (e) => {

    const message = e.target.closest('.message.user');

    if(!message){
        return;
    }

    const value = message.querySelector('.message-value span').innerText;

    currentStep = Number(message.dataset.step);

    /*
     * Remove mensagens posteriores
     */

    let remove = false;

    [...messages.children].forEach(item => {

        if(item === message){
            remove = true;
        }

        if(remove){
            item.remove();
        }

    });

    /*
     * Remove campos posteriores do formData
     */

    Object.keys(formData).forEach(key => {

        const step = steps.findIndex(s => {

            return `${s.objectTypeId}/${s.name}` === key;

        });

        if(step >= currentStep){

            delete formData[key];

        }

    });

    const websiteStep = steps.findIndex(s => s.name === 'website');

    if(websiteStep >= currentStep){
        delete formData['nao_tem_site'];
    }

    const segmentStep = steps.findIndex(s => s.name === segmentFieldName);

    if(segmentStep >= currentStep){
        delete formData[otherSegmentFieldKey];
    }

    prepareInputForStep(steps[currentStep], value);
    input.focus();

});

    function prepareInputForStep(step, value = ''){
        resetInput();
        pendingOtherSegmentStep = null;

        document.querySelectorAll('#messages > .options').forEach(option => option.remove());

        if(step.fieldType === 'select'){
            input.value = '';
            renderOptions(step);
            return;
        }

        if(step.name === 'mobilephone'){
            initWhatsappInput();

            input.value = value;

            if(whatsappInstance && value.startsWith('+')){
                whatsappInstance.setNumber(value);
            }

            normalizeWhatsappValue();
            return;
        }

        input.value = value;
    }

    async function finishForm(){
        console.log('FINALIZANDO');
        appendTrackingData();

        addBotMessage("{{__('forms.sending_your_data')}}");

        const formDataSubmit = new FormData();

        formDataSubmit.append(
            '_token',
            document.querySelector(
                'meta[name="csrf-token"]'
            ).content
        );

        formDataSubmit.append(
            'form_type',
            "{{ $formHubSpot->form_name }}"
        );

        formDataSubmit.append(
            'locale',
            '{{ app()->getLocale() }}'
        );

        formDataSubmit.append(
            'pageUri',
            '{{url()->current()}}'
        );

        formDataSubmit.append(
            'pageName',
            '{{SEOTools::getTitle()}}'
        );

        Object.entries(formData).forEach(([key, value]) => {
            formDataSubmit.append(key, value);
        });

        try {
            const response = await fetch(
                "{{ route('form.custom.store') }}",
                {
                    method:'POST',
                    credentials:'include',
                    headers:{
                        'Accept':'application/json',
                        'X-CSRF-TOKEN':
                            document.querySelector(
                                'meta[name="csrf-token"]'
                            ).content
                    },
                    body: formDataSubmit
                }
            );

            const data = await response.json();

            if(data.success){
                window.DigifyForms?.saveCookie?.(formDataSubmit);

                addBotMessage("{{__('forms.data_has_been_sen')}}");

                clearChatForm();

                if(data.redirectUri){
                    closeChatModal();
                    window.open(data.redirectUri, '_blank');
                }
            }
            else{
                addBotMessage(data.message || "{{__('forms.submission_could_not_be_completed')}}");
            }

        }
        catch(error){
            console.error(error);
            addBotMessage("{{__('forms.failed_to_send')}}");
        }
    }

    function clearChatForm(){
        formData = {};
        pendingOtherSegmentStep = null;
        input.value = '';
        input.classList.remove('input-error', 'is-invalid');
        document.querySelectorAll('#messages > .options').forEach(option => option.remove());
    }

    function closeChatModal(){
        const modal = document.getElementById('whatsappCommercialModal');

        if(modal){
            modal.classList.remove('active');
        }
    }

    button.addEventListener('click',submitAnswer);

    input.addEventListener('keydown',function(e){
        if(e.key === 'Enter'){
            submitAnswer();
        }
    });

    askQuestion();

    function addBotMessage(text){
        addMessage(text,'bot');
    }
    function renderTerms(){
        showTyping();

        setTimeout(() => {
            hideTyping();

            addMessage('<?=$termos;?>', 'bot');

            const wrapper = document.createElement('div');

            wrapper.className = 'options';
            wrapper.id = 'terms-options';

            const btn = document.createElement('button');

            btn.className = 'option-btn';
            btn.innerText = "{{__('forms.agree_continue')}}";

            btn.onclick = () => {
                formData['termos'] = '1';

                addMessage(
                    "{{__('forms.agree_terms')}}",
                    'user'
                );
                wrapper.remove();
                currentStep++;
                finishForm();
            };

            wrapper.appendChild(btn);

            messages.appendChild(wrapper);

            messages.scrollTop = messages.scrollHeight;

        }, 800);
    }

    async function validateStep(field, value){
        const response = await fetch('/validate-chat-step', {
            method: 'POST',
            headers: {
                'Content-Type':'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .content
            },
            body: JSON.stringify({
                field,
                value,
                locale: '{{ app()->getLocale() }}',
                form_type: '{{ $formHubSpot->form_name }}',
            })
        });

        return await response.json();
    }

    function appendTrackingData(){
        formData['0-1/utm_source']   = localStorage.getItem('utm_source') || '';
        formData['0-1/utm_medium']   = localStorage.getItem('utm_medium') || '';
        formData['0-1/utm_campaign'] = localStorage.getItem('utm_campaign') || '';
        formData['0-1/utm_content']  = localStorage.getItem('utm_content') || '';
        formData['0-1/utm_term']     = localStorage.getItem('utm_term') || '';
        formData['0-1/utm_id']       = localStorage.getItem('utm_id') || '';
        formData['0-1/gclid']        = localStorage.getItem('gclid') || '';
    }

    

function initWhatsappInput() {

    input.classList.add('whatsapp');

    removeWhatsappHandlers();

    if (whatsappInstance) {
        whatsappInstance.destroy();
    }

    whatsappInstance = window.intlTelInput(input, {
        initialCountry: definirDDIPorPaisChat(),
        autoPlaceholder: "aggressive",
        separateDialCode: true,
        preferredCountries: [
            "br",
            "pt",
            "us",
            "ar",
            "es",
            "co",
            "mx",
            "ve"
        ],
        customPlaceholder: function(selectedCountryPlaceholder) {
            return selectedCountryPlaceholder;
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });

    const iti = whatsappInstance;
    

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

   

        const countryChangeHandler = function() {
            input.value = '';
        };

        input.addEventListener("countrychange", countryChangeHandler);

         /**
         * Procura o select de país dentro do mesmo container do input.
         * Adicione a classe "pais-mkt-espanhol" ao seu <select>.
         */
        const selectPaises = document.querySelectorAll(".pais-mkt-espanhol");
        const selectHandlers = [];

        selectPaises.forEach((selectPais) => {        
            const selectChangeHandler = function () {
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
            };

            selectPais.addEventListener("change", selectChangeHandler);
            selectHandlers.push({
                select: selectPais,
                handler: selectChangeHandler
            });
        });


        function whatsappMask(e){
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
        }

        input.addEventListener("input", whatsappMask);

        // Ao sair do campo (blur)
        const blurHandler = function() {
            if (!normalizeWhatsappValue()) {
                input.classList.add("is-invalid");
            } else {
                input.classList.remove("is-invalid");
            }
        };

        input.addEventListener("blur", blurHandler);

        whatsappHandlers = {
            countryChange: countryChangeHandler,
            mask: whatsappMask,
            blur: blurHandler,
            selects: selectHandlers
        };



}

function normalizeWhatsappValue() {
    if (!whatsappInstance || !input.value.trim()) {
        return true;
    }

    const countryData = whatsappInstance.getSelectedCountryData();
    const digits = input.value.replace(/\D/g, '');
    const dialCode = countryData.dialCode || '';
    const number = whatsappInstance.getNumber();

    if (countryData.iso2 === 'br') {
        input.value = formatBrazilWhatsapp(digits);
        return whatsappInstance.isValidNumber();
    }

    input.value = number || `+${dialCode}${digits}`;

    return whatsappInstance.isValidNumber();
}

function formatBrazilWhatsapp(value) {
    let v = value.replace(/^55/, '');

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

    return `+55 ${v}`;
}

function removeWhatsappHandlers() {
    if (!whatsappHandlers) {
        return;
    }

    input.removeEventListener("countrychange", whatsappHandlers.countryChange);
    input.removeEventListener("input", whatsappHandlers.mask);
    input.removeEventListener("blur", whatsappHandlers.blur);

    whatsappHandlers.selects.forEach(({ select, handler }) => {
        select.removeEventListener("change", handler);
    });

    whatsappHandlers = null;
}

function resetInput() {

    input.classList.remove('whatsapp');
    input.classList.remove('is-invalid');

    removeWhatsappHandlers();

    if (whatsappInstance) {
        whatsappInstance.destroy();
        whatsappInstance = null;
    }

    const iti = input.closest('.iti');

    if (iti) {

        // volta o input para o pai original
        iti.parentNode.insertBefore(input, iti);

        // remove o wrapper criado pelo plugin
        iti.remove();
    }

    // Remove estilos adicionados pelo plugin
    input.style.paddingLeft = '';
    input.style.paddingRight = '';
    input.style.width = '';
    input.setAttribute('placeholder', defaultAnswerPlaceholder);

    input.value = '';

}


function definirDDIPorPaisChat() {
        if(window.definirDDIPorPais){
            return window.definirDDIPorPais();
        }

        const appLocale = '{{ app()->getLocale() }}';
        const locale = navigator.language || navigator.userLanguage || "en-US";

        let codigoPais = "br"; // fallback padrão

        // Obtém a rota atual
        const rota = window.location.pathname.toLowerCase();
            
        // Define o país com base na rota
        if (appLocale === "es" || rota.startsWith("/es")) {
            codigoPais = "co"; // Espanhol -> Colômbia (+57)
        }else if(appLocale === "en" || rota.startsWith("/en")){
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
            if (appLocale === "es" || rota.startsWith("/es")) {
                codigoPais = "co"; // Espanhol -> Colômbia (+57)
            }else if(appLocale === "en" || rota.startsWith("/en")){
                codigoPais = "us"; // Estados Unidos (+1)
            }
        }

        // Define o país no intl-tel-input
        return codigoPais;
    }
</script>
