@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="caseConverterTool()">
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

        <textarea x-model="text" rows="8" placeholder="Type or paste your text here..." class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm focus:outline-hidden focus:border-[#E83E46] mb-4"></textarea>

        <div class="flex flex-wrap gap-3 mb-6">
            <button @click="toUpper" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold px-4 py-2 rounded-xl text-xs transition">UPPERCASE</button>
            <button @click="toLower" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold px-4 py-2 rounded-xl text-xs transition">lowercase</button>
            <button @click="toTitle" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold px-4 py-2 rounded-xl text-xs transition">Title Case</button>
            <button @click="toSentence" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold px-4 py-2 rounded-xl text-xs transition">Sentence case</button>
        </div>

        <div class="flex space-x-4">
            <button @click="copyText" class="bg-[#E83E46] text-white font-semibold px-6 py-2.5 rounded-xl text-sm hover:bg-[#d23239] transition">Copy Text</button>
            <button @click="text = ''" class="bg-gray-100 text-gray-700 font-semibold px-4 py-2.5 rounded-xl text-sm transition">Clear</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
function caseConverterTool() {
    return {
        text: '',
        toUpper() { this.text = this.text.toUpperCase(); },
        toLower() { this.text = this.text.toLowerCase(); },
        toTitle() {
            this.text = this.text.toLowerCase().replace(/(^\w{1})|(\s+\w{1})/g, match => match.toUpperCase());
        },
        toSentence() {
            this.text = this.text.toLowerCase().replace(/(^\s*\w|[.!?]\s*\w)/g, c => c.toUpperCase());
        },
        copyText() {
            navigator.clipboard.writeText(this.text);
            alert('Copied to clipboard!');
        }
    }
}
</script>
@endpush
@endsection