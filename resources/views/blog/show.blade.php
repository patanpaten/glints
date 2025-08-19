@extends('layouts.blog')

@section('title', $article->title . ' - Blog Glints')

@section('content')
<div class="bg-white min-h-screen">
    <!-- Breadcrumb -->
    <div class="bg-gray-50 py-4">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <a href="{{ route('blog') }}" class="text-gray-500 hover:text-gray-700">Blog</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="text-gray-700">{{ $article->category }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Article Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Article Header -->
        <div class="mb-8">
            <div class="flex items-center mb-4">
                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                    {{ $article->category }}
                </span>
                <span class="text-gray-500 text-sm ml-4">
                    {{ $article->formatted_published_at }}
                </span>
                <span class="text-gray-500 text-sm ml-4">
                    {{ $article->read_time }} min read
                </span>
                <span class="text-gray-500 text-sm ml-4">
                    <i class="fas fa-eye mr-1"></i>
                    {{ number_format($article->views) }} views
                </span>
            </div>
            
            <h1 class="text-4xl font-bold text-gray-900 mb-6 leading-tight">
                {{ $article->title }}
            </h1>
            
            <p class="text-xl text-gray-600 mb-6 leading-relaxed">
                {{ $article->excerpt }}
            </p>
            
            <!-- Author Info -->
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-gray-600"></i>
                </div>
                <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                        {{ $article->author->name ?? 'Glints Team' }}
                    </div>
                    <div class="text-sm text-gray-500">
                        Content Writer
                    </div>
                </div>
            </div>
            
            @if($article->featured_image)
            <!-- Featured Image -->
            <div class="mb-8">
                <img src="{{ $article->featured_image }}" 
                     alt="{{ $article->title }}"
                     class="w-full h-96 object-cover rounded-lg shadow-lg">
            </div>
            @endif
        </div>

        <!-- Article Body -->
        <div class="prose prose-lg max-w-none mb-12">
            {!! nl2br(e($article->content)) !!}
        </div>

        <!-- Tags -->
        @if($article->tags && count($article->tags) > 0)
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Tags</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($article->tags as $tag)
                <span class="bg-gray-100 text-gray-700 text-sm px-3 py-1 rounded-full">
                    {{ $tag }}
                </span>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Share Buttons -->
        <div class="border-t border-b border-gray-200 py-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-3">Bagikan Artikel</h3>
            <div class="flex space-x-4">
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                   target="_blank"
                   class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200">
                    <i class="fab fa-facebook-f mr-2"></i>Facebook
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article->title) }}" 
                   target="_blank"
                   class="bg-blue-400 text-white px-4 py-2 rounded-md hover:bg-blue-500 transition duration-200">
                    <i class="fab fa-twitter mr-2"></i>Twitter
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" 
                   target="_blank"
                   class="bg-blue-700 text-white px-4 py-2 rounded-md hover:bg-blue-800 transition duration-200">
                    <i class="fab fa-linkedin-in mr-2"></i>LinkedIn
                </a>
                <button onclick="copyToClipboard('{{ request()->fullUrl() }}')"
                        class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition duration-200">
                    <i class="fas fa-link mr-2"></i>Copy Link
                </button>
            </div>
        </div>

        <!-- Related Articles -->
        @if($relatedArticles->count() > 0)
        <div class="mb-12">
            <h3 class="text-2xl font-bold text-gray-900 mb-6">Artikel Terkait</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedArticles as $related)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    @if($related->featured_image)
                    <div class="h-40 bg-cover bg-center" style="background-image: url('{{ $related->featured_image }}');"></div>
                    @else
                    <div class="h-40 bg-gradient-to-r from-gray-200 to-gray-300"></div>
                    @endif
                    <div class="p-4">
                        <div class="flex items-center mb-2">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">
                                {{ $related->category }}
                            </span>
                            <span class="text-gray-500 text-xs ml-2">
                                {{ $related->formatted_published_at }}
                            </span>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 hover:text-blue-600 transition duration-200">
                            <a href="{{ route('blog.show', $related->slug) }}">
                                {{ $related->title }}
                            </a>
                        </h4>
                        <p class="text-gray-600 text-sm line-clamp-2">
                            {{ $related->excerpt }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Back to Blog -->
        <div class="text-center">
            <a href="{{ route('blog') }}" 
               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Blog
            </a>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check mr-2"></i>Copied!';
        button.classList.remove('bg-gray-600', 'hover:bg-gray-700');
        button.classList.add('bg-green-600', 'hover:bg-green-700');
        
        setTimeout(() => {
            button.innerHTML = originalText;
            button.classList.remove('bg-green-600', 'hover:bg-green-700');
            button.classList.add('bg-gray-600', 'hover:bg-gray-700');
        }, 2000);
    });
}
</script>

<style>
.prose {
    color: #374151;
    line-height: 1.75;
}

.prose p {
    margin-bottom: 1.25em;
}

.prose h2 {
    font-size: 1.5em;
    font-weight: 700;
    margin-top: 2em;
    margin-bottom: 1em;
    color: #111827;
}

.prose h3 {
    font-size: 1.25em;
    font-weight: 600;
    margin-top: 1.6em;
    margin-bottom: 0.6em;
    color: #111827;
}

.prose ul, .prose ol {
    margin-bottom: 1.25em;
    padding-left: 1.625em;
}

.prose li {
    margin-bottom: 0.5em;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection