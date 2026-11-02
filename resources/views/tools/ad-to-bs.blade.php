@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="adToBsTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'arrow-left-circle' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="space-y-4 mb-6">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Select AD Date</label>
                <input type="date" x-model="adDate" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>

            <button @click="convert" class="w-full bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition">
                Convert AD to BS
            </button>
        </div>

        <div class="p-6 bg-red-50 rounded-2xl border border-red-100 text-center" x-show="bsResult">
            <div class="text-xs font-semibold text-[#E83E46] uppercase mb-1">Converted Bikram Sambat (BS) Date</div>
            <div class="text-2xl font-bold text-gray-900" x-text="bsResult"></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function adToBsTool() {
    return {
        adDate: '2024-11-02',
        bsResult: '',
        convert() {
            let d = new Date(this.adDate);
            let bsY = d.getFullYear() + 57;
            let bsM = (d.getMonth() + 9) % 12 + 1;
            let bsD = d.getDate();
            const months = ['Baisakh', 'Jestha', 'Ashadh', 'Shrawan', 'Bhadra', 'Ashwin', 'Kartik', 'Mangsir', 'Poush', 'Magh', 'Falgun', 'Chaitra'];
            this.bsResult = `${bsY} ${months[bsM - 1]} ${bsD} B.S.`;
        }
    }
}
</script>
@endpush
@endsection