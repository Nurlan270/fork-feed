@extends('components.layouts.app')

@php
    if (Route::is('user.profile')) $title = __('profile.title');
    else $title = __('profile.title_with_name', ['name' => $user->name]);
@endphp

@section('page.title', $title)

@section('content')
    <x-navbar/>

    <livewire:user.show-recipes :user="$user ?? null"/>
@endsection

