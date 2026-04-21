@extends('layouts.layout')

@section('main')
    <div class="instagram-feed">
        @foreach( $posts as $post)
            <div class="post-card">

                <div class="post-header">
                    <div class="avatar-small-container">
                        @if($post->user && $post->user->avatar)
                            <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="avatar" class="avatar-small-img">
                        @else
                            <div class="avatar-small-placeholder">
                                {{ strtoupper(substr($post->user->name ?? 'U', 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div class="username">User_{{ $post->id }}</div>
                </div>
                <h3>{{$post->title}}</h3>

                <div class="post-photo">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="post-main-image" alt="post">
                    @else
                        <div style="height: 300px; background: #fafafa; display: flex; align-items: center; justify-content: center; color: #ccc;">
                            No Image
                        </div>
                    @endif
                </div>
                <div class="post-actions">
                    <div class="left-actions">
                        <button class="action-btn" title="Like"><i class="fa fa-heart-o" aria-hidden="true"></i></button>
                        <button class="action-btn" title="Comment"><i class="fa fa-commenting" aria-hidden="true"></i></button>
                    </div>
                    <div class="right-actions">
                        <button class="action-btn" title="Save"><i class="fa fa-bookmark-o" aria-hidden="true"></i></button>
                    </div>
                </div>

{{--                <div class="post-info">--}}
{{--                    <span class="likes-count">1,234 likes</span>--}}

{{--                    <div class="post-caption">--}}
{{--                        <b>User_{{ $post->id }}</b> {{ $post->title }}--}}
{{--                    </div>--}}

{{--                    <div style="margin-top: 8px; color: #8e8e8e; font-size: 12px; cursor: pointer;">--}}
{{--                        View all 15 comments--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>
        @endforeach
    </div>
@endsection
