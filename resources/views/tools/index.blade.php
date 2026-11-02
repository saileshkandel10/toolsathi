@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-[#242B36]">All Online Tools</h1>
        <p class="text-gray-600 text-sm mt-1">Browse our complete directory of free online utility tools.</p>
    </div>

    <!-- Category Filter Tabs -->
    <div class="flex flex-wrap gap-2 mb-8 border-b border-gray-200 pb-4">
        <a href="{{ route('tools.index') }}" class="px-4 py-2 rounded-xl text-sm font-semibold bg-[#E83E46] text-white shadow-xs">
            All Categories
        </a>
        @foreach($categories as $cat)
            <a href="{{ url('/' . $cat->slug) }}" class="px-4 py-2 rounded-xl text-sm font-semibold bg-white text-gray-700 hover:bg-gray-100 border border-gray-200 transition">
                {{ $cat->name }} ({{ $cat->tools_count }})
            </a>
        @endforeach
    </div>

    <!-- Search input -->
    <form action="{{ route('tools.index') }}" method="GET" class="mb-8">
        <div class="flex max-w-lg">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search tools..." class="bg-white border border-gray-300 rounded-l-xl px-4 py-2.5 text-sm w-full focus:outline-hidden focus:border-[#E83E46]">
            <button type="submit" class="bg-[#E83E46] text-white px-6 rounded-r-xl text-sm font-semibold hover:bg-[#d23239] transition">Search</button>
        </div>
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($tools as $tool)
            <a href="{{ url('/' . optional($tool->category)->slug . '/' . $tool->slug) }}" class="bg-white p-6 rounded-2xl shadow-xs border border-gray-200 hover:shadow-md hover:border-[#E83E46]/50 transition flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 rounded-lg bg-red-50 text-[#E83E46] flex items-center justify-center group-hover:bg-[#E83E46] group-hover:text-white transition">
                            <i data-lucide="{{ $tool->icon ?? 'tool' }}" class="w-5 h-5"></i>
                        </div>
                        <span class="text-xs font-semibold px-2.5 py-1 bg-gray-100 rounded-full text-gray-600">
                            {{ optional($tool->category)->name ?? 'Tool' }}
                        </span>
                    </div>
                    <h3 class="text-base font-bold text-gray-900 group-hover:text-[#E83E46] transition mb-1">{{ $tool->name }}</h3>
                    <p class="text-xs text-gray-600 line-clamp-2 mb-4">{{ $tool->description }}</p>
                </div>
                <div class="flex items-center justify-between text-xs text-gray-500 pt-3 border-t border-gray-100">
                    <span>{{ number_format($tool->views_count) }} views</span>
                    <span class="font-semibold text-[#E83E46]">Launch Tool &rarr;</span>
                </div>
            </a>
        @empty
            <div class="col-span-3 text-center py-12 bg-white rounded-2xl border border-gray-200">
                <p class="text-gray-500 text-sm">No tools found matching your search.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $tools->links() }}
    </div>
</div>
@endsection