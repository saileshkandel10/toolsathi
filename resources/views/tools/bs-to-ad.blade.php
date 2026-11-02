@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="bsToAdTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'arrow-right-circle' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="space-y-4 mb-6">
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Year (B.S.)</label>
                    <input type="number" x-model.number="bsYear" min="2000" max="2090" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Month</label>
                    <select x-model.number="bsMonth" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                        <template x-for="(m, i) in ['Baisakh', 'Jestha', 'Ashadh', 'Shrawan', 'Bhadra', 'Ashwin', 'Kartik', 'Mangsir', 'Poush', 'Magh', 'Falgun', 'Chaitra']">
                            <option :value="i + 1" x-text="m"></option>
                        </template>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Day</label>
                    <input type="number" x-model.number="bsDay" min="1" max="32" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                </div>
            </div>

            <button @click="convert" class="w-full bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition">
                Convert BS to AD
            </button>
        </div>

        <div class="p-6 bg-red-50 rounded-2xl border border-red-100 text-center" x-show="adResult">
            <div class="text-xs font-semibold text-[#E83E46] uppercase mb-1">Converted AD Date</div>
            <div class="text-2xl font-bold text-gray-900" x-text="adResult"></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function bsToAdTool() {
    return {
        bsYear: 2081,
        bsMonth: 7,
        bsDay: 16,
        adResult: '',
        convert() {
            let adY = this.bsYear - 57;
            let adM = (this.bsMonth + 3) % 12 + 1;
            if (this.bsMonth >= 9) adY++;
            let d = new Date(adY, adM - 1, this.bsDay);
            this.adResult = d.toDateString();
        }
    }
}
</script>
@endpush
@endsection