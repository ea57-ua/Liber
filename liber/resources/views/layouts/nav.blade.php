<nav
    class="flex items-center justify-between flex-wrap bg-black py-4 lg:px-12 shadow">
    <div class="flex justify-between lg:w-auto w-full lg:border-b-0 pl-6 pr-2 border-solid border-b-2 border-gray-300 pb-5 lg:pb-0">
        <div class="flex items-center flex-shrink-0 text-gray-800 mr-16">
            <div class="text-white text-2xl font-bold tracking-tight">Liber</div>
        </div>
        <div class="block lg:hidden ">
            <button
                id="nav"
                class="flex items-center px-3 py-2 border-2 rounded text-white border-white hover:text-white hover:border-red-700">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                </svg>
            </button>
        </div>
    </div>

    <div class="menu w-full lg:block flex-grow lg:flex lg:items-center lg:w-auto lg:px-3 px-8">
        <div class="text-md font-bold text-white lg:flex-grow">
            <a href="#"
               class="block mt-4 lg:inline-block lg:mt-0 hover:text-white px-4 py-2 rounded hover:bg-red-700 mr-2">
                Home
            </a>
            <a href="#"
               class=" block mt-4 lg:inline-block lg:mt-0 hover:text-white px-4 py-2 rounded hover:bg-red-700 mr-2">
                Forum
            </a>
            <a href="#"
               class="block mt-4 lg:inline-block lg:mt-0 hover:text-white px-4 py-2 rounded hover:bg-red-700 mr-2">
                Movies
            </a>
            <a href="#"
               class="block mt-4 lg:inline-block lg:mt-0 hover:text-white px-4 py-2 rounded hover:bg-red-700 mr-2">
                Lists
            </a>
        </div>

        <!-- This is an example component -->
        <div class="relative w-96 text-gray-600 lg:block hidden mr-20">
            <input
                class="bg-gray-500 h-10 pl-2 pr-10 w-full rounded-lg text-sm focus:outline-none"
                type="search" name="search" placeholder="Search for anything">
            <button type="submit" class="absolute right-0 top-0 mt-3 mr-2">
                <svg class="text-gray-600 h-4 w-6 fill-current" xmlns="http://www.w3.org/2000/svg"
                     version="1.1" id="Capa_1" x="0px" y="0px"
                     viewBox="0,0,256,256"
                     style="fill:#000000;">
                    <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt"
                       stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                       font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                        <g transform="scale(5.12,5.12)">
                            <path d="M21,3c-9.37891,0 -17,7.62109 -17,17c0,9.37891 7.62109,17 17,17c3.71094,0 7.14063,-1.19531 9.9375,-3.21875l13.15625,13.125l2.8125,-2.8125l-13,-13.03125c2.55469,-2.97656 4.09375,-6.83984 4.09375,-11.0625c0,-9.37891 -7.62109,-17 -17,-17zM21,5c8.29688,0 15,6.70313 15,15c0,8.29688 -6.70312,15 -15,15c-8.29687,0 -15,-6.70312 -15,-15c0,-8.29687 6.70313,-15 15,-15z"></path></g></g>
                </svg>
            </button>
        </div>
        <div class="flex">
            <a href="#"
               class="bg-white text-black block text-md px-4 py-2 rounded ml-2 font-bold hover:text-white mt-4 hover:bg-red-700 lg:mt-0">
                Sign in</a>

            <a href="#"
               class="bg-white text-black block text-md px-4  ml-2 py-2 rounded font-bold hover:text-white mt-4 hover:bg-red-700 lg:mt-0">
                Sign up
            </a>
        </div>
    </div>

</nav>
<!--
    <div class="">
        @if (Route::has('login'))
    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
@auth
        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                    @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
    @endauth
    </div>
@endif
</div>
-->
