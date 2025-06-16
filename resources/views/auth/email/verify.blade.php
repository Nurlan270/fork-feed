@extends('components.layouts.app')

@section('page.title', __('auth/email_verify.title'))

@section('content')
    <x-navbar/>

    <main class="min-h-screen flex items-center justify-center p-4 bg-cover bg-center bg-no-repeat bg-fixed"
          style="background-image: url('{{ asset('media/auth-bg.jpg') }}')">
        <div class="max-w-md w-full bg-white/90 rounded-lg shadow-md p-6 backdrop-blur-sm">
            <div class="text-center mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="mx-auto text-primary-500 mb-4 size-12">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/>
                </svg>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">
                    {{ __('auth/email_verify.heading') }}
                </h2>
                <p class="max-w-md mx-auto text-lg text-gray-600">
                    {{ __('auth/email_verify.description') }}
                </p>
            </div>

            <div class="space-y-4">
                <div class="bg-primary-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-primary-700 mb-2">
                        {{ __('auth/email_verify.not_received') }}
                    </h3>
                    <p class="text-gray-600">
                        {{ __('auth/email_verify.check_spam') }}
                    </p>
                </div>

                <button type="submit" form="resend-email" class="w-full flex justify-center py-2 px-4
                        border border-transparent rounded-md shadow-sm
                        text-sm font-medium text-white bg-primary-600
                        hover:bg-primary-700 focus:outline-none focus:ring-2
                        focus:ring-offset-2 focus:ring-primary-500 cursor-pointer transition-colors">
                    {{ __('auth/email_verify.resend') }}
                </button>

                <form id="resend-email" class="hidden" action="{{ getLocalizedURL('verification.send') }}"
                      method="POST">@csrf</form>
            </div>
        </div>
    </main>
@endsection

