@extends('components.layouts.app')

@section('page.title', 'Bookmarks')

@section('content')
    <div>
        <x-navbar/>

        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
                <h2 class="text-3xl font-semibold">Bookmarks</h2>
            </div>

            @if($bookmarks->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach($bookmarks as $recipe)
                        <x-recipe-card :$recipe :key="$recipe->id">
                            <x-slot:buttons>
                                <div class="flex items-center gap-1 flex-shrink-0">
                                    <button type="submit"
                                            class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors cursor-pointer"
                                            title="Remove Bookmark"
                                            wire:click="removeBookmark({{ $recipe->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                             class="size-4">
                                            <path
                                                d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM20.25 5.507v11.561L5.853 2.671c.15-.043.306-.075.467-.094a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93ZM3.75 21V6.932l14.063 14.063L12 18.088l-7.165 3.583A.75.75 0 0 1 3.75 21Z"/>
                                        </svg>
                                    </button>
                                </div>
                            </x-slot:buttons>
                        </x-recipe-card>
                    @endforeach
                </div>
            @else
                <div class="text-center mt-16">
                    <p class="text-gray-600 text-base mb-2">You haven't bookmarked any recipes yet.</p>
                    <p class="text-gray-600 text-base flex justify-center items-center gap-1">
                        You can do so by clicking
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.5"
                             stroke="currentColor" class="size-3.5 mx-1 text-primary-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z"/>
                        </svg>
                        button on recipes page.
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection
