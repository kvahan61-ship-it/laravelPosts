<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function loginStore(Request $request)
    {

        $request->validate([
            'login' => 'required|string',
            'password' => 'required',
        ]);


        $loginValue = $request->input('login');


        $fieldType = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'phoneNumber';


        $credentials = [
            $fieldType => $loginValue,
            'password' => $request->input('password'),
        ];


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/')->with('success', 'Welcome back!');
        }


        return back()->withErrors([
            'login' => 'Неверный логин (Email/Телефон) или пароль.',
        ])->onlyInput('login');
    }

    public function registerStore(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phoneNumber' => 'required|string|unique:users',
            'gender' => 'nullable|string|in:male,female,other',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'required|string|min:4|confirmed',
        ]);


        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }


        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phoneNumber' => $data['phoneNumber'],
            'gender' => $data['gender'] ?? null,
            'avatar' => $avatarPath,
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Account created successfully!');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
