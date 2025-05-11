@extends('layouts.app')

@section('page.title', 'Sign Up')

@section('content')
    <main class="min-h-screen flex items-center justify-center p-4 bg-cover bg-center bg-no-repeat bg-fixed"
          style="background-image: url('{{ asset('media/auth-bg.jpg') }}');">
        <div class="max-w-md w-full bg-white/90 rounded-lg shadow-md p-6 backdrop-blur-sm">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                Create an account
            </h2>

            <form method="POST" action="{{ route('auth.register.store') }}" class="space-y-4">
                @csrf

                <div class="space-y-2">
                    <label for="username" class="text-sm font-medium text-gray-700">
                        Username
                    </label>
                    <input id="username" name="username" type="text"
                           value="{{ old('username') }}"
                           class="block w-full p-2 border rounded-md shadow-sm
                   focus:ring-orange-500 focus:border-orange-500"
                           required autocomplete="name" autofocus>
                    @error('username')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="email" class="text-sm font-medium text-gray-700">
                        Email address
                    </label>
                    <input id="email" name="email" type="email"
                           value="{{ old('email') }}"
                           class="block w-full p-2 border rounded-md shadow-sm
                   focus:ring-orange-500 focus:border-orange-500"
                           required autocomplete="email">
                    @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="password" class="text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <input id="password" name="password" type="password"
                           class="block w-full p-2 border rounded-md shadow-sm
                   focus:ring-orange-500 focus:border-orange-500"
                           required autocomplete="new-password">
                    @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="password-confirm" class="text-sm font-medium text-gray-700">
                        Confirm Password
                    </label>
                    <input id="password-confirm" name="password_confirmation" type="password"
                           class="block w-full p-2 border rounded-md shadow-sm
                   focus:ring-orange-500 focus:border-orange-500"
                           required autocomplete="new-password">
                </div>

                <div class="space-y-4">
                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent
                    rounded-md shadow-sm text-sm font-medium text-white bg-orange-600
                    hover:bg-orange-700 focus:outline-none focus:ring-2 cursor-pointer
                    focus:ring-offset-2 focus:ring-orange-500">
                        Sign up
                    </button>

                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">
                        Or continue with
                    </span>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <a href="{{ route('auth.google') }}"
                           class="flex-1 flex items-center justify-center gap-2 py-2 px-4 border border-gray-300
                   rounded-md shadow-sm text-sm font-medium text-gray-700
                   hover:bg-gray-50 focus:outline-none focus:ring-2
                   focus:ring-offset-2 focus:ring-orange-500">
                            <img src="{{ asset('media/google-icon.svg') }}" class="size-5" alt="Google logo">
                            Google
                        </a>
                        <a href="{{ route('auth.github') }}"
                           class="flex-1 flex items-center justify-center gap-2 py-2 px-4 border border-gray-300
                   rounded-md shadow-sm text-sm font-medium text-gray-700
                   hover:bg-gray-50 focus:outline-none focus:ring-2
                   focus:ring-offset-2 focus:ring-orange-500">
                            <img src="{{ asset('media/github-icon.svg') }}" class="size-5" alt="GitHub logo">
                            GitHub
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
