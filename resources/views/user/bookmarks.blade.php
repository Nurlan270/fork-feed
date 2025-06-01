@extends('layouts.app')

@section('page.title', 'Bookmarks')

@section('content')
    <x-navbar/>

    <livewire:bookmarks :$bookmarks/>
@endsection
