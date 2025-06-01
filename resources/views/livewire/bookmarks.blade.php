<main class="min-h-screen flex items-start justify-center">
    <div class="max-w-7xl w-full min-h-screen bg-white/90 shadow-md p-4 backdrop-blur-sm">
        <div class="bg-white rounded-lg p-3 md:p-4">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-base md:text-2xl font-semibold text-primary-800">
                    Bookmarks
                </h3>
            </div>

            @if($bookmarks->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    @foreach($bookmarks as $recipe)
                        <div wire:key="{{ $recipe->id }}"
                             @click="window.location='{{ route('recipe.show', compact('recipe')) }}'"
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
                            <div class="absolute bottom-3 left-3 w-full z-30 text-white">
                                <h4 class="font-medium text-sm mb-1 drop-shadow">{{ $recipe->title }}</h4>

                                <div class="flex items-center justify-between text-xs drop-shadow pe-6">
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

                            <div title="Remove from Bookmarks"
                                 class="absolute top-2 right-2 z-40 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                <div class="relative">
                                    <button wire:click="removeBookmark({{ $recipe->id }})"
                                            @click.stop
                                            class="inline-flex items-center p-2 text-xs text-white bg-black/30 rounded-md hover:bg-black/50 transition-colors focus:outline-none focus:ring-0 cursor-pointer"
                                            type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                             fill="currentColor" class="size-4">
                                            <path
                                                d="M3.53 2.47a.75.75 0 0 0-1.06 1.06l18 18a.75.75 0 1 0 1.06-1.06l-18-18ZM20.25 5.507v11.561L5.853 2.671c.15-.043.306-.075.467-.094a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93ZM3.75 21V6.932l14.063 14.063L12 18.088l-7.165 3.583A.75.75 0 0 1 3.75 21Z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600 text-base mb-3">You haven’t bookmarked any recipes yet.</p>
                <p class="text-center text-gray-600 text-base flex justify-center items-center gap-1">
                    You can do so by clicking
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.5"
                         stroke="currentColor" class="size-3.5 mx-1 text-primary-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z"/>
                    </svg>
                    button on recipes page.
                </p>
            @endif
        </div>
    </div>
</main>
