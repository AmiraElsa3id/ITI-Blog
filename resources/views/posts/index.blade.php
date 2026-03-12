<x-layout>
    <x-slot:title>
        All Posts
    </x-slot>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="text-center">
        <a href="{{ route('posts.create') }}" class="mt-4 px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            Create Post
        </a>
    </div>

    {{-- Active Posts --}}
    <div class="mt-6 rounded-lg border border-gray-200">
        <div class="overflow-x-auto rounded-t-lg">
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead class="text-left">
                    <tr>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">#</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Title</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Posted By</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Created At</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($posts as $post)
                    <tr>
                        <td class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">{{ $post->id }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{ $post->title }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{ $post->user->name }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{ $post->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-gray-700 space-x-2">
                            <a href="{{ route('posts.show', $post->id) }}" class="inline-block px-4 py-1 text-xs font-medium text-white bg-blue-400 rounded hover:bg-blue-500">View</a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="inline-block px-4 py-1 text-xs font-medium text-white bg-blue-600 rounded hover:bg-blue-700">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <x-button type="submit" class="bg-red-600 hover:bg-red-700 focus:ring-red-500 text-xs py-1" onclick="return confirm('Are you sure you want to delete this post?')">
                                    Delete
                                </x-button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="rounded-b-lg border-t border-gray-200 px-4 py-2 flex justify-end">
            {{ $posts->links() }}
        </div>
    </div>

    {{-- Deleted Posts --}}
    @if($deleted->count() > 0)
    <div class="mt-8 rounded-lg border border-red-200">
        <div class="px-4 py-3 bg-red-50 border-b border-red-200">
            <h2 class="text-base font-medium text-red-700">Deleted Posts</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead class="text-left">
                    <tr>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">#</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Title</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Posted By</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Deleted At</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($deleted as $post)
                    <tr class="bg-red-50">
                        <td class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">{{ $post->id }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{ $post->title }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{ $post->user->name }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{ $post->deleted_at->format('d M Y') }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-gray-700">
                            <form action="{{ route('posts.restore', $post->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <x-button type="submit" class="bg-green-600 hover:bg-green-700 focus:ring-green-500 text-xs py-1">
                                    Restore
                                </x-button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="rounded-b-lg border-t border-gray-200 px-4 py-2 flex justify-end">
            {{ $deleted->links() }}
        </div>
    </div>
    @endif

</x-layout>