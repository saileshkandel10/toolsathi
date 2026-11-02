@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="mergePdfTool()">
    <!-- Breadcrumbs -->
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
                <i data-lucide="{{ $tool->icon ?? 'files' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <!-- Dropzone -->
        <div 
            @dragover.prevent="dragover = true" 
            @dragleave.prevent="dragover = false" 
            @drop.prevent="dragover = false; handleFiles($event.dataTransfer.files)"
            :class="dragover ? 'border-[#E83E46] bg-red-50/50' : 'border-gray-300 bg-gray-50'"
            class="border-2 border-dashed rounded-2xl p-8 text-center transition cursor-pointer mb-6"
            @click="$refs.fileInput.click()"
        >
            <input type="file" x-ref="fileInput" @change="handleFiles($event.target.files)" multiple accept="application/pdf" class="hidden">
            <div class="w-16 h-16 bg-red-100 text-[#E83E46] rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="upload-cloud" class="w-8 h-8"></i>
            </div>
            <h3 class="text-base font-bold text-gray-900 mb-1">Drag and drop PDF files here</h3>
            <p class="text-xs text-gray-500 mb-4">or click to browse files from your computer (Max 50MB)</p>
            <button type="button" class="bg-[#E83E46] text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#d23239] transition">
                Choose PDF Files
            </button>
        </div>

        <!-- File List -->
        <div x-show="files.length > 0" class="mb-6 space-y-3" x-cloak>
            <h4 class="text-xs font-semibold uppercase text-gray-500 tracking-wider">Selected Files (<span x-text="files.length"></span>)</h4>
            <template x-for="(file, index) in files" :key="index">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-200">
                    <div class="flex items-center space-x-3">
                        <i data-lucide="file-text" class="w-5 h-5 text-[#E83E46]"></i>
                        <div>
                            <div class="text-sm font-semibold text-gray-900" x-text="file.name"></div>
                            <div class="text-[10px] text-gray-500" x-text="(file.size / 1024 / 1024).toFixed(2) + ' MB'"></div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button @click.stop="moveUp(index)" x-show="index > 0" class="p-1 text-gray-400 hover:text-gray-600">&uarr;</button>
                        <button @click.stop="moveDown(index)" x-show="index < files.length - 1" class="p-1 text-gray-400 hover:text-gray-600">&darr;</button>
                        <button @click.stop="removeFile(index)" class="p-1 text-red-500 hover:text-red-700">&times;</button>
                    </div>
                </div>
            </template>
        </div>

        <!-- Action Buttons -->
        <div x-show="files.length > 0" class="flex space-x-4" x-cloak>
            <button @click="mergePdfs" :disabled="processing" class="flex-grow bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition flex items-center justify-center space-x-2 disabled:opacity-50">
                <span x-show="!processing">Merge PDFs Now</span>
                <span x-show="processing" class="flex items-center space-x-2">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>Merging PDFs...</span>
                </span>
            </button>
            <button @click="resetForm" class="bg-gray-100 text-gray-700 font-semibold px-6 py-3 rounded-xl hover:bg-gray-200 transition">
                Reset
            </button>
        </div>

        <!-- Success Result -->
        <div x-show="mergedUrl" class="mt-6 p-6 bg-green-50 rounded-2xl border border-green-200 text-center" x-cloak>
            <div class="text-green-700 font-bold mb-2">PDFs Merged Successfully!</div>
            <a :href="mergedUrl" download="merged.pdf" class="inline-block bg-green-600 text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-green-700 transition">
                Download Merged PDF
            </a>
        </div>
    </div>

    <!-- How-to & FAQs -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8 space-y-6">
        <div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">How to Merge PDF Files Online</h3>
            <ol class="list-decimal pl-5 space-y-2 text-sm text-gray-600">
                <li>Upload or drag-and-drop your PDF files into the secure box above.</li>
                <li>Reorder the files if necessary using the up/down arrows.</li>
                <li>Click "Merge PDFs Now" to combine them securely in your browser.</li>
                <li>Download your merged PDF document instantly.</li>
            </ol>
        </div>
        <div class="border-t border-gray-100 pt-6">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Frequently Asked Questions</h3>
            <div class="space-y-4 text-sm">
                <div>
                    <h4 class="font-semibold text-gray-800">Is it safe to merge PDFs here?</h4>
                    <p class="text-gray-600">Yes! Processing happens entirely client-side in your browser using secure JavaScript libraries. Your files are never uploaded to any server.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800">Is there any file size limit?</h4>
                    <p class="text-gray-600">You can merge multiple PDFs as long as your browser memory permits (typically up to 50MB per file).</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Tools -->
    @if($relatedTools->count() > 0)
        <div class="mt-12">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Related Tools in {{ $category->name }}</h3>
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
function mergePdfTool() {
    return {
        files: [],
        dragover: false,
        processing: false,
        mergedUrl: '',
        handleFiles(newFiles) {
            for (let f of newFiles) {
                if (f.type === 'application/pdf') {
                    this.files.push(f);
                } else {
                    alert('Please select valid PDF files.');
                }
            }
        },
        removeFile(index) {
            this.files.splice(index, 1);
        },
        moveUp(index) {
            if (index > 0) {
                let temp = this.files[index];
                this.files[index] = this.files[index - 1];
                this.files[index - 1] = temp;
            }
        },
        moveDown(index) {
            if (index < this.files.length - 1) {
                let temp = this.files[index];
                this.files[index] = this.files[index + 1];
                this.files[index + 1] = temp;
            }
        },
        resetForm() {
            this.files = [];
            this.mergedUrl = '';
        },
        async mergePdfs() {
            if (this.files.length < 2) {
                alert('Please select at least 2 PDF files to merge.');
                return;
            }
            this.processing = true;
            try {
                const mergedPdf = await PDFLib.PDFDocument.create();
                for (let file of this.files) {
                    const arrayBuffer = await file.arrayBuffer();
                    const pdfDoc = await PDFLib.PDFDocument.load(arrayBuffer);
                    const copiedPages = await mergedPdf.copyPages(pdfDoc, pdfDoc.getPageIndices());
                    copiedPages.forEach((page) => mergedPdf.addPage(page));
                }
                const mergedPdfBytes = await mergedPdf.save();
                const blob = new Blob([mergedPdfBytes], { type: 'application/pdf' });
                this.mergedUrl = URL.createObjectURL(blob);
            } catch (e) {
                console.error(e);
                alert('Error merging PDFs. Please ensure files are valid and unencrypted.');
            } finally {
                this.processing = false;
            }
        }
    }
}
</script>
@endpush
@endsection