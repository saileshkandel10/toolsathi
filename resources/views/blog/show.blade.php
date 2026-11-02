@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <nav class="text-xs text-gray-500 mb-6 flex items-center space-x-2">
        <a href="{{ url('/') }}" class="hover:text-[#E83E46]">Home</a>
        <span>/</span>
        <a href="{{ url('/blog') }}" class="hover:text-[#E83E46]">Blog</a>
        <span>/</span>
        <span class="text-gray-800 font-medium line-clamp-1">{{ $post->title }}</span>
    </nav>

    <article class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        <h1 class="text-3xl font-extrabold text-[#242B36] mb-4">{{ $post->title }}</h1>
        <div class="text-xs text-gray-500 mb-6 flex items-center space-x-4">
            <span>Published on {{ $post->created_at->format('M d, Y') }}</span>
        </div>

        @if($post->image)
            <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-80 object-cover rounded-xl mb-8">
        @endif

        <div class="prose max-w-none text-gray-700 space-y-4 text-sm leading-relaxed">
            {!! nl2br(e($post->content)) !!}
        </div>
    </article>

    <!-- Article Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Article",
      "headline": "{{ $post->title }}",
      "datePublished": "{{ $post->created_at->toIso8601String() }}",
      "author": {
        "@type": "Organization",
        "name": "ToolSathi"
      }
    }
    </script>
</div>
@endsection