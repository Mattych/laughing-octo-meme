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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hind" rel="stylesheet">
    <link rel="icon" href="img/logo.ico">
    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .navbar{
            font-family: 'Montserrat', sans-serif;
            color: #DD6031;
        }

        .navbar-custom{
            background-color: #EABE7C;
        }

        h1{
            font-family: 'Hind', sans-serif;
            font-weight: bold;
            color: #311E10;
        }

        .btn-user, .btn-donate{
            background-color: #D9DD92;
            color: #311E10;
        }
        
        .btn-user:hover, .btn-donate:hover{
            background-color: #C4C883;
            color: #311E10;
        }

        .btn-forget{
            color: #311E10;
        }

        .btn-forget:hover{
            color: #837666;
        }

        .btn-manage{
            background-color: #DD6031;
            color: white;
        }

        .btn-manage:hover{
            background-color: #BE4D27;
            color: white;
        }

        .btn-edit{
            background-color: #D9DD92;
            color: #311E10;
        }

        .btn-edit:hover{
            background-color: #C4C883;
            color: #311E10;
        }

        .btn-delete{
            background-color: #DD6031;
            color:white;
        }

        .btn-delete:hover{
            background-color: #CE562C;
            color:white;
        }

        .btn-create{
            background-color: #88DD69;
            color: white;
        }

        .btn-create:hover{
            background-color: #7AC95F;
            color: white;
        }
    
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container-fluid w-75">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="img/logo.png" alt="" width=30 height=30>
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Of Navbar -->
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link nav-register" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
