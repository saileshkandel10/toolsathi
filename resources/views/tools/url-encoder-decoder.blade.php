@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="urlTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'link' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <textarea x-model="input" rows="6" placeholder="URL string..." class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm font-mono focus:outline-hidden focus:border-[#E83E46] mb-4"></textarea>

        <div class="flex space-x-4 mb-6">
            <button @click="encode" class="bg-[#E83E46] text-white font-semibold px-6 py-2.5 rounded-xl text-sm hover:bg-[#d23239] transition">URL Encode</button>
            <button @click="decode" class="bg-gray-100 text-gray-800 font-semibold px-6 py-2.5 rounded-xl text-sm hover:bg-gray-200 transition">URL Decode</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
function urlTool() {
    return {
        input: '',
        encode() { this.input = encodeURIComponent(this.input); },
        decode() { this.input = decodeURIComponent(this.input); }
    }
}
</script>
@endpush
@endsection