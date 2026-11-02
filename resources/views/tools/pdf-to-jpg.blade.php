@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="pdfToJpgTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'image' }}" class="w-6 h-6"></i>
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
            <h3 class="text-base font-bold text-gray-900 mb-1">Choose PDF to Convert to JPG</h3>
            <p class="text-xs text-gray-500">Extract pages as image files packaged in a ZIP archive</p>
        </div>

        <div x-show="file" class="space-y-6" x-cloak>
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-200">
                <div class="flex items-center space-x-3">
                    <i data-lucide="file-text" class="w-6 h-6 text-[#E83E46]"></i>
                    <div class="font-bold text-gray-900" x-text="file?.name"></div>
                </div>
                <button @click="resetForm" class="text-xs text-red-500 font-semibold hover:underline">Change File</button>
            </div>

            <button @click="convertToJpg" :disabled="processing" class="w-full bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition disabled:opacity-50">
                <span x-show="!processing">Convert PDF to JPG Now</span>
                <span x-show="processing" x-text="statusText">Converting...</span>
            </button>
        </div>

        <div x-show="zipUrl" class="mt-6 p-6 bg-green-50 rounded-2xl border border-green-200 text-center" x-cloak>
            <div class="text-green-700 font-bold mb-2">Converted to JPG Successfully!</div>
            <a :href="zipUrl" download="pdf-pages-jpg.zip" class="inline-block bg-green-600 text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-green-700 transition">
                Download ZIP Archive
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

function pdfToJpgTool() {
    return {
        file: null,
        processing: false,
        zipUrl: '',
        statusText: 'Converting...',
        handleFile(f) {
            if (!f || f.type !== 'application/pdf') {
                alert('Please select a valid PDF file.');
                return;
            }
            this.file = f;
        },
        resetForm() {
            this.file = null;
            this.zipUrl = '';
        },
        async convertToJpg() {
            this.processing = true;
            try {
                const arrayBuffer = await this.file.arrayBuffer();
                const loadingTask = pdfjsLib.getDocument({ data: arrayBuffer });
                const pdf = await loadingTask.promise;
                const zip = new JSZip();

                for (let i = 1; i <= pdf.numPages; i++) {
                    this.statusText = `Rendering page ${i} of ${pdf.numPages}...`;
                    const page = await pdf.getPage(i);
                    const viewport = page.getViewport({ scale: 1.5 });
                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    await page.render({ canvasContext: context, viewport: viewport }).promise;
                    let dataUrl = canvas.toDataURL('image/jpeg', 0.9);
                    let base64Data = dataUrl.replace(/^data:image\/jpeg;base64,/, "");
                    zip.file(`page-${i}.jpg`, base64Data, { base64: true });
                }

                this.statusText = 'Generating ZIP archive...';
                const content = await zip.generateAsync({ type: 'blob' });
                this.zipUrl = URL.createObjectURL(content);
            } catch (e) {
                console.error(e);
                alert('Error converting PDF to JPG.');
            } finally {
                this.processing = false;
            }
        }
    }
}
</script>
@endpush
@endsection