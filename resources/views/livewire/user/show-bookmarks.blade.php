<div>
    @if($bookmarks->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @foreach($bookmarks as $recipe)
                <livewire:recipe-card
                    :$recipe
                    :show-remove-bookmark-button="true"
                    wire:key="{{ $recipe->id }}"
                />
            @endforeach
        </div>
        {{ $bookmarks->links() }}
    @else
        <div class="text-center mt-16">
            <p class="text-gray-600 text-base mb-2">{{ __('bookmarks.empty') }}</p>
        </div>
    @endif
</div>
