<div class="collapse col-12 col-lg-6" id="navbarSupportedProfile">
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
            <li class="nav-item">
                @if(Auth::user()->admin == 1)
                    <a class="nav-link"
                       href="{{route('all_users')}}"><i class="fas fa-crown"></i> Admin Panel</a>
                    <hr>
                @endif
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile') }}"><i class="fas fa-user"></i> Profile</a>
            </li>
            @if (auth()->user()->trainer == 1 AND auth()->user()->trainer_approved == 1)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('training_list') }}"><i class="fas fa-dumbbell"></i> Your trainings</a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('exercise_list') }}"><i class="fas fa-running"></i> Add exercise</a>    

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('recipe_list') }}"><i class="fas fa-apple-alt"></i> Your recipes</a>    

                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>                
        @endguest
    </ul>
</div>