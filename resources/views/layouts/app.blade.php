<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Titular dinàmic --}}
    <title>@yield('title', 'Tutorials de reparació en català')</title>

    {{-- Descripció SEO dinàmica --}}
    <meta name="description" content="@yield('meta_description', 'Accedeix a tutorials de reparació pas a pas.')">

    {{-- OpenGraph per compartir a xarxes socials --}}
    <meta property="og:title" content="@yield('og_title', 'Tutorials de reparació en català')" />
    <meta property="og:description" content="@yield('og_description', 'Guies detallades per reparar dispositius.')" />
    <meta property="og:image" content="@yield('og_image', asset('default.png'))" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="article" />

    {{-- Altres meta tags (favicon, etc.) --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Goocle Analythics --}}
    @if (app()->environment('production'))
        {{-- Google Console --}}
        <meta name="google-site-verification" content="{{ env('GOOGLE_VERIFICATION_CODE') }}" />
        
        <!-- Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('GA_MEASUREMENT_ID') }}"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ env('GA_MEASUREMENT_ID') }}');
    </script>
@endif

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('tutorials.index') }}">Tutorials.cat</a>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <footer class="text-center mt-4 mb-2 text-muted">
        &copy; {{ date('Y') }} Tutorials.cat
    </footer>
</body>
</html>
