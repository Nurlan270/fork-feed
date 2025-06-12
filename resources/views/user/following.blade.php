@extends('components.layouts.app')

@section('page.title', $user->name . "'s Following List")

@section('content')
    <x-navbar/>

    <x-profile :$user>
        <div class="md:col-span-9">
            <div class="bg-white rounded-lg p-3 md:p-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-base md:text-lg font-semibold text-primary-800">
                        Following
                    </h3>
                </div>

                <div class="flex flex-col">
                    @forelse($following as $user)
                        <a class="flex items-center justify-between border-b-2 border-b-gray-200 py-5"
                           href="{{ route('user.tag-profile', compact('user')) }}">
                            <div class="flex gap-x-4 items-center">
                                <img src="{{ $user->avatar }}" alt="Avatar" class="size-14 rounded-4xl">
                                <div class="flex flex-col justify-center gap-y-1">
                                    <p>{{ $user->name }}</p>
                                    <p>{{ '@'.$user->username }}</p>
                                </div>
                            </div>
                            <livewire:buttons.subscription-button :$user/>
                        </a>
                    @empty
                        <p class="text-sm text-center text-gray-600 mt-6">Not following anyone</p>
                    @endforelse
                </div>
            </div>
        </div>
    </x-profile>
@endsection
