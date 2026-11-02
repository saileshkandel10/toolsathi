@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="wordCounter()">
    <nav class="text-xs text-gray-500 mb-6 flex items-center space-x-2">
        <a href="{{ route('home') }}" class="hover:text-[#E83E46]">Home</a>
        <span>/</span>
        <a href="{{ route('tools.index') }}" class="hover:text-[#E83E46]">Tools</a>
        <span>/</span>
        <span class="text-gray-800 font-medium">{{ $tool->name }}</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8 mb-8">
        <div class="flex items-center space-x-4 mb-6">
            <div class="w-12 h-12 rounded-xl bg-red-50 text-[#E83E46] flex items-center justify-center">
                <i data-lucide="{{ $tool->icon ?? 'bar-chart-2' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center">
                <div class="text-2xl font-extrabold text-[#E83E46]" x-text="wordsCount">0</div>
                <div class="text-xs text-gray-500 uppercase font-semibold mt-1">Words</div>
            </div>
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center">
                <div class="text-2xl font-extrabold text-gray-800" x-text="charsCount">0</div>
                <div class="text-xs text-gray-500 uppercase font-semibold mt-1">Characters</div>
            </div>
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center">
                <div class="text-2xl font-extrabold text-gray-800" x-text="sentencesCount">0</div>
                <div class="text-xs text-gray-500 uppercase font-semibold mt-1">Sentences</div>
            </div>
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 text-center">
                <div class="text-2xl font-extrabold text-gray-800" x-text="readingTime">0 min</div>
                <div class="text-xs text-gray-500 uppercase font-semibold mt-1">Reading Time</div>
            </div>
        </div>

        <div>
            <textarea x-model="text" rows="10" placeholder="Paste or type your text here..." class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm focus:outline-hidden focus:border-[#E83E46]"></textarea>
        </div>

        <div class="mt-4 flex justify-between items-center">
            <button @click="text = ''" class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2 rounded-xl transition">Clear Text</button>
            <button @click="navigator.clipboard.writeText(text); alert('Copied!')" class="text-xs bg-[#E83E46] hover:bg-[#d23239] text-white font-semibold px-4 py-2 rounded-xl transition">Copy Text</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
function wordCounter() {
    return {
        text: '',
        get wordsCount() {
            if (!this.text.trim()) return 0;
            return this.text.trim().split(/\s+/).length;
        },
        get charsCount() {
            return this.text.length;
        },
        get sentencesCount() {
            if (!this.text.trim()) return 0;
            return this.text.split(/[.!?]+/).filter(Boolean).length;
        },
        get readingTime() {
            let words = this.wordsCount;
            let minutes = Math.ceil(words / 200);
            return minutes + ' min';
        }
    }
}
</script>
@endpush
@endsection