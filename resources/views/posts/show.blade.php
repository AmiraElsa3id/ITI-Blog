<x-layout>
    <x-slot:title>
        Show Post
    </x-slot>

    <div class="max-w-3xl mx-auto space-y-6">

        {{-- Post Info --}}
        <div class="bg-white rounded border border-gray-200">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                <h2 class="text-base font-medium text-gray-700">Post Info</h2>
            </div>
            <div class="px-4 py-4">
                <div class="mb-2">
                    <h3 class="text-lg font-medium text-gray-800">Title :- <span class="font-normal">{{ $post->title }}</span></h3>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-800">Description :-</h3>
                    <p class="text-gray-600">{{ $post->description }}</p>
                </div>
            </div>
        </div>

        {{-- Post Creator Info --}}
        <div class="bg-white rounded border border-gray-200">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                <h2 class="text-base font-medium text-gray-700">Post Creator Info</h2>
            </div>
            <div class="px-4 py-4">
                <div class="mb-2">
                    <h3 class="text-lg font-medium text-gray-800">Name :- <span class="font-normal">{{ $post->user->name }}</span></h3>
                </div>
                <div class="mb-2">
                    <h3 class="text-lg font-medium text-gray-800">Email :- <span class="font-normal">{{ $post->user->email }}</span></h3>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-800">Created At :- <span class="font-normal">{{ $post->created_at->format('d M Y') }}</span></h3>
                </div>
            </div>
        </div>

        {{-- Comments --}}
        <div class="bg-white rounded border border-gray-200">
            <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                <h2 class="text-base font-medium text-gray-700">Comments ({{ $post->comments->count() }})</h2>
            </div>
            <div class="px-4 py-4 space-y-4">

                {{-- Add Comment Form --}}
                <form method="POST" action="{{ route('comments.store', $post->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Comment As</label>
                        <select
                            name="user_id"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border bg-white"
                        >
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Comment</label>
                        <textarea
                            name="body"
                            rows="3"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border"
                            placeholder="Write a comment..."
                        ></textarea>
                    </div>
                    <div class="flex justify-end">
                        <x-button type="submit" class="bg-blue-600 hover:bg-blue-700 focus:ring-blue-500">
                            Add Comment
                        </x-button>
                    </div>
                </form>

                <hr>

                {{-- Comments List --}}
                @forelse($post->comments as $comment)
                    <div class="border border-gray-200 rounded p-3">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-gray-800">{{ $comment->user->name }}</span>
                            <span class="text-xs text-gray-400">{{ $comment->created_at->format('d M Y') }}</span>
                        </div>
                        <p class="text-gray-600 text-sm">{{ $comment->body }}</p>
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="mt-2 text-right">
                            @csrf
                            @method('DELETE')
                            <x-button type="submit" class="bg-red-600 hover:bg-red-700 focus:ring-red-500 text-xs py-1" onclick="return confirm('Delete this comment?')">
                                Delete
                            </x-button>
                        </form>
                    </div>
                @empty
                    <p class="text-gray-500 text-sm">No comments yet. Be the first to comment!</p>
                @endforelse

            </div>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('posts.index') }}" class="px-4 py-2 bg-gray-600 text-white font-medium rounded hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Back to All Posts
            </a>
        </div>
    </div>
</x-layout>