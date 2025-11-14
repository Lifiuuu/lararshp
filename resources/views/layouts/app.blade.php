<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles: use project's public assets/css files -->
    <link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landingpage.css') }}">
    <!-- Optional auth styles (pages can rely on this or push their own) -->
    <link rel="stylesheet" href="{{ asset('assets/css/loginform.css') }}">

    <!-- Scripts (Vite) - include JS bundle; CSS loaded from public/css -->
    @vite('resources/js/app.js')
    @stack('styles')
</head>
<body>
    <div id="app">
        {{-- header partial --}}
        @include('layouts.site.header')

        <main class="py-4">
            @yield('content')
        </main>

        {{-- footer partial --}}
        @include('layouts.site.footer')
    </div>

    @stack('scripts')
</body>
</html>