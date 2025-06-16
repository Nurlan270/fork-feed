@extends('components.layouts.app')

@section('page.title', __('auth/password/forgot.title'))

@section('content')
    <x-navbar/>

    <main class="flex items-start justify-center py-5">
        <div class="max-w-md w-full bg-white/90 rounded-lg shadow-md p-6 backdrop-blur-sm">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                {{ __('auth/password/forgot.heading') }}
            </h2>

            <form method="POST" action="{{ getLocalizedURL('password.email') }}" class="space-y-4">
                @csrf

                <div class="space-y-2">
                    <x-input label="{{ __('auth/password/forgot.form.email') }}" name="email" placeholder="{{ __('auth/password/forgot.form.email_placeholder') }}"/>
                </div>

                <div class="space-y-2">
                    <img src="{{ captcha_src('flat') }}" alt="{{ __('auth/register.form.captcha_alt') }}">
                    <x-input name="captcha" :render-old-value="false"
                             placeholder="{{ __('auth/register.form.captcha_placeholder') }}"/>
                </div>

                <button type="submit" class="w-full flex justify-center py-2 px-4
                    border border-transparent rounded-md shadow-sm
                    text-sm font-medium text-white bg-primary-600
                    hover:bg-primary-700 focus:outline-none focus:ring-2
                    focus:ring-offset-2 focus:ring-primary-500 cursor-pointer transition-colors">
                    {{ __('auth/password/forgot.form.submit') }}
                </button>

                <p class="text-sm text-gray-600 text-center">
                    {{ __('auth/password/forgot.form.remember') }} <a href="{{ getLocalizedURL('auth.login') }}"
                                               class="text-primary-600 hover:text-primary-500">{{ __('auth/password/forgot.form.sign_in') }}</a>
                </p>
            </form>
        </div>
    </main>
@endsection

