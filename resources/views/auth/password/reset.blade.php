@extends('layouts.app')

@section('page.title', 'Reset Password')

@section('content')
    <main class="min-h-screen flex items-center justify-center p-4 bg-cover bg-center bg-no-repeat bg-fixed"
          style="background-image: url('{{ asset('media/auth-bg.jpg') }}')">
        <div class="max-w-md w-full bg-white/90 rounded-lg shadow-md p-6 backdrop-blur-sm">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">
                Reset Your Password
            </h2>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf

                <input type="hidden" name="token" value="{{ request('token') }}">

                <div class="space-y-2">
                    <label for="email" class="text-sm font-medium text-gray-700">
                        Email address
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           class="block w-full p-2 border rounded-md shadow-sm
                       focus:ring-orange-500 focus:border-orange-500"
                           required>
                    @error('email')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="password" class="text-sm font-medium text-gray-700">
                        New Password
                    </label>
                    <input type="password" id="password" name="password"
                           class="block w-full p-2 border rounded-md shadow-sm
                       focus:ring-orange-500 focus:border-orange-500"
                           required>
                    @error('password')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="password-confirm" class="text-sm font-medium text-gray-700">
                        Confirm New Password
                    </label>
                    <input type="password" id="password-confirm" name="password_confirmation"
                           class="block w-full p-2 border rounded-md shadow-sm
                       focus:ring-orange-500 focus:border-orange-500"
                           required>
                </div>

                <button type="submit" class="w-full flex justify-center py-2 px-4
                    border border-transparent rounded-md shadow-sm
                    text-sm font-medium text-white bg-orange-600
                    hover:bg-orange-700 focus:outline-none focus:ring-2
                    focus:ring-offset-2 focus:ring-orange-500 cursor-pointer">
                    Reset Password
                </button>

                <p class="text-sm text-gray-600 text-center">
                    Remember your password? <a href="{{ route('login') }}" class="text-orange-600 hover:text-orange-500">Sign in</a>
                </p>
            </form>
        </div>
    </main>
@endsection
