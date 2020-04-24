<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.meta')

    <style>
        @php
            echo file_get_contents(public_path('css/create.css'));
        @endphp
    </style>
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
