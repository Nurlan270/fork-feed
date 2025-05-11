<nav class="fixed top-0 left-0 right-0 z-50 bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('welcome') }}" class="text-xl font-bold">
                    <img src="{{ asset('media/logo.png') }}" alt="Logo" class="h-12">
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:block">
                <div class="ml-10 flex space-x-8">
                    <a href="" class="text-gray-600 hover:text-gray-900">Recipes</a>
                    <a href="" class="text-gray-600 hover:text-gray-900">Community</a>
                    <a href="" class="text-gray-600 hover:text-gray-900">About</a>
                </div>
            </div>

            @guest
                <div class="hidden md:block">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('auth.login') }}" class="text-gray-600 hover:text-gray-900">Sign In</a>
                        <a href="{{ route('auth.register') }}" class="inline-flex items-center justify-center px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition-colors">
                            Sign Up
                        </a>
                    </div>
                </div>
            @endguest

            <!-- Profile Section -->
            @auth
                <div class="hidden md:block">
                    <div class="relative">
                        <button id="profileDropdown"
                                class="flex items-center gap-2 px-2 py-2 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors cursor-pointer"
                                aria-expanded="false"
                                aria-haspopup="true">
                            <img src="{{ auth()->user()->avatar }}" alt="Profile" class="w-6 h-6 rounded-full object-cover">
                            <span class="text-sm font-medium">{{ auth()->user()->username }}</span>
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div id="profileDropdownMenu"
                             class="hidden absolute right-0 mt-2 w-40 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5"
                             role="menu"
                             aria-orientation="vertical"
                             aria-labelledby="profileDropdown">
                            <a href="" class="flex items-center gap-2 px-3 py-2 text-md text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                Profile
                            </a>
                            <a href="" class="flex items-center gap-2 px-3 py-2 text-md text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                Settings
                            </a>
                            <a onclick="document.querySelector('form#logout').submit()" class="flex items-center gap-2 px-3 py-2 text-md text-gray-700 hover:bg-gray-100 hover:text-gray-900 cursor-pointer" role="menuitem">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                </svg>
                                Logout
                            </a>
                            <form id="logout" class="hidden" action="{{ route('logout') }}" method="POST">@csrf</form>
                        </div>
                    </div>
                </div>
            @endauth

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button class="menu-btn" aria-label="Toggle mobile menu" aria-expanded="false">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
