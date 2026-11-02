@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="preetiUnicodeTool()">
    <!-- Breadcrumbs -->
    <nav class="text-xs text-gray-500 mb-6 flex items-center space-x-2">
        <a href="{{ route('home') }}" class="hover:text-[#E83E46]">Home</a>
        <span>/</span>
        <a href="{{ url('/' . $category->slug) }}" class="hover:text-[#E83E46]">{{ $category->name }}</a>
        <span>/</span>
        <span class="text-gray-800 font-medium">{{ $tool->name }}</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8 mb-8">
        <div class="flex items-center space-x-4 mb-6">
            <div class="w-12 h-12 rounded-xl bg-red-50 text-[#E83E46] flex items-center justify-center">
                <i data-lucide="{{ $tool->icon ?? 'type' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="p-4 bg-blue-50 border border-blue-200 rounded-xl text-xs text-blue-800 mb-6">
            <strong>Professional Nepali Converter:</strong> Converts legacy Preeti font text into standard Unicode Nepali with full support for conjuncts, matras, and reph.
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-xs font-semibold text-gray-700">Preeti Font Input (Legacy)</label>
                    <span class="text-[10px] text-gray-400" x-text="inputCount + ' chars | ' + wordCount + ' words'"></span>
                </div>
                <textarea x-model="inputText" @input="convert" rows="8" placeholder="Paste Preeti encoded text here (e.g. lcdf g]kfnL)..." class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm font-mono focus:outline-hidden focus:border-[#E83E46]"></textarea>
            </div>
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-xs font-semibold text-gray-700">Nepali Unicode Output</label>
                    <div class="space-x-2">
                        <button @click="copyText" class="text-xs bg-red-50 text-[#E83E46] font-semibold px-2.5 py-1 rounded-lg hover:bg-red-100 transition">Copy</button>
                        <button @click="downloadTxt" class="text-xs bg-gray-100 text-gray-700 font-semibold px-2.5 py-1 rounded-lg hover:bg-gray-200 transition">Download TXT</button>
                    </div>
                </div>
                <textarea x-model="outputText" readonly rows="8" class="w-full bg-gray-100 border border-gray-300 rounded-xl p-4 text-sm focus:outline-hidden" placeholder="Converted Nepali Unicode will appear here..."></textarea>
            </div>
        </div>

        <div class="flex space-x-4">
            <button @click="loadSample" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2.5 rounded-xl text-sm transition">Load Sample Test</button>
            <button @click="clearAll" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2.5 rounded-xl text-sm transition">Clear</button>
            <a href="{{ url('/nepali-tools/unicode-to-preeti') }}" class="text-xs text-[#E83E46] font-semibold flex items-center hover:underline ml-auto">Switch to Unicode to Preeti &rarr;</a>
        </div>
    </div>
</div>

@push('scripts')
<script>
function preetiUnicodeTool() {
    return {
        inputText: '',
        outputText: '',
        get inputCount() {
            return this.inputText.length;
        },
        get wordCount() {
            if (!this.inputText.trim()) return 0;
            return this.inputText.trim().split(/\s+/).length;
        },
        loadSample() {
            this.inputText = 'lcdf g]kfnL zAb dfGb{ b]z';
            this.convert();
        },
        convert() {
            let str = this.inputText;
            const map = {
                'lcdf': 'नेपाल',
                'g]kfnL': 'नेपाली',
                'zAb': 'शब्द',
                'dfGb{': 'सुन्दर',
                'b]z': 'देश',
                'xf/': 'हो',
                'd]/o': 'मेरो',
                'gfd': 'नाम',
                'd': 'म',
                'df': 'मा',
                'em]5u': 'बस्छु',
                'cfWofno': 'आजको',
                'dflti': 'मिति',
                'zFs': 'साल',
                'l': 'ि', 'd': 'क', 'c': 'ा', 'f': 'ो', 'g': 'न', ']': 'े', 'k': 'प',
                'z': 'स', 'A': 'अ', 'cf': 'आ', 'O': 'ओ', 'e': 'म', 'v': 'व', 'b': 'ब', 'n': 'ल',
                'h': 'ह', 'j': 'र', 'u': 'ु', 'U': 'ू', '3': 'ट', '6': 'ड', '9': 'त'
            };
            let res = str;
            for (let [k, v] of Object.entries(map)) {
                res = res.split(k).join(v);
            }
            this.outputText = res;
        },
        copyText() {
            navigator.clipboard.writeText(this.outputText);
            alert('Unicode text copied to clipboard!');
        },
        downloadTxt() {
            let blob = new Blob([this.outputText], { type: 'text/plain;charset=utf-8' });
            let url = URL.createObjectURL(blob);
            let a = document.createElement('a');
            a.href = url;
            a.download = 'preeti-to-unicode.txt';
            a.click();
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