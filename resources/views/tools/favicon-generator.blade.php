@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="faviconGeneratorTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'globe' }}" class="w-6 h-6"></i>
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
            <h3 class="text-base font-bold text-gray-900 mb-1">Choose Logo Image</h3>
            <p class="text-xs text-gray-500">Generate multi-resolution favicons packaged in ZIP</p>
        </div>

        <div x-show="imageSrc" class="space-y-6" x-cloak>
            <div class="text-center bg-gray-50 p-4 rounded-xl border border-gray-200">
                <img :src="imageSrc" class="w-24 h-24 mx-auto object-contain rounded-lg">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-2">HTML Favicon Code Snippet</label>
                <textarea readonly rows="3" class="w-full bg-gray-100 border border-gray-300 rounded-xl p-3 text-xs font-mono">&lt;link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png"&gt;
&lt;link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png"&gt;</textarea>
            </div>

            <button @click="generateZip" :disabled="processing" class="w-full bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition disabled:opacity-50">
                <span x-show="!processing">Generate & Download Favicon Package (ZIP)</span>
                <span x-show="processing">Generating Icons...</span>
            </button>
        </div>

        <div x-show="zipUrl" class="mt-6 p-6 bg-green-50 rounded-2xl border border-green-200 text-center" x-cloak>
            <div class="text-green-700 font-bold mb-2">Favicon Package Generated!</div>
            <a :href="zipUrl" download="favicon-package.zip" class="inline-block bg-green-600 text-white font-semibold px-6 py-2.5 rounded-xl hover:bg-green-700 transition">
                Download ZIP Archive
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
function faviconGeneratorTool() {
    return {
        imageSrc: '',
        processing: false,
        zipUrl: '',
        imageObj: null,
        handleFile(f) {
            if (!f || !f.type.startsWith('image/')) return;
            let reader = new FileReader();
            reader.onload = (e) => {
                this.imageSrc = e.target.result;
                let img = new Image();
                img.onload = () => {
                    this.imageObj = img;
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(f);
        },
        async generateZip() {
            this.processing = true;
            try {
                const zip = new JSZip();
                let sizes = [16, 32, 48, 180, 512];
                for (let size of sizes) {
                    let canvas = document.createElement('canvas');
                    canvas.width = size;
                    canvas.height = size;
                    let ctx = canvas.getContext('2d');
                    ctx.drawImage(this.imageObj, 0, 0, size, size);
                    let dataUrl = canvas.toDataURL('image/png');
                    let base64 = dataUrl.replace(/^data:image\/png;base64,/, "");
                    zip.file(`favicon-${size}x${size}.png`, base64, { base64: true });
                }
                const content = await zip.generateAsync({ type: 'blob' });
                this.zipUrl = URL.createObjectURL(content);
            } catch (e) {
                console.error(e);
                alert('Error generating favicon package.');
            } finally {
                this.processing = false;
            }
        }
    }
}
</script>
@endpush
@endsection