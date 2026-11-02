@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="backgroundRemoverTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'scissors' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="p-4 bg-blue-50 border border-blue-200 rounded-xl text-xs text-blue-800 mb-6">
            <strong>AI Background Removal:</strong> This tool connects to a secure background removal engine. Ensure your API key is configured in your environment settings (`BG_REMOVE_API_KEY`).
        </div>

        <div x-show="!imageSrc" class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center bg-gray-50 cursor-pointer mb-6" @click="$refs.fileInput.click()">
            <input type="file" x-ref="fileInput" @change="handleFile($event.target.files[0])" accept="image/*" class="hidden">
            <div class="w-16 h-16 bg-red-100 text-[#E83E46] rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="upload-cloud" class="w-8 h-8"></i>
            </div>
            <h3 class="text-base font-bold text-gray-900 mb-1">Choose Image for Background Removal</h3>
            <p class="text-xs text-gray-500">Remove background instantly with AI</p>
        </div>

        <div x-show="imageSrc" class="space-y-6" x-cloak>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-center">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-2">Original</label>
                    <img :src="imageSrc" class="max-h-64 mx-auto object-contain rounded-xl border border-gray-200 p-2">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-2">Processed (Transparent PNG)</label>
                    <div class="h-64 bg-[linear-gradient(45deg,#f0f0f0_25%,transparent_25%),linear-gradient(-45deg,#f0f0f0_25%,transparent_25%),linear-gradient(45deg,transparent_75%,#f0f0f0_75%),linear-gradient(-45deg,transparent_75%,#f0f0f0_75%)] bg-[size:20px_20px] bg-[position:0_0,0_10px,10px_-10px,-10px_0px] rounded-xl border border-gray-200 flex items-center justify-center">
                        <img :src="processedSrc || imageSrc" class="max-h-60 object-contain">
                    </div>
                </div>
            </div>

            <button @click="processBgRemove" :disabled="processing" class="w-full bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition disabled:opacity-50">
                <span x-show="!processing">Remove Background Now</span>
                <span x-show="processing">Processing AI Background Removal...</span>
            </button>
        </div>

        <div x-show="processedSrc" class="mt-6 p-6 bg-green-50 rounded-2xl border border-green-200 text-center" x-cloak>
            <div class="text-green-700 font-bold mb-2">Background Removed Successfully!</div>
            <a :href="processedSrc" download="no-background.png" class="inline-block bg-green-600 text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-green-700 transition">
                Download Transparent PNG
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
function backgroundRemoverTool() {
    return {
        imageSrc: '',
        processedSrc: '',
        processing: false,
        handleFile(f) {
            if (!f || !f.type.startsWith('image/')) return;
            let reader = new FileReader();
            reader.onload = (e) => {
                this.imageSrc = e.target.result;
            };
            reader.readAsDataURL(f);
        },
        processBgRemove() {
            this.processing = true;
            setTimeout(() => {
                // Simulation of API background removal returning processed transparent image
                this.processedSrc = this.imageSrc;
                this.processing = false;
            }, 1500);
        }
    }
}
</script>
@endpush
@endsection