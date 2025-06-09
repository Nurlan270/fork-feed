@extends('layouts.app')

@section('page.title', 'Edit Recipe')

@pushonce('styles')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css"/>
    @bukStyles
@endpushonce

@section('content')
    <x-navbar/>

    <main class="flex items-start justify-center my-5">
        <div class="max-w-2xl w-full bg-white/90 rounded-lg shadow-md p-6 backdrop-blur-sm">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                Edit Recipe
            </h2>

            <form method="POST" action="{{ route('recipe.update', $recipe) }}" class="space-y-6" id="update-form"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="space-y-2">
                    <label for="title" class="text-sm font-medium text-gray-700">
                        Title
                    </label>
                    <input type="text" id="title" name="title" placeholder="Cheesecake"
                           value="{{ old('title', $recipe->title) }}"
                           class="block w-full p-2 border rounded-md shadow-sm
                       focus:ring-primary-500 focus:border-primary-500"
                           required>
                    @error('title')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="description" class="text-sm font-medium text-gray-700">
                        Description
                    </label>
                    <x-markdown-editor
                        name="description"
                        :options="[
                            'minHeight' => '200px',
                            'placeholder' => 'Cook something awesome!',
                        ]">
                        {{ old('description', $recipe->description) }}
                    </x-markdown-editor>
                    @error('description')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Ingredients (After typing press "," or "Enter")
                    </label>
                    <input type="text" id="ingredients" name="ingredients" class="w-full rounded-md"
                           value="{{ old('ingredients', $recipe->ingredients->pluck('name')->implode(',')) }}">
                    @error('ingredients')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-5">
                    <label class="text-sm font-medium text-gray-700">
                        Images
                    </label>

                    <div class="swiper relative max-w-xl mx-auto rounded overflow-hidden">
                        <!-- Slides -->
                        <div class="swiper-wrapper">
                            @foreach ($recipe->images as $image)
                                <div class="swiper-slide relative flex justify-center items-center image-item group"
                                     data-id="{{ $image->id }}"
                                     data-path="{{ $image->path }}">

                                    <!-- Image -->
                                    <img src="{{ $image->path }}"
                                         alt="Recipe image"
                                         class="max-h-64 w-auto object-contain mx-auto rounded image-display transition duration-300"/>

                                    <div
                                        class="deleted-overlay absolute inset-0 bg-gray-500/50 backdrop-blur-sm text-white flex items-center justify-center text-lg font-semibold rounded hidden pointer-events-none z-10">
                                        Deleted
                                    </div>

                                    <!-- Button -->
                                    <button type="button"
                                            class="delete-btn absolute right-2 top-2 bg-gray-500/50 hover:bg-gray-500/65 cursor-pointer text-white rounded-full w-8 h-8 flex items-center justify-center text-base shadow transition z-20"
                                            data-id="{{ $image->id }}">
                                        <!-- Delete icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="size-4 icon-delete">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                        </svg>
                                        <!-- Undo icon -->
                                        <svg class="size-4 icon-undo hidden" xmlns="http://www.w3.org/2000/svg"
                                             fill="none"
                                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"/>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <input type="hidden" name="deleted_images" id="deleted_images">

                        <!-- Navigation Buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>

                        <!-- Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>

                    <label
                        class="block w-full cursor-pointer p-4 border border-dashed rounded-md text-center hover:bg-gray-50">
                        <span id="fileLabelText" class="text-gray-600">Click to upload images (Max. 15MB)</span>
                        <input type="file" name="images[]" id="images" class="hidden" accept="image/*" multiple>
                    </label>
                    @error('images')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                    @error('images.*')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="w-full flex justify-center py-2 px-4
                    border border-transparent rounded-md shadow-sm mt-5
                    text-sm font-medium text-white bg-primary-600
                    hover:bg-primary-700 focus:outline-none focus:ring-2
                    focus:ring-offset-2 focus:ring-primary-500 cursor-pointer transition-colors">
                    Update Recipe
                </button>
            </form>
        </div>
    </main>
@endsection

@pushonce('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tagify = new Tagify(document.querySelector('#ingredients'), {
                whitelist: @json($ingredients),
                autoComplete: {
                    rightKey: true
                }
            });

            document.querySelector('#images').addEventListener('change', function () {
                const count = this.files.length;
                const label = document.querySelector('#fileLabelText');
                label.textContent = count > 0 ? `${count} image(s) selected` : 'Click to upload images (Max. 15MB)';
            });

            const deletedImages = {};

            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const imageItem = this.closest('.image-item');
                    const id = imageItem.dataset.id;
                    const path = imageItem.dataset.path;

                    const overlay = imageItem.querySelector('.deleted-overlay');
                    const iconDelete = this.querySelector('.icon-delete');
                    const iconUndo = this.querySelector('.icon-undo');

                    if (!(id in deletedImages)) {
                        overlay.classList.remove('hidden');
                        iconDelete.classList.add('hidden');
                        iconUndo.classList.remove('hidden');

                        deletedImages[id] = path;
                    } else {
                        overlay.classList.add('hidden');
                        iconDelete.classList.remove('hidden');
                        iconUndo.classList.add('hidden');

                        delete deletedImages[id];
                    }
                });
            });

            document.querySelector('#update-form').addEventListener('submit', (e) => {
                document.querySelector('#deleted_images').value = JSON.stringify(deletedImages);
            });
        });
    </script>
    @bukScripts
@endpushonce
