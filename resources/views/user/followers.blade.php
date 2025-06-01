@extends('layouts.app')

@section('page.title', $user->name . "'s Followers List")

@section('content')
    <x-navbar/>

    <x-profile :$user>
        <div class="md:col-span-9">
            <div class="bg-white rounded-lg p-3 md:p-4">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-base md:text-lg font-semibold text-primary-800">
                        Followers
                    </h3>
                </div>

                <div class="flex flex-col gap-y-7">
                    @foreach($followers as $user)
                        <a class="flex items-center justify-between border-b-2 border-b-gray-200 pb-4" href="{{ route('tag-profile', compact('user')) }}">
                            <div class="flex gap-x-4 items-center">
                                <img src="{{ $user->avatar }}" alt="Avatar" class="size-14 rounded-4xl">
                                <div class="flex flex-col justify-center gap-y-1">
                                    <p>{{ $user->name }}</p>
                                    <p>{{ '@'.$user->username }}</p>
                                </div>
                            </div>
                            <livewire:subscription-button :$user/>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </x-profile>
@endsection
