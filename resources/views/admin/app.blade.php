<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $config['site_name'] ?? '' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        <script src="/build/assets/js_admin.js"></script>
        @yield('css_js')

        <!-- Scripts -->
        <link rel="stylesheet" href="/build/assets/app_admin.css">
        
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        @livewireStyles
    </head>
    <body @auth class="min-h-screen bg-gray-50 flex" @endauth>
        @include('admin.layouts.header', ['isShowMenu' => true])

        <main @auth class="flex-1 p-6 overflow-auto" @endauth>
            @yield('content')
        </main>

        @include('admin.layouts.footer')
        @livewireScripts

    </body>
</html>

