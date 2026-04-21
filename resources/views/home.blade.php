@extends('layouts.layout')

@section('main')
    <div class="instagram-feed">
        @foreach($posts as $post)
            @include('posts.post', ['post' => $post])
        @endforeach
    </div>
@endsection
