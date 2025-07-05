@extends('components.layouts.app')

@section('page.title', 'Ingredients')

@section('content')
    <x-navbar/>

    <livewire:show-ingredients/>
@endsection
