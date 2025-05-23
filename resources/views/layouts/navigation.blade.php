<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <!-- <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a> -->
                    <a class="navbar-brand" style="color: black; font-size: 30px;font-weight: 1000; margin-top: 10px;">VOTIFY</a>
                    
                </div>

                <!-- Navigation Links -->

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center  space-x-8 sm:-my-px sm:ms-10 sm:flex">
            @if(Auth::user()->role==1)
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Home') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.election')" :active="request()->routeIs('admin.election')">
                        {{ __('Election') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.candidate')" :active="request()->routeIs('admin.candidate')">
                        {{ __('Candidate') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.voters')" :active="request()->routeIs('admin.voters')">
                        {{ __('Voters') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.result')" :active="request()->routeIs('admin.result')">
                        {{ __('Result') }}
                        </x-nav-link>
                    @else
                    
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('vote.select')" :active="request()->routeIs('vote.select')">
                        {{ __('Vote') }}
                    </x-nav-link>
                    <x-nav-link :href="route('result')" :active="request()->routeIs('result')">
                        {{ __('Result') }}
                    </x-nav-link>
                    @endif
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

        </div>
    </div>


</nav>
