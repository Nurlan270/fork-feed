@extends('components.layouts.app')

@section('title', __('about.title'))

@section('content')
    <x-navbar/>

    <div class="max-w-4xl mx-auto px-4 py-12">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800">{{ __('about.title') }}</h1>
            <p class="mt-4 text-lg text-gray-600">
                {{ __('about.subtitle') }}
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-md px-6 py-10 space-y-6">
            <section>
                <h2 class="text-2xl font-semibold text-primary-600">{{ __('about.mission_title') }}</h2>
                <p class="mt-2 text-gray-700">
                    {{ __('about.mission_text') }}
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-semibold text-primary-600">{{ __('about.what_we_do_title') }}</h2>
                <ul class="mt-2 list-disc list-inside text-gray-700 space-y-1">
                    <li>{{ __('about.feature_1') }}</li>
                    <li>{{ __('about.feature_2') }}</li>
                    <li>{{ __('about.feature_3') }}</li>
                    <li>{{ __('about.feature_4') }}</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-semibold text-primary-600">{{ __('about.story_title') }}</h2>
                <p class="mt-2 text-gray-700">
                    {{ __('about.story_text') }}
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-semibold text-primary-600">{{ __('about.community_title') }}</h2>
                <p class="mt-2 text-gray-700">
                    {{ __('about.community_text') }}
                </p>
                @guest
                    <div class="flex justify-center mt-6">
                        <a href="{{ route('auth.register') }}"
                           class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2 rounded-md">
                            {{ __('about.register_button') }}
                        </a>
                    </div>
                @endguest
            </section>
        </div>
    </div>
@endsection
