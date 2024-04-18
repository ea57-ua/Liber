<header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center ">
        <a href="{{route('welcome')}}" class="logo d-flex align-items-center me-5">
            <h1>Liber<span>.</span></h1>
        </a>
        <nav id="navbar" class="navbar ms-5 me-5">
                <ul>
                    <li><a href="{{route('welcome')}}">Home</a></li>
                    <li><a href="{{route('forumPage')}}">Forum</a></li>
                    <li><a href="{{route('moviesPage')}}">Movies</a></li>
                    <li><a href="{{route('listsPage')}}">Lists</a></li>

                    <form class="ms-5 navbar-search">
                        <input class="form-control me-2" type="search"
                               placeholder="Search"
                               aria-label="Search"
                               style="width: 300px">
                    </form>

                    @if(Auth::check())
                        <li class="ms-4 nav-logged-btns">
                            <a href="{{ route(config('chatify.routes.prefix')) }}" class="btn-custom">
                                <i class="bi bi-chat-dots-fill me-1" style="font-size: 24px;"></i>
                                Chat
                            </a>
                        </li>
                        <li class="nav-logged-btns d-flex ms-2 dropdown">
                            <button class="btn btn-username btn-sm dropdown-toggle"
                                    type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                id="userNameDropDown">
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
                        </li>
                    @endif

                    @if(!Auth::check())
                        <li class="ms-5 nav-auth-btns signin">
                            <a href="{{ route('login') }}"
                               class="btn-custom me-2 nav-auth-btn ">
                                Sign In
                            </a>
                        </li>
                        <li class="nav-auth-btns">
                            <a href="{{ route('register') }}"
                               class="btn-custom ms-2 nav-auth-btn">
                                Sign Up
                            </a>
                        </li>
                    @endif
                </ul>
        </nav>

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
    </div>
</header>
