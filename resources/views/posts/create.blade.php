@extends('layouts.layout')

@section('main')
    <div class="create-post-container">
        <div class="post-form-card">
            <div class="form-header">
                <h2>Новая публикация</h2>
                <p>Поделитесь моментом с друзьями в MySocial</p>
            </div>

            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Поле заголовка --}}
                <div class="form-group">
                    <label for="title">О чем вы думаете?</label>
                    <textarea name="title" id="title" class="form-input" placeholder="Введите описание вашего поста..." required></textarea>
                </div>

                {{-- Поле загрузки фото --}}
                <div class="form-group">
                    <label>Добавьте фото</label>
                    <div class="file-upload-wrapper">
                        <input type="file" name="image" id="image" accept="image/*" class="file-input-hidden" onchange="previewImage(event)">
                        <label for="image" class="file-upload-label">
                            <span class="upload-icon">📸</span>
                            <span id="file-name">Выберите изображение</span>
                        </label>
                    </div>
                    {{-- Место для превью --}}
                    <div id="image-preview-container" class="image-preview" style="display: none;">
                        <img id="output-image" src="#" alt="Preview">
                    </div>
                </div>

                <button type="submit" class="btn-publish">Опубликовать</button>
            </form>
        </div>
    </div>

    {{-- Простой скрипт для превью фото --}}
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('output-image');
                var container = document.getElementById('image-preview-container');
                var labelText = document.getElementById('file-name');

                output.src = reader.result;
                container.style.display = 'block';
                labelText.innerText = event.target.files[0].name;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
