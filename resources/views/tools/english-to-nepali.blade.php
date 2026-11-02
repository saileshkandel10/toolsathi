@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="englishToNepaliTool()">
    <nav class="text-xs text-gray-500 mb-6 flex items-center space-x-2">
        <a href="{{ url('/') }}" class="hover:text-[#E83E46]">Home</a>
        <span>/</span>
        <a href="{{ url('/' . $category->slug) }}" class="hover:text-[#E83E46]">{{ $category->name }}</a>
        <span>/</span>
        <span class="text-gray-800 font-medium">{{ $tool->name }}</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8 mb-8">
        <div class="flex items-center space-x-4 mb-6">
            <div class="w-12 h-12 rounded-xl bg-red-50 text-[#E83E46] flex items-center justify-center">
                <i data-lucide="{{ $tool->icon ?? 'globe' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-2">English Phonetic Input</label>
                <textarea x-model="inputText" @input="transliterate" rows="8" placeholder="Type English (e.g. 'kathmandu')..." class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm focus:outline-hidden focus:border-[#E83E46]"></textarea>
            </div>
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-xs font-semibold text-gray-700">Nepali Transliteration</label>
                    <button @click="copyText" class="text-xs bg-red-50 text-[#E83E46] font-semibold px-2.5 py-1 rounded-lg hover:bg-red-100 transition">Copy</button>
                </div>
                <textarea x-model="outputText" readonly rows="8" class="w-full bg-gray-100 border border-gray-300 rounded-xl p-4 text-sm focus:outline-hidden" placeholder="Nepali text output..."></textarea>
            </div>
        </div>

        <button @click="inputText = ''; outputText = ''" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2.5 rounded-xl text-sm transition">Clear</button>
    </div>
</div>

@push('scripts')
<script>
function englishToNepaliTool() {
    return {
        inputText: '',
        outputText: '',
        transliterate() {
            let t = this.inputText.toLowerCase();
            const map = {
                'nepal': 'नेपाल',
                'kathmandu': 'काठमाडौं',
                'pokhara': 'पोखरा',
                'toolsathi': 'टूलसाथी',
                'a': 'अ', 'i': 'इ', 'u': 'उ', 'e': 'ए', 'o': 'ओ'
            };
            let words = t.split(' ');
            let res = words.map(w => map[w] || w);
            this.outputText = res.join(' ');
        },
        copyText() {
            navigator.clipboard.writeText(this.outputText);
            alert('Copied to clipboard!');
        }
    }
}
</script>
@endpush
@endsection