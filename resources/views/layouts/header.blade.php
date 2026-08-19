@php
    $menuPagina = $menuPagina ?? collect();
@endphp

<header class="site-header">
    @auth
        @if(!empty($item) || !empty($blog))
        <div class="admin-edit">
            @php
            if(!empty($item)){
                $routeName = 'admin.site.page.edit';
                $routeParam = $item['id'];
            } elseif(!empty($blog)){
                $routeName = 'blogs.edit';
                $routeParam = $blog['id'];
            }
            @endphp
            <a href="{{ route($routeName, $routeParam) }}" class="btn btn-edit" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" style="fill:#fff;width: 23px;"><path d="M100.4 417.2C104.5 402.6 112.2 389.3 123 378.5L304.2 197.3L338.1 163.4C354.7 180 389.4 214.7 442.1 267.4L476 301.3L442.1 335.2L260.9 516.4C250.2 527.1 236.8 534.9 222.2 539L94.4 574.6C86.1 576.9 77.1 574.6 71 568.4C64.9 562.2 62.6 553.3 64.9 545L100.4 417.2zM156 413.5C151.6 418.2 148.4 423.9 146.7 430.1L122.6 517L209.5 492.9C215.9 491.1 221.7 487.8 226.5 483.2L155.9 413.5zM510 267.4C493.4 250.8 458.7 216.1 406 163.4L372 129.5C398.5 103 413.4 88.1 416.9 84.6C430.4 71 448.8 63.4 468 63.4C487.2 63.4 505.6 71 519.1 84.6L554.8 120.3C568.4 133.9 576 152.3 576 171.4C576 190.5 568.4 209 554.8 222.5C551.3 226 536.4 240.9 509.9 267.4z"/></svg>
            </a>   
        </div>  
        @endif
    @endauth
    <div class="site-header__inner">
        <a class="brand" href="{{ route('home') }}" aria-label="{{ $config['site_name'] ?? '' }}">
            <img class="brand__logo" src="{{ !empty($config['logo_header']) ? asset('storage/' . $config['logo_header']) : '' }}" alt="{{ $config['site_name'] ?? '' }}" width="104">
        </a>

        <input class="site-header__menu-check" type="checkbox" id="site-navigation-toggle" aria-hidden="true">

        <nav id="site-navigation" class="site-nav" aria-label="Menu principal">
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
