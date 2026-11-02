@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="nepaliTypingTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'edit-3' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="mb-4 flex items-center justify-between text-xs text-gray-500 bg-gray-50 p-3 rounded-xl border border-gray-200">
            <span>Words: <strong class="text-gray-900" x-text="wordCount">0</strong></span>
            <span>Characters: <strong class="text-gray-900" x-text="charCount">0</strong></span>
        </div>

        <textarea x-model="text" rows="10" placeholder="Type here in Romanized Nepali (e.g. 'nepal ma swagat cha')..." class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm focus:outline-hidden focus:border-[#E83E46] mb-4"></textarea>

        <div class="flex space-x-4">
            <button @click="copyText" class="bg-[#E83E46] text-white font-semibold px-6 py-2.5 rounded-xl text-sm hover:bg-[#d23239] transition">Copy Text</button>
            <button @click="downloadTxt" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-2.5 rounded-xl text-sm transition">Download TXT</button>
            <button @click="text = ''" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2.5 rounded-xl text-sm transition">Clear</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
function nepaliTypingTool() {
    return {
        text: '',
        get wordCount() {
            if (!this.text.trim()) return 0;
            return this.text.trim().split(/\s+/).length;
        },
        get charCount() {
            return this.text.length;
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
            a.download = 'nepali-typing.txt';
            a.click();
        }
    }
}
</script>
@endpush
@endsection