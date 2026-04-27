<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MySocial</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @vite(['resources/css/app.css'])

    @stack('styles')
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
        @auth
            <div class="user-profile">
                @auth
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
                        <li><a href="{{ route('admin.dashboard') }}" style="color: #e00; font-weight: bold;">Admin Panel</a></li>
                    @endif
                @endauth


                <a href="{{ route('profile') }}"
                class="username">{{ auth()->user()->name }}</a>
                <div class="avatar-container">
                    @if(auth()->user()->avatar)
                        <a href="{{ route('profile') }}" >
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="avatar" class="avatar-image">
                        </a>
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
