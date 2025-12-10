<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="color-scheme" content="light dark" />
<meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
<meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />

<!--begin::Fonts-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
<!--end::Fonts-->

<!--begin::Third Party Plugin(OverlayScrollbars)-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
<!--end::Third Party Plugin(OverlayScrollbars)-->

<!--begin::Third Party Plugin(Bootstrap Icons)-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />
<!--end::Third Party Plugin(Bootstrap Icons)-->

<!--begin::Third Party Plugin(Flatpickr Date Picker)-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" crossorigin="anonymous" />
<!--end::Third Party Plugin(Flatpickr Date Picker)-->

<!--begin::Required Plugin(AdminLTE) - use files in public/assets/css -->
<link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}" />
<!-- if you prefer the non-minified file, use: {{ "asset('assets/css/adminlte.css')" }} -->
<!--end::Required Plugin(AdminLTE)-->

@stack('styles')

<!-- Project overrides & theme (load after AdminLTE so our variables win) -->
<link rel="stylesheet" href="{{ asset('assets/css/global.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/loginform.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/landingpage.css') }}" />
