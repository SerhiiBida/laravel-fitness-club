<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon.icon') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--Styles-->
    @vite(['resources/sass/app.scss'])

    <title>
        Fitness Club Admin Panel
    </title>
</head>
<body>
<div class="app">
    @includeIf('admin.layouts.header')

    <main class="main">
        @yield('content')
    </main>

    @includeIf('admin.layouts.footer')
</div>

<!--Scripts-->
@vite(['resources/js/app.js'])
</body>
</html>
