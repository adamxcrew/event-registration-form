<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - {{ config('app.desc') }}</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        table.dataTable {
            clear: both;
            margin-top: 0 !important;
            border-collapse: collapse !important;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div id="app" class="wrapper">
        @includeWhen(session('success'), 'components.alert.success')
        @include('components.alert.confirm-before-delete')

        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            @if (isset($back))
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ $back }}" class="nav-link" onclick="{{ $back == '#' ? 'window.history.back()' : '' }}">
                            <i class="fas fa-arrow-left mr-2"></i> Back
                        </a>
                    </li>
                </ul>
            @else
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ url('/') }}" class="nav-link text-uppercase">
                            {{ config('app.desc') }}
                        </a>
                    </li>
                </ul>
            @endif

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
                <img src="{{ asset('images/laravel-white.png') }}" alt="{{ config('app.name') }}" class="brand-image">
                <span class="brand-text">{{ config('app.name') }}</span>
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
                                <a href="{{ route('home') }}" class="nav-link @activeRoute('home')">
                                    <span class="nav-icon">
                                        <svg style="width: 1.1em; height: 1.1em;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                    </span>
                                    <p class="ml-1">Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('participants.index') }}" class="nav-link @activeRoute('participants.*')">
                                    <span class="nav-icon">
                                        <svg style="width: 1.1em; height: 1.1em;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                        </svg>
                                    </span>
                                    <p class="ml-1">Participant</p>
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link">
                                    <i class="fas fa-home nav-icon"></i>
                                    <p class="ml-1">Home</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('profile.index') }}" class="nav-link">
                                    <i class="fas fa-user-circle nav-icon"></i>
                                    <p class="ml-1">Profile</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('modules.index') }}" class="nav-link">
                                    <i class="fas fa-book nav-icon"></i>
                                    <p class="ml-1">Module</p>
                                </a>
                            </li>
                        @endif

                        @role(['superadmin', 'admin'])
                            <li class="nav-header">Resource</li>
                            <li class="nav-item">
                                <a href="{{ route('modules.index') }}" class="nav-link @activeRoute('modules.*')">
                                    <span class="nav-icon">
                                        <svg style="width: 1.1em; height: 1.1em;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                        </svg>
                                    </span>
                                    <p class="ml-1">Files</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('category.index') }}" class="nav-link @activeRoute('category.*')">
                                    <span class="nav-icon">
                                        <svg style="width: 1.1em; height: 1.1em;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                        </svg>
                                    </span>
                                    <p class="pl-1">Category</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('event.index') }}" class="nav-link @activeRoute('event.*')">
                                    <span class="nav-icon">
                                        <svg style="width: 1.1em; height: 1.1em;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                        </svg>
                                    </span>
                                    <p class="pl-1">Event</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('package.index') }}" class="nav-link @activeRoute('package.*')">
                                    <span class="nav-icon">
                                        <svg style="width: 1.1em; height: 1.1em;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                        </svg>
                                    </span>
                                    <p class="pl-1">Package</p>
                                </a>
                            </li>

                            <li class="nav-header">Setting</li>
                            <li class="nav-item">
                                <a href="{{ route('config.index') }}" class="nav-link @activeRoute('config.*')">
                                    <span class="nav-icon">
                                        <svg style="width: 1.1em; height: 1.1em;"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </span>
                                    <p class="pl-1">Event</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('account.index') }}" class="nav-link @activeRoute('account.*')">
                                    <span class="nav-icon">
                                        <svg style="width: 1.1em; height: 1.1em;"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </span>
                                    <p class="pl-1">Account</p>
                                </a>
                            </li>
                        @endrole

                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            @if (App::environment('local') && $errors->any())
                <x-alert.errors class="mx-3 mt-3 mb-0" />
            @endif

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

    @yield('scripts')
    @stack('scripts')
</body>
</html>
