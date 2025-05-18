@extends('layouts.app')

@section('content')
    <x-navbar/>

    <section class="relative min-h-screen bg-cover bg-center flex items-center justify-center"
             style="background-image: url('{{ asset('media/hero.jpg') }}');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/60"></div>

        <!-- Content -->
        <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                Share Your Passion For Food
            </h1>

            <p class="max-w-md mx-auto text-xl text-gray-200 mb-8">
                Discover, share, and enjoy recipes with food enthusiasts worldwide
            </p>

            <div class="flex justify-center gap-4">
                @guest
                    <a href="{{ route('auth.register') }}"
                       class="inline-flex items-center justify-center px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors">
                        Get Started
                    </a>
                @endguest
                <a href=""
                   class="inline-flex items-center justify-center px-6 py-3 bg-white text-orange-500 rounded-lg hover:bg-gray-100 transition-colors">
                    Explore Recipes
                </a>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">How ForkFeed Works</h2>
                <p class="mt-4 max-w-md mx-auto text-lg text-gray-600">
                    Join our community of food enthusiasts and start sharing your favorite recipes today!
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-orange-500 mb-4 mx-auto">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900">Share Your Recipes</h3>
                    <p class="mt-2 text-gray-600">Upload photos and share your cooking creations with the community.</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-orange-500 mb-4 mx-auto">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900">Discover Recipes</h3>
                    <p class="mt-2 text-gray-600">Browse thousands of recipes shared by food enthusiasts.</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-orange-500 mb-4 mx-auto">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900">Join Communities</h3>
                    <p class="mt-2 text-gray-600">Connect with fellow food lovers and join recipe discussions.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Today's Featured Recipes</h2>
                <p class="mt-2 max-w-md mx-auto text-lg text-gray-600">
                    Handpicked recipes from our passionate community members
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @for ($i = 0; $i < 3; $i++)
                    <article class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <img src="{{ asset('media/hero.jpg') }}" alt="Recipe Image" class="w-full h-64 object-cover">

                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                Summer Vegetable Pasta
                            </h3>

                            <div class="flex items-center justify-between text-sm text-gray-600">
                                <span>By Sarah Johnson</span>
                                <span>15 mins</span>
                            </div>

                            <p class="mt-4 text-gray-600 line-clamp-2">
                                Fresh vegetables tossed in homemade pesto sauce, served with whole wheat pasta...
                            </p>

                            <div class="mt-4 flex justify-between items-center">
                                <div class="flex gap-1 items-center">
                                    <span class="text-orange-500">4.9</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-orange-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                    </svg>
                                </div>

                                <a href="#"
                                   class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 transition-colors">
                                    View Recipe
                                </a>
                            </div>
                        </div>
                    </article>
                @endfor
            </div>

            <div class="mt-8 text-center">
                <a href=""
                   class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-900 rounded-lg hover:bg-gray-200 transition-colors">
                    Browse More Recipes
                </a>
            </div>
        </div>
    </section>

    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Our Community Loves ForkFeed</h2>
                <p class="mt-2 max-w-md mx-auto text-lg text-gray-600">
                    Real stories from passionate food enthusiasts who found their cooking community
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @for ($i = 0; $i < 2; $i++)
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <blockquote class="mb-6">
                            <p class="text-xl text-gray-700 italic mb-4">
                                Fork Feed - Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae consectetur
                                error fugit harum laboriosam nobis quidem recusandae sed. Animi, vitae!
                            </p>

                            <footer class="flex items-center justify-start space-x-4">
                                <img src="https://avatar.iran.liara.run/public/{{ Arr::random(['boy', 'girl']) }}"
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

    <x-footer/>
@endsection
