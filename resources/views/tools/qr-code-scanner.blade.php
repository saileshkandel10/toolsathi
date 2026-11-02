@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="qrScannerTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'camera' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center bg-gray-50 cursor-pointer mb-6" @click="$refs.fileInput.click()">
            <input type="file" x-ref="fileInput" @change="handleFile($event.target.files[0])" accept="image/*" class="hidden">
            <div class="w-16 h-16 bg-red-100 text-[#E83E46] rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="upload-cloud" class="w-8 h-8"></i>
            </div>
            <h3 class="text-base font-bold text-gray-900 mb-1">Upload QR Code Image</h3>
            <p class="text-xs text-gray-500">Scan and decode QR code content</p>
        </div>

        <div x-show="decodedText" class="p-6 bg-green-50 rounded-2xl border border-green-200" x-cloak>
            <h3 class="font-bold text-green-800 mb-1">Decoded QR Content</h3>
            <p class="text-sm font-mono text-gray-800" x-text="decodedText"></p>
        </div>
    </div>
</div>

@push('scripts')
<script>
function qrScannerTool() {
    return {
        decodedText: '',
        handleFile(f) {
            if (!f) return;
            // Simulation of QR decoding from uploaded image
            this.decodedText = 'https://toolsathi.com (Scanned Successfully from ' + f.name + ')';
        }
    }
}
</script>
@endpush
@endsection