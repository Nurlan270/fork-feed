<nav class="bg-white border-gray-200 fixed top-0 left-0 right-0 z-50"
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
                <!-- Search Bar Container -->
                <div
                    class="flex items-center bg-white/80 border border-gray-200 rounded-full px-2 cursor-pointer me-3 group hover:border-primary-500 transition-colors"
                    @click.stop="$dispatch('mary-search-open')">
                    <!-- Search Icon -->
                    <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-gray-600 transition-colors" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>

                    <span
                        class="flex-1 text-gray-400 text-sm py-2 mx-2 group-hover:text-gray-600 cursor-pointer transition-colors">
                        {{ __('navbar.spotlight.button_placeholder') }}
                    </span>

                    <!-- Shortcut Buttons Container - Hidden on small screens -->
                    <div class="hidden sm:flex items-center space-x-1">
                        <!-- First Shortcut Button -->
                        <div
                            class="w-5 h-5 bg-gray-100 border border-gray-200 text-gray-500 rounded flex items-center justify-center">
                            ⌘
                        </div>

                        <!-- Second Shortcut Button -->
                        <div
                            class="w-5 h-5 bg-gray-100 border border-gray-200 text-gray-500 rounded flex items-center justify-center">
                            K
                        </div>
                    </div>
                </div>

                <a href="{{ getLocalizedURL('user.chats') }}"
                   class="text-gray-500 me-3 rounded-full p-1.5 hover:bg-gray-100 transition-colors cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z"/>
                    </svg>
                </a>

                <button type="button"
                        class="flex relative text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300"
                        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                        data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full cursor-pointer" src="{{ auth()->user()->avatar }}" alt="Avatar">
                    @if(!auth()->user()->hasVerifiedEmail())
                        <span class="size-3 bg-yellow-300 rounded-full absolute -top-0.5 -right-0.5"></span>
                    @endif
                </button>
                <!-- Dropdown menu -->
                <div
                    class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm max-w-64"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900">{{ auth()->user()->name }}</span>
                        <span
                            class="block text-sm text-gray-500 truncate">{{ '@'.auth()->user()->username }}</span>
                    </div>

                    @if(!auth()->user()->hasVerifiedEmail())
                        <div class="px-4 py-3 bg-yellow-50 border-b border-yellow-100">
                            <div class="flex items-start gap-x-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor"
                                     class="size-5 text-yellow-600 mt-0.5 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                                </svg>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-yellow-800">{{ __('navbar.verify_email.title') }}</p>
                                    <p class="text-xs text-yellow-700 mt-1">{{ __('navbar.verify_email.message') }}</p>
                                    <form action="{{ route('verification.send') }}" method="POST" class="mt-2">
                                        @csrf
                                        <button type="submit"
                                                class="text-xs font-medium text-yellow-800 hover:text-yellow-900 underline hover:no-underline cursor-pointer text-left">
                                            {{ __('navbar.verify_email.button') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

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
                    <a href="{{ getLocalizedURL('recipes') }}"
                       class="block py-2 px-3 text-gray-900 rounded-sm
                              md:p-0 md:bg-transparent md:hover:bg-transparent
                              hover:bg-gray-100
                              hover:text-primary-700
                              {{ markRoute('explore', 'text-white bg-primary-700 md:text-primary-700') }}">
                        {{ __('navbar.recipes') }}
                    </a>
                </li>
                <li>
                    <a href="{{ getLocalizedURL('ingredients') }}"
                       class="block py-2 px-3 text-gray-900 rounded-sm
                              md:p-0 md:bg-transparent md:hover:bg-transparent
                              hover:bg-gray-100
                              hover:text-primary-700
                              {{ markRoute('explore', 'text-white bg-primary-700 md:text-primary-700') }}">
                        {{ __('navbar.ingredients') }}
                    </a>
                </li>
                <li>
                    <a href="{{ getLocalizedURL('about-us') }}"
                       class="block py-2 px-3 text-gray-900 rounded-sm
                              md:p-0 md:bg-transparent md:hover:bg-transparent
                              hover:bg-gray-100
                              hover:text-primary-700
                              {{ markRoute('about-us', 'text-white bg-primary-700 md:text-primary-700') }}">
                        {{ __('navbar.about') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
