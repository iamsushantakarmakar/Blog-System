<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex-1">
                <h2 class="text-xl font-semibold mb-1">All Posts</h2>
                <p class="text-sm text-gray-500">Discover stories from our community</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 sm:py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div
                    class="flex items-start gap-3 p-4 mb-6 sm:mb-8 bg-green-50 border border-green-200 text-green-800 rounded-lg">
                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8">
                @forelse($posts as $post)
                    <article
                        class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div class="p-4 sm:p-6">
                            <!-- Post Header -->
                            <div class="flex items-start justify-between mb-4 sm:mb-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-semibold text-white text-sm flex-shrink-0"
                                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%)">
                                        {{ strtoupper(substr($post->user->name, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $post->user->name }}
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>

                                @auth
                                    @if (auth()->id() === $post->user_id)
                                        <div class="flex gap-2">
                                            <a href="{{ route('posts.edit', $post) }}"
                                                class="text-sm px-3 py-1 rounded-md text-gray-600 hover:bg-gray-100 transition-colors">
                                                Edit
                                            </a>
                                        </div>
                                    @endif
                                @endauth
                            </div>

                            <!-- Post Title -->
                            <h3
                                class="text-lg sm:text-xl font-bold text-gray-900 mb-3 sm:mb-4 leading-tight line-clamp-2 hover:text-blue-600 transition-colors">
                                <a href="{{ route('posts.show', $post) }}" class="block">
                                    {{ $post->title }}
                                </a>
                            </h3>

                            <!-- Post Excerpt -->
                            <p class="text-sm sm:text-base text-gray-600 mb-4 sm:mb-6 leading-relaxed line-clamp-3">
                                {{ Str::limit($post->content, 150) }}
                            </p>

                            <!-- Post Footer -->
                            <div
                                class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 pt-4 border-t border-gray-200">
                                <a href="{{ route('posts.show', $post) }}"
                                    class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700 transition-colors group">
                                    Read More
                                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>

                                <div class="flex items-center gap-4">
                                    <span class="flex items-center gap-1 text-sm text-gray-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        {{ rand(10, 500) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-1 lg:col-span-2 text-center py-12 sm:py-16">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400 opacity-50" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No posts yet</h3>
                        <p class="text-gray-500 mb-6 max-w-md mx-auto px-4">Be the first to share your story with the
                            community!</p>
                        @auth
                            <a href="{{ route('posts.create') }}" class="inline-block btn btn--primary">Create Your First
                                Post</a>
                        @endauth
                    </div>
                @endforelse
            </div>


            <div class="mt-12 sm:mt-16 ">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
