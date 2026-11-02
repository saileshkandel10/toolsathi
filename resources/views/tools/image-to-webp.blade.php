@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="imageToWebpTool()">
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

        <div x-show="!imageSrc" class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center bg-gray-50 cursor-pointer mb-6" @click="$refs.fileInput.click()">
            <input type="file" x-ref="fileInput" @change="handleFile($event.target.files[0])" accept="image/*" class="hidden">
            <div class="w-16 h-16 bg-red-100 text-[#E83E46] rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="upload-cloud" class="w-8 h-8"></i>
            </div>
            <h3 class="text-base font-bold text-gray-900 mb-1">Choose Image to Convert to WebP</h3>
            <p class="text-xs text-gray-500">Supports JPG, PNG, and GIF</p>
        </div>

        <div x-show="imageSrc" class="space-y-6" x-cloak>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-center">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-2">Original</label>
                    <img :src="imageSrc" class="max-h-48 mx-auto object-contain rounded-xl border border-gray-200 p-2">
                    <div class="text-xs text-gray-500 mt-2">Size: <strong x-text="originalSize"></strong></div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-2">WebP Result</label>
                    <img :src="webpSrc" class="max-h-48 mx-auto object-contain rounded-xl border border-gray-200 p-2">
                    <div class="text-xs text-gray-500 mt-2">Size: <strong x-text="webpSize"></strong></div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Quality: <span x-text="Math.round(quality * 100) + '%'"></span></label>
                <input type="range" x-model.number="quality" min="0.1" max="1.0" step="0.05" @input="convert" class="w-full accent-[#E83E46]">
            </div>

            <div class="flex space-x-4">
                <a :href="webpSrc" download="converted.webp" class="flex-grow bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition text-center shadow-xs">
                    Download WebP Image
                </a>
                <button @click="resetForm" class="bg-gray-100 text-gray-700 font-semibold px-6 py-3 rounded-xl hover:bg-gray-200 transition">Reset</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function imageToWebpTool() {
    return {
        imageSrc: '',
        webpSrc: '',
        originalSize: '',
        webpSize: '',
        quality: 0.85,
        imageObj: null,
        handleFile(f) {
            if (!f || !f.type.startsWith('image/')) return;
            this.originalSize = (f.size / 1024).toFixed(2) + ' KB';
            let reader = new FileReader();
            reader.onload = (e) => {
                this.imageSrc = e.target.result;
                let img = new Image();
                img.onload = () => {
                    this.imageObj = img;
                    this.convert();
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(f);
        },
        convert() {
            if (!this.imageObj) return;
            let canvas = document.createElement('canvas');
            canvas.width = this.imageObj.width;
            canvas.height = this.imageObj.height;
            let ctx = canvas.getContext('2d');
            ctx.drawImage(this.imageObj, 0, 0);
            let dataUrl = canvas.toDataURL('image/webp', this.quality);
            this.webpSrc = dataUrl;
            let len = dataUrl.length - (dataUrl.indexOf(',') + 1);
            this.webpSize = ((len * 3) / 4 / 1024).toFixed(2) + ' KB';
        },
        resetForm() {
            this.imageSrc = '';
            this.webpSrc = '';
            this.imageObj = null;
        }
    }
}
</script>
@endpush
@endsection