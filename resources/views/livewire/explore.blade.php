@use(Illuminate\Support\Carbon)
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <h2 class="text-3xl font-semibold">Explore Recipes</h2>

        <div class="flex w-full max-w-lg">
            <!-- Search Input with loading spinner -->
            <div class="relative w-full">
                <input
                    wire:model.live="search"
                    type="text"
                    placeholder="Search recipes..."
                    class="w-full pr-10 px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-primary-500 transition-all"
                />

                <!-- Loading Spinner -->
                <svg wire:loading.delay
                     viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none"
                     class="absolute right-2 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 animate-spin">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g fill="#000000" fill-rule="evenodd" clip-rule="evenodd">
                            <path d="M8 1.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM0 8a8 8 0 1116 0A8 8 0 010 8z"
                                  opacity=".2"></path>
                            <path
                                d="M7.25.75A.75.75 0 018 0a8 8 0 018 8 .75.75 0 01-1.5 0A6.5 6.5 0 008 1.5a.75.75 0 01-.75-.75z"></path>
                        </g>
                    </g>
                </svg>
            </div>

            <!-- Sort Dropdown -->
            <select
                wire:model.live="sort"
                class="pe-8 py-2 border-t border-b border-r border-gray-300 rounded-r-md focus:outline-none focus:ring-1 focus:ring-primary-500 transition-all"
            >
                <option selected disabled>Sort By</option>
                <option value="popular">Popular</option>
                <option value="liked">Most Liked</option>
                <option value="newest">Newest</option>
                <option value="oldest">Oldest</option>
            </select>
        </div>
    </div>

    @if($recipes->isNotEmpty())
        <!-- Featured Recipes -->
        <div class="mt-8 grid gap-6 grid-cols-1 md:grid-cols-2">
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

                                <button
                                    class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors cursor-pointer"
                                    title="Delete Recipe"
                                    wire:click="deleteRecipe({{ $recipe->id }})"
                                    wire:confirm="Are you sure you want to delete this recipe?">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24" stroke-width="1.5"
                                         stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                    </svg>
                                </button>
                            </div>
                        @endcanany
                    </x-slot:buttons>
                </x-recipe-card>
            @endforeach
        </div>
        {{ $recipes->links() }}
    @else
        <p class="text-base text-center mt-10 break-words">Nothing found</p>
    @endif
</div>
