<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <h2 class="text-3xl font-semibold">{{ __('recipe/by_ingredient.title', ['ingredient' => $ingredient->name]) }}</h2>

        <div class="flex w-full max-w-lg">
            <!-- Search Input with loading spinner -->
            <div class="relative w-full">
                <input
                    wire:model.live="search"
                    type="text"
                    placeholder="{{ __('recipe/by_ingredient.search_placeholder') }}"
                    class="w-full pr-10 px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-1 focus:ring-primary-500 transition-all"
                />

                <!-- Loading Spinner -->
                <svg wire:loading.delay
                     wire:target="search, sort"
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
                <option selected disabled>{{ __('recipe/by_ingredient.sort_by.label') }}</option>
                <option value="popular">{{ __('recipe/by_ingredient.sort_by.popular') }}</option>
                <option value="liked">{{ __('recipe/by_ingredient.sort_by.liked') }}</option>
                <option value="newest">{{ __('recipe/by_ingredient.sort_by.newest') }}</option>
                <option value="oldest">{{ __('recipe/by_ingredient.sort_by.oldest') }}</option>
            </select>
        </div>
    </div>

    @if($recipes->isNotEmpty())
        <!-- Featured Recipes -->
        <div class="mt-8 grid gap-6 grid-cols-1 md:grid-cols-2">
            @foreach($recipes as $recipe)
                <livewire:recipe-card
                    :$recipe
                    :show-action-buttons="true"
                    wire:key="{{ $recipe->id }}"
                    @recipe-deleted="$refresh"
                />
            @endforeach
        </div>
        {{ $recipes->links() }}
    @else
        <p class="text-base text-center mt-10 break-words">{{ __('recipe/by_ingredient.nothing_found') }}</p>
    @endif
</div>
