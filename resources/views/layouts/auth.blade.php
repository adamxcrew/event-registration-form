<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="msapplication-TileImage" content="{{ site('logo', asset('images/laravel-white.png')) }}" />

    <title>{{ site('name', config('app.name')) }} - @yield('title', site('description', config('app.desc')))</title>

    <link rel="icon" href="{{ site('logo', asset('images/laravel-white.png')) }}" sizes="32x32" />
    <link rel="icon" href="{{ site('logo', asset('images/laravel-white.png')) }}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ site('logo', asset('images/laravel-white.png')) }}" />
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body class="hold-transition @yield('body')-page">
    <div id="app" class="py-4" style="min-height: 100vh; display: flex; flex-direction: column; justify-content: center; width: 100%;">
        @if (App::environment('local') && $errors->any())
            <x-alert.errors class="mx-3 mt-3 mb-0" />
        @endif
        <div>
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')
</body>
</html>
