@php
    $children = ($page->childrenRecursive ?? collect())->where('status', true)->values();
@endphp

<div class="site-nav__item {{ $children->isNotEmpty() ? 'site-nav__item--has-children' : '' }}">
    <a class="site-nav__link" href="{{ route('site.show', $page->slug) }}">{{ $page->titulo }}</a>

    @if ($children->isNotEmpty())
        <button class="site-nav__submenu-toggle" type="button" aria-expanded="false" aria-label="Abrir submenu de {{ $page->titulo }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="m6 9 6 6 6-6"/>
            </svg>
        </button>

        <div class="site-nav__submenu">
            @foreach ($children as $child)
                @include('layouts.partials.site-nav-item', ['page' => $child])
            @endforeach
        </div>
    @endif
</div>
