<div>
    <div class="w-full mx-auto  2xl:max-w-7xl">
        <div x-data="{ open: false }"
            class="relative flex flex-col w-full px-5 py-2 mx-auto  md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
            <div class="flex flex-row items-center justify-between lg:justify-start">
                <a class="text-lg tracking-tight text-black uppercase focus:outline-none focus:ring lg:text-2xl"
                    href="/">
                    <div class="flex space-x-2 items-center">
                        @if (auth()->user()->jail->logo_path != null)
                            <img src="{{ Storage::url(auth()->user()->jail->logo_path) }}"
                                class="h-16 w-16 object-cover rounded-full" alt="">
                        @else
                            <img src="{{ asset('images/bjmp_logo.png') }}" class="h-16 object-cover w-16"
                                alt="">
                        @endif
                        <div>
                            <h1 class="font-bold font-barlow text-gray-700">
                                {{ auth()->user()->jail->region->name }}</h1>
                            <h1 class="text-sm font-semibold leading-3 text-red-600">
                                {{ auth()->user()->jail->name }}</h1>
                        </div>
                    </div>
                </a>
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-black focus:outline-none focus:text-black md:hidden">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                        </path>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <nav :class="{ 'flex': open, 'hidden': !open }"
                class="flex-col items-center flex-grow hidden md:pb-0 md:flex md:justify-end md:flex-row">
                <a class=" {{ request()->routeIs('admin.dashboard') ? 'text-main font-medium' : '' }} px-2 py-2 text-sm text-gray-500 lg:px-6 md:px-3 hover:text-main lg:ml-auto"
                    href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>
                <a class="{{ request()->routeIs('admin.commits') ? 'text-main font-medium' : '' }} px-2 py-2 text-sm text-gray-500 lg:px-6 md:px-3 hover:text-main"
                    href="{{ route('admin.commits') }}">
                    Commits
                </a>
                <a class="{{ request()->routeIs('admin.hearings') ? 'text-main font-medium' : '' }} px-2 py-2 text-sm text-gray-500 lg:px-6 md:px-3 hover:text-main"
                    href="{{ route('admin.hearings') }}">
                    Hearings
                </a>
                <a class="{{ request()->routeIs('admin.remands') ? 'text-main font-medium' : '' }} px-2 py-2 text-sm text-gray-500 lg:px-6 md:px-3 hover:text-main"
                    href="{{ route('admin.remands') }}">
                    Remands
                </a>
                <a class="{{ request()->routeIs('admin.releases') ? 'text-main font-medium' : '' }} px-2 py-2 text-sm text-gray-500 lg:px-6 md:px-3 hover:text-main"
                    href="{{ route('admin.releases') }}">
                    Releases
                </a>
                <a class="px-2 py-2 text-sm text-gray-500 lg:px-6 md:px-3 hover:text-main" href="#">
                    Latest Issuance
                </a>
                <a class="{{ request()->routeIs('admin.report') ? 'text-main font-medium' : '' }} px-2 py-2 text-sm text-gray-500 lg:px-6 md:px-3 hover:text-main"
                    href="{{ route('admin.report') }}">
                    Reports
                </a>
                <div class="inline-flex items-center gap-2 list-none lg:ml-auto">
                    <div class="relative flex-shrink-0 ml-5" @click.away="open = false" x-data="{ open: false }">
                        <div>

                            <button @click="open = !open" type="button"
                                class="flex bg-white rounded-full focus:outline-none  focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">
                                    Open user menu
                                </span>
                                <img class="object-cover w-12 h-12  border rounded-full"
                                    src="{{ asset('images/sample.png') }}" alt="">
                            </button>
                        </div>

                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95" style="display: none"
                            class="absolute right-0 z-10 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                            tabindex="-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-500" role="menuitem"
                                tabindex="-1" id="user-menu-item-0">
                                Your Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="route('logout')"
                                    onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                    class="block px-4 py-2 text-sm text-gray-500 hover:text-red-700" role="menuitem"
                                    tabindex="-1" id="user-menu-item-2">
                                    Sign out
                                </a>
                            </form>
                        </div>
                    </div>

                </div>
            </nav>
        </div>
    </div>
</div>
