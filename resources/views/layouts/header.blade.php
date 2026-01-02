<!DOCTYPE html>
<html lang="id">
    <head>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-023RSV4YZQ"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-023RSV4YZQ');
        </script>
		@include('partials.seo')
        <!-- Favicon-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="icon" type="image/x-icon" href="{{asset('images/icon.ico')}}" />
        <script async charset="utf-8" src="https://cdn.embedly.com/widgets/platform.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.8.8/dist/lazyload.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>