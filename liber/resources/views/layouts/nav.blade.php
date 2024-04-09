<header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center ">
        <a href="{{route('welcome')}}" class="logo d-flex align-items-center me-5">
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1>Liber<span>.</span></h1>
        </a>
        <nav id="navbar" class="navbar ms-5 me-5">
            <ul>
                <li><a href="{{route('welcome')}}">Home</a></li>
                <li><a href="{{route('forumPage')}}">Forum</a></li>
                <li><a href="{{route('moviesPage')}}">Movies</a></li>
                <li><a href="{{route('listsPage')}}">Lists</a></li>
            </ul>
            <!-- Search form -->
            <form class="d-flex ms-5" style="margin-top: 12px">
                <input class="form-control me-2" type="search"
                       placeholder="Search"
                       aria-label="Search"
                        style="width: 300px">
            </form>
            <div class="d-flex ms-5">
                <!-- TODO: comprobar con usuario logeado -->
                @if(Auth::check())
                    <div class="dropdown">
                        <button class="btn btn-username btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                            </li>
                            @if(Auth::user()->admin == true)
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Liber Admin</a>
                                </li>
                            @endif
                            <li>
                                <div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item navbarDropDownButton">
                                            Sign Out
                                        </button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                @else
                    <!-- Sign in and Sign up buttons for guests -->
                    <a href="{{ route('login') }}" class="btn-custom me-2">Sign In</a>
                    <a href="{{ route('register') }}" class="btn-custom ms-2">Sign Up</a>
                @endif
            </div>
        </nav>

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
    </div>
</header>
