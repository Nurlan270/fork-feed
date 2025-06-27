@extends('components.layouts.app')

@section('page.title', __('chats.title'))

@section('content')
    <x-navbar/>

    <livewire:user.chats :user="$user ?? null"/>
@endsection
