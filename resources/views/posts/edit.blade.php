@extends('layouts.layout')
@section('main')
    <div>
        <form action="{{ route('post.update',$post->id) }}" method="POST">
            @csrf
            @method('patch')
            <div>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="{{ $post->title }}">
            </div>
            <div>
                <label for="image">Image</label>
                <input type="text" name="image" id="image" value="{{ $post->image }}">
            </div>
            <button type="submit">Create</button>
        </form>
    </div>
@endsection
