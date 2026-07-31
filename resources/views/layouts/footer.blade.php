@php
    $menus = [];
    $menuPagina = $menuPagina ?? collect();
@endphp
<footer class="site-footer">
    <div class="container">
        <div class="site-footer__inner">
            <div class="site-footer__brand">
                <a href="{{route('home')}}" aria-label="Digify — página inicial">
                    <img class="site-footer__logo" src="{{ !empty($config['logo_header']) ? asset('storage/' . $config['logo_header']) : 'images/weuny-logo.png' }}" alt="{{ $config['site_name'] ?? '' }}" width="92">
                </a>
                <p class="site-footer__tagline">CRM que organiza sua operação comercial. Simples de começar, modular para crescer.</p>
            </div>
            <ul class="site-footer__links">
                <li><a class="site-footer__link" href="{{route('home')}}#recursos">Recursos</a></li>
                <li><a class="site-footer__link" href="{{route('home')}}#modules">Funcionalidades</a></li>
                @if (!empty($menuPagina))
                    @foreach ($menuPagina as $page)
                        <a class="site-footer__link" href='{{ route('site.show', $page->slug) }}'>{{ $page->titulo }}</a>
                    @endforeach
                @endif
                <li><a class="site-footer__link" href="{{route('home')}}#integracoes">Integrações</a></li>

                @php
                    $page = getPageById(2); //Privacidade
                @endphp
                @if (!empty($page))
                    <li><a class="site-footer__link" href="{{ route('site.show', $page->slug) }}">{{$page->titulo}}</a></li>
                @endif

                @php
                    $page = getPageById(3); //Termos de Uso
                @endphp
                @if (!empty($page))
                    <li><a class="site-footer__link" href="{{ route('site.show', $page->slug) }}">{{$page->titulo}}</a></li>
                @endif
            </ul>
        </div>
        <div class="site-footer__bottom">
            <p class="site-footer__copy">© <span data-year><?=date('Y');?></span> Digify · Um produto da <a href="https://ikatec.com.br/" title="Ikatec Engenharia de Software Ltda">Ikatec Engenharia de Software Ltda</a> - CNPJ: 18.716.151/0001-06 · Todos os direitos reservados</p>
            <span class="site-footer__social-cta">Siga a Digify</span>
            <ul class="site-footer__social">
                @if($config['facebook'])
                    <li>
                        <a class="site-footer__social-link" href="{{$config['facebook']}}" target="_blank" rel="noopener noreferrer" aria-label="Digify no Facebook">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        </a>
                    </li>
                @endif
                @if($config['instagram'])
                    <li>
                        <a class="site-footer__social-link" href="https://www.instagram.com/digify.oficial/" target="_blank" rel="noopener noreferrer" aria-label="Digify no Instagram">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                        </a>
                    </li>
                @endif
                @if($config['linkedin'])
                    <li>
                        <a class="site-footer__social-link" href="https://www.linkedin.com/company/digify-oficial/?viewAsMember=true" target="_blank" rel="noopener" aria-label="LinkedIn da Digify">
                            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.14 1.45-2.14 2.95v5.66H9.34V9h3.42v1.56h.05c.48-.9 1.64-1.85 3.37-1.85 3.61 0 4.27 2.38 4.27 5.47v6.27ZM5.32 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12Zm1.78 13.02H3.54V9H7.1v11.45ZM22.22 0H1.77C.79 0 0 .77 0 1.72v20.56C0 23.23.79 24 1.77 24h20.45c.98 0 1.78-.77 1.78-1.72V1.72C24 .77 23.2 0 22.22 0Z"/></svg>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    <button id="backToTop" class="back-to-top">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M297.4 169.4C309.9 156.9 330.2 156.9 342.7 169.4L534.7 361.4C547.2 373.9 547.2 394.2 534.7 406.7C522.2 419.2 501.9 419.2 489.4 406.7L320 237.3L150.6 406.6C138.1 419.1 117.8 419.1 105.3 406.6C92.8 394.1 92.8 373.8 105.3 361.3L297.3 169.3z"/></svg>
    </button>
</footer>

<div class="whatsapp-floating">
    <div class="whatsapp-btn whatsapp-commercial href-whatsapp-commercial" aria-label="WhatsApp Comercial">
        <div class="whatsapp-icon">
            <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/whatsapp.svg" alt="WhatsApp" title="WhatsApp" aria-label="WhatsApp">
        </div>
    </div>
</div>

@include('layouts.modal-whatsapp-commercial')