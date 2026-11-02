@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="imageMakerApp()">
    <!-- Breadcrumbs -->
    <nav class="text-xs text-gray-500 mb-6 flex items-center space-x-2">
        <a href="{{ route('home') }}" class="hover:text-[#E83E46]">Home</a>
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Controls -->
            <div class="space-y-6 bg-gray-50 p-6 rounded-2xl border border-gray-200">
                <h3 class="font-bold text-gray-900 text-base">Design Controls</h3>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Quote / Greeting Text</label>
                    <textarea x-model="quoteText" @input="drawCanvas" rows="4" class="w-full bg-white border border-gray-300 rounded-xl p-3 text-sm focus:outline-hidden focus:border-[#E83E46]"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Background Color</label>
                    <input type="color" x-model="bgColor" @change="drawCanvas" class="w-full h-10 rounded-xl cursor-pointer bg-white border border-gray-300 p-1">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Text Color</label>
                    <input type="color" x-model="textColor" @change="drawCanvas" class="w-full h-10 rounded-xl cursor-pointer bg-white border border-gray-300 p-1">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Font Size: <span x-text="fontSize + 'px'"></span></label>
                    <input type="range" x-model.number="fontSize" min="20" max="80" @input="drawCanvas" class="w-full accent-[#E83E46]">
                </div>
                <div class="space-y-3 pt-2">
                    <button @click="downloadImage('png')" class="w-full bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition text-center shadow-xs">
                        Download as PNG
                    </button>
                    <button @click="downloadImage('jpg')" class="w-full bg-gray-200 text-gray-800 font-semibold py-3 rounded-xl hover:bg-gray-300 transition text-center">
                        Download as JPG
                    </button>
                </div>
            </div>

            <!-- Center Canvas Preview -->
            <div class="lg:col-span-2 flex flex-col items-center justify-center bg-gray-100 p-6 rounded-2xl border border-gray-200">
                <canvas id="designCanvas" width="1080" height="1080" class="w-full max-w-lg aspect-square shadow-xl rounded-xl bg-white"></canvas>
                <span class="text-xs text-gray-400 mt-4">Canvas Resolution: 1080 × 1080 px (Square Post)</span>
            </div>
        </div>
    </div>

    <!-- Related Tools -->
    @if($relatedTools->count() > 0)
        <div class="mt-12">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Related Tools in Nepali Tools</h3>
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
function imageMakerApp() {
    return {
        quoteText: 'शुभ विजया दशमी २०८३!\nमेहनत गर्ने मान्छे कहिल्यै हार्दैन।',
        bgColor: '#E83E46',
        textColor: '#FFFFFF',
        fontSize: 48,
        init() {
            this.drawCanvas();
        },
        drawCanvas() {
            let canvas = document.getElementById('designCanvas');
            if (!canvas) return;
            let ctx = canvas.getContext('2d');
            ctx.fillStyle = this.bgColor;
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            ctx.fillStyle = this.textColor;
            ctx.font = `bold ${this.fontSize}px Inter, Noto Sans Devanagari, sans-serif`;
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';

            let lines = this.quoteText.split('\n');
            let lineHeight = this.fontSize * 1.4;
            let startY = (canvas.height / 2) - ((lines.length - 1) * lineHeight / 2);

            lines.forEach((line, index) => {
                ctx.fillText(line, canvas.width / 2, startY + (index * lineHeight));
            });
        },
        downloadImage(format) {
            let canvas = document.getElementById('designCanvas');
            let mime = format === 'jpg' ? 'image/jpeg' : 'image/png';
            let dataUrl = canvas.toDataURL(mime, 0.95);
            let a = document.createElement('a');
            a.href = dataUrl;
            a.download = `nepali-quote.${format}`;
            a.click();
        }
    }
}
</script>
@endpush
@endsection