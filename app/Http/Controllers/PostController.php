<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
   public function index()
{
    $posts = Post::with('user', 'comments.user')->paginate(10);

    return Inertia::render('Posts/Index', [
        'posts' => $posts,
        'users' => User::all(),
    ]);
}

    public function store(Request $request)
    {
        Post::create([
            'title'       => $request->title,
            'description' => $request->description,
            'user_id'     => $request->user_id,
        ]);

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully!');
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update([
            'title'       => $request->title,
            'description' => $request->description,
            'user_id'     => $request->user_id,
        ]);

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully!');
    }
}