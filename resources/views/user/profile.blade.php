@extends('components.layouts.app')

@php
    if (Route::is('profile')) $title = 'Profile';
    else $title = $user->name . "'s Profile";
@endphp

@section('page.title', $title)

@section('content')
    <div>
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
                <div class="bg-white rounded-lg md:p-4">
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
                        <div class="grid grid-cols-1 gap-y-5">
                            @foreach($recipes as $recipe)
                                <x-recipe-card :$recipe>
                                    <x-slot:buttons>
                                        @canany(['update', 'delete'], $recipe)
                                            <div class="flex items-center gap-1 flex-shrink-0">
                                                {{-- Edit Button --}}
                                                <a href="{{ route('recipe.edit', compact('recipe')) }}"
                                                   class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors"
                                                   title="Edit Recipe">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                         viewBox="0 0 24 24" stroke-width="1.5"
                                                         stroke="currentColor" class="size-4">
                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                                                    </svg>
                                                </a>

                                                {{-- Delete Button --}}
                                                <form action="{{ route('recipe.delete', compact('recipe')) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                            onclick="return confirm('Are you sure you want to delete this recipe?')"
                                                            class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors cursor-pointer"
                                                            title="Delete Recipe">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             fill="none"
                                                             viewBox="0 0 24 24" stroke-width="1.5"
                                                             stroke="currentColor" class="size-4">
                                                            <path stroke-linecap="round"
                                                                  stroke-linejoin="round"
                                                                  d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        @endcanany
                                    </x-slot:buttons>
                                </x-recipe-card>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-600 text-sm">No recipes yet</p>
                    @endif
                </div>
                {{ $recipes->links() }}
            </div>
        </x-profile>
    </div>
@endsection
