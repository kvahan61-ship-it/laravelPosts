@extends('layouts.layout')
@push('styles')
    @vite(['resources/css/create.css'])
@endpush
@section('main')
    <div class="form-container">
        <div class="form-card">
            <div class="form-header">
                <h2>Ստեղծել նոր պոստ</h2>
            </div>

            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data" class="post-form">
                @csrf

                <div class="form-group">
                    <label for="title">Վերնագիր</label>
                    <input type="text" name="title" id="title" class="@error('title') error-border @enderror" value="{{ old('title') }}" placeholder="Ի՞նչ կա նորություն...">
                    @error('title')
                    <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">Բովանդակություն</label>
                    <textarea name="content" id="content" rows="6" class="@error('content') error-border @enderror" placeholder="Գրեք այստեղ...">{{ old('content') }}</textarea>
                    @error('content')
                    <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Ավելացնել նկար</label>
                    <div class="file-upload-wrapper">
                        <input type="file" name="image" id="image">
                        <div class="file-upload-design">
                            <span class="upload-icon">📷</span>
                            <span class="upload-text">Ընտրեք նկարը</span>
                        </div>
                    </div>
                    @error('image')
                    <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-actions">
                    <a href="{{ route('home') }}" class="btn-cancel">Չեղարկել</a>
                    <button type="submit" class="btn-submit">Հրապարակել</button>
                </div>
            </form>
        </div>
    </div>
@endsection
