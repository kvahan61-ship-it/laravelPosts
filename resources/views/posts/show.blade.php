@extends('layouts.layout')
@section('main')
    <div>
        <div>
            <h1>{{$post->id}} . {{$post->title}}</h1>
        </div>
        <div>
            <a href="{{ route('post.edit',$post->id) }}">Update</a>
        </div>
        <div>
            <form action="{{ route('post.delete',$post->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
    </div>
@endsection
