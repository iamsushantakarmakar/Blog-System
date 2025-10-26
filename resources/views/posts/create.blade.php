<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-xl font-semibold">Create New Post</h2>
        </div>
    </x-slot>

    <div class="py-8 sm:py-12 lg:py-16">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8 text-center">
                <div
                    class="w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Share Your Story</h1>
                <p class="text-gray-600">Create a new post and share your thoughts with the community</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <form action="{{ route('posts.store') }}" method="POST" id="createPostForm">
                    @csrf

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
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all text-gray-900 placeholder-gray-400"
                                placeholder="Enter an engaging title for your post..." value="{{ old('title') }}"
                                required>
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
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all resize-none text-gray-900 placeholder-gray-400"
                                rows="12"
                                placeholder="Write your post content here... Share your ideas, experiences, or insights with the community."
                                required>{{ old('content') }}</textarea>
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

                        <!-- Tips Section -->
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div class="flex-1">
                                    <h4 class="text-sm font-semibold text-blue-900 mb-2">Writing Tips</h4>
                                    <ul class="text-xs text-blue-800 space-y-1">
                                        <li>• Use a clear and concise title that captures attention</li>
                                        <li>• Break your content into paragraphs for better readability</li>
                                        <li>• Check for spelling and grammar before publishing</li>
                                        <li>• Be respectful and constructive in your writing</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="px-6 py-4 sm:px-8 sm:py-6 bg-gray-50 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
                            <a href="{{ route('posts.index') }}"
                                class="inline-flex items-center justify-center gap-2 px-6 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-100 transition-colors order-2 sm:order-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancel
                            </a>
                            <button type="submit" id="submitBtn"
                                class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-purple-500 to-indigo-600 text-white rounded-lg font-semibold hover:from-purple-600 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl order-1 sm:order-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                <span id="btnText">Publish Post</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
