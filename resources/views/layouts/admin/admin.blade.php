<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - {{ config('app.name', 'Application') }}</title>

    <!-- Global and admin styles (pastikan global.css dimuat sebelum admin.css) -->
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!-- Font Awesome (ikon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @stack('styles')
</head>
<body class="admin-panel">

    <div class="admin-wrapper">

        <!-- Sidebar (pulled from partial) -->
        @include('layouts.admin.sidebar')

        <!-- Main content -->
        <main class="admin-content">
            <header class="admin-header">
                <div class="title">@yield('page-title', 'Dashboard')</div>
                <div class="actions">
                    @yield('header-actions')
                </div>
            </header>

            <section>
                @if(session('status'))
                    <div class="admin-card" style="margin-bottom:12px;">
                        <p>{{ session('status') }}</p>
                    </div>
                @endif

                @yield('content')
            </section>
        </main>

    </div>

    @stack('scripts')
</body>
</html>
