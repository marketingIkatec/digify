<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Favicon / ícones -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Theme / mobile -->
    <meta name="theme-color" content="#0d6efd">

    <!-- Fontes: Red Hat Display & Inter -->
    <link
        href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Exo+2:wght@500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/build/assets/app.css?cache=<?= date('his') ?>">
    <script src="/build/assets/js_app.js"></script>

</head>

<body>
    <!-- Menu -->
    @include('layouts.header')
    <!-- Menu -->
    <main>
        @yield('content')
    </main>

    @include('layouts.footer')
</body>

</html>
