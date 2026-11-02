@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumbs -->
    <nav class="text-xs text-gray-500 mb-6 flex items-center space-x-2">
        <a href="{{ url('/') }}" class="hover:text-[#E83E46]">Home</a>
        <span>/</span>
        <a href="{{ route('tools.index') }}" class="hover:text-[#E83E46]">Tools</a>
        <span>/</span>
        <span class="text-gray-800 font-medium">{{ $category->name }}</span>
    </nav>

    <!-- Category Header -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 mb-8 flex items-center space-x-6">
        <div class="w-16 h-16 rounded-2xl bg-red-50 text-[#E83E46] flex items-center justify-center shadow-xs">
            <i data-lucide="{{ $category->icon ?? 'folder' }}" class="w-8 h-8"></i>
        </div>
        <div>
            <h1 class="text-3xl font-extrabold text-[#242B36]">{{ $category->name }}</h1>
            <p class="text-sm text-gray-600 mt-1">{{ $category->description }}</p>
        </div>
    </div>

    <!-- Category Tabs -->
    <div class="flex flex-wrap gap-2 mb-8 border-b border-gray-200 pb-4">
        @foreach($categories as $cat)
            <a href="{{ url('/' . $cat->slug) }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition {{ $cat->id === $category->id ? 'bg-[#E83E46] text-white shadow-xs' : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200' }}">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>

    <!-- Tools Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($tools as $tool)
            <a href="{{ url('/' . $category->slug . '/' . $tool->slug) }}" class="bg-white p-6 rounded-2xl shadow-xs border border-gray-200 hover:shadow-md hover:border-[#E83E46]/50 transition flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 rounded-lg bg-red-50 text-[#E83E46] flex items-center justify-center group-hover:bg-[#E83E46] group-hover:text-white transition">
                            <i data-lucide="{{ $tool->icon ?? 'tool' }}" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xs font-semibold px-2.5 py-1 bg-gray-100 rounded-full text-gray-600">
                            {{ $category->name }}
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 group-hover:text-[#E83E46] transition mb-1">{{ $tool->name }}</h3>
                    <p class="text-xs text-gray-600 line-clamp-2 mb-4">{{ $tool->description }}</p>
                </div>
                <div class="flex items-center justify-between text-xs text-gray-500 pt-3 border-t border-gray-100">
                    <span>{{ number_format($tool->views_count) }} views</span>
                    <span class="font-semibold text-[#E83E46] group-hover:translate-x-1 transition">Use Tool &rarr;</span>
                </div>
            </a>
        @empty
            <div class="col-span-3 text-center py-12 bg-white rounded-2xl border border-gray-200">
                <p class="text-gray-500 text-sm">No tools available in this category yet.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $tools->links() }}
    </div>
</div>
@endsection