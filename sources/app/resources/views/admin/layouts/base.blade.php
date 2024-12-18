<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--Styles-->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <title>
        Fitness Club Admin Panel
    </title>
</head>
<body>
<div class="app">
    @includeIf('admin.layouts.header')

    <main class="main">
        <div class="container-lg pt-1">
            {{-- Уведомления --}}
            @error('errorMessage')
            <div class="alert alert-danger mb-1" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>

        @yield('content')

        @includeIf('admin.components.message')
    </main>

    @includeIf('admin.layouts.footer')
</div>

<script>
    window.user = {
        userId: @auth {{ auth()->user()->id }} @else null @endauth
    };
</script>
@vite(['resources/js/events.js', 'resources/js/action.js'])
</body>
</html>
