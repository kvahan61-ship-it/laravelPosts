<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $posts = $user->posts()->latest()->get();

        return view('UserProfile', compact('user', 'posts'));
    }
}
