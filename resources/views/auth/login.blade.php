@extends('layouts.app')

@section('page.title', 'Sign In')

@section('content')
    <main class="min-h-screen flex items-center justify-center p-4 bg-cover bg-center bg-no-repeat bg-fixed"
          style="background-image: url('{{ asset('media/auth-bg.jpg') }}');">
        <div class="max-w-md w-full bg-white/90 rounded-lg shadow-md p-6 backdrop-blur-sm">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                Sign in to ForkFeed
            </h2>

            <form method="POST" action="{{ route('auth.login.store') }}" class="space-y-4">
                @csrf

                <div class="space-y-2">
                    <label for="login" class="text-sm font-medium text-gray-700">
                        Email address / Username
                    </label>
                    <input id="login" name="login" type="text"
                           value="{{ old('login') }}"
                           class="block w-full p-2 border rounded-md shadow-sm
                       focus:ring-orange-500 focus:border-orange-500"
                           required autocomplete="email" autofocus>
                    @error('login')
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
                           required autocomplete="current-password">
                    @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                               class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded cursor-pointer">
                        <label for="remember" class="ml-2 block text-sm text-gray-900 cursor-pointer">
                            Remember me
                        </label>
                    </div>
                    <a href="#"
                       class="text-sm text-orange-600 hover:text-orange-500">
                        Forgot your password?
                    </a>
                </div>

                <div class="space-y-4">
                    <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent
                        rounded-md shadow-sm text-sm font-medium text-white bg-orange-600
                        hover:bg-orange-700 focus:outline-none focus:ring-2
                        focus:ring-offset-2 focus:ring-orange-500 cursor-pointer">
                        Sign in
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
