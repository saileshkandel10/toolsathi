@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="jpgToPdfTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'file-plus' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center bg-gray-50 cursor-pointer mb-6" @click="$refs.fileInput.click()">
            <input type="file" x-ref="fileInput" @change="handleFiles($event.target.files)" multiple accept="image/jpeg,image/png" class="hidden">
            <div class="w-16 h-16 bg-red-100 text-[#E83E46] rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="upload-cloud" class="w-8 h-8"></i>
            </div>
            <h3 class="text-base font-bold text-gray-900 mb-1">Choose Images (JPG, PNG)</h3>
            <p class="text-xs text-gray-500">Combine multiple images into a single PDF document</p>
        </div>

        <div x-show="images.length > 0" class="space-y-6" x-cloak>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <template x-for="(img, index) in images" :key="index">
                    <div class="relative bg-gray-50 p-2 rounded-xl border border-gray-200 text-center">
                        <img :src="img.preview" class="w-full h-24 object-cover rounded-lg mb-2">
                        <span class="text-[10px] text-gray-500 truncate block" x-text="img.file.name"></span>
                        <button @click="removeImage(index)" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center">&times;</button>
                    </div>
                </template>
            </div>

            <button @click="convertToPdf" :disabled="processing" class="w-full bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition disabled:opacity-50">
                <span x-show="!processing">Convert Images to PDF Now</span>
                <span x-show="processing">Generating PDF...</span>
            </button>
        </div>

        <div x-show="pdfUrl" class="mt-6 p-6 bg-green-50 rounded-2xl border border-green-200 text-center" x-cloak>
            <div class="text-green-700 font-bold mb-2">PDF Generated Successfully!</div>
            <a :href="pdfUrl" download="images-converted.pdf" class="inline-block bg-green-600 text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-green-700 transition">
                Download Converted PDF
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
function jpgToPdfTool() {
    return {
        images: [],
        processing: false,
        pdfUrl: '',
        handleFiles(files) {
            for (let f of files) {
                if (f.type === 'image/jpeg' || f.type === 'image/png') {
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        this.images.push({ file: f, preview: e.target.result });
                    };
                    reader.readAsDataURL(f);
                } else {
                    alert('Please select valid JPG or PNG images.');
                }
            }
        },
        removeImage(index) {
            this.images.splice(index, 1);
        },
        async convertToPdf() {
            if (this.images.length === 0) return;
            this.processing = true;
            try {
                const pdfDoc = await PDFLib.PDFDocument.create();
                for (let imgObj of this.images) {
                    const arrayBuffer = await imgObj.file.arrayBuffer();
                    let embeddedImage;
                    if (imgObj.file.type === 'image/png') {
                        embeddedImage = await pdfDoc.embedPng(arrayBuffer);
                    } else {
                        embeddedImage = await pdfDoc.embedJpg(arrayBuffer);
                    }
                    const page = pdfDoc.addPage([embeddedImage.width, embeddedImage.height]);
                    page.drawImage(embeddedImage, {
                        x: 0,
                        y: 0,
                        width: embeddedImage.width,
                        height: embeddedImage.height,
                    });
                }
                const pdfBytes = await pdfDoc.save();
                const blob = new Blob([pdfBytes], { type: 'application/pdf' });
                this.pdfUrl = URL.createObjectURL(blob);
            } catch (e) {
                console.error(e);
                alert('Error converting images to PDF.');
            } finally {
                this.processing = false;
            }
        }
    }
}
</script>
@endpush
@endsection