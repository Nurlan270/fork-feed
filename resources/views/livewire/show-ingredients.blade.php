<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <h2 class="text-3xl font-semibold text-primary-800">
            {{ __('ingredients.title') }}
        </h2>

        <div class="flex w-full max-w-lg">
            <!-- Search -->
            <div class="relative w-full">
                <input
                    wire:model.live="search"
                    type="text"
                    placeholder="{{ __('ingredients.search_placeholder') }}"
                    class="w-full pr-10 px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-primary-500 transition-all"
                />
                <!-- Spinner -->
                <svg wire:loading.delay wire:target="search, sort"
                     class="absolute right-2 top-1/2 -translate-y-1/2 w-5 h-5 text-primary-400 animate-spin"
                     viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none">
                    <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                        <path d="M8 1.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM0 8a8 8 0 1116 0A8 8 0 010 8z" opacity=".2"/>
                        <path d="M7.25.75A.75.75 0 018 0a8 8 0 018 8 .75.75 0 01-1.5 0A6.5 6.5 0 008 1.5a.75.75 0 01-.75-.75z"/>
                    </g>
                </svg>
            </div>

            <!-- Sort Dropdown -->
            <select
                wire:model.live="sort"
                class="pe-8 py-2 border-t border-b border-r border-gray-300 rounded-r-md focus:outline-none focus:ring-1 focus:ring-primary-500 transition-all"
            >
                <option selected disabled>{{ __('ingredients.sort_by.label') }}</option>
                <option value="most_used">{{ __('ingredients.sort_by.used') }}</option>
                <option value="most_liked">{{ __('ingredients.sort_by.liked') }}</option>
            </select>
        </div>
    </div>

    <!-- Ingredients -->
    @if($ingredients->isNotEmpty())
        <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($ingredients as $ingredient)
                <a href="{{ getLocalizedURL('recipe.by-ingredient', $ingredient) }}"
                    class="bg-white border border-primary-100 rounded-lg p-4 transition hover:shadow-md hover:border-primary-400 cursor-pointer"
                >
                    <h3 class="text-lg font-semibold mb-2 text-primary-700 break-words">
                        {{ $ingredient->name }}
                    </h3>

                    <div class="flex items-center justify-between text-sm text-gray-500 mt-3">
                        <!-- Recipes Count -->
                        <span class="text-xs text-gray-500">
                            {{ __('ingredients.recipes_count') }}: {{ $ingredient->recipes_count ?? 0 }}
                        </span>

                        <!-- Likes -->
                        <span class="flex items-center gap-x-2 text-xs text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 class="size-5 text-primary-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z"/>
                            </svg>
                            {{ $ingredient->likes_count ?? 0 }}
                        </span>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $ingredients->links() }}
        </div>
    @else
        <p class="text-base text-center mt-10 break-words">
            {{ __('ingredients.nothing_found') }}
        </p>
    @endif
</div>
