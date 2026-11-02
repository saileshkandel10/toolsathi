@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-b from-white to-[#F6F7F9] py-16 px-4 sm:px-6 lg:px-8 border-b border-gray-200">
    <div class="max-w-4xl mx-auto text-center">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-[#E83E46] mb-4">
            🚀 Over 15+ Free Professional Tools
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-[#242B36] tracking-tight mb-4">
            Your Digital <span class="text-[#E83E46]">Tools Companion</span>
        </h1>
        <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
            Fast, secure, and user-friendly online utilities. PDF tools, Nepali date converters, image compressors, calculators, and text utilities all in one place.
        </p>

        <!-- Big Live Search Bar with Suggestions -->
        <div class="relative max-w-2xl mx-auto" x-data="{ query: '', results: [], open: false }">
            <div class="flex items-center bg-white rounded-2xl shadow-lg border border-gray-200 px-4 py-3">
                <i data-lucide="search" class="w-6 h-6 text-gray-400 mr-3"></i>
                <input 
                    type="text" 
                    x-model="query"
                    @input.debounce.250ms="if(query.length > 0) { fetch('/api/search?q=' + query).then(res => res.json()).then(data => { results = data; open = true; }) } else { results = []; open = false; }"
                    placeholder="Search for any tool (e.g. Merge PDF, Nepali Unicode, Word Counter)..." 
                    class="w-full text-gray-800 placeholder-gray-400 focus:outline-hidden text-base"
                >
                <button class="bg-[#E83E46] text-white px-5 py-2 rounded-xl text-sm font-semibold hover:bg-[#d23239] transition">
                    Search
                </button>
            </div>

            <!-- Live Search Suggestions Dropdown -->
            <div x-show="open && results.length > 0" @click.away="open = false" class="absolute left-0 right-0 mt-2 bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden z-50 text-left" x-cloak>
                <template x-for="tool in results">
                    <a :href="tool.url" class="flex items-center justify-between p-4 hover:bg-gray-50 transition border-b border-gray-100 last:border-none">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-red-50 text-[#E83E46] flex items-center justify-center font-bold text-xs">
                                <i :data-lucide="tool.icon" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900 text-sm" x-text="tool.name"></div>
                                <div class="text-xs text-gray-500" x-text="tool.description"></div>
                            </div>
                        </div>
                        <span class="text-xs font-semibold px-2 py-0.5 bg-gray-100 rounded-full text-gray-600" x-text="tool.category"></span>
                    </a>
                </template>
            </div>
            <div x-show="open && results.length === 0 && query.length > 0" class="absolute left-0 right-0 mt-2 bg-white rounded-xl shadow-2xl border border-gray-100 p-4 z-50 text-center text-gray-500 text-sm" x-cloak>
                No tools found matching "<span x-text="query"></span>".
            </div>
        </div>
    </div>
</div>

<!-- Categories Section (7 Required Categories) -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-[#242B36]">Explore Categories</h2>
            <p class="text-sm text-gray-500">Choose from our curated collection of professional utility categories</p>
        </div>
        <a href="{{ route('tools.index') }}" class="text-sm font-semibold text-[#E83E46] hover:underline flex items-center">
            View All Tools <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($categories as $category)
            <a href="{{ url('/' . $category->slug) }}" class="bg-white p-6 rounded-2xl shadow-xs border border-gray-200/80 hover:shadow-lg hover:border-[#E83E46]/50 transition group">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-red-50 text-[#E83E46] flex items-center justify-center group-hover:bg-[#E83E46] group-hover:text-white transition shadow-xs">
                        <i data-lucide="{{ $category->icon ?? 'folder' }}" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-[#E83E46] transition">{{ $category->name }}</h3>
                        <span class="text-xs text-gray-500 font-medium">{{ $category->tools_count }} Tools Available</span>
                    </div>
                </div>
                <p class="text-sm text-gray-600 line-clamp-2">{{ $category->description }}</p>
            </a>
        @endforeach
    </div>
</div>

<!-- Featured Tools Section -->
<div class="bg-white py-16 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl font-bold text-[#242B36]">Featured Tools</h2>
                <p class="text-sm text-gray-500">Most popular and frequently used utilities by our community</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredTools as $tool)
                <a href="{{ url('/' . optional($tool->category)->slug . '/' . $tool->slug) }}" class="bg-[#F6F7F9] p-6 rounded-2xl border border-gray-200 hover:shadow-md hover:bg-white transition flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-lg bg-red-100 text-[#E83E46] flex items-center justify-center group-hover:bg-[#E83E46] group-hover:text-white transition">
                                <i data-lucide="{{ $tool->icon ?? 'tool' }}" class="w-5 h-5"></i>
                            </div>
                            <span class="text-xs font-semibold px-2.5 py-1 bg-white rounded-full text-gray-600 border border-gray-200">
                                {{ optional($tool->category)->name ?? 'Tool' }}
                            </span>
                        </div>
                        <h3 class="text-base font-bold text-gray-900 group-hover:text-[#E83E46] transition mb-1">{{ $tool->name }}</h3>
                        <p class="text-xs text-gray-600 line-clamp-2 mb-4">{{ $tool->description }}</p>
                    </div>
                    <div class="flex items-center justify-between text-xs text-gray-500 pt-3 border-t border-gray-200/60">
                        <span class="flex items-center"><i data-lucide="eye" class="w-3.5 h-3.5 mr-1 text-gray-400"></i> {{ number_format($tool->views_count) }} views</span>
                        <span class="font-semibold text-[#E83E46] flex items-center group-hover:translate-x-1 transition">Use Tool &rarr;</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection