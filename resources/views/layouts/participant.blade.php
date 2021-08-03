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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body class="hold-transition layout-top-nav">
    <div id="app" class="wrapper">
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">

                <a href="{{ url('/') }}" class="navbar-brand ml-2 ml-md-0 mr-md-3">
                    <span class="brand-text font-weight-bold text-uppercase text-primary">{{ site('name', config('app.name')) }}</span>
                </a>

                <div class="collapse navbar-collapse order-3 border-left ml-2 ml-md-0 pl-2 pl-md-0" id="navbarCollapse">
                    @auth
                        <!-- Left navbar links -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link @activeRoute('home')">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('profile.index') }}" class="nav-link @activeRoute('profile.*')">Profile</a>
                            </li>
                        </ul>
                    @endauth

                    <!-- Right navbar links -->
                    <ul class="navbar-nav ml-auto">
                        @auth
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link @activeRoute('login')">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link @activeRoute('register')">Registrasi</a>
                            </li>
                        @endauth
                    </ul>
                </div>

                <button class="navbar-toggler order-1 order-md-3 border-0" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <!-- /.navbar -->
        @includeWhen(session('success'), 'components.alert.success')

        <div class="content-wrapper">
            @if (App::environment('local') && $errors->any())
                <x-alert.errors class="mx-3 mt-3 mb-0" />
            @endif

            @yield('content')
        </div>

        @include('layouts._footer')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
