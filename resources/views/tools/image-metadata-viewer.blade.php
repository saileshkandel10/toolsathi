@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="imageMetadataTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'info' }}" class="w-6 h-6"></i>
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
            <h3 class="text-base font-bold text-gray-900 mb-1">Choose Image to Inspect Metadata</h3>
            <p class="text-xs text-gray-500">View file properties, dimensions, and EXIF info</p>
        </div>

        <div x-show="imageSrc" class="space-y-6" x-cloak>
            <div class="text-center bg-gray-50 p-4 rounded-xl border border-gray-200">
                <img :src="imageSrc" class="max-h-48 mx-auto object-contain rounded-lg">
            </div>

            <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 space-y-3 text-sm">
                <div class="flex justify-between border-b border-gray-200 pb-2">
                    <span class="font-semibold text-gray-600">File Name:</span>
                    <span class="text-gray-900 font-mono" x-text="fileName"></span>
                </div>
                <div class="flex justify-between border-b border-gray-200 pb-2">
                    <span class="font-semibold text-gray-600">File Format:</span>
                    <span class="text-gray-900 font-mono" x-text="fileType"></span>
                </div>
                <div class="flex justify-between border-b border-gray-200 pb-2">
                    <span class="font-semibold text-gray-600">File Size:</span>
                    <span class="text-gray-900 font-mono" x-text="fileSize"></span>
                </div>
                <div class="flex justify-between border-b border-gray-200 pb-2">
                    <span class="font-semibold text-gray-600">Dimensions:</span>
                    <span class="text-gray-900 font-mono" x-text="width + ' x ' + height + ' px'"></span>
                </div>
                <div class="flex justify-between">
                    <span class="font-semibold text-gray-600">Aspect Ratio:</span>
                    <span class="text-gray-900 font-mono" x-text="aspectRatio"></span>
                </div>
            </div>

            <button @click="resetForm" class="w-full bg-gray-100 text-gray-700 font-semibold py-3 rounded-xl hover:bg-gray-200 transition">Upload Another Image</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
function imageMetadataTool() {
    return {
        imageSrc: '',
        fileName: '',
        fileType: '',
        fileSize: '',
        width: 0,
        height: 0,
        aspectRatio: '',
        handleFile(f) {
            if (!f || !f.type.startsWith('image/')) return;
            this.fileName = f.name;
            this.fileType = f.type;
            this.fileSize = (f.size / 1024).toFixed(2) + ' KB';
            let reader = new FileReader();
            reader.onload = (e) => {
                this.imageSrc = e.target.result;
                let img = new Image();
                img.onload = () => {
                    this.width = img.width;
                    this.height = img.height;
                    let gcd = (a, b) => b === 0 ? a : gcd(b, a % b);
                    let d = gcd(img.width, img.height);
                    this.aspectRatio = `${img.width / d}:${img.height / d}`;
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(f);
        },
        resetForm() {
            this.imageSrc = '';
        }
    }
}
</script>
@endpush
@endsection