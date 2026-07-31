@php
    $menuPagina = $menuPagina ?? collect();
@endphp

<header class="site-header">
    <div class="site-header__inner">
        <a class="brand" href="{{ route('home') }}" aria-label="{{ $config['site_name'] ?? '' }}">
            <img class="brand__logo" src="{{ !empty($config['logo_header']) ? asset('storage/' . $config['logo_header']) : 'images/weuny-logo.png' }}" alt="{{ $config['site_name'] ?? '' }}" width="104">
        </a>

        <nav class="site-nav" aria-label="Menu principal">
            <a class="site-nav__link" href="{{ route('home') }}#recursos">Recursos</a>
            <a class="site-nav__link" href="{{ route('home') }}#modules">Funcionalidades</a>
            <a class="site-nav__link" href="{{ route('home') }}#integracoes">Integrações</a>
            @if (!empty($menuPagina))
                @foreach ($menuPagina as $page)
                    <a class="site-nav__link" href='{{ route('site.show', $page->slug) }}'>{{ $page->titulo }}</a>
                @endforeach
            @endif
        </nav>

        <div class="site-header__actions">
            <a href="https://app.digify.com.br/login?signup" class="button button--success button--pill">
                Comece Grátis
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
            <a href="https://app.digify.com.br/login" class="button button--light button--pill">Login</a>
        </div>
    </div>
</header>
