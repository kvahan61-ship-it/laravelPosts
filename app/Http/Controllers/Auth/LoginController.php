<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // 1. Ցույց տալ ֆորման (GET)
    public function login()
    {
        return view('auth.login');
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


}

