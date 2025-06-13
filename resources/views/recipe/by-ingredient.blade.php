@extends('components.layouts.app')

@section('page.title', 'Recipes with ' .  $ingredient->name)

@section('content')
    <x-navbar/>

    <livewire:show-recipes-with-ingredient :$ingredient/>
@endsection
