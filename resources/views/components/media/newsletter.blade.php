{{--
<div class="namidia-newsletter">
    <div class="namidia-newsletter-grid">
        <!-- Ícone e Chamada -->
        <div class="namidia-newsletter-info">
            <div class="namidia-newsletter-icon">
                <svg class="namidia-icon-md" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div class="namidia-newsletter-text">
                <h4 class="namidia-newsletter-title">Receba nossas novidades</h4>
                <p class="namidia-newsletter-description">
                    Cadastre-se para acompanhar nossas matérias, artigos, tendências de mercado e atualizações das nossas marcas.
                </p>
            </div>
        </div>

        <!-- Formulário de Captura -->
        <div class="namidia-newsletter-form-wrap">
            @if(session('newsletter_success'))
                <div class="namidia-newsletter-success">
                    {{ session('newsletter_success') }}
                </div>
            @else
                <form action="{{ route('na-midia.newsletter.store') }}" method="POST" class="namidia-newsletter-form">
                    @csrf
                    <!-- Nome -->
                    <div class="namidia-newsletter-field">
                        <input type="text" 
                               name="name" 
                               required 
                               placeholder="Seu nome" 
                               class="namidia-newsletter-input">
                        @error('name')
                            <span class="namidia-newsletter-error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Email -->
                    <div class="namidia-newsletter-field">
                        <input type="email" 
                               name="email" 
                               required 
                               placeholder="Seu melhor e-mail" 
                               class="namidia-newsletter-input">
                        @error('email')
                            <span class="namidia-newsletter-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Botão -->
                    <button type="submit" 
                            class="namidia-newsletter-button">
                        Quero receber
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
--}}