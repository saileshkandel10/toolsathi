@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="fontLibraryApp()">
    <!-- Breadcrumbs -->
    <nav class="text-xs text-gray-500 mb-6 flex items-center space-x-2">
        <a href="{{ route('home') }}" class="hover:text-[#E83E46]">Home</a>
        <span>/</span>
        <a href="{{ url('/nepali-tools') }}" class="hover:text-[#E83E46]">Nepali Tools</a>
        <span>/</span>
        <span class="text-gray-800 font-medium">Nepali Font Library</span>
    </nav>

    <!-- Header & Controls -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8 mb-8">
        <h1 class="text-3xl font-extrabold text-[#242B36] mb-2">Nepali Font Library</h1>
        <p class="text-sm text-gray-600 mb-6">Browse, search, preview, and download free Unicode Devanagari and legacy Preeti-compatible Nepali fonts.</p>

        <!-- Search & Custom Preview Input -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Search Fonts</label>
                <input type="text" x-model="searchQuery" placeholder="Search by name or author..." class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Custom Preview Text</label>
                <input type="text" x-model="customText" placeholder="नेपाली भाषा र संस्कृति..." class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
        </div>
    </div>

    <!-- Font Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($fonts as $font)
            <div class="bg-white rounded-2xl shadow-xs border border-gray-200 p-6 flex flex-col justify-between hover:shadow-md transition">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-xs font-semibold px-2.5 py-1 bg-red-50 text-[#E83E46] rounded-full">{{ $font->category }}</span>
                        <span class="text-xs text-gray-400 font-mono">{{ $font->format }} &bull; {{ $font->license }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $font->name }}</h3>
                    <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 mb-4 min-h-[80px] flex items-center justify-center">
                        <p class="text-xl text-gray-800" x-text="customText || '{{ $font->sample_text }}'"></p>
                    </div>
                    <p class="text-xs text-gray-500 mb-4">Author: <strong class="text-gray-700">{{ $font->author ?? 'Unknown' }}</strong></p>
                </div>
                <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-xs text-green-600 font-semibold">Ready to Use</span>
                    <button onclick="alert('Font download started!')" class="bg-[#E83E46] text-white text-xs font-semibold px-4 py-2 rounded-xl hover:bg-[#d23239] transition">
                        Download Font
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $fonts->links() }}
    </div>
</div>

@push('scripts')
<script>
function fontLibraryApp() {
    return {
        searchQuery: '',
        customText: ''
    }
}
</script>
@endpush
@endsection