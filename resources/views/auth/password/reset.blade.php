@extends('components.layouts.app')

@section('page.title', __('auth/password/reset.title'))

@section('content')
    <x-navbar/>

    <main class="flex items-start justify-center py-5">
        <div class="max-w-md w-full bg-white/90 rounded-lg shadow-md p-6 backdrop-blur-sm">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                {{ __('auth/password/reset.heading') }}
            </h2>

            <form method="POST" action="{{ getLocalizedURL('password.update') }}" class="space-y-6">
                @csrf

                <input type="hidden" name="token" value="{{ request('token') }}">

                <div class="space-y-2">
                    <x-input :label="__('auth/password/reset.form.email')" name="email" placeholder="{{ __('auth/password/reset.placeholder.email') }}"/>
                </div>

                <div class="space-y-2">
                    <x-input :label="__('auth/password/reset.form.password')" name="password" type="password" :render-old-value="false"/>
                </div>

                <div class="space-y-2">
                   <x-input :label="__('auth/password/reset.form.password_confirmation')" name="password_confirmation" type="password" :render-old-value="false"/>
                </div>

                <button type="submit" class="w-full flex justify-center py-2 px-4
                    border border-transparent rounded-md shadow-sm
                    text-sm font-medium text-white bg-primary-600
                    hover:bg-primary-700 focus:outline-none focus:ring-2
                    focus:ring-offset-2 focus:ring-primary-500 cursor-pointer transition-colors">
                    {{ __('auth/password/reset.form.submit') }}
                </button>

                <p class="text-sm text-gray-600 text-center">
                    {{ __('auth/password/reset.form.remember') }} <a href="{{ getLocalizedURL('auth.login') }}"
                                                                     class="text-primary-600 hover:text-primary-500">{{ __('auth/password/reset.form.sign_in') }}</a>
                </p>
            </form>
        </div>
    </main>
@endsection

