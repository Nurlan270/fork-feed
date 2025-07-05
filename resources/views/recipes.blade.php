@extends('components.layouts.app')

@section('page.title', __('recipes.title'))

@section('content')
    <x-navbar/>

    <livewire:show-recipes/>
@endsection
