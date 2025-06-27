@extends('components.layouts.app')

@section('page.title', __('profile.following.page_title', ['name' => $user->name]))

@section('content')
    <x-navbar/>

    <x-profile :$user>
        <div class="md:col-span-9">
            <div class="bg-white rounded-lg p-3 md:p-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-base md:text-lg font-semibold text-primary-800">
                        {{ __('profile.following.title') }}
                    </h3>
                </div>

                <div class="flex flex-col">
                    @forelse($following as $user)
                        <div class="flex items-center justify-between border-b-2 border-b-gray-200 py-5">
                            <a href="{{ getLocalizedURL('user.tag-profile', compact('user')) }}"
                               title="{{ __('profile.following.go_to_profile', ['name' => $user->name]) }}"
                               class="flex gap-x-4 items-center">
                                <img src="{{ $user->avatar }}" alt="Avatar" class="size-14 rounded-4xl">
                                <div class="flex flex-col justify-center gap-y-1">
                                    <p>{{ $user->name }}</p>
                                    <p>{{ '@'.$user->username }}</p>
                                </div>
                            </a>
                            <livewire:buttons.user-action-buttons :$user/>
                        </div>
                    @empty
                        <p class="text-sm text-center text-gray-600 mt-6">
                            {{ __('profile.following.empty') }}
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </x-profile>
@endsection
