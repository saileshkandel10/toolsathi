@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="qrGenerator()">
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
                <i data-lucide="{{ $tool->icon ?? 'qr-code' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Enter Text or URL</label>
                    <textarea x-model="text" @input="generateQr" rows="5" placeholder="https://toolsathi.com" class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm focus:outline-hidden focus:border-[#E83E46]"></textarea>
                </div>
            </div>

            <div class="flex flex-col items-center justify-center bg-gray-50 p-6 rounded-2xl border border-gray-200">
                <div class="bg-white p-4 rounded-xl shadow-xs border border-gray-200 mb-4">
                    <img :src="qrUrl" alt="QR Code" class="w-48 h-48 object-contain">
                </div>
                <a :href="qrUrl" download="qrcode.png" class="bg-[#E83E46] text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#d23239] transition">
                    Download QR Code
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function qrGenerator() {
    return {
        text: 'https://toolsathi.com',
        get qrUrl() {
            let val = encodeURIComponent(this.text || 'https://toolsathi.com');
            return `https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=${val}`;
        },
        generateQr() {
            // Reactive via getter
        }
    }
}
</script>
@endpush
@endsection