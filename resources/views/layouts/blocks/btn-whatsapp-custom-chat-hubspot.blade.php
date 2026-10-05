@php
    $cssSection = 'btn-whatsapp-custom';

    $formHubSpot = getFormHubSpotById(__('forms.form-whatsapp-comercial'));
    View::share('isModalWhatsapp', true);
@endphp

@if (!empty($formHubSpot))
    <div class="whatsapp-floating">
        <div class="whatsapp-btn whatsapp-commercial href-whatsapp-commercial" aria-label="WhatsApp Comercial">
            <span class="whatsapp-label">Comercial</span>
            <div class="whatsapp-icon">
                <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/whatsapp.svg" alt="WhatsApp">
            </div>
        </div>
    </div>

    <div id="whatsappCommercialModal" class="whatsapp-chat-popup">
        <div class="modal-box modal-whatsapp-commercial {{ $cssSection }}">
            <section id="section-form-whatsapp-commercial">
                <div id="whatsapp-commercial" class="container-whatsapp-commercial">
                    <div class="modal-header">
                        <div class="modal-header-content">
                            <div class="seller-card">
                                <div class="seller-avatar-wrap">
                                    <span class="seller-chat-icon" aria-hidden="true">D</span>
                                    <img class="seller-avatar" src="{{ asset('storage/site/danieli-silva.png') }}"
                                        alt="Danieli Silva">
                                    <span class="seller-status" aria-label="Online agora"></span>
                                </div>
                                <div>
                                    <strong>Danieli Silva</strong>
                                    <span>{{ __('forms.commercial_team') }}</span>
                                </div>
                            </div>
                        </div>
                        <button class="modal-close" aria-label="Fechar popup">&times;</button>
                    </div>

                    <div class="modal-body">
                        @include('forms.form-custom-chat-hubspot', ['formHubSpot' => $formHubSpot])
                    </div>
                </div>
            </section>
        </div>
    </div>
@endif
