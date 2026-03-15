<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StorePostRequest;
use App\Http\Requests\Api\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // GET api/posts
    public function index(): AnonymousResourceCollection
    {
        $posts = Post::with('user')->paginate(10);

        return PostResource::collection($posts);
    }

    // GET api/posts/{post}
    public function show(Post $post): PostResource
    {
        $post->load('user');

        return new PostResource($post);
    }

    // POST api/posts
    public function store(StorePostRequest $request): PostResource
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post = $request->user()->posts()->create($data);

        return (new PostResource($post))
            ->response()
            ->setStatusCode(201);
    }

    // PUT api/posts/{post}
    public function update(UpdatePostRequest $request, Post $post): PostResource
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return new PostResource($post->fresh('user'));
    }

    // DELETE api/posts/{post}
    public function destroy(Post $post): Response
    {
        if ($this->user()->id !== $post->user_id) {
            abort(403, 'Unauthorized');
        }

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return response()->noContent(); // 204
    }
}