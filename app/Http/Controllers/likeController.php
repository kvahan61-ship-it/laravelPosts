<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class likeController extends Controller
{
    public function like()
    {
        $savedPosts = auth()->user()->savedPosts()->with('user')->latest()->get();
        return view('saved', compact('savedPosts'));
    }
    public function toggleLike($postId)
    {
        $user = auth()->user();

        // Метод toggle() автоматически добавит запись, если её нет,
        // и удалит, если она уже существует в таблице likes.
        $user->likePosts()->toggle($postId);

        return back(); // Возвращает пользователя на ту же страницу
    }
}
