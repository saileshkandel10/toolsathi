@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="easyNepaliTyping()">
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
                <i data-lucide="{{ $tool->icon ?? 'edit-3' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="flex items-center justify-between mb-4 bg-gray-50 p-3 rounded-xl border border-gray-200 text-xs text-gray-500">
            <span>Characters: <strong class="text-gray-900" x-text="text.length">0</strong></span>
            <span>Words: <strong class="text-gray-900" x-text="wordCount">0</strong></span>
            <a href="{{ url('/nepali-tools/unicode-to-preeti') }}" class="text-[#E83E46] font-semibold hover:underline">Convert to Preeti &rarr;</a>
        </div>

        <textarea x-model="text" @input="transliterate" rows="10" placeholder="Type Romanized Nepali (e.g. 'nepal mero desh ho')..." class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm focus:outline-hidden focus:border-[#E83E46] mb-4"></textarea>

        <div class="flex space-x-4">
            <button @click="copyText" class="bg-[#E83E46] text-white font-semibold px-6 py-2.5 rounded-xl text-sm hover:bg-[#d23239] transition">Copy Text</button>
            <button @click="downloadTxt" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-2.5 rounded-xl text-sm transition">Download TXT</button>
            <button @click="text = ''" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2.5 rounded-xl text-sm transition">Clear</button>
        </div>
    </div>

    <!-- Related Tools -->
    @if($relatedTools->count() > 0)
        <div class="mt-12">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Related Tools in Nepali Tools</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($relatedTools as $rel)
                    <a href="{{ url('/' . $category->slug . '/' . $rel->slug) }}" class="bg-white p-4 rounded-xl border border-gray-200 hover:border-[#E83E46] transition flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-lg bg-red-50 text-[#E83E46] flex items-center justify-center shrink-0">
                            <i data-lucide="{{ $rel->icon ?? 'tool' }}" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 text-sm">{{ $rel->name }}</h4>
                            <p class="text-xs text-gray-500 line-clamp-1">{{ $rel->description }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
function easyNepaliTyping() {
    return {
        text: '',
        get wordCount() {
            if (!this.text.trim()) return 0;
            return this.text.trim().split(/\s+/).length;
        },
        transliterate() {
            // Enhanced transliteration simulation
            let t = this.text;
            const map = {
                'nepal': 'नेपाल',
                'mero': 'मेरो',
                'naam': 'नाम',
                'ram': 'राम',
                'ho': 'हो',
                'desh': 'देश',
                'tapai': 'तपाईं',
                'kasto': 'कस्तो',
                'chha': 'छ',
                'namaste': 'नमस्ते'
            };
            let words = t.split(' ');
            let res = words.map(w => map[w.toLowerCase()] || w);
            // Only update if changed via space/punctuation
            if (t.endsWith(' ')) {
                this.text = res.join(' ');
            }
        },
        copyText() {
            navigator.clipboard.writeText(this.text);
            alert('Copied to clipboard!');
        },
        downloadTxt() {
            let blob = new Blob([this.text], { type: 'text/plain;charset=utf-8' });
            let url = URL.createObjectURL(blob);
            let a = document.createElement('a');
            a.href = url;
            a.download = 'easy-nepali-typing.txt';
            a.click();
        }
    }
}
</script>
@endpush
@endsection