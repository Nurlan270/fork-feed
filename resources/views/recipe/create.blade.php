@extends('components.layouts.app')

@section('page.title', 'Create Recipe')

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
                Create New Recipe
            </h2>

            <form method="POST" action="{{ route('recipe.store') }}" class="space-y-6" enctype="multipart/form-data">
                @csrf

                <div class="space-y-2">
                    <label for="title" class="text-sm font-medium text-gray-700">
                        Title
                    </label>
                    <input type="text" id="title" name="title" placeholder="Cheesecake"
                           value="{{ old('title') }}"
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
                    <x-markdown-editor name="description" :options="[
                        'minHeight' => '200px',
                        'placeholder' => 'Cook something awesome!',
                    ]"/>
                    @error('description')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">
                        Ingredients (After typing press "," or "Enter")
                    </label>
                    <input type="text" id="ingredients" name="ingredients" class="w-full rounded-md"
                           value="{{ old('ingredients') }}">
                    @error('ingredients')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700">
                        Images
                    </label>
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
                    border border-transparent rounded-md shadow-sm
                    text-sm font-medium text-white bg-primary-600
                    hover:bg-primary-700 focus:outline-none focus:ring-2
                    focus:ring-offset-2 focus:ring-primary-500 cursor-pointer transition-colors">
                    Upload Recipe
                </button>
            </form>
        </div>
    </main>
@endsection

@pushonce('scripts')
    <script>
        var tagify = new Tagify(document.querySelector('#ingredients'), {
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
    </script>
    @bukScripts
@endpushonce
