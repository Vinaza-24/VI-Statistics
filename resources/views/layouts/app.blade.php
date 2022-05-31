<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>VI Sitatics</title>
    <link rel="icon" href="http://localhost/vistatistics/resources/images/logo.png">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2512e4cd7e.js" crossorigin="anonymous"></script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/quintet.css') }}" rel="stylesheet">

    <style>
        .form-check-input:checked {
            background-color: green !important;
            border-color: white !important;
        }

        .a div{
            height: 20%!important;
        }

        /*Table*/
        @media screen and (max-width: 600px) {
            table {
                width:100%;
            }
            thead {
                display: none;
            }
            tr:nth-of-type(2n) {
                background-color: inherit;
            }
            tr td:first-child {
                background: #f0f0f0;
                font-weight:bold;
                font-size:1.3em;
            }
            tbody td {
                display: block;
                text-align:center;
            }
            tbody td:before {
                content: attr(data-th);
                display: block;
                text-align:center;
            }
        }
    </style>

    <!-- Data Table -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


</head>
<body style="background-image: url('https://www.yorokobu.es/wp-content/uploads/2021/05/Vanila-x-NHL_Logos_Press_images_Pattern-scaled.jpg');">
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="background-color: #17408B !important;">
        <div class="container" >
            @if(Auth::user())
                <a class="navbar-brand" href="{{ route('home') }}" style="color: white !important;">
                    <i class="fa-solid fa-house"></i> {{ __('Home') }}
                </a>
            @endif

            @if(Auth::user())
                <button class="navbar-toggler" type="button"   data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }} ">
                    <span class="navbar-toggler-icon"></span>
                </button>
            @endif

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto" style="display: flex; align-items: center;">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" style="color: white !important;" href="{{ route('login') }}" >{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" style="color: white !important;" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" style="color: white !important;" href="{{ route('welcome') }}"><i class="fas fa-reply"></i></a>
                            </li>
                        @endif
                    @else
                        @can('create player')
                            <li class="nav-item dropdown navbar-brand">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white!important;">
                                    {{ __('Create') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('panel.create.player') }}"><i class="fa-solid fa-user-plus"></i> {{ __('Player') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('panel.create.quintet') }}"><i class="fa-solid fa-file"></i> {{ __('Quintet') }}</a>
                                    <a class="dropdown-item" href="{{ route('panel.create.game') }}"><i class="fa-solid fa-trophy"></i> {{ __('Game') }}</a>
                                </div>
                            </li>

                            <a class="navbar-brand" href="{{ route('panel.player.pool') }}" style="color: white !important;">
                                <i class="fa-solid fa-people-group"></i> {{ __('Player Pool') }}
                            </a>
                        @endcan

                        @if(Auth::user())
                            <li class="nav-item dropdown navbar-brand">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white!important;">
                                    {{ __('Whatch') }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('panel.whatch.team') }}"><i class="fa-solid fa-sitemap"></i> {{ __('Team') }}</a>
                                    @can('create player')
                                        <a class="dropdown-item" href="{{ route('panel.watch.quintet') }}"><i class="fa-solid fa-file"></i> {{ __('Quintet') }}</a>
                                        <a class="dropdown-item" href="{{ route('panel.compare.players') }}"><i class="fa-solid fa-code-compare"></i> {{ __('Compare') }}</a>
                                    @endcan
                                </div>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" style="color: white !important;" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-user"></i> &nbsp {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('panel.myData') }}">
                                    <i class="fa-solid fa-image-portrait"></i> &nbsp {{ __('My Data') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-from-bracket"></i> &nbsp {{ __('Logout') }}
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

<footer class="bg-light text-center text-lg-start" style="position: fixed; mso-margin-top:10%; bottom: 0; width: 100%;">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: #17408B !important; color: white; text-shadow: 0 0 5px black;">
        © 2022 Copyright: VI Statistics.com
    </div>
    <!-- Copyright -->
</footer>


<!-- Sweet Alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://fastly.jsdelivr.net/npm/echarts@5.3.2/dist/echarts.min.js"></script>

</body>
</html>

@stack('alert-card-players')
@stack('alert-card-create-game')
@stack('my-data-panel')
@stack('quintet')
@stack('echarts-player')
@stack('echarts-player-compare')
@stack('compare-player')
@stack('quintetWatch')
