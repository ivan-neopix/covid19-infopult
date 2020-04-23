<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title') | {{ config('app.name') }}</title>

    <link rel="preconnect dns-prefetch" href="https://www.googletagmanager.com">
    {{--  TODO Add meta tags   --}}

    <!-- Styles -->
    <link href="{{ asset('css/create.css') }}" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo env("GOOGLE_ANALYTICS_ID", "") ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '<?php echo env("GOOGLE_ANALYTICS_ID", "") ?>');
    </script>
</head>
<body class="@yield('body_class')">
    <header class="site-header">
        <div class="container site-header__container">
            <a class="site-header__logo" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
        </div>
    </header>
    <div class="flash">
        @include('layouts.flash')
    </div>
    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
