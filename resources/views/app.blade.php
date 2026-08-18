<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- SEO TOOLS -->
    {!! SEOTools::generate() !!}

    <!-- GLOBAL JSON-LD -->
    @if (isset($schemaJsonLd))
        <script type="application/ld+json">{!! $schemaJsonLd !!}</script>
    @endif

    @isset($blogSchema)
        @foreach ($blogSchema as $key => $schema)
            <!-- {{ $key }} -->
            <script type="application/ld+json">{!! $schema !!}</script>
        @endforeach
    @endisset


    @isset($faqSchema)
        <!-- FAQ Schema -->
        <script type="application/ld+json">{!! $faqSchema !!}</script>
    @endisset


    @isset($serviceSchema)
        <!-- Service Schema -->
        <script type="application/ld+json">{!! $serviceSchema !!}</script>
    @endisset

    <!-- Favicon / ícones -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Theme / mobile -->
    <meta name="theme-color" content="#0d6efd">


    @yield('css_js')


    <link
        href="https://fonts.googleapis.com/css2?family=Exo+2:wght@500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- mascara do celular -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>
    <!-- mascara do celular -->

    <link rel="stylesheet" href="/build/assets/app.css?cache=<?= date('his') ?>">
    <!--<link rel="stylesheet" href="/build/assets/app_namidia.css?cache=<?= date('his') ?>">-->
    <link rel="stylesheet" href="/build/assets/app_blog.css?cache=<?= date('his') ?>">
    <script src="/build/assets/js_app.js"></script>

    @if (env('APP_ENV') != 'local')
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-P5J23R5J');
        </script>
        <!-- End Google Tag Manager -->
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="legal-page">

    <!-- BODY Google Tag Manager (noscript) -->
    @if (env('APP_ENV') != 'local')
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P5J23R5J" height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endif
    <!-- End BODY Google Tag Manager (noscript) -->

    <!-- Menu -->
    @include('layouts.header')
    <!-- Menu -->
    <main class="internal-page">
        @yield('content')
    </main>

    @include('layouts.footer')
</body>

</html>
