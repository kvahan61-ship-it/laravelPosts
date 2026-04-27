@extends('layouts.layout')
@push('styles')
    @vite(['resources/css/feed.css'])
@endpush
@section('main')
    <div class="instagram-feed">
        @foreach($posts as $post)
            @include('posts.post', ['post' => $post])
        @endforeach
    </div>
@endsection
