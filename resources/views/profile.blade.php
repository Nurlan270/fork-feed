@extends('layouts.app')

@section('page.title', 'Profile')

@section('content')
    <x-navbar/>

    <main class="max-h-screen flex items-start justify-center">
        <div class="max-w-7xl w-full bg-white/90 shadow-md p-4 backdrop-blur-sm">
            <div class="relative w-full mb-6 md:mb-10">
                <div class="relative w-full mb-6 md:mb-10">
                    <!-- Banner -->
                    <div class="group relative">
                        <img src="{{ asset('media/recipe-create.jpg') }}" alt="Profile Banner"
                             class="w-full h-40 md:h-48 rounded-lg object-cover">
                    </div>

                    <!-- Avatar -->
                    <div class="absolute -bottom-6 left-4">
                        <img src="{{ $user->avatar }}" alt="Profile Avatar"
                             class="w-16 h-16 md:w-20 md:h-20 rounded-full border-4 border-white object-cover">
                    </div>
                </div>
            </div>

            <!-- Name and username -->
            <div class="flex justify-between items-center mb-6 text-left px-4">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-primary-800">{{ $user->name }}</h2>
                    <p class="text-sm md:text-base text-primary-900">{{ '@' . $user->username }}</p>
                </div>

                <livewire:subscription-button :user="$user"/>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-6 mb-4 md:mb-6">
                <!-- Left Column: Profile, Bookmarks, Ingredients -->
                <div class="md:col-span-3 space-y-4">
                    <!-- Profile Information -->
                    <div class="bg-white rounded-lg p-4 shadow-sm">
                        <h3 class="text-base md:text-lg font-semibold text-primary-800">
                            Profile Information
                        </h3>
                        <div class="grid grid-cols-3 gap-2 md:gap-4 text-center py-6 border-b-2 border-b-gray-200">
                            <div>
                    <span class="block text-xl md:text-2xl font-bold text-[#408D45]">
                        {{ $user->recipes()->count() }}
                    </span>
                                <span class="block text-xs md:text-sm text-primary-900">Recipes</span>
                            </div>
                            <div>
                    <span class="block text-xl md:text-2xl font-bold text-[#408D45]">
                        {{ $user->followers->count() }}
                    </span>
                                <span class="block text-xs md:text-sm text-primary-900">Followers</span>
                            </div>
                            <div>
                    <span class="block text-xl md:text-2xl font-bold text-[#408D45]">
                        {{ $user->following->count() }}
                    </span>
                                <span class="block text-xs md:text-sm text-primary-900">Following</span>
                            </div>
                        </div>
                        <div class="flex justify-between mt-5">
                            <span class="text-primary-900">Joined</span>
                            <span class="font-medium text-[#3A883E]">{{ $user->created_at->format('M, Y') }}</span>
                        </div>
                    </div>

                    <!-- Bookmarks -->
                    {{--                    <div class="bg-white rounded-lg p-3 md:p-4 shadow-sm">--}}
                    {{--                        <h3 class="text-base md:text-lg font-semibold text-primary-800 mb-5">--}}
                    {{--                            Bookmarks--}}
                    {{--                        </h3>--}}
                    {{--                        <div class="grid grid-cols-2 gap-2">--}}
                    {{--                            <img src="" alt="Recipe" class="w-full h-32 md:h-44 rounded-lg object-cover">--}}
                    {{--                            <img src="" alt="Recipe" class="w-full h-32 md:h-44 rounded-lg object-cover">--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    <!-- Most Used Ingredients -->
                    <div class="bg-white rounded-lg p-3 md:p-4 shadow-sm">
                        <h3 class="text-base md:text-lg font-semibold text-primary-800 mb-4">
                            Most used ingredients
                        </h3>
                        @if($ingredients->isNotEmpty())
                            <div class="grid grid-cols-2 gap-2">
                                @foreach($ingredients as $ingredient)
                                    <a class="px-2 py-1 text-sm text-center bg-[#408D45]/10 text-[#408D45] rounded-md hover:bg-[#408D45]/20 transition-colors cursor-pointer">
                                        {{ $ingredient->name }} ・ {{ $ingredient->usage_count }}
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <p class="text-center text-gray-600 text-sm">No ingredients used yet.</p>
                        @endif
                    </div>
                </div>

                <!-- Right Column: Recipes -->
                <div class="md:col-span-9">
                    <div class="bg-white rounded-lg p-3 md:p-4">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-base md:text-lg font-semibold text-primary-800">
                                Recipes
                            </h3>
                            @if(auth()->id() === $user->id)
                                <a href="{{ route('recipe.create') }}"
                                   class="flex items-center gap-x-2 px-3 py-2 md:px-4 md:py-2 text-xs md:text-sm bg-primary-500 text-white rounded-md hover:bg-primary-700 transition-colors cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/>
                                    </svg>
                                    <span>Upload Recipe</span>
                                </a>
                            @endif
                        </div>

                        @if($user->recipes->isNotEmpty())
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                @foreach($user->recipes as $recipe)
                                    <div
                                        class="group relative rounded-lg overflow-hidden cursor-pointer hover:opacity-90 transition-opacity">
                                        <img src="{{ Storage::url('recipe-images/'.$recipe->images->first()->name) }}"
                                             alt="Recipe"
                                             class="w-full h-48 md:h-64 object-cover">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-gray-900/60 via-transparent to-transparent z-10"></div>
                                        <div
                                            class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors z-20"></div>
                                        <div class="absolute bottom-3 left-3 z-30 text-white">
                                            <h4 class="font-medium text-sm mb-1 drop-shadow">{{ $recipe->title }}</h4>
                                            <p class="text-xs drop-shadow">{{ $recipe->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            @if(Route::is('profile'))
                                <p class="text-center text-gray-600 text-sm">You haven’t shared any recipes yet.</p>
                            @else
                                <p class="text-center text-gray-600 text-sm">This user hasn’t shared any recipes
                                    yet.</p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
