@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="passportPhotoTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'user' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-xl text-xs text-yellow-800 mb-6">
            <strong>Disclaimer:</strong> Please verify official passport or visa dimension and background requirements before submitting your final printed photograph.
        </div>

        <div x-show="!imageSrc" class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center bg-gray-50 cursor-pointer mb-6" @click="$refs.fileInput.click()">
            <input type="file" x-ref="fileInput" @change="handleFile($event.target.files[0])" accept="image/*" class="hidden">
            <div class="w-16 h-16 bg-red-100 text-[#E83E46] rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="upload-cloud" class="w-8 h-8"></i>
            </div>
            <h3 class="text-base font-bold text-gray-900 mb-1">Choose Photograph</h3>
            <p class="text-xs text-gray-500">Crop and format to passport specifications</p>
        </div>

        <div x-show="imageSrc" class="space-y-6" x-cloak>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Photo Size Preset</label>
                    <select x-model="sizePreset" @change="updateDimensions" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-hidden focus:border-[#E83E46]">
                        <option value="2x2">2 x 2 inches (US Visa / Passport)</option>
                        <option value="35x45">35 x 45 mm (Standard Passport)</option>
                        <option value="custom">Custom Dimensions</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Background Color</label>
                    <select x-model="bgColor" @change="generatePhoto" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-hidden focus:border-[#E83E46]">
                        <option value="#ffffff">White</option>
                        <option value="#3b82f6">Light Blue</option>
                        <option value="#ef4444">Red</option>
                    </select>
                </div>
            </div>

            <div class="text-center bg-gray-50 p-4 rounded-xl border border-gray-200">
                <img :src="outputSrc" class="max-h-80 mx-auto object-contain rounded-lg border border-gray-200">
            </div>

            <div class="flex space-x-4">
                <a :href="outputSrc" download="passport-photo.jpg" class="flex-grow bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition text-center shadow-xs">
                    Download Passport Photo
                </a>
                <button @click="resetForm" class="bg-gray-100 text-gray-700 font-semibold px-6 py-3 rounded-xl hover:bg-gray-200 transition">Reset</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function passportPhotoTool() {
    return {
        imageSrc: '',
        outputSrc: '',
        sizePreset: '2x2',
        bgColor: '#ffffff',
        imageObj: null,
        handleFile(f) {
            if (!f || !f.type.startsWith('image/')) return;
            let reader = new FileReader();
            reader.onload = (e) => {
                this.imageSrc = e.target.result;
                let img = new Image();
                img.onload = () => {
                    this.imageObj = img;
                    this.generatePhoto();
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(f);
        },
        updateDimensions() {
            this.generatePhoto();
        },
        generatePhoto() {
            if (!this.imageObj) return;
            let width = 600;
            let height = 600;
            if (this.sizePreset === '35x45') {
                width = 413;
                height = 531;
            }

            let canvas = document.createElement('canvas');
            canvas.width = width;
            canvas.height = height;
            let ctx = canvas.getContext('2d');

            ctx.fillStyle = this.bgColor;
            ctx.fillRect(0, 0, width, height);

            // Center image crop simulation
            let iw = this.imageObj.width;
            let ih = this.imageObj.height;
            let scale = Math.max(width / iw, height / ih);
            let x = (width / 2) - (iw / 2) * scale;
            let y = (height / 2) - (ih / 2) * scale;

            ctx.drawImage(this.imageObj, x, y, iw * scale, ih * scale);
            this.outputSrc = canvas.toDataURL('image/jpeg', 0.95);
        },
        resetForm() {
            this.imageSrc = '';
            this.outputSrc = '';
            this.imageObj = null;
        }
    }
}
</script>
@endpush
@endsection