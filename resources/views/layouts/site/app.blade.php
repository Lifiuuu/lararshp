<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Styles: use project's compiled public CSS (global theme) -->
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">

    <!-- Scripts (Vite) - only include JS bundle to keep module tooling; CSS is loaded from public/css -->
    @vite('resources/js/app.js')
</head>
<body>
    <div id="app">
        {{-- header partial: menggunakan resources/views/layouts/site/header.blade.php --}}
        @include('layouts.site.header')

        <main class="py-4">
            @yield('content')
        </main>

        {{-- footer partial --}}
        @include('layouts.site.footer')
    </div>
</body>
</html>
