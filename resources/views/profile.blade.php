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
                <h2 class="text-2xl md:text-3xl font-bold text-[#034628]">{{ auth()->user()->name }}</h2>
                <p class="text-sm md:text-base text-[#1D3325]">{{ '@' . auth()->user()->username }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-6 mb-4 md:mb-6">
                <!-- Left Sidebar -->
                <div class="md:col-span-3 space-y-4">
                    <div class="bg-white rounded-lg p-3 md:p-4 shadow-sm">
                        <h3 class="text-base md:text-lg font-semibold text-[#034628] mb-5">
                            Profile Information
                        </h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-[#1D3325]">Joined</span>
                                <span class="font-medium text-[#3A883E]">{{ auth()->user()->created_at->format('M, Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg p-3 md:p-4 shadow-sm">
                        <h3 class="text-base md:text-lg font-semibold text-[#034628] mb-5">
                            Statistics
                        </h3>
                        <div class="grid grid-cols-3 gap-2 md:gap-4 text-center">
                            <div>
                                <span class="block text-xl md:text-2xl font-bold text-[#408D45]">42</span>
                                <span class="block text-xs md:text-sm text-[#1D3325]">Recipes</span>
                            </div>
                            <div>
                                <span class="block text-xl md:text-2xl font-bold text-[#408D45]">120</span>
                                <span class="block text-xs md:text-sm text-[#1D3325]">Followers</span>
                            </div>
                            <div>
                                <span class="block text-xl md:text-2xl font-bold text-[#408D45]">250</span>
                                <span class="block text-xs md:text-sm text-[#1D3325]">Following</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Middle Column -->
                <div class="md:col-span-6 space-y-4">
                    <!-- Bookmarks -->
                    <div class="bg-white rounded-lg p-3 md:p-4 shadow-sm">
                        <h3 class="text-base md:text-lg font-semibold text-[#034628] mb-5">
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
                        <h3 class="text-base md:text-lg font-semibold text-[#034628] mb-2">
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
                    <h3 class="text-base md:text-lg font-semibold text-[#034628]">
                        Recipes
                    </h3>
                    <a
                        class="px-3 py-1 md:px-4 md:py-2 text-sm bg-[#408D45] text-white rounded-md hover:bg-[#3A883E] transition-colors cursor-pointer">
                        Upload Recipe
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div
                        class="group relative rounded-lg overflow-hidden cursor-pointer hover:opacity-90 transition-opacity">
                        <img src="{{ asset('media/auth-bg.jpg') }}" alt="Recipe" class="w-full h-48 md:h-64 object-cover">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors">
                            <div class="absolute bottom-3 left-3 text-white">
                                <h4 class="font-medium text-sm mb-1 text-[#1D3325]">Summer Pasta</h4>
                                <p class="text-xs text-[#1D3325]">15 minutes ago</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="group relative rounded-lg overflow-hidden cursor-pointer hover:opacity-90 transition-opacity">
                        <img src="{{ asset('media/recipe-create.jpg') }}" alt="Recipe" class="w-full h-48 md:h-64 object-cover">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors">
                            <div class="absolute bottom-3 left-3 text-white">
                                <h4 class="font-medium text-sm mb-1 text-[#1D3325]">Vegan Burger</h4>
                                <p class="text-xs text-[#1D3325]">2 hours ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
