@extends('components.layouts.app')

@section('page.title', 'Bookmarks')

@section('content')
    <x-navbar/>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <h2 class="text-3xl font-semibold">Bookmarks</h2>
        </div>

        <livewire:show-bookmarks/>
    </div>
@endsection
