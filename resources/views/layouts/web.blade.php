<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.meta')

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <pwa-update></pwa-update>
    <header class="site-header">
        <div class="container site-header__container">
            <a class="site-header__logo" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
            <form action="{{ route('homepage') }}#rezultati" method="GET" class="input-group">
                <div class="input-group__prefix">#</div>
                <div class="input-group__input">
                    <input id="tags-output" type="hidden" name="tags" value="{{ $tags }}" autocomplete="off">
                    <input id="tags-input" type="text" class="tagify-single-line" value="{{ $tags }}" autocomplete="off"
                           placeholder="Pretraga tagova" data-type="search">
                    <div id="tags-autocomplete"></div>
                </div>
                <button type="submit" class="input-group__sufix" aria-label="Pretraži">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 512 512"><path d="M508.875 493.792L353.089 338.005c32.358-35.927 52.245-83.296 52.245-135.339C405.333 90.917 314.417 0 202.667 0S0 90.917 0 202.667s90.917 202.667 202.667 202.667c52.043 0 99.411-19.887 135.339-52.245l155.786 155.786a10.634 10.634 0 007.542 3.125c2.729 0 5.458-1.042 7.542-3.125 4.166-4.167 4.166-10.917-.001-15.083zM202.667 384c-99.979 0-181.333-81.344-181.333-181.333S102.688 21.333 202.667 21.333 384 102.677 384 202.667 302.646 384 202.667 384z"/></svg>
                </button>
            </form>
            <a class="site-header__button button" aria-label="Dodajte objavu " href="{{ route('posts.create') }}">
                <span class="site-header__button-plus">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 448 448"><path d="M408 184H272a8 8 0 01-8-8V40c0-22.09-17.91-40-40-40s-40 17.91-40 40v136a8 8 0 01-8 8H40c-22.09 0-40 17.91-40 40s17.91 40 40 40h136a8 8 0 018 8v136c0 22.09 17.91 40 40 40s40-17.91 40-40V272a8 8 0 018-8h136c22.09 0 40-17.91 40-40s-17.91-40-40-40zm0 0"/></svg>
                </span>
                <span class="site-header__button-text">Dodajte objavu</span>
            </a>
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
