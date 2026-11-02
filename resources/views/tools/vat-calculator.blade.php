@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="vatCalcTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'percent' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Amount</label>
                <input type="number" x-model.number="amount" @input="calculate" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Tax Rate (%)</label>
                <input type="number" x-model.number="taxRate" @input="calculate" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 text-center">
                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Net Amount</div>
                <div class="text-xl font-bold text-gray-900" x-text="netAmount"></div>
            </div>
            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 text-center">
                <div class="text-xs font-semibold text-gray-500 uppercase mb-1">Tax Amount</div>
                <div class="text-xl font-bold text-[#E83E46]" x-text="taxAmount"></div>
            </div>
            <div class="bg-red-50 p-6 rounded-2xl border border-red-100 text-center">
                <div class="text-xs font-semibold text-[#E83E46] uppercase mb-1">Total Amount</div>
                <div class="text-xl font-extrabold text-gray-900" x-text="totalAmount"></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function vatCalcTool() {
    return {
        amount: 1000,
        taxRate: 13,
        netAmount: '1,000.00',
        taxAmount: '130.00',
        totalAmount: '1,130.00',
        calculate() {
            let a = parseFloat(this.amount) || 0;
            let r = parseFloat(this.taxRate) || 0;
            let tax = (a * r) / 100;
            let total = a + tax;
            this.netAmount = a.toFixed(2);
            this.taxAmount = tax.toFixed(2);
            this.totalAmount = total.toFixed(2);
        }
    }
}
</script>
@endpush
@endsection