<nav class="bg-white border-gray-200 fixed top-0 left-0 right-0 z-50 transition-transform duration-300 ease-in-out"
     id="navbar">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ getLocalizedURL('welcome') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('media/logo.png') }}" class="h-8" alt="ForkFeed Logo"/>
        </a>

        @guest
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <a href="{{ getLocalizedURL('auth.register') }}"
                   class="text-white bg-primary-500 hover:bg-primary-700 transition-colors focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 text-center">
                    {{ __('navbar.get_started') }}
                </a>
            </div>
        @endguest

        @auth
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <button type="button"
                        class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300"
                        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                        data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full cursor-pointer" src="{{ auth()->user()->avatar }}" alt="Avatar">
                </button>
                <!-- Dropdown menu -->
                <div
                    class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900">{{ auth()->user()->name }}</span>
                        <span
                            class="block text-sm text-gray-500 truncate">{{ '@'.auth()->user()->username }}</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="{{ getLocalizedURL('recipe.create') }}"
                               class="flex items-center gap-x-2 ps-4 pe-6 py-2 text-sm cursor-pointer text-gray-700 hover:bg-gray-100 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/>
                                </svg>
                                <span>{{ __('navbar.upload_recipe') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ getLocalizedURL('user.profile') }}"
                               class="flex items-center gap-x-2 px-4 py-2 text-sm cursor-pointer text-gray-700 hover:bg-gray-100 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                </svg>
                                <span>{{ __('navbar.profile') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ getLocalizedURL('user.bookmarks') }}"
                               class="flex items-center gap-x-2 px-4 py-2 text-sm cursor-pointer text-gray-700 hover:bg-gray-100 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z"/>
                                </svg>
                                <span>{{ __('navbar.bookmarks') }}</span>
                            </a>
                        </li>
                        <li class="pb-2">
                            <a href="{{ getLocalizedURL('user.settings') }}"
                               class="flex items-center gap-x-2 px-4 py-2 text-sm cursor-pointer text-gray-700 hover:bg-gray-100 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>
                                <span>{{ __('navbar.settings') }}</span>
                            </a>
                        </li>
                        <li class="border-t border-gray-100 pt-2">
                            <form id="logout" class="hidden" action="{{ getLocalizedURL('logout') }}"
                                  method="POST">@csrf</form>
                            <button form="logout" type="submit"
                                    class="flex items-center gap-x-2 px-4 py-2 w-full text-left cursor-pointer text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15"/>
                                </svg>
                                <span>{{ __('navbar.logout') }}</span>
                            </button>
                        </li>
                    </ul>
                </div>
                <button data-collapse-toggle="navbar-user" type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                        aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">{{ __('navbar.open_menu') }}</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
            </div>
        @endauth

        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
            <ul class="flex flex-col gap-y-2 font-medium p-2 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
                <li>
                    <a href="{{ getLocalizedURL('explore') }}"
                       class="block py-2 px-3 text-gray-900 rounded-sm
                              md:p-0 md:bg-transparent md:hover:bg-transparent
                              hover:bg-gray-100
                              hover:text-primary-700
                              {{ markRoute('explore', 'text-white bg-primary-700 md:text-primary-700') }}">
                        {{ __('navbar.explore') }}
                    </a>
                </li>
                <li>
                    <a href="{{ getLocalizedURL('welcome') }}"
                       class="block py-2 px-3 text-gray-900 rounded-sm
                              md:p-0 md:bg-transparent md:hover:bg-transparent
                              hover:bg-gray-100
                              hover:text-primary-700
                              {{ markRoute('#', 'text-white bg-primary-700 md:text-primary-700') }}">
                        {{ __('navbar.about') }}
                    </a>
                </li>
                <li>
                    <a href="{{ getLocalizedURL('welcome') }}"
                       class="block py-2 px-3 text-gray-900 rounded-sm
                              md:p-0 md:bg-transparent md:hover:bg-transparent
                              hover:bg-gray-100
                              hover:text-primary-700
                              {{ markRoute('#', 'text-white bg-primary-700 md:text-primary-700') }}">
                        {{ __('navbar.services') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
