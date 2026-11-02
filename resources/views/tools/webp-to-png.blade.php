@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="webpToPngTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'file-image' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div x-show="!imageSrc" class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center bg-gray-50 cursor-pointer mb-6" @click="$refs.fileInput.click()">
            <input type="file" x-ref="fileInput" @change="handleFile($event.target.files[0])" accept="image/webp" class="hidden">
            <div class="w-16 h-16 bg-red-100 text-[#E83E46] rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="upload-cloud" class="w-8 h-8"></i>
            </div>
            <h3 class="text-base font-bold text-gray-900 mb-1">Choose WebP Image</h3>
            <p class="text-xs text-gray-500">Convert WebP format to lossless PNG preserving transparency</p>
        </div>

        <div x-show="imageSrc" class="space-y-6" x-cloak>
            <div class="text-center bg-gray-50 p-4 rounded-xl border border-gray-200">
                <img :src="pngSrc" class="max-h-80 mx-auto object-contain rounded-lg">
            </div>

            <div class="flex space-x-4">
                <a :href="pngSrc" download="converted.png" class="flex-grow bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition text-center shadow-xs">
                    Download PNG Image
                </a>
                <button @click="resetForm" class="bg-gray-100 text-gray-700 font-semibold px-6 py-3 rounded-xl hover:bg-gray-200 transition">Reset</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function webpToPngTool() {
    return {
        imageSrc: '',
        pngSrc: '',
        handleFile(f) {
            if (!f) return;
            let reader = new FileReader();
            reader.onload = (e) => {
                this.imageSrc = e.target.result;
                let img = new Image();
                img.onload = () => {
                    let canvas = document.createElement('canvas');
                    canvas.width = img.width;
                    canvas.height = img.height;
                    let ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0);
                    this.pngSrc = canvas.toDataURL('image/png');
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(f);
        },
        resetForm() {
            this.imageSrc = '';
            this.pngSrc = '';
        }
    }
}
</script>
@endpush
@endsection