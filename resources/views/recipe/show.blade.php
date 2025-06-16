@extends('components.layouts.app')

@section('page.title', $recipe->title)

@section('content')
    <x-navbar/>

    <main class="min-h-screen flex items-start justify-center">
        <div class="max-w-7xl w-full min-h-screen bg-white/90 shadow-md p-4 backdrop-blur-sm">
            <div class="relative w-full mb-6 md:mb-10">
                <div class="swiper relative w-full aspect-[4/3] md:aspect-[16/5] rounded-lg overflow-hidden">
                    <!-- Slides -->
                    <div class="swiper-wrapper">
                        @foreach ($recipe->images as $image)
                            <div class="swiper-slide flex justify-center items-center bg-gray-50">
                                <img
                                    src="{{ $image->path }}"
                                    alt="Recipe image"
                                    class="w-full h-full object-contain"
                                />
                            </div>
                        @endforeach
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>
                </div>

            </div>

            <!-- Main Content -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-6 mb-4 md:mb-6">
                <!-- Left Column: Title and Description -->
                <div class="md:col-span-9 space-y-6">
                    <!-- Title and Buttons -->
                    <div
                        class="flex flex-col md:flex-row sm:flex-row sm:justify-between md:justify-between md:items-center md:gap-4 gap-6 mb-4 text-left px-4 border-b-2 border-b-gray-200 md:pb-7 pb-5">
                        <div class="">
                            <h2 class="text-xl md:text-3xl font-bold text-primary-800">{{ $recipe->title }}</h2>
                        </div>

                        <livewire:buttons.recipe-action-buttons :$recipe/>
                    </div>

                    <!-- Description -->
                    <div class="p-4">
                        <h3 class="text-base md:text-md font-semibold text-primary-800 mb-6">{{ __('recipe/show.description') }}</h3>
                        <div class="prose max-w-fit">
                            {!! Str::markdown($recipe->description) !!}
                        </div>
                    </div>
                </div>

                <!-- Right Column: Author + Ingredients -->
                <div class="md:col-span-3 space-y-4">
                    <!-- Right Column: Author and Info Section -->
                    <div class="md:col-span-3 space-y-4 sticky top-5">

                        <!-- Author Info -->
                        <div class="rounded-lg p-4 shadow-sm">
                            <a href="{{ getLocalizedURL('user.tag-profile', $recipe->author) }}" title="{{ __('recipe/show.go_to_profile') }}"
                               class="flex items-center space-x-4 border-b-2 border-b-gray-100 pb-5">
                                <!-- Avatar -->
                                <img src="{{ $recipe->author->avatar }}" alt="{{ $recipe->author->name }}"
                                     class="size-11 rounded-full object-cover">

                                <!-- Name and Username -->
                                <div>
                                    <h3 class="text-base font-semibold text-primary-800">
                                        {{ $recipe->author->name }}
                                    </h3>
                                    <p class="text-sm text-gray-600">{{ '@'. $recipe->author->username }}</p>
                                </div>
                            </a>

                            <div class="pt-5 space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-primary-900">{{ __('recipe/show.views') }}</span>
                                    <span class="font-medium text-[#3A883E]">{{ $recipe->views }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-primary-900">{{ __('recipe/show.uploaded') }}</span>
                                    <span
                                        class="font-medium text-[#3A883E]">{{ $recipe->created_at->translatedFormat('d M, Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Ingredients -->
                        <div class="rounded-lg p-3 md:p-4 shadow-sm">
                            <h3 class="text-base md:text-lg font-semibold text-primary-800 mb-4">
                                {{ __('recipe/show.ingredients.title') }}
                            </h3>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach($recipe->ingredients as $ingredient)
                                    <a href="{{ getLocalizedURL('recipe.by-ingredient', compact('ingredient')) }}"
                                       class="px-2 py-1 text-sm text-center bg-[#408D45]/10 text-[#408D45] rounded-md hover:bg-[#408D45]/20 transition-colors cursor-pointer">
                                        {{ $ingredient->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
