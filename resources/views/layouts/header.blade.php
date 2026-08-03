@php
    $menuPagina = $menuPagina ?? collect();
@endphp

<header class="site-header">
    <div class="site-header__inner">
        <a class="brand" href="{{ route('home') }}" aria-label="{{ $config['site_name'] ?? '' }}">
            <img class="brand__logo" src="{{ !empty($config['logo_header']) ? asset('storage/' . $config['logo_header']) : 'images/weuny-logo.png' }}" alt="{{ $config['site_name'] ?? '' }}" width="104">
        </a>

        <input class="site-header__menu-check" type="checkbox" id="site-navigation-toggle" aria-hidden="true">

        <nav id="site-navigation" class="site-nav" aria-label="Menu principal">
            <div class="site-nav__item">
                <a class="site-nav__link" href="{{ route('home') }}#recursos">Recursos</a>
            </div>
            <div class="site-nav__item">
                <a class="site-nav__link" href="{{ route('home') }}#modules">Funcionalidades</a>
            </div>
            <div class="site-nav__item">
                <a class="site-nav__link" href="{{ route('home') }}#integracoes">Integrações</a>
            </div>
            @if (!empty($menuPagina))
                @foreach ($menuPagina as $page)
                    @include('layouts.partials.site-nav-item', ['page' => $page])
                @endforeach
            @endif

            <div class="site-nav__mobile-actions">
                <a href="https://app.digify.com.br/login?signup" class="button button--success button--pill">
                    Comece Grátis
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
                <a href="https://app.digify.com.br/login" class="button button--light button--pill">Login</a>
            </div>
        </nav>

        <label class="site-header__menu-toggle" for="site-navigation-toggle" aria-controls="site-navigation" aria-label="Abrir menu">
            <span class="site-header__menu-icon" aria-hidden="true"></span>
            <span class="site-header__menu-icon" aria-hidden="true"></span>
            <span class="site-header__menu-icon" aria-hidden="true"></span>
        </label>

        <div class="site-header__actions site-header__actions--desktop">
            <a href="https://app.digify.com.br/login?signup" class="button button--success button--pill">
                Comece Grátis
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
            <a href="https://app.digify.com.br/login" class="button button--light button--pill">Login</a>
        </div>
    </div>
</header>
