@extends('layouts.app')

@php
    if (Route::is('profile')) $title = 'Profile';
    else $title = $user->name . "'s Profile";
@endphp

@section('page.title', $title)

@section('content')
    <x-navbar/>

    <x-profile :$user>
        <x-slot:sidebar>
            @if($ingredients->isNotEmpty())
                <div class="bg-white rounded-lg p-3 md:p-4 shadow-sm">
                    <h3 class="text-base md:text-lg font-semibold text-primary-800 mb-4">
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
            @endif
        </x-slot:sidebar>

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
                            <span class="hide-xs">Upload Recipe</span>
                        </a>
                    @endif
                </div>

                @if($recipes->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        @foreach($recipes as $recipe)
                            <div onclick="window.location='{{ route('recipe.show', compact('recipe')) }}'"
                                 class="group relative rounded-lg overflow-hidden hover:opacity-90 transition-opacity cursor-pointer">

                                <!-- Image -->
                                <img src="{{ Storage::url('recipe-images/'.$recipe->images->first()->name) }}"
                                     alt="Recipe"
                                     class="w-full h-48 md:h-64 object-cover pointer-events-none">

                                <!-- Gradient overlays -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-gray-900/60 via-transparent to-transparent z-10"></div>
                                <div
                                    class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors z-20"></div>

                                <!-- Recipe text -->
                                <div class="absolute bottom-3 left-3 w-full z-30 text-white pe-6">
                                    <h4 class="font-medium text-sm mb-1 drop-shadow">{{ $recipe->title }}</h4>

                                    <div class="flex items-center justify-between text-xs drop-shadow">
                                        <p>{{ $recipe->created_at->diffForHumans() }}</p>

                                        <p class="flex items-center gap-x-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4"
                                                 fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                                <path fill-rule="evenodd"
                                                      d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                            <span>{{ $recipe->views }}</span>
                                        </p>
                                    </div>
                                </div>

                                @canany(['update', 'delete'], $recipe)
                                    <!-- Dropdown button: hidden by default, shown on hover -->
                                    <div
                                        class="absolute top-2 right-2 z-40 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                        <div class="relative">
                                            <button onclick="event.stopPropagation()"
                                                    id="dropdownMenuIconButton-{{ $loop->index }}"
                                                    data-dropdown-toggle="dropdownDots-{{ $loop->index }}"
                                                    class="inline-flex items-center p-2 text-xs text-white bg-black/30 rounded-md hover:bg-black/50 transition-colors focus:outline-none focus:ring-0 cursor-pointer"
                                                    type="button">
                                                <svg class="w-4 h-4" aria-hidden="true"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     fill="currentColor" viewBox="0 0 4 15">
                                                    <path
                                                        d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                                </svg>
                                            </button>

                                            <div id="dropdownDots-{{ $loop->index }}"
                                                 class="z-50 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-28 dark:bg-gray-700 dark:divide-gray-600 absolute right-0 mt-2">
                                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                                    aria-labelledby="dropdownMenuIconButton-{{ $loop->index }}">
                                                    <li>
                                                        <a href="{{ route('recipe.edit', compact('recipe')) }}"
                                                           class="flex items-center gap-x-3 w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                 viewBox="0 0 24 24" stroke-width="1.5"
                                                                 stroke="currentColor" class="size-4">
                                                                <path stroke-linecap="round"
                                                                      stroke-linejoin="round"
                                                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                                                            </svg>
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form
                                                            action="{{ route('recipe.delete', compact('recipe')) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="flex items-center gap-x-3 w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                     fill="none"
                                                                     viewBox="0 0 24 24" stroke-width="1.5"
                                                                     stroke="currentColor" class="size-4">
                                                                    <path stroke-linecap="round"
                                                                          stroke-linejoin="round"
                                                                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                                </svg>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endcanany
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-600 text-sm">No recipes yet</p>
                @endif
            </div>
            {{ $recipes->links() }}
        </div>
    </x-profile>
@endsection
