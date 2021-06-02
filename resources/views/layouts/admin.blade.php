<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PerfectCombination') }}</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <link rel="shortcut icon" href="{{ asset('/favicon/favicon1.ico') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-config" href="{{ asset('/favicon/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/4f2a159a87.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        body{
            background: white;
        }
    </style>
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="padding: 0px 10px 0px 10px">
            <div class="container">
                <a class="navbar-brand" title="Home page" href="{{route('home')}}">
                    <img style="width: 150px" src="{{asset('img/logo.png')}}" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('all_users') }}">
                                <i class="fas fa-user"></i> Users 
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('all_trainings') }}">
                                <i class="fas fa-dumbbell"></i> Trainings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('all_recipes') }}">
                                <i class="fas fa-apple-alt"></i> Recipes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('all_exercises') }}">
                                <i class="fas fa-running"></i> Exercises
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('all_ingredients') }}">
                                <i class="fas fa-carrot"></i> Ingredients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('check_trainers') }}">
                                <i class="fas fa-user"></i> Check trainer <span class="badge badge-pill badge-danger @if($trainer_count = App\Models\User::where('email_verified_at','!=', null)->where('trainer',1)->where('trainer_approved',0)->count() != 0) @else invisible @endif" id="trainer-count">{{ $trainer_count }}</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
                        
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <!-- Go to the top of the page button -->
        <button id="btnScrollToTop" class="btnScrollToTop" title="{{__('general.goToTop')}}">
            <i class="fa fa-angle-up" style="color: black"></i>
        </button>
    </div>
    @include('sweetalert::alert')
    @include('partials.js.app')
</body>
</html>
