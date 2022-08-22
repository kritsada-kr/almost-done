<nav class="sticky top-0 z-50 bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded drop-shadow-lg">
    <div class="container flex ">
        <div class="pt-2">
            <a href="{{ url('/') }}" >
                <img src="{{ asset('imgs/logo.png') }}" alt="logo">
            </a>
        </div>

        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white ">
                @auth
                <div class="flex md:flex-row md:space-x-12">
                <li>
                        <a href="{{ route('posts.index') }}"
                           class="hover:bg-gray-100 block py-2 pr-4 pl-3 mt-5 text-center inline-flex items-center @if(Route::currentRouteName() === 'posts.index') current-page @endif" >
                            Posts
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('posts.create') }}"
                           class="hover:bg-gray-100 block py-2 pr-4 pl-3 mt-5 text-center inline-flex items-center @if(Route::currentRouteName() === 'posts.create') current-page @endif">
                            New Post
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('tags.index') }}"
                           class="hover:bg-gray-100 block py-2 pr-4 pl-3 mt-5 text-center inline-flex items-center @if(Route::currentRouteName() === 'tags.index') current-page @endif" >
                            Tags
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('organizationTags.index') }}"
                           class="hover:bg-gray-100 block py-2 pr-4 pl-3 mt-5 text-center inline-flex items-center @if(Route::currentRouteName() === 'organizationTags.index') current-page @endif" >
                           Organization
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('charts.index') }}"
                           class="hover:bg-gray-100 block py-2 pr-4 pl-3 mt-5 text-center inline-flex items-center @if(Route::currentRouteName() === 'charts.index') current-page @endif" >
                           Chart
                        </a>
                    </li>


                    <li>
                        <form action="/search" method="get" class="pt-4">
                            <input class="normal-field" name="search" type="search" placeholder="Search ..">
                                <button class="app-button-orange" type="submit">Search</button>
                        </form>
                    </li>


                </div>


                <div class="flex  justify-end pl-36 pt-4">
                    <li>
                        <button id="dropdownDefault" data-dropdown-toggle="dropdown" type="button"
                            class="hover:bg-gray-100 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center"
                            >
                        {{ Auth::user()->email }}
                            <svg
                                class="ml-2 w-4 h-4"
                                aria-hidden="true"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            >

                            </path>
                            </svg>
                        </button>
                            <div id="dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                                    <li>
                                        <a href="{{route('users.index')}}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">My Posts</a>
                                    </li>
                                    <li>
                                        <a href="{{route('popularposts.index')}}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Popular and Most Liked Posts</a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')"
                                                            onclick="event.preventDefault();
                                                                this.closest('form').submit();"
                                                                >
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                    </li>
                </div>
                @else
                <div class="flex md:flex-row md:space-x-8 mt-5 absolute right-20">
                    <li>
                        <a href="{{ route('login') }}"
                           class="hover:bg-gray-100 block py-2 pr-4 pl-3 text-center inline-flex items-center rounded-lg  @if(Route::currentRouteName() === 'login') current-page @endif" >
                            Login
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('register') }}"
                           class="hover:bg-gray-100 block py-2 pr-4 pl-3 text-center inline-flex items-center rounded-lg  @if(Route::currentRouteName() === 'register') current-page @endif" >
                            Register
                        </a>
                    </li>
                </div>
                @endauth
            </ul>
        </div>
    </div>
</nav>
