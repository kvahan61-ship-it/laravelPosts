<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Այս էջերը հասանելի չեն լինի ուղիղ հղումով (URL-ով)
    public function index() { abort(404);}
    public function show(Post $post) { abort(404); }
    public function edit(Post $post) { abort(404); }

    public function create()
    {
        // Եթե ուզում ես, որ միայն դու տեսնես այս էջը, կարող ես ստուգել քո ID-ն
        // կամ պարզապես թողնել, եթե արդեն AdminMiddleware-ի մեջ է
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $data['image'] = $path;
        }

        Post::create([
            'title' => $data['title'],
            'image' => $data['image'] ?? null,
            'user_id' => Auth::id(),
            'published' => 1,
        ]);

        // ՓՈՓՈԽՈՒԹՅՈՒՆ: Ուղարկում ենք Home (գլխավոր էջ) կամ Profile
        return redirect()->route('home')->with('success', 'Պոստը հաջողությամբ տեղադրվեց:');
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('home'); // Կամ պրոֆիլ
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('home');
    }
}
