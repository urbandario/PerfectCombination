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
   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
   <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
   @yield('scripts')

   <!-- Fonts -->
   <link rel="dns-prefetch" href="//fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

   <!-- Font Awesome -->
   <script src="https://kit.fontawesome.com/4f2a159a87.js" crossorigin="anonymous"></script>

   <!-- Styles -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" rel="stylesheet">
   <script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>
   <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
   @yield('styles')
   <style>
       .ck-content{
           height: 250px;
       }
       .image-look{
            border-radius: 25px;
            border: 2 solid #5a5a5a;
            box-shadow: 5px 5px 20px green;
       }
   </style>
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="padding: 0px 10px 0px 10px">
            <div class="container">
                <div class="col-12 col-md-3 text-center">
                    <a class="navbar-brand" title="Home page" href="{{route('home')}}">
                        <img style="width: 150px" src="{{asset('img/logo.png')}}" alt="Logo">
                    </a>
                    <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('general.navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!--Button for Collapsed Profile List -->
                    <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedProfile" aria-controls="navbarSupportedProfile" aria-expanded="false" aria-label="{{ __('general.navigation') }}">
                        @guest
                            <i class="far fa-user"></i>
                            @else
                                <img src="/img/avatars/{{ Auth::user()->avatar }}" style="width:32px; height:32px; top:10px; left:10px; border-radius:50%">
                        @endguest
                    </button>
                </div>
                @include('partials.profile_collapse')

                @include('partials.menu_collapse')

                <div class="col-12 col-md-3 d-none d-sm-none d-md-block d-lg-block d-xl-block">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <div class="row">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="/img/avatars/{{ Auth::user()->avatar }}" style="width:32px; height:32px; top:10px; left:10px; border-radius:50%">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->admin == 1)
                                        <a class="dropdown-item"
                                           href="{{route('admin_home')}}"><i class="fas fa-crown"></i> Admin Panel</a>
                                        <hr>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user"></i> Profile</a>
                                    <a class="dropdown-item" href="{{ route('favorites') }}"><i class="fas fa-heart"></i> Favorites</a>

                                    @if (auth()->user()->trainer == 1 AND auth()->user()->trainer_approved == 1)
                                        <a class="dropdown-item" href="{{ route('training_list') }}"><i class="fas fa-dumbbell"></i> Your trainings</a>
                                        <a class="dropdown-item" href="{{ route('exercise_list') }}"><i class="fas fa-running"></i> Add exercise</a>    
                                        <a class="dropdown-item" href="{{ route('recipe_list') }}"><i class="fas fa-apple-alt"></i> Your recipes</a>    
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </div>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="container-fluid my-auto" style="bottom: 0;">
            <div class="row h-100">
                <div class="col-12 my-auto icons text-center">
                    Ovde ce se nalaziti sve sto ce biti u footeru
                </div>
            </div>
        </footer>

        <!-- Go to the top of the page button -->
        <button id="btnScrollToTop" class="btnScrollToTop" title="{{__('general.goToTop')}}">
            <i class="fa fa-angle-up" style="color: black"></i>
        </button>
    </div>
    @include('sweetalert::alert')
    @include('partials.js.app')
</body>
</html>
