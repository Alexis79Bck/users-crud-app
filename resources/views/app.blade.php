<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendor/AdminLTE3/css/adminlte.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/AdminLTE3/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="antialiased hold-transition sidebar-mini layout-fixed">
    {{-- <div class="wrapper"> --}}
    @inertia

    <script type="text/javascript">
        window.config = {
            appName: "{{ config('app.name') }}",
            appVersion: "{{ config('app.version_number') }}"
        }
    </script>
    <script src="{{ asset('assets/vendor/AdminLTE3/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/AdminLTE3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/AdminLTE3/js/adminlte.min.js') }}"></script>
</body>

</html>
