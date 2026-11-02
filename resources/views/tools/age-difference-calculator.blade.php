@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="ageDiffTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'calendar' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">First Person DOB</label>
                <input type="date" x-model="dob1" @change="calculate" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Second Person DOB</label>
                <input type="date" x-model="dob2" @change="calculate" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
        </div>

        <div class="p-6 bg-red-50 rounded-2xl border border-red-100 text-center">
            <div class="text-xs font-semibold text-[#E83E46] uppercase mb-1">Age Gap Difference</div>
            <div class="text-3xl font-extrabold text-gray-900" x-text="diffResult"></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function ageDiffTool() {
    return {
        dob1: '1995-05-15',
        dob2: '1998-10-20',
        diffResult: '3 Years, 5 Months, 5 Days',
        calculate() {
            let d1 = new Date(this.dob1);
            let d2 = new Date(this.dob2);
            let diffMs = Math.abs(d2 - d1);
            let diffDays = Math.ceil(diffMs / (1000 * 60 * 60 * 24));
            let yrs = Math.floor(diffDays / 365);
            let daysRem = diffDays % 365;
            let mos = Math.floor(daysRem / 30);
            let days = daysRem % 30;
            this.diffResult = `${yrs} Years, ${mos} Months, ${days} Days (${diffDays.toLocaleString()} Total Days)`;
        }
    }
}
</script>
@endpush
@endsection