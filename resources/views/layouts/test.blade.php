<nav x-data="{ open: false }" class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('logo/logo-transparent-png.png') }}" class="h-20" alt=" Logo" />

        </a>

        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-search">


            <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-200 rounded-lg gray-200 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700 justify-center">
                <div class=" space-x-8 sm:-my-px sm:ml-10 sm:flex justify-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Home') }}
                    </x-nav-link>
                </div>
                <div class=" space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if(auth()->user()->hasRole('admin'))
                    <x-nav-link :href="route('admin.devices.index')" :active="request()->routeIs('admin.devices.index')">
                        {{ __('Devices') }}
                    </x-nav-link>
                    @elseif(auth()->user()->hasRole('user'))
                    <x-nav-link :href="route('user.devices.index')" :active="request()->routeIs('user.devices.index')">
                        {{ __('Devices') }}
                    </x-nav-link>
                    @else
                    <x-nav-link :href="route('devices.index')" :active="request()->routeIs('devices.index')">
                        {{ __('Devices') }}
                    </x-nav-link>
                    @endif
                </div>

                <div class=" space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if(auth()->user()->hasRole('admin'))
                    <x-nav-link :href="route('admin.manufacturers.index')" :active="request()->routeIs('admin.manufacturers.index')">
                        {{ __('Manufacturers') }}
                    </x-nav-link>
                    @elseif(auth()->user()->hasRole('user'))
                    <x-nav-link :href="route('user.manufacturers.index')" :active="request()->routeIs('user.manufacturers.index')">
                        {{ __('Manufacturers') }}
                    </x-nav-link>
                    @endif
                </div>




                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>


        </div>


        <div x-data="{ open: false }" @keydown.window.escape="open = false" @click.away="open = false" class="relative">
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="absolute top-full left-0 w-screen bg-white shadow-md sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        @if(auth()->user()->hasRole('admin'))
                        <x-responsive-nav-link :href="route('admin.devices.index')" :active="request()->routeIs('admin.devices.index')">
                            {{ __('Devices') }}
                        </x-responsive-nav-link>
                        @elseif(auth()->user()->hasRole('user'))
                        <x-responsive-nav-link :href="route('user.devices.index')" :active="request()->routeIs('user.devices.index')">
                            {{ __('Devices') }}
                        </x-responsive-nav-link>
                        @else
                        <x-responsive-nav-link :href="route('devices.index')" :active="request()->routeIs('devices.index')">
                            {{ __('Devices') }}
                        </x-responsive-nav-link>
                        @endif

                        @if(auth()->user()->hasRole('admin'))
                        <x-responsive-nav-link :href="route('admin.manufacturers.index')" :active="request()->routeIs('admin.manufacturers.index')">
                            {{ __('Manufacturers') }}
                        </x-responsive-nav-link>
                        @elseif(auth()->user()->hasRole('user'))
                        <x-responsive-nav-link :href="route('user.manufacturers.index')" :active="request()->routeIs('user.manufacturers.index')">
                            {{ __('Manufacturers') }}
                        </x-responsive-nav-link>
                        @else
                        <x-responsive-nav-link :href="route('manufacturers.index')" :active="request()->routeIs('manufacturers.index')">
                            {{ __('Manufacturers') }}
                        </x-responsive-nav-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                            </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
