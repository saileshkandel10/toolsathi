@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-12 text-center max-w-2xl mx-auto">
        <h1 class="text-3xl font-extrabold text-[#242B36] mb-2">ToolSathi Blog & Guides</h1>
        <p class="text-gray-600 text-sm">Discover tips, tutorials, and updates on PDF tools, Nepali typing, and digital utilities.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
            <article class="bg-white rounded-2xl shadow-xs border border-gray-200 overflow-hidden flex flex-col justify-between group hover:shadow-md transition">
                <div>
                    @if($post->image)
                        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-6">
                        <span class="text-xs font-semibold text-[#E83E46] bg-red-50 px-2.5 py-1 rounded-full mb-3 inline-block">Guide</span>
                        <h2 class="text-lg font-bold text-gray-900 group-hover:text-[#E83E46] transition mb-2">
                            <a href="{{ url('/blog/' . $post->slug) }}">{{ $post->title }}</a>
                        </h2>
                        <p class="text-xs text-gray-600 line-clamp-3">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                    </div>
                </div>
                <div class="px-6 pb-6 pt-0 flex items-center justify-between text-xs text-gray-400 border-t border-gray-100 pt-4">
                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                    <a href="{{ url('/blog/' . $post->slug) }}" class="font-semibold text-[#E83E46] hover:underline">Read Article &rarr;</a>
                </div>
            </article>
        @empty
            <div class="col-span-3 text-center py-12 bg-white rounded-2xl border border-gray-200">
                <p class="text-gray-500 text-sm">No blog posts published yet.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</div>
@endsection