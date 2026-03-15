<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    // GET /api/posts/{post}/comments
    public function index(Post $post): AnonymousResourceCollection
    {
        $comments = $post->comments()
            ->with('user')
            ->latest()
            ->paginate(10);

        return CommentResource::collection($comments);
    }

    // POST /api/posts/{post}/comments
    public function store(StoreCommentRequest $request, Post $post): CommentResource
    {
        $comment = $post->comments()->create([
            'user_id' => $request->user()->id, // ✅ from auth, not request body
            'body'    => $request->validated()['body'],
        ]);

        return (new CommentResource($comment->load('user')))
            ->response()
            ->setStatusCode(201);
    }

    // DELETE /api/comments/{comment}
    public function destroy(Comment $comment): Response
    {
        if ($request->user()->id !== $comment->user_id) {
            abort(403, 'Unauthorized');
        }

        $comment->delete();

        return response()->noContent(); // 204
    }
}