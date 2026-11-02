@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumbs -->
    <nav class="text-xs text-gray-500 mb-6 flex items-center space-x-2">
        <a href="{{ route('home') }}" class="hover:text-[#E83E46]">Home</a>
        <span>/</span>
        <span class="text-gray-800 font-medium">Nepali Tools</span>
    </nav>

    <!-- Header -->
    <div class="bg-gradient-to-r from-red-50 to-white rounded-3xl p-8 sm:p-12 mb-12 border border-red-100 shadow-xs">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-[#E83E46] mb-4">
            🇳🇵 Complete Nepali Digital Suite
        </span>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-[#242B36] tracking-tight mb-3">
            All Nepali Tools – Write, Design, Convert & Create
        </h1>
        <p class="text-base text-gray-600 max-w-2xl">
            Free online Nepali tools for typing, fonts, document editing, voice typing, image creation and text conversion.
        </p>
    </div>

    <!-- Tools Grid grouped by categories -->
    <div class="space-y-12">
        <div>
            <h2 class="text-2xl font-bold text-[#242B36] mb-6 flex items-center">
                <i data-lucide="type" class="w-6 h-6 text-[#E83E46] mr-2"></i> Nepali Fonts & Typing
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($tools->whereIn('slug', ['nepali-fonts', 'easy-nepali-typing', 'nepali-voice-typing', 'preeti-to-unicode', 'unicode-to-preeti', 'nepali-typing', 'english-to-nepali']) as $tool)
                    <a href="{{ url('/nepali-tools/' . $tool->slug) }}" class="bg-white p-6 rounded-2xl shadow-xs border border-gray-200 hover:shadow-md hover:border-[#E83E46]/50 transition flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-10 h-10 rounded-lg bg-red-50 text-[#E83E46] flex items-center justify-center group-hover:bg-[#E83E46] group-hover:text-white transition">
                                    <i data-lucide="{{ $tool->icon ?? 'tool' }}" class="w-5 h-5"></i>
                                </div>
                                <span class="text-xs font-semibold px-2.5 py-1 bg-gray-100 rounded-full text-gray-600">Nepali Tool</span>
                            </div>
                            <h3 class="text-base font-bold text-gray-900 group-hover:text-[#E83E46] transition mb-1">{{ $tool->name }}</h3>
                            <p class="text-xs text-gray-600 line-clamp-2 mb-4">{{ $tool->description }}</p>
                        </div>
                        <div class="flex items-center justify-between text-xs text-gray-500 pt-3 border-t border-gray-100">
                            <span>{{ number_format($tool->views_count) }} views</span>
                            <span class="font-semibold text-[#E83E46] group-hover:translate-x-1 transition">Open Tool &rarr;</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <div>
            <h2 class="text-2xl font-bold text-[#242B36] mb-6 flex items-center">
                <i data-lucide="file-text" class="w-6 h-6 text-[#E83E46] mr-2"></i> Documents, Image Maker & Calculators
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($tools->whereNotIn('slug', ['nepali-fonts', 'easy-nepali-typing', 'nepali-voice-typing', 'preeti-to-unicode', 'unicode-to-preeti', 'nepali-typing', 'english-to-nepali']) as $tool)
                    <a href="{{ url('/nepali-tools/' . $tool->slug) }}" class="bg-white p-6 rounded-2xl shadow-xs border border-gray-200 hover:shadow-md hover:border-[#E83E46]/50 transition flex flex-col justify-between group">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-10 h-10 rounded-lg bg-red-50 text-[#E83E46] flex items-center justify-center group-hover:bg-[#E83E46] group-hover:text-white transition">
                                    <i data-lucide="{{ $tool->icon ?? 'tool' }}" class="w-5 h-5"></i>
                                </div>
                                <span class="text-xs font-semibold px-2.5 py-1 bg-gray-100 rounded-full text-gray-600">Nepali Tool</span>
                            </div>
                            <h3 class="text-base font-bold text-gray-900 group-hover:text-[#E83E46] transition mb-1">{{ $tool->name }}</h3>
                            <p class="text-xs text-gray-600 line-clamp-2 mb-4">{{ $tool->description }}</p>
                        </div>
                        <div class="flex items-center justify-between text-xs text-gray-500 pt-3 border-t border-gray-100">
                            <span>{{ number_format($tool->views_count) }} views</span>
                            <span class="font-semibold text-[#E83E46] group-hover:translate-x-1 transition">Open Tool &rarr;</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection