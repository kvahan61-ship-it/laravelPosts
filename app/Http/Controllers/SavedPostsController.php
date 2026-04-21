<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SavedPostsController extends Controller
{
    public function saved()
    {
        $savedPosts = auth()->user()->savedPosts()->with('user')->latest()->get();
        return view('saved', compact('savedPosts'));
    }
    public function toggleSave($postId)
    {
        $user = auth()->user();

        // Метод toggle() автоматически добавит запись, если её нет,
        // и удалит, если она уже существует в таблице saved_posts.
        $user->savedPosts()->toggle($postId);

        return back(); // Возвращает пользователя на ту же страницу
    }
}
