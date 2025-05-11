@extends('layouts.app')

@section('content')
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
                    <svg class="mx-auto h-12 w-12 text-orange-500 mb-4"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 13h6v6H9V13z M12 3v2m-3 4h6m0 0l-3 3m3-3l3-3"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900">Share Your Recipes</h3>
                    <p class="mt-2 text-gray-600">Upload photos and share your cooking creations with the community.</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                    <svg class="mx-auto h-12 w-12 text-orange-500 mb-4"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 11v7a2 2 0 0 1-2 2H10a2 2 0 0 1-2-2V11m10-4V9a2 2 0 0 1-2-2H6a2 2 0 0 1-2 2v6a2 2 0 0 1 2 2h6m4-2h8m0 0v4m0-4L12 3m4 5v14m0-14V19m-4-4h4m-4 4c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900">Discover Recipes</h3>
                    <p class="mt-2 text-gray-600">Browse thousands of recipes shared by food enthusiasts.</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                    <svg class="mx-auto h-12 w-12 text-orange-500 mb-4"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 0 0-2 2v18a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2z"/>
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
                                <div class="flex gap-2">
                                    <span class="text-orange-500">4.9</span>
                                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 15l-4-4 8-8 1.5 1.5L10 12l-5.5 5.5z"/>
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
@endsection
