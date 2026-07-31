@php
    $formHubSpot = getPageSettings($item ?? null, 'formHubSpot');
    if($formHubSpot == ""){
       $formHubSpot = getPageSettings($block ?? null, 'formHubSpot'); 
    }
@endphp    



<section class="section form-section" aria-labelledby="form-title" id="formulario-de-contato">
    <div class="wrap" id="falar-com-especialista">
        <div class="form-grid">     

            {!! renderBlock($block, 'conteudo') !!}

            <div class="form-card reveal-right">
                @include('forms.form-custom-hubspot',['formHubSpot' => $formHubSpot]) 
            
            
                <div id="form-success" class="form-success" role="status" aria-live="polite">
                    <div class="s-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6 9 17l-5-5"/>
                        </svg>
                    </div>
                    <strong>Mensagem enviada!</strong>
                    <span>Nossa equipe entrará em contato em breve.</span>
                </div>
            </div>
        </div>
    </div>    
</section>