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
