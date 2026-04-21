<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function create(){
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048', // макс 2МБ
        ]);
        if (request()->hasFile('image')) {
            $path = request()->file('image')->store('posts', 'public');
            $data['image'] = $path;
        }

        Post::create([
            'title' => $data['title'],
            'image' => $data['image'],
            'user_id' => Auth::id(), // Исправлено: запятая вместо точки с запятой
            'published' => 1,
        ]);

        return redirect()->route('post.index');
    }
    public function show(Post $post){
        return view('posts.show',compact('post'));
    }
    public function edit(Post $post){
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request ,Post $post)
    {
        $data=request()->validate([
            'title'=>'string',
            'image'=>'string',
        ]);

        if ($request->hasFile('image')) {
            // Удаляем старое фото, если загружаем новое
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);
        return redirect()->route('post.show', $post->id) ;
    }
    public function delete()
    {

        $post=Post::withTrashed()->find(2 );
        $post->restore();
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index') ;
    }

}
