@extends('components.layouts.app')

@section('content')
    <x-navbar/>

    <section class="relative min-h-screen bg-cover bg-center flex items-center justify-center"
             style="background-image: url('{{ asset('media/hero.jpg') }}');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/60"></div>

        <!-- Content -->
        <div class="relative text-center px-4 sm:px-6 lg:px-8">
            <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6">
                {{ __('welcome.hero.main') }}
            </h1>

            <p class="max-w-md mx-auto text-xl text-gray-200 mb-8">
                {{ __('welcome.hero.sub') }}
            </p>

            <div class="flex justify-center gap-4">
                @guest
                    <a href="{{ getLocalizedURL('auth.register') }}"
                       class="inline-flex items-center justify-center px-6 py-3 bg-primary-500 text-white rounded-lg hover:bg-primary-700 transition-colors">
                        {{ __('welcome.get_started') }}
                    </a>
                @endguest
                <a href="{{ getLocalizedURL('recipes') }}"
                   class="inline-flex items-center justify-center px-6 py-3 bg-white text-primary-500 rounded-lg hover:bg-gray-100 transition-colors">
                    {{ __('welcome.explore') }}
                </a>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                    {{ __('welcome.steps.title') }}
                </h2>
                <p class="mt-4 max-w-md mx-auto text-lg text-gray-600">
                    {{ __('welcome.steps.subtitle') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-12 text-primary-500 mb-4 mx-auto">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900">{{ __('welcome.steps.share.title') }}</h3>
                    <p class="mt-2 text-gray-600">{{ __('welcome.steps.share.desc') }}</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-12 text-primary-500 mb-4 mx-auto">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900">{{ __('welcome.steps.discover.title') }}</h3>
                    <p class="mt-2 text-gray-600">{{ __('welcome.steps.discover.desc') }}</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-12 text-primary-500 mb-4 mx-auto">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900">{{ __('welcome.steps.join.title') }}</h3>
                    <p class="mt-2 text-gray-600">{{ __('welcome.steps.join.desc') }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">{{ __('welcome.featured.title') }}</h2>
                <p class="mt-2 max-w-md mx-auto text-lg text-gray-600">
                    {{ __('welcome.featured.subtitle') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @for ($i = 0; $i < 3; $i++)
                    <article class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <img src="{{ asset('media/hero.jpg') }}" alt="Recipe Image" class="w-full h-64 object-cover">

                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                {{ __('welcome.featured.recipe_title') }}
                            </h3>

                            <div class="flex items-center justify-between text-sm text-gray-600">
                                <span>{{ __('welcome.featured.by') }}</span>
                                <span>{{ __('welcome.featured.time') }}</span>
                            </div>

                            <p class="mt-4 text-gray-600 line-clamp-2">
                                {{ __('welcome.featured.description') }}
                            </p>

                            <div class="mt-6 flex justify-between items-center">
                                <div class="flex gap-1 items-center">
                                    <span class="text-primary-500">4.9</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-5 text-primary-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>
                                    </svg>
                                </div>

                                <a href="#"
                                   class="inline-flex items-center px-4 py-2 bg-primary-500 text-white rounded-md hover:bg-primary-700 transition-colors">
                                    {{ __('welcome.view_recipe') }}
                                </a>
                            </div>
                        </div>
                    </article>
                @endfor
            </div>

            <div class="mt-8 text-center">
                <a href="{{ getLocalizedURL('recipes') }}"
                   class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-900 rounded-lg hover:bg-gray-200 transition-colors">
                    {{ __('welcome.browse_more') }}
                </a>
            </div>
        </div>
    </section>

    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">{{ __('welcome.testimonials.title') }}</h2>
                <p class="mt-2 max-w-md mx-auto text-lg text-gray-600">
                    {{ __('welcome.testimonials.subtitle') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @for ($i = 0; $i < 2; $i++)
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <blockquote class="mb-6">
                            <p class="text-xl text-gray-700 italic mb-4">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae consectetur error fugit...
                            </p>

                            <footer class="flex items-center justify-start space-x-4">
                                <img src="{{ asset('media/logo-mini.png') }}"
                                     alt="Avatar" class="w-12 h-12 rounded-full object-cover border-2 border-white">
                                <div class="space-y-1">
                                    <h3 class="font-semibold text-gray-900">{{ fake()->name() }}</h3>
                                    <p class="text-sm text-gray-600">{{ fake()->jobTitle() }}</p>
                                </div>
                            </footer>
                        </blockquote>
                    </div>
                @endfor
            </div>
        </div>
    </section>
@endsection
