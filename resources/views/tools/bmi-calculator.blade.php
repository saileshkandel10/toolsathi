@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="bmiTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'activity' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Height (cm)</label>
                <input type="number" x-model.number="height" @input="calculate" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Weight (kg)</label>
                <input type="number" x-model.number="weight" @input="calculate" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
        </div>

        <div class="p-6 bg-red-50 rounded-2xl border border-red-100 text-center">
            <div class="text-xs font-semibold text-[#E83E46] uppercase mb-1" x-text="category"></div>
            <div class="text-3xl font-extrabold text-gray-900" x-text="bmi"></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function bmiTool() {
    return {
        height: 170,
        weight: 65,
        bmi: '22.49',
        category: 'Normal Weight',
        calculate() {
            let h = (parseFloat(this.height) || 0) / 100;
            let w = parseFloat(this.weight) || 0;
            if (h > 0 && w > 0) {
                let val = w / (h * h);
                this.bmi = val.toFixed(2);
                if (val < 18.5) this.category = 'Underweight';
                else if (val < 25) this.category = 'Normal Weight';
                else if (val < 30) this.category = 'Overweight';
                else this.category = 'Obese';
            }
        }
    }
}
</script>
@endpush
@endsection