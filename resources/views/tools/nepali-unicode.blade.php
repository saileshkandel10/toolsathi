@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="nepaliUnicode()">
    <nav class="text-xs text-gray-500 mb-6 flex items-center space-x-2">
        <a href="{{ route('home') }}" class="hover:text-[#E83E46]">Home</a>
        <span>/</span>
        <a href="{{ route('tools.index') }}" class="hover:text-[#E83E46]">Tools</a>
        <span>/</span>
        <span class="text-gray-800 font-medium">{{ $tool->name }}</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8">
        <div class="flex items-center space-x-4 mb-6">
            <div class="w-12 h-12 rounded-xl bg-red-50 text-[#E83E46] flex items-center justify-center">
                <i data-lucide="{{ $tool->icon ?? 'type' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-2">Type Romanized (e.g., "nepal")</label>
                <textarea x-model="inputText" @input="translateText" rows="8" placeholder="Type here in English letters to convert to Nepali Unicode..." class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm focus:outline-hidden focus:border-[#E83E46]"></textarea>
            </div>
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-xs font-semibold text-gray-700">Nepali Unicode Output</label>
                    <button @click="copyText" class="text-xs bg-red-50 text-[#E83E46] font-semibold px-2.5 py-1 rounded-lg hover:bg-red-100 transition">Copy Text</button>
                </div>
                <textarea x-model="outputText" readonly rows="8" class="w-full bg-gray-100 border border-gray-300 rounded-xl p-4 text-sm focus:outline-hidden" placeholder="Nepali text will appear here..."></textarea>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button @click="clearAll" class="bg-gray-100 text-gray-700 font-semibold px-4 py-2 rounded-xl text-sm hover:bg-gray-200 transition">Clear</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
function nepaliUnicode() {
    return {
        inputText: '',
        outputText: '',
        mapping: {
            'nepal': 'नेपाल',
            'kathmandu': 'काठमाडौं',
            'toolsathi': 'टूलसाथी',
            'namaste': 'नमस्ते',
            'nepali': 'नेपाली',
            'a': 'आ', 'i': 'इ', 'u': 'उ', 'e': 'ए', 'o': 'ओ',
            'ka': 'क', 'kha': 'ख', 'ga': 'ग', 'gha': 'घ',
            'ch': 'च', 'chha': 'छ', 'ja': 'ज', 'jha': 'झ',
            'ta': 'त', 'tha': 'थ', 'da': 'द', 'dha': 'ध', 'na': 'न',
            'pa': 'प', 'pha': 'फ', 'ba': 'ब', 'bha': 'भ', 'ma': 'म',
            'ya': 'य', 'ra': 'र', 'la': 'ल', 'wa': 'व',
            'sha': 'श', 'shha': 'ष', 'sa': 'स', 'ha': 'ह'
        },
        translateText() {
            let text = this.inputText.toLowerCase();
            // Simple mapping demonstration
            let words = text.split(' ');
            let translated = words.map(w => this.mapping[w] || w);
            this.outputText = translated.join(' ');
        },
        copyText() {
            navigator.clipboard.writeText(this.outputText);
            alert('Copied to clipboard!');
        },
        clearAll() {
            this.inputText = '';
            this.outputText = '';
        }
    }
}
</script>
@endpush
@endsection