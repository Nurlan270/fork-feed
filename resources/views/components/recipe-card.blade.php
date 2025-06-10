@use(Illuminate\Support\Carbon)

<article
    class="bg-white rounded-lg shadow-sm overflow-hidden flex flex-col md:flex-row hover:scale-103 transition-transform h-auto md:h-60 relative">
    {{-- Recipe Image --}}
    <div class="w-full md:w-1/3 h-48 md:h-full flex-shrink-0">
        <img src="{{ $recipe->firstImage->path }}"
             alt="{{ $recipe->title }} image"
             class="w-full h-full object-cover">
    </div>

    {{-- Content Section --}}
    <div class="flex-1 py-2 md:p-0 flex flex-col justify-between min-w-0">
        {{-- Content Section --}}
        <div class="flex-1 p-4 md:p-6 flex flex-col justify-between min-w-0">
            <div class="space-y-3 flex-1">
                {{-- Title and Action Buttons --}}
                <div class="flex items-start justify-between gap-3">
                    <h3 class="text-lg md:text-xl font-semibold text-gray-900 leading-snug line-clamp-2 break-words flex-1">
                        {{ $recipe->title }}
                    </h3>

                    {{ $buttons ?? '' }}
                </div>

                {{-- Meta info --}}
                <div class="flex flex-wrap items-center text-xs md:text-sm text-gray-600 gap-3 md:gap-4 mb-4">
                    {{-- Author --}}
                    <a class="flex items-center whitespace-nowrap hover:underline truncate max-w-32 md:max-w-none"
                       href="{{ route('user.tag-profile', ['user' => $recipe->author->username]) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                             class="size-4 text-gray-500 flex-shrink-0">
                            <path fill-rule="evenodd"
                                  d="M17.834 6.166a8.25 8.25 0 1 0 0 11.668.75.75 0 0 1 1.06 1.06c-3.807 3.808-9.98 3.808-13.788 0-3.808-3.807-3.808-9.98 0-13.788 3.807-3.808 9.98-3.808 13.788 0A9.722 9.722 0 0 1 21.75 12c0 .975-.296 1.887-.809 2.571-.514.685-1.28 1.179-2.191 1.179-.904 0-1.666-.487-2.18-1.164a5.25 5.25 0 1 1-.82-6.26V8.25a.75.75 0 0 1 1.5 0V12c0 .682.208 1.27.509 1.671.3.401.659.579.991.579.332 0 .69-.178.991-.579.3-.4.509-.99.509-1.671a8.222 8.222 0 0 0-2.416-5.834ZM15.75 12a3.75 3.75 0 1 0-7.5 0 3.75 3.75 0 0 0 7.5 0Z"
                                  clip-rule="evenodd"/>
                        </svg>
                        {{ $recipe->author->username }}
                    </a>

                    {{-- Views --}}
                    <span class="flex items-center gap-x-1 whitespace-nowrap">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"
                             class="size-4 text-gray-500 flex-shrink-0">
                            <path d="M12 15a3 3 0 100-6 3 3 0 000 6Z"/>
                            <path fill-rule="evenodd"
                                  d="M1.3 11.4C2.8 6.98 7 3.75 12 3.75s9.2 3.23 10.7 7.69a1.75 1.75 0 010 1.12C21.2 17.02 17 20.25 12 20.25S2.8 17.02 1.3 12.56a1.75 1.75 0 010-1.12ZM12 17.25a5.25 5.25 0 100-10.5 5.25 5.25 0 000 10.5Z"
                                  clip-rule="evenodd"/>
                        </svg>
                        {{ $recipe->views }}
                    </span>

                    {{-- Date --}}
                    <span class="flex items-center gap-x-1 whitespace-nowrap">
                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-4 text-gray-500 flex-shrink-0">
                          <path
                              d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"/>
                          <path fill-rule="evenodd"
                                d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z"
                                clip-rule="evenodd"/>
                       </svg>
                        {{ Carbon::parse($recipe->created_at)->format('d M Y') }}
                    </span>
                </div>

                @if($ingredients = $recipe->limitedIngredients)
                    {{-- Ingredient Tags --}}
                    <div class="flex flex-wrap gap-2 mb-4 md:mb-0">
                        @foreach($ingredients as $ingredient)
                            <a href=""
                               class="px-2 py-1 text-sm text-center bg-[#408D45]/10 text-[#408D45] rounded-md hover:bg-[#408D45]/20 transition-colors cursor-pointer">
                                {{ $ingredient->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- CTA or Footer Actions --}}
            <div class="flex-shrink-0">
                <a href="{{ route('recipe.show', $recipe->slug) }}"
                   class="inline-block text-sm text-primary-600 hover:underline font-medium whitespace-nowrap">
                    View Recipe →
                </a>
            </div>
        </div>
    </div>
</article>
