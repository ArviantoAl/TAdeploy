<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">--}}

<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('form_register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        @if(Auth::user()->user_role == 1)
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('Data') }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.user') }}">
                                        {{ __('Data User') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.kategori') }}">
                                        {{ __('Data Kategori') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.layanan') }}">
                                        {{ __('Data Layanan') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.langganan') }}">
                                        {{ __('Data Langganan') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.invoice') }}">
                                        {{ __('Data Invoice') }}
                                    </a>
                                </div>
                            </li>
                        @elseif(Auth::user()->user_role == 2)
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('Data') }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('administrator.user') }}">
                                        {{ __('Data User') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('administrator.layanan') }}">
                                        {{ __('Data Layanan') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('administrator.langganan') }}">
                                        {{ __('Data Langganan') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('administrator.invoice') }}">
                                        {{ __('Data Invoice') }}
                                    </a>
                                </div>
                            </li>
                        @elseif(Auth::user()->user_role == 3)
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('Data') }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('teknisi.user') }}">
                                        {{ __('Data User') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('teknisi.layanan') }}">
                                        {{ __('Data Layanan') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('teknisi.langganan') }}">
                                        {{ __('Data Langganan') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('teknisi.invoice') }}">
                                        {{ __('Data Invoice') }}
                                    </a>
                                </div>
                            </li>
                        @elseif(Auth::user()->user_role == 4)
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('Data') }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('pelanggan.layanan') }}">
                                        {{ __('Data Layanan') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('pelanggan.langganan') }}">
                                        {{ __('Data Langganan') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('pelanggan.invoice') }}">
                                        {{ __('Data Invoice') }}
                                    </a>
                                </div>
                            </li>
                        @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
