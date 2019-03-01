<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
    <div id="app" class="wrapper">
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            {{-- Right Menu --}}
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="overflow-x: hidden;">
            <a href="{{ url('/') }}" class="brand-link">
                <img src="{{ asset('images/calendar.png') }}" alt="{{ config('app.name') }}" class="brand-image img-circle">
                <span class="brand-text font-weight-bold">MY EVENT</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('images/user-circle.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        @if (Auth::user()->hasRole(['superadmin', 'admin']))
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link close-sidebar">
                                    <i class="fas fa-tachometer-alt nav-icon"></i>
                                    <p class="ml-1">Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('participants.index') }}" class="nav-link close-sidebar">
                                    <i class="fas fa-user-plus nav-icon"></i>
                                    <p class="ml-1">Participant</p>
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link close-sidebar">
                                    <i class="fas fa-home nav-icon"></i>
                                    <p class="ml-1">Home</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('profile.index') }}" class="nav-link close-sidebar">
                                    <i class="fas fa-user-circle nav-icon"></i>
                                    <p class="ml-1">Profile</p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{ route('modules.index') }}" class="nav-link close-sidebar">
                                <i class="fas fa-book nav-icon"></i>
                                <p class="ml-1">Module</p>
                            </a>
                        </li>

                        {{-- <li class="nav-header">EVENT</li> --}}

                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            @yield('content')
        </div>

        <aside class="control-sidebar control-sidebar-light">
            <div class="p-3">
                <img src="{{ asset('images/user-circle.png') }}" class="img-fluid mx-auto d-block rounded-circle" style="width: 75px">
                <div class="pt-2 text-center">
                    <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                    <p>{{ Auth::user()->roles[0]->display_name ?? '-' }}</p>
                </div>
                <hr class="mt-0">
                <button class="btn btn-outline-secondary border-0 btn-block" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                </button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </aside>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Sukses!',
                text: "{{ session('success') }}",
                type: 'success',
            })
        </script>
    @endif
    @yield('scripts')
</body>
</html>
