@php
  $apiHubspot = new \App\Services\HubspotCampaignService(); 
  $fields = $apiHubspot->listForm($formHubSpot->id ?? null);
@endphp

@if(!empty($formHubSpot) && !empty($fields['saidaHtml']))
    <form class="form-conversao-digify" id="custom-form-{{ $formHubSpot->form_name }}" method="POST" data-action="{{ route('form.custom.store') }}">
        @csrf
        <input type="hidden" name="form_type" value="{{ $formHubSpot->form_name }}">
        <input type="hidden" name="locale" value="{{ app()->getLocale() }}">
        <input type="hidden" name="pageUri" value="{{url()->current()}}">
        <input type="hidden" name="pageName" value="{{SEOTools::getTitle()}}">        
        
        {!! $fields['saidaHtml'] !!}

        <div class="form-group-checkbox">
            <input type="checkbox" id="termos" name="termos" value="1">
            <label for="termos">
                {!! __('forms.communication_consent_notice') !!}
                @php
                    //Política de Privacidade
                    $pagePolitica = getPageById(2);
                    //Termos de Uso
                    $pageTermos = getPageById(3);
                @endphp 
                @if(!empty($pagePolitica))
                    <a href="{{route('site.show', $pagePolitica->slug)}}" target="_blank">{{$pagePolitica->titulo}}</a> e 
                @endif
                @if(!empty($pageTermos))
                    <a href="{{route('site.show', $pageTermos->slug)}}" target="_blank">{{$pageTermos->titulo}}</a>. 
                @endif
            </label>
        </div>
        
        @if($formHubSpot->form_captcha)
            <div
                class="cf-turnstile"
                data-sitekey="{{ config('services.turnstile.site_key') }}">
            </div>
        @endif

        <div id="error-message-{{ $formHubSpot->form_name }}" class="message-error"></div>
        <button class="btn btn-thirdy submit" data-sending="Enviando..." data-original-text="{{ $formHubSpot->form_title_button }}">{{ $formHubSpot->form_title_button }}
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="arrow-right" aria-hidden="true" class="lucide lucide-arrow-right w-5 h-5 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
            <div class="shine"></div>
        </button>
    </form>
@endif