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
            <button class="action-btn" title="Like">
                <form action="{{ route('post.like', $post->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="action-btn" title="Save">
                        @if(auth()->user()->likePosts->contains($post->id))
                            <i class="fa fa-heart" aria-hidden="true" style="color: #e``00;"></i>
                        @else
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                        @endif
                    </button>
                </form>
            </button>
            <button class="action-btn" title="Comment"><i class="fa fa-commenting" aria-hidden="true"></i></button>
        </div>
        <div class="right-actions">
            <form action="{{ route('post.save', $post->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="action-btn" title="Save">
                    @if(auth()->user()->savedPosts->contains($post->id))
                        <i class="fa fa-bookmark" aria-hidden="true" style="color: #262626;"></i>
                    @else
                        <i class="fa fa-bookmark-o" aria-hidden="true"></i>
                    @endif
                </button>
            </form>
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
