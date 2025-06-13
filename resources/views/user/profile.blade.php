@extends('components.layouts.app')

@php
    if (Route::is('user.profile')) $title = 'Profile';
    else $title = $user->name . "'s Profile";
@endphp

@section('page.title', $title)

@section('content')
    <x-navbar/>

    <livewire:show-user-recipes :user="$user ?? null"/>
@endsection
