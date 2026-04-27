@extends('layouts.layout')
@push('styles')
    @vite(['resources/css/profile.css'])
@endpush
@section('main')
    <div class="profile-container">
        <header class="profile-header-section">
            <div class="profile-image">
                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://via.placeholder.com/150' }}" alt="Avatar">
            </div>

            <div class="profile-info">
                <div class="profile-top-row">
                    <h2>{{ $user->name }}</h2>
                    <button class="btn-edit">Edit Profile</button>

                </div>

                <div class="profile-stats">
                    <span><strong>{{ $posts->count() }}</strong> posts</span>

                </div>

                <div class="profile-bio">
                    <p>Email: {{ $user->email }}</p>
                </div>
            </div>
        </header>

        <hr class="separator">

        <div class="posts-grid">
            @forelse($posts as $post)
                <div class="post-card">
                    <img src="{{ $post->image ? asset('storage/' . $post->image) : 'https://via.placeholder.com/400' }}" alt="Post image">
                    <div class="post-overlay">
                        <span class="post-title">{{ Str::limit($post->title, 20) }}</span>
                    </div>
                </div>
            @empty
                <div class="no-posts">
                    <p>No posts yet.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
