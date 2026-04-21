<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])
    <title>MySocial</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
@auth
<header class="main-header">
    <div class="logo">
        <a href="{{ route('home') }}">MySocial</a>
    </div>

    <nav>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('saved') }}">Saved</a></li>
            <li><a href="{{ route('post.create') }}" class="btn-create">+ Create Post</a></li>
        </ul>
    </nav>

    <div class="registerPart">
        {{-- Если пользователь залогинен, покажем аватар, если нет — кнопки входа --}}
        @auth
            <div class="user-profile">
                <span class="username">{{ auth()->user()->name }}</span>
                <div class="avatar-container">
                    @if(auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="avatar" class="avatar-image">
                    @else
                        <div class="avatar-placeholder">
                            {{-- Берем первую букву имени, если нет фото --}}
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:red; cursor:pointer;">Exit</button>
                </form>
            </div>
        @else
            <x-registerPart></x-registerPart>
        @endauth
    </div>
</header>
@endauth
<main>
    @yield('main')
</main>
</body>
</html>
