<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);

        $post->comments()->create([
            'user_id' => $request->user_id,
            'body'    => $request->body,
        ]);

        return redirect()->back()
            ->with('success', 'Comment added successfully!');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()
            ->with('success', 'Comment deleted successfully!');
    }
}