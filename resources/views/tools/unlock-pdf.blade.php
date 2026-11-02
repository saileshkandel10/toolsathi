@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="unlockPdfTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'unlock' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div x-show="!file" class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center bg-gray-50 cursor-pointer mb-6" @click="$refs.fileInput.click()">
            <input type="file" x-ref="fileInput" @change="handleFile($event.target.files[0])" accept="application/pdf" class="hidden">
            <div class="w-16 h-16 bg-red-100 text-[#E83E46] rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="upload-cloud" class="w-8 h-8"></i>
            </div>
            <h3 class="text-base font-bold text-gray-900 mb-1">Choose Locked PDF</h3>
            <p class="text-xs text-gray-500">Remove password security from unlocked PDF documents</p>
        </div>

        <div x-show="file" class="space-y-6" x-cloak>
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-200">
                <div class="flex items-center space-x-3">
                    <i data-lucide="file-text" class="w-6 h-6 text-[#E83E46]"></i>
                    <div class="font-bold text-gray-900" x-text="file?.name"></div>
                </div>
                <button @click="resetForm" class="text-xs text-red-500 font-semibold hover:underline">Change File</button>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Owner / User Password (if known)</label>
                <input type="password" x-model="password" placeholder="Enter document password" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>

            <button @click="unlockPdf" :disabled="processing" class="w-full bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition disabled:opacity-50">
                <span x-show="!processing">Unlock PDF Now</span>
                <span x-show="processing">Unlocking...</span>
            </button>
        </div>

        <div x-show="unlockedUrl" class="mt-6 p-6 bg-green-50 rounded-2xl border border-green-200 text-center" x-cloak>
            <div class="text-green-700 font-bold mb-2">PDF Unlocked Successfully!</div>
            <a :href="unlockedUrl" download="unlocked.pdf" class="inline-block bg-green-600 text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-green-700 transition">
                Download Unlocked PDF
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
function unlockPdfTool() {
    return {
        file: null,
        password: '',
        processing: false,
        unlockedUrl: '',
        handleFile(f) {
            if (!f || f.type !== 'application/pdf') {
                alert('Please select a valid PDF file.');
                return;
            }
            this.file = f;
        },
        resetForm() {
            this.file = null;
            this.password = '';
            this.unlockedUrl = '';
        },
        async unlockPdf() {
            this.processing = true;
            try {
                const arrayBuffer = await this.file.arrayBuffer();
                const pdfDoc = await PDFLib.PDFDocument.load(arrayBuffer, { password: this.password });
                const pdfBytes = await pdfDoc.save();
                const blob = new Blob([pdfBytes], { type: 'application/pdf' });
                this.unlockedUrl = URL.createObjectURL(blob);
            } catch (e) {
                console.error(e);
                alert('Error unlocking PDF. Please check password.');
            } finally {
                this.processing = false;
            }
        }
    }
}
</script>
@endpush
@endsection