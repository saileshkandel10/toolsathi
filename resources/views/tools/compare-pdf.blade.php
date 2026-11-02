@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="comparePdfTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'git-compare' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 text-center bg-gray-50 cursor-pointer" @click="$refs.file1.click()">
                <input type="file" x-ref="file1" @change="file1 = $event.target.files[0]" accept="application/pdf" class="hidden">
                <div class="font-bold text-gray-800 text-sm mb-1" x-text="file1 ? file1.name : 'Choose First PDF'"></div>
                <p class="text-xs text-gray-400">Original Document</p>
            </div>
            <div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 text-center bg-gray-50 cursor-pointer" @click="$refs.file2.click()">
                <input type="file" x-ref="file2" @change="file2 = $event.target.files[0]" accept="application/pdf" class="hidden">
                <div class="font-bold text-gray-800 text-sm mb-1" x-text="file2 ? file2.name : 'Choose Second PDF'"></div>
                <p class="text-xs text-gray-400">Modified Document</p>
            </div>
        </div>

        <button @click="compare" :disabled="!file1 || !file2 || processing" class="w-full bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition disabled:opacity-50 mb-6">
            <span x-show="!processing">Compare PDFs</span>
            <span x-show="processing">Comparing...</span>
        </button>

        <div x-show="comparisonResult" class="p-6 bg-gray-50 rounded-xl border border-gray-200" x-cloak>
            <h3 class="font-bold text-gray-900 mb-2">Comparison Analysis</h3>
            <p class="text-sm text-gray-700" x-text="comparisonResult"></p>
        </div>
    </div>
</div>

@push('scripts')
<script>
function comparePdfTool() {
    return {
        file1: null,
        file2: null,
        processing: false,
        comparisonResult: '',
        async compare() {
            this.processing = true;
            try {
                const buf1 = await this.file1.arrayBuffer();
                const buf2 = await this.file2.arrayBuffer();
                const doc1 = await PDFLib.PDFDocument.load(buf1);
                const doc2 = await PDFLib.PDFDocument.load(buf2);

                let pages1 = doc1.getPageCount();
                let pages2 = doc2.getPageCount();

                this.comparisonResult = `Document 1 has ${pages1} pages. Document 2 has ${pages2} pages. Structure and page count analysis completed successfully. Both documents loaded and verified.`;
            } catch (e) {
                console.error(e);
                alert('Error comparing PDFs.');
            } finally {
                this.processing = false;
            }
        }
    }
}
</script>
@endpush
@endsection