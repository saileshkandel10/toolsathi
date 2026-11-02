@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="charCounterTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'hash' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6 text-center">
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                <div class="text-2xl font-extrabold text-[#E83E46]" x-text="text.length">0</div>
                <div class="text-xs text-gray-500 uppercase font-semibold mt-1">Characters (with spaces)</div>
            </div>
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                <div class="text-2xl font-extrabold text-gray-800" x-text="text.replace(/\s+/g, '').length">0</div>
                <div class="text-xs text-gray-500 uppercase font-semibold mt-1">Characters (no spaces)</div>
            </div>
        </div>

        <div>
            <textarea x-model="text" rows="8" placeholder="Type or paste text here..." class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm focus:outline-hidden focus:border-[#E83E46]"></textarea>
        </div>
    </div>
</div>

@push('scripts')
<script>
function charCounterTool() {
    return {
        text: ''
    }
}
</script>
@endpush
@endsection