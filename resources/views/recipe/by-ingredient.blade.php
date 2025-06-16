@extends('components.layouts.app')

@section('page.title', __('recipe/by_ingredient.title', ['ingredient' => $ingredient->name]))

@section('content')
    <x-navbar/>

    <livewire:show-recipes-with-ingredient :$ingredient/>
@endsection
