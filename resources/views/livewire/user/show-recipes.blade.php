<x-profile :$user>
    <x-slot:sidebar>
        @if($ingredients->isNotEmpty())
            <div class="bg-white rounded-lg p-3 md:p-4 shadow-sm">
                <h3 class="text-base md:text-lg font-semibold text-primary-800 mb-4">
                    {{ __('profile.recipes.most_used_ingredients') }}
                </h3>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($ingredients as $ingredient)
                        <a href="{{ getLocalizedURL('recipe.by-ingredient', compact('ingredient')) }}"
                           class="px-2 py-1 text-sm text-center bg-[#408D45]/10 text-[#408D45] rounded-md hover:bg-[#408D45]/20 transition-colors cursor-pointer">
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
                    {{ __('profile.recipes.title') }}
                </h3>
                @if(auth()->id() === $user->id)
                    <a href="{{ getLocalizedURL('recipe.create') }}"
                       class="flex items-center gap-x-2 px-3 py-2 md:px-4 md:py-2 text-xs md:text-sm bg-primary-500 text-white rounded-md hover:bg-primary-700 transition-colors cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/>
                        </svg>
                        <span class="hide-xs">{{ __('profile.recipes.upload_button') }}</span>
                    </a>
                @endif
            </div>

            @if($recipes->isNotEmpty())
                <div class="grid grid-cols-1 gap-y-5">
                    @foreach($recipes as $recipe)
                        <livewire:recipe-card
                            :$recipe
                            :show-action-buttons="true"
                            wire:key="{{ $recipe->id }}"
                            @recipe-deleted="$refresh"
                        />
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-600 text-sm">{{ __('profile.recipes.no_recipes') }}</p>
            @endif
        </div>
        {{ $recipes->links() }}
    </div>
</x-profile>
