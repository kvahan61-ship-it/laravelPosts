@extends('layouts.layout')

@section('main')
    <div class="auth-container">
        <form action="{{ route('login.store') }}" method="post" class="auth-form">
            @csrf
            <h1>Welcome Back</h1>
            <p class="auth-subtitle">Log in to your MySocial account</p>

            @if ($errors->any())
                <div class="error-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label>Email or Phone Number</label>
                <input type="text" name="login" value="{{ old('login') }}" placeholder="example@mail.com or +374..." required autofocus>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="buttReg">Login</button>

            <p class="auth-footer">Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
        </form>
    </div>
@endsection
