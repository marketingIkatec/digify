@props([
    'type' => 'success', // success, error, warning, info
    'message' => '',
])

@php
    $styles = [
        'success' => ['bg' => '#e9f8ec', 'border' => '#7bc89a', 'color' => '#2e7b52', 'icon' => 'check-circle'],
        'error'   => ['bg' => '#fdeaea', 'border' => '#e28a8a', 'color' => '#a94442', 'icon' => 'x-circle'],
        'warning' => ['bg' => '#fff8db', 'border' => '#e6d27a', 'color' => '#8a6d1a', 'icon' => 'exclamation-triangle'],
        'info'    => ['bg' => '#e7f4fd', 'border' => '#7ab8e6', 'color' => '#31708f', 'icon' => 'information-circle'],
    ];

    $style = $styles[$type] ?? $styles['success'];
@endphp

<div 
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 3500)"
    class="alert"
    style="background: {{ $style['bg'] }}; border: 1px solid {{ $style['border'] }}; color: {{ $style['color'] }};"
>
    <x-dynamic-component :component="'heroicon-o-' . $style['icon']" class="w-5 h-5" />
    <span>{{ $message }}</span>
</div>
