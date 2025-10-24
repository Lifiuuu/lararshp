<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RSHP Universitas Airlangga')</title>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landingpage.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    @stack('styles') {{-- Untuk CSS spesifik per halaman --}}
</head>
<body class="font-sans antialiased bg-gray-100">
    <div id="app" class="min-h-screen flex flex-col">
        @include('layouts.header')

        <main class="flex-grow">
            @yield('content')
        </main>

        @include('layouts.footer')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts') {{-- Untuk JS spesifik per halaman --}}
</body>
</html>