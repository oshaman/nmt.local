<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta name="robots" content="noindex, nofollow">

    <meta name="robots" content="noindex, follow">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} : {{ $title ?? '' }}</title>
    <link href="{{ asset('favicon.ico') }}" rel="shortcut icon">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@yield('css')
<!-- TinyMCE -->
@yield('tiny')
<!-- TinyMCE -->
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default custom-nav-panel-top">
        <div class="app-menu container-fluid">
            <div class="navbar-header navbar-header-background">

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}" target="_blank">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right custom-nav-panel-top_login-box">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Вхід</a></li>
                        {{--<li><a href="{{ route('register') }}">Register</a></li>--}}
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->email }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>

                    @yield('navbar')

            </div>
        </div>
    </nav>
    <div class="container">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <p class="error">
                    @foreach ($errors->toArray() as $key=>$error)
                    {!! str_replace(str_replace('_', ' ', $key), '<strong>' . trans('admin.' . $key) . '</strong>', $error[0]) !!}</br>
                    @endforeach
                </p>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @yield('content')
    </div>

</div>
@yield('mark')
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('jss')
<script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
