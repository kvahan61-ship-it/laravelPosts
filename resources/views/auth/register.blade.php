@extends('layouts.layout')
@push('styles')
    @vite(['resources/css/auth.css'])
@endpush
@section('main')
    <div class="auth-container">
        <form action="{{ route('register.store') }}" method="post" enctype="multipart/form-data" class="auth-form">
            @csrf
            <h1>Create Account</h1>
            <p class="auth-subtitle">Join MySocial community today</p>

            @if ($errors->any())
                <div class="error-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-grid">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe">
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="example@mail.com">
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phoneNumber" value="{{ old('phoneNumber') }}" placeholder="+374 XX XXXXXX">
                </div>

                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender">
                        <option value="" disabled selected>Select gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label>Profile Picture</label>
                    <input type="file" name="avatar" accept="image/*" class="file-input">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••••">
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="••••••••">
                </div>
            </div>

            <button type="submit" class="buttReg">Register Now</button>

            <p class="auth-footer">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
        </form>
    </div>
@endsection
