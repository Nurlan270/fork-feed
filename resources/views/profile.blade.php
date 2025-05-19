@extends('layouts.app')

@section('page.title', 'Profile')

@section('content')
    <x-navbar/>

    <main class="min-h-screen flex items-center justify-center p-4 bg-cover bg-center bg-no-repeat bg-fixed">
        <div class="max-w-7xl w-full bg-white/90 rounded-lg shadow-md p-4 backdrop-blur-sm">
            <div class="relative w-full mb-6 md:mb-10">
                <img src="{{ asset('media/recipe-create.jpg') }}" alt="Profile Banner"
                     class="w-full h-40 md:h-48 rounded-lg object-cover">
                <div class="absolute -bottom-6 left-4">
                    <img src="{{ auth()->user()->avatar }}" alt="Profile Avatar"
                         class="w-16 h-16 md:w-20 md:h-20 rounded-full border-4 border-white object-cover">
                </div>
            </div>

            <!-- Name and username -->
            <div class="mb-6 text-left pl-4">
                <h2 class="text-2xl md:text-3xl font-bold text-primary-800">{{ auth()->user()->name }}</h2>
                <p class="text-sm md:text-base text-primary-900">{{ '@' . auth()->user()->username }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-6 mb-4 md:mb-6">
                <!-- Left Sidebar -->
                <div class="md:col-span-3 space-y-4">
                    <div class="bg-white rounded-lg p-3 md:p-4 shadow-sm">
                        <h3 class="text-base md:text-lg font-semibold text-primary-800 mb-5">
                            Profile Information
                        </h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-primary-900">Joined</span>
                                <span
                                    class="font-medium text-[#3A883E]">{{ auth()->user()->created_at->format('M, Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg p-3 md:p-4 shadow-sm">
                        <h3 class="text-base md:text-lg font-semibold text-primary-800 mb-5">
                            Statistics
                        </h3>
                        <div class="grid grid-cols-3 gap-2 md:gap-4 text-center">
                            <div>
                                <span
                                    class="block text-xl md:text-2xl font-bold text-[#408D45]">{{ $recipes->count() }}</span>
                                <span class="block text-xs md:text-sm text-primary-900">Recipes</span>
                            </div>
                            <div>
                                <span class="block text-xl md:text-2xl font-bold text-[#408D45]">120</span>
                                <span class="block text-xs md:text-sm text-primary-900">Followers</span>
                            </div>
                            <div>
                                <span class="block text-xl md:text-2xl font-bold text-[#408D45]">250</span>
                                <span class="block text-xs md:text-sm text-primary-900">Following</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Middle Column -->
                <div class="md:col-span-6 space-y-4">
                    <!-- Bookmarks -->
                    <div class="bg-white rounded-lg p-3 md:p-4 shadow-sm">
                        <h3 class="text-base md:text-lg font-semibold text-primary-800 mb-5">
                            Bookmarks
                        </h3>
                        <div class="grid grid-cols-2 gap-2">
                            <img src="" alt="Recipe" class="w-full h-32 md:h-44 rounded-lg object-cover">
                            <img src="" alt="Recipe" class="w-full h-32 md:h-44 rounded-lg object-cover">
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="md:col-span-3 space-y-4">
                    <!-- Categories -->
                    <div class="bg-white rounded-lg p-3 md:p-4 shadow-sm">
                        <h3 class="text-base md:text-lg font-semibold text-primary-800 mb-2">
                            Most used ingredients
                        </h3>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach($ingredients as $ingredient)
                                <a class="px-2 py-1 text-sm text-center bg-[#408D45]/10 text-[#408D45] rounded-md hover:bg-[#408D45]/20 transition-colors cursor-pointer">
                                    {{ $ingredient->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recipes -->
            <div class="bg-white rounded-lg p-3 md:p-4">
                <div class="flex justify-between items-center mb-6 md:mb-4">
                    <h3 class="text-base md:text-lg font-semibold text-primary-800">
                        Recipes
                    </h3>
                    <a href="{{ route('recipe.create') }}"
                       class="px-3 py-1 md:px-4 md:py-2 text-sm bg-primary-500 text-white rounded-md hover:bg-primary-700 transition-colors cursor-pointer">
                        Upload Recipe
                    </a>
                </div>
                @if($recipes->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        @foreach($recipes as $recipe)
                            <div
                                class="group relative rounded-lg overflow-hidden cursor-pointer hover:opacity-90 transition-opacity">
                                <img
                                    src="{{ Storage::url('recipe-images/'.$recipe->images->first()->name) }}"
                                    alt="Recipe"
                                    class="w-full h-48 md:h-64 object-cover">

                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 via-transparent to-transparent z-10"></div>
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors z-20"></div>

                                <div class="absolute bottom-3 left-3 z-30 text-white">
                                    <h4 class="font-medium text-sm mb-1 drop-shadow">{{ $recipe->title }}</h4>
                                    <p class="text-xs drop-shadow">{{ $recipe->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-600 text-sm">You don't have any recipe yet.</p>
                @endif
            </div>
        </div>
    </main>
@endsection
