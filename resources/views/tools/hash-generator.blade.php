@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="hashTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'shield' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <textarea x-model="text" @input="generateHashes" rows="6" placeholder="Type text to generate cryptographic hashes..." class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm font-mono focus:outline-hidden focus:border-[#E83E46] mb-6"></textarea>

        <div class="space-y-4">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">SHA-256 Hash</label>
                <input type="text" x-model="sha256" readonly class="w-full bg-gray-100 border border-gray-300 rounded-xl px-4 py-2.5 text-xs font-mono">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">SHA-1 Hash</label>
                <input type="text" x-model="sha1" readonly class="w-full bg-gray-100 border border-gray-300 rounded-xl px-4 py-2.5 text-xs font-mono">
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function hashTool() {
    return {
        text: '',
        sha256: '',
        sha1: '',
        async generateHashes() {
            if (!this.text) {
                this.sha256 = '';
                this.sha1 = '';
                return;
            }
            const msgBuffer = new TextEncoder().encode(this.text);
            
            const hashBuffer256 = await crypto.subtle.digest('SHA-256', msgBuffer);
            const hashArray256 = Array.from(new Uint8Array(hashBuffer256));
            this.sha256 = hashArray256.map(b => b.toString(16).padStart(2, '0')).join('');

            const hashBuffer1 = await crypto.subtle.digest('SHA-1', msgBuffer);
            const hashArray1 = Array.from(new Uint8Array(hashBuffer1));
            this.sha1 = hashArray1.map(b => b.toString(16).padStart(2, '0')).join('');
        }
    }
}
</script>
@endpush
@endsection