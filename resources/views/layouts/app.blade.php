<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Test by Eric') }}</title>

    <!-- Styles -->
    @yield('css')
    <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/vendor/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="/styles/roboto.css">
    <link rel="stylesheet" href="/styles/font-awesome.css">
    <link rel="stylesheet" href="/styles/panel.css">
    <link rel="stylesheet" href="/styles/feather.css">
    <link rel="stylesheet" href="/styles/animate.css">
    <link rel="stylesheet" href="/styles/urban.css">
    <link rel="stylesheet" href="/styles/urban.skins.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    @if (Auth::check())
                    <ul class="nav navbar-nav">
                        <a class="navbar-brand" href="{{ url('/blogs') }}">
                            Blogs
                        </a>
                        <a class="navbar-brand" href="{{ url('/users') }}">
                            Users
                        </a>
                    </ul>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/scripts/extentions/modernizr.js"></script>
    <script src="/vendor/jquery/dist/jquery.js"></script>
    <script src="/vendor/bootstrap/dist/js/bootstrap.js"></script>
    <script src="/vendor/jquery.easing/jquery.easing.js"></script>
    <script src="/vendor/fastclick/lib/fastclick.js"></script>
    <script src="/vendor/onScreen/jquery.onscreen.js"></script>
    <script src="/vendor/jquery-countTo/jquery.countTo.js"></script>
    <script src="/vendor/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="/scripts/ui/accordion.js"></script>
    <script src="/scripts/ui/animate.js"></script>
    <script src="/scripts/ui/link-transition.js"></script>
    <script src="/scripts/ui/panel-controls.js"></script>
    <script src="/scripts/ui/preloader.js"></script>
    <script src="/scripts/ui/toggle.js"></script>
    <script src="/scripts/urban-constants.js"></script>
    <script src="/scripts/extentions/lib.js"></script>
    @yield('js')
</body>
</html>
