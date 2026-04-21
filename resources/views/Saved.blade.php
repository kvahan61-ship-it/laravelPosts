@extends('layouts.layout')

@section('main')
    <div class="instagram-feed">
        @foreach($savedPosts as $post)
            @include('posts.post', ['post' => $post])
        @endforeach
    </div>
@endsection
