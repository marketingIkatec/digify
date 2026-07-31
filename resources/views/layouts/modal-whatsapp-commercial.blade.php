@php
    $formHubSpot = getFormHubSpotById(__('forms.form-whatsapp-comercial'));
@endphp

<!-- Modal WhatsApp -->
<div id="whatsappCommercialModal" class="modal-overlay">
  <div class="modal-box modal-whatsapp-commercial">

    <section id="section-form-whatsapp-commercial">
      <div id="whatsapp-commercial" class="container-whatsapp-commercial">
        
        <div class="modal-header">
          <div>
            <h1>{{ __('forms.commercial_team') }}</h1>
            online
          </div>
          <button class="modal-close">&times;</button>
        </div>
        
        <div class="modal-body">

          <div class="digify-contact-info">
            {!! ($formHubSpot->form_corporate_email) ? __('forms.commercial_intro_corporate') : __('forms.commercial_intro') !!}
          </div>
          @include('forms.form-custom-hubspot',['formHubSpot' => $formHubSpot])
        </div>
      </div>
    </section>    
  
  </div>
</div>

