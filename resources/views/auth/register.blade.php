@extends('components.layouts.app')

@section('page.title', __('auth/register.title'))

@section('content')
    <x-navbar/>

    <main class="flex items-start justify-center py-5">
        <div class="max-w-md w-full bg-white/90 rounded-lg shadow-md p-6 backdrop-blur-sm">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                {{ __('auth/register.heading') }}
            </h2>

            <form method="POST" action="{{ getLocalizedURL('auth.register.store') }}" class="space-y-4">
                @csrf

                <div class="space-y-2">
                    <x-input label="{{ __('auth/register.form.name') }}" name="name"
                             placeholder="{{ __('auth/register.form.name_placeholder') }}"/>
                </div>

                <div class="space-y-2">
                    <x-input label="{{ __('auth/register.form.username') }}" name="username"
                             placeholder="{{ __('auth/register.form.username_placeholder') }}"/>
                </div>

                <div class="space-y-2">
                    <x-input label="{{ __('auth/register.form.email') }}" name="email" type="email"
                             placeholder="{{ __('auth/register.form.email_placeholder') }}"/>
                </div>

                <div class="space-y-2">
                    <x-input label="{{ __('auth/register.form.password') }}" name="password" type="password"
                             :render-old-value="false"/>
                </div>

                <div class="space-y-2">
                    <x-input label="{{ __('auth/register.form.password_confirmation') }}" name="password_confirmation"
                             type="password"
                             :render-old-value="false"/>
                </div>

                <div class="space-y-4">
                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent
                    rounded-md shadow-sm text-sm font-medium text-white bg-primary-600
                    hover:bg-primary-700 focus:outline-none focus:ring-2 cursor-pointer
                    focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                        {{ __('auth/register.form.submit') }}
                    </button>

                    <span class="text-sm text-gray-500">{{ __('auth/register.form.already_have_account') }} <a
                            class="text-primary-600 hover:underline"
                            href="{{ getLocalizedURL('auth.login') }}">{{ __('auth/register.form.sign_in') }}</a></span>

                    <div class="relative mt-4">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">
                        {{ __('auth/register.form.or_continue_with') }}
                    </span>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <a href="{{ getLocalizedURL('auth.google') }}"
                           class="flex-1 flex items-center justify-center gap-2 py-2 px-4 border border-gray-300
                   rounded-md shadow-sm text-sm font-medium text-gray-700
                   hover:bg-gray-50 focus:outline-none focus:ring-2
                   focus:ring-offset-2 focus:ring-primary-500">
                            <img src="{{ asset('media/google-icon.svg') }}" class="size-5" alt="Google logo">
                            {{ __('auth/register.form.google') }}
                        </a>
                        <a href="{{ getLocalizedURL('auth.github') }}"
                           class="flex-1 flex items-center justify-center gap-2 py-2 px-4 border border-gray-300
                   rounded-md shadow-sm text-sm font-medium text-gray-700
                   hover:bg-gray-50 focus:outline-none focus:ring-2
                   focus:ring-offset-2 focus:ring-primary-500">
                            <img src="{{ asset('media/github-icon.svg') }}" class="size-5" alt="GitHub logo">
                            {{ __('auth/register.form.github') }}
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </main>
@endsection

