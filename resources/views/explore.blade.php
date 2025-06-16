@extends('components.layouts.app')

@section('page.title', __('explore.title'))

@section('content')
    <x-navbar/>

    <livewire:explore/>
@endsection
