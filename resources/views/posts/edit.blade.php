<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('posts.show', $post) }}" class="text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-xl font-semibold">Edit Post</h2>
        </div>
    </x-slot>

    <div class="py-8 sm:py-12 lg:py-16">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8 text-center">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Update Your Post</h1>
                <p class="text-gray-600">Make changes to improve your content</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <form action="{{ route('posts.update', $post) }}" method="POST" id="editPostForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_token" id="csrf-token" value="{{ csrf_token() }}">

                    <div class="p-6 sm:p-8 lg:p-10 space-y-6">
                        <!-- Title Field -->
                        <div>
                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-3">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                                Post Title
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="title"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-gray-900 placeholder-gray-400"
                                placeholder="Enter an engaging title for your post..."
                                value="{{ old('title', $post->title) }}" required>
                            @error('title')
                                <div class="mt-2 flex items-start gap-2 text-sm text-red-600">
                                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                            <p class="mt-2 text-xs text-gray-500">Choose a clear and descriptive title (minimum 3
                                characters)</p>
                        </div>

                        <!-- Content Field -->
                        <div>
                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-3">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Post Content
                                <span class="text-red-500">*</span>
                            </label>
                            <textarea name="content" id="content"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none text-gray-900 placeholder-gray-400"
                                rows="12"
                                placeholder="Write your post content here... Share your ideas, experiences, or insights with the community."
                                required>{{ old('content', $post->content) }}</textarea>
                            @error('content')
                                <div class="mt-2 flex items-start gap-2 text-sm text-red-600">
                                    <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                            <div class="mt-2 flex items-center justify-between">
                                <p class="text-xs text-gray-500">Write detailed and meaningful content</p>
                                <p class="text-xs text-gray-500" id="charCount">0 characters</p>
                            </div>
                        </div>

                        <!-- Info Section -->
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div class="flex-1">
                                    <h4 class="text-sm font-semibold text-yellow-900 mb-2">Editing Tips</h4>
                                    <ul class="text-xs text-yellow-800 space-y-1">
                                        <li>• Review your changes carefully before updating</li>
                                        <li>• Make sure the content is still clear and well-structured</li>
                                        <li>• Check for any spelling or grammar errors</li>
                                        <li>• Consider how changes might affect existing comments</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Post Metadata -->
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                            <div
                                class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-sm text-gray-600">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Created: {{ $post->created_at->format('M d, Y') }}</span>
                                </div>
                                @if ($post->created_at != $post->updated_at)
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        <span>Last updated: {{ $post->updated_at->diffForHumans() }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="px-6 py-4 sm:px-8 sm:py-6 bg-gray-50 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
                            <a href="{{ route('posts.show', $post) }}"
                                class="inline-flex items-center justify-center gap-2 px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-100 transition-colors order-2 sm:order-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel
                            </a>
                            <button type="submit" id="submitBtn"
                                class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-cyan-600 text-white rounded-lg font-semibold hover:from-blue-600 hover:to-cyan-700 transition-all shadow-lg hover:shadow-xl order-1 sm:order-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                <span id="btnText">Update Post</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
