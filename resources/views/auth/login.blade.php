@extends('components.layouts.app')

@section('page.title', __('auth/login.title'))

@section('content')
    <x-navbar/>

    <main class="min-h-8 flex items-center justify-center py-5">
        <div class="max-w-md w-full bg-white/90 rounded-lg shadow-md p-6 backdrop-blur-sm">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                {{ __('auth/login.heading') }}
            </h2>

            <form method="POST" action="{{ getLocalizedURL('auth.login.store') }}" class="space-y-4">
                @csrf

                <div class="space-y-2">
                    <x-input :label="__('auth/login.form.login_label')" name="login" placeholder="john@gmail.com"/>
                </div>

                <div class="space-y-2">
                    <x-input :label=" __('auth/login.form.password')" name="password" type="password" :render-old-value="false"/>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                               class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded cursor-pointer">
                        <label for="remember" class="ml-2 block text-sm text-gray-900 cursor-pointer">
                            {{ __('auth/login.form.remember') }}
                        </label>
                    </div>
                    <a href="{{ getLocalizedURL('password.request') }}"
                       class="text-sm text-primary-600 hover:text-primary-500">
                        {{ __('auth/login.form.forgot') }}
                    </a>
                </div>

                <div class="space-y-4">
                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent
                        rounded-md shadow-sm text-sm font-medium text-white bg-primary-600
                        hover:bg-primary-700 focus:outline-none focus:ring-2
                        focus:ring-offset-2 focus:ring-primary-500 cursor-pointer transition-colors">
                        {{ __('auth/login.form.submit') }}
                    </button>

                    <span class="text-sm text-gray-500">{{ __('auth/login.form.no_account') }} <a
                            class="text-primary-600 hover:underline"
                            href="{{ getLocalizedURL('auth.register') }}">{{ __('auth/login.form.sign_up') }}</a></span>

                    <div class="relative mt-4">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">
                            {{ __('auth/login.form.or_continue_with') }}
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
                            {{ __('auth/login.form.google') }}
                        </a>
                        <a href="{{ getLocalizedURL('auth.github') }}"
                           class="flex-1 flex items-center justify-center gap-2 py-2 px-4 border border-gray-300
                   rounded-md shadow-sm text-sm font-medium text-gray-700
                   hover:bg-gray-50 focus:outline-none focus:ring-2
                   focus:ring-offset-2 focus:ring-primary-500">
                            <img src="{{ asset('media/github-icon.svg') }}" class="size-5" alt="GitHub logo">
                            {{ __('auth/login.form.github') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

