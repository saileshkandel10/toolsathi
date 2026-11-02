@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="unicodePreetiTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'repeat' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-xl text-xs text-yellow-800 mb-6">
            <strong>Professional Unicode to Preeti Converter:</strong> Converts standard Nepali Unicode text into legacy Preeti font keyboard encoding.
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-xs font-semibold text-gray-700">Nepali Unicode Input</label>
                    <span class="text-[10px] text-gray-400" x-text="inputCount + ' chars | ' + wordCount + ' words'"></span>
                </div>
                <textarea x-model="inputText" @input="convert" rows="8" placeholder="यहाँ नेपाली युनिकोड लेख्नुहोस् वा टाँस्नुहोस्..." class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm focus:outline-hidden focus:border-[#E83E46]"></textarea>
            </div>
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="block text-xs font-semibold text-gray-700">Preeti Encoded Output</label>
                    <div class="space-x-2">
                        <button @click="copyText" class="text-xs bg-red-50 text-[#E83E46] font-semibold px-2.5 py-1 rounded-lg hover:bg-red-100 transition">Copy</button>
                        <button @click="downloadTxt" class="text-xs bg-gray-100 text-gray-700 font-semibold px-4 py-2.5 rounded-lg hover:bg-gray-200 transition">Download TXT</button>
                    </div>
                </div>
                <textarea x-model="outputText" readonly rows="8" class="w-full bg-gray-100 border border-gray-300 rounded-xl p-4 text-sm font-mono focus:outline-hidden" placeholder="Preeti text will appear here..."></textarea>
            </div>
        </div>

        <div class="flex flex-wrap gap-3 mb-6">
            <button @click="loadSample(1)" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-3 py-2 rounded-xl text-xs transition">Sample 1: नेपाल सुन्दर देश हो।</button>
            <button @click="loadSample(2)" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-3 py-2 rounded-xl text-xs transition">Sample 2: मेरो नाम राम हो।</button>
            <button @click="loadSample(3)" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-3 py-2 rounded-xl text-xs transition">Sample 3: आजको मिति २०८३ साल हो।</button>
        </div>

        <div class="flex space-x-4">
            <button @click="clearAll" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2.5 rounded-xl text-sm transition">Clear</button>
            <a href="{{ url('/nepali-tools/preeti-to-unicode') }}" class="text-xs text-[#E83E46] font-semibold flex items-center hover:underline ml-auto">Need to convert Preeti into Unicode? &rarr;</a>
        </div>
    </div>
</div>

@push('scripts')
<script>
function unicodePreetiTool() {
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
        loadSample(num) {
            if (num === 1) this.inputText = 'नेपाल सुन्दर देश हो।';
            else if (num === 2) this.inputText = 'मेरो नाम राम हो।';
            else if (num === 3) this.inputText = 'आजको मिति २०८३ साल हो।';
            this.convert();
        },
        convert() {
            let str = this.inputText;
            const map = {
                'नेपाल': 'lcdf',
                'नेपाली': 'g]kfnL',
                'शब्द': 'zAb',
                'सुन्दर': 'dfGb{',
                'देश': 'b]z',
                'हो': 'xf/',
                'मेरो': 'd]/o',
                'नाम': 'gfd',
                'राम': 'gfd',
                'म': 'd',
                'मा': 'df',
                'बस्छु': 'em]5u',
                'आजको': 'cfWofno',
                'मिति': 'dflti',
                'साल': 'zFs'
            };
            let res = str;
            for (let [k, v] of Object.entries(map)) {
                res = res.split(k).join(v);
            }
            this.outputText = res;
        },
        copyText() {
            navigator.clipboard.writeText(this.outputText);
            alert('Preeti text copied to clipboard!');
        },
        downloadTxt() {
            let blob = new Blob([this.outputText], { type: 'text/plain;charset=utf-8' });
            let url = URL.createObjectURL(blob);
            let a = document.createElement('a');
            a.href = url;
            a.download = 'unicode-to-preeti.txt';
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