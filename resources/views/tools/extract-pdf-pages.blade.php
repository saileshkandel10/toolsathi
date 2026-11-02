@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="extractPdfTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'external-link' }}" class="w-6 h-6"></i>
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
            <h3 class="text-base font-bold text-gray-900 mb-1">Choose PDF to Extract Pages</h3>
            <p class="text-xs text-gray-500">Extract specific pages into a new standalone PDF</p>
        </div>

        <div x-show="file" class="space-y-6" x-cloak>
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-200">
                <div class="flex items-center space-x-3">
                    <i data-lucide="file-text" class="w-6 h-6 text-[#E83E46]"></i>
                    <div>
                        <div class="font-bold text-gray-900" x-text="file?.name"></div>
                        <div class="text-xs text-gray-500" x-text="totalPages + ' Pages'"></div>
                    </div>
                </div>
                <button @click="resetForm" class="text-xs text-red-500 font-semibold hover:underline">Change File</button>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Pages to Extract (e.g. 1, 3, 5-8)</label>
                <input type="text" x-model="extractPages" placeholder="1, 3, 5-8" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>

            <button @click="extractPdf" :disabled="processing" class="w-full bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition disabled:opacity-50">
                <span x-show="!processing">Extract Pages Now</span>
                <span x-show="processing">Extracting...</span>
            </button>
        </div>

        <div x-show="extractedUrl" class="mt-6 p-6 bg-green-50 rounded-2xl border border-green-200 text-center" x-cloak>
            <div class="text-green-700 font-bold mb-2">Pages Extracted Successfully!</div>
            <a :href="extractedUrl" download="extracted.pdf" class="inline-block bg-green-600 text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-green-700 transition">
                Download Extracted PDF
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
function extractPdfTool() {
    return {
        file: null,
        pdfDoc: null,
        totalPages: 0,
        extractPages: '',
        processing: false,
        extractedUrl: '',
        async handleFile(f) {
            if (!f || f.type !== 'application/pdf') {
                alert('Please select a valid PDF file.');
                return;
            }
            this.file = f;
            const arrayBuffer = await f.arrayBuffer();
            this.pdfDoc = await PDFLib.PDFDocument.load(arrayBuffer);
            this.totalPages = this.pdfDoc.getPageCount();
        },
        resetForm() {
            this.file = null;
            this.pdfDoc = null;
            this.extractedUrl = '';
        },
        async extractPdf() {
            this.processing = true;
            try {
                const newPdf = await PDFLib.PDFDocument.create();
                let indices = [];
                let parts = this.extractPages.split(',');
                for (let p of parts) {
                    if (p.includes('-')) {
                        let [start, end] = p.split('-').map(n => parseInt(n.trim()) - 1);
                        for (let i = start; i <= end; i++) {
                            if (i >= 0 && i < this.totalPages) indices.push(i);
                        }
                    } else {
                        let idx = parseInt(p.trim()) - 1;
                        if (idx >= 0 && idx < this.totalPages) indices.push(idx);
                    }
                }
                const copiedPages = await newPdf.copyPages(this.pdfDoc, indices);
                copiedPages.forEach(p => newPdf.addPage(p));
                const pdfBytes = await newPdf.save();
                const blob = new Blob([pdfBytes], { type: 'application/pdf' });
                this.extractedUrl = URL.createObjectURL(blob);
            } catch (e) {
                console.error(e);
                alert('Error extracting pages.');
            } finally {
                this.processing = false;
            }
        }
    }
}
</script>
@endpush
@endsection