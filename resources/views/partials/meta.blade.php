<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="preconnect dns-prefetch" href="https://www.googletagmanager.com">

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/favicons/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicons/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicons/favicon-16x16.png') }}">
<link rel="manifest" crossorigin="use-credentials" href="{{ asset('/favicons/site.webmanifest') }}">
<link rel="mask-icon" href="{{ asset('/favicons/safari-pinned-tab.svg') }}" color="#000000'">
<link rel="shortcut icon" href="{{ asset('/favicons/favicon.ico') }}">
<meta name="msapplication-TileColor" content="#000000">
<meta name="msapplication-config" content="{{ asset('/favicons/browserconfig.xml') }}">
<meta name="theme-color" content="#000000">

<!-- Primary Meta Tags -->
<title>@yield('page_title') | {{ config('app.name') }}</title>
<meta name="title" content="@yield('page_title') | {{ config('app.name') }}">
<meta name="description" content="With Meta Tags you can edit and experiment with your content then preview how your webpage will look on Google, Facebook, Twitter and more!">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url('') }}">
<meta property="og:title" content="@yield('page_title') | {{ config('app.name') }}">
<meta property="og:description" content="{{ config('meta.description') }}">
<meta property="og:image" content="{{ asset(config('meta.image')) }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url('') }}">
<meta property="twitter:title" content="@yield('page_title') | {{ config('app.name') }}">
<meta property="twitter:description" content="{{ config('meta.description') }}">
<meta property="twitter:image" content="{{ asset(config('meta.image')) }}">

<script>
    @php
        echo file_get_contents(asset('js/init.js'));
    @endphp
</script>


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo env("GOOGLE_ANALYTICS_ID", "") ?>"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '<?php echo env("GOOGLE_ANALYTICS_ID", "") ?>');
</script>
