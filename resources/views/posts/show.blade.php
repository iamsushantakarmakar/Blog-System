<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="text-xl font-semibold">Post Details</h2>
            @if(auth()->check() && (auth()->id() === $post->user_id || auth()->user()->isAdmin()))
                <div class="flex gap-2 sm:gap-3">
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn--secondary">Edit</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn--outline">Delete</button>
                    </form>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-8 sm:py-12 lg:py-16">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Post Article -->
            <article class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8 sm:mb-12">
                <div class="p-6 sm:p-8 lg:p-12">
                    <!-- Post Header -->
                    <div class="mb-6 sm:mb-8">
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-4 sm:mb-6 leading-tight">
                            {{ $post->title }}
                        </h1>

                        <!-- Author Info -->
                        <div class="flex items-center gap-4 pb-6 border-b border-gray-200">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center font-semibold text-white flex-shrink-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%)">
                                {{ strtoupper(substr($post->user->name, 0, 1)) }}
                            </div>
                            <div class="min-w-0">
                                <p class="text-base font-semibold text-gray-900">{{ $post->user->name }}</p>
                                <div class="flex items-center gap-2 text-sm text-gray-500">
                                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                                    <span>•</span>
                                    <span>{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Post Content -->
                    <div class="prose prose-sm sm:prose-base lg:prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    <!-- Post Footer Stats -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex items-center gap-6 text-sm text-gray-500">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                {{ rand(50, 1000) }} views
                            </span>
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                {{ $post->comments->count() }} comments
                            </span>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Comments Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 sm:px-8 sm:py-6 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900 flex items-center gap-2">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Comments ({{ $post->comments->count() }})
                    </h3>
                </div>

                <div class="p-6 sm:p-8">
                    <!-- Comment Form -->
                    @auth
                        <div class="mb-8 sm:mb-12 pb-8 sm:pb-12 border-b border-gray-200">
                            <form action="{{ route('comments.store', $post) }}" method="POST" id="commentForm">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Add a comment</label>
                                    <textarea
                                        name="content"
                                        id="commentContent"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"
                                        rows="4"
                                        placeholder="Share your thoughts..."
                                        required
                                    ></textarea>
                                </div>
                                <button type="submit" id="submitBtn" class="inline-flex items-center gap-2 btn btn--primary">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    <span id="btnText">Post Comment</span>
                                </button>
                            </form>
                        </div>

                        <script>
                            document.getElementById('commentForm').addEventListener('submit', function(e) {
                                const submitBtn = document.getElementById('submitBtn');
                                const btnText = document.getElementById('btnText');

                                // Prevent double submission
                                if (submitBtn.disabled) {
                                    e.preventDefault();
                                    return false;
                                }

                                // Disable button and show loading state
                                submitBtn.disabled = true;
                                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                                btnText.textContent = 'Posting...';
                            });
                        </script>
                    @else
                        <div class="mb-8 sm:mb-12 pb-8 sm:pb-12 border-b border-gray-200">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 sm:p-6 text-center">
                                <svg class="w-12 h-12 mx-auto mb-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                <p class="text-gray-700 mb-4">Join the conversation! Please <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:text-blue-700 underline">login</a> to leave a comment.</p>
                            </div>
                        </div>
                    @endauth

                    <!-- Comments List -->
                    @forelse($post->comments as $comment)
                        <div class="py-6 {{ !$loop->last ? 'border-b border-gray-200' : '' }}">
                            <div class="flex gap-4">
                                <!-- Commenter Avatar -->
                                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center font-semibold text-white text-sm flex-shrink-0" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%)">
                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                </div>

                                <!-- Comment Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-3">
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $comment->user->name }}</p>
                                            <p class="text-xs sm:text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                        </div>

                                        @if(auth()->check() && (auth()->id() === $comment->user_id || auth()->user()->isAdmin()))
                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm text-red-600 hover:text-red-700 font-medium flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>

                                    <p class="text-gray-700 leading-relaxed break-words">{{ $comment->content }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <p class="text-gray-500 text-lg font-medium mb-2">No comments yet</p>
                            <p class="text-gray-400">Be the first to share your thoughts!</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Back to Posts Button -->
            <div class="mt-8 text-center">
                <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to All Posts
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
