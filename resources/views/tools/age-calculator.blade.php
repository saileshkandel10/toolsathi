@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="ageCalculator()">
    <nav class="text-xs text-gray-500 mb-6 flex items-center space-x-2">
        <a href="{{ route('home') }}" class="hover:text-[#E83E46]">Home</a>
        <span>/</span>
        <a href="{{ route('tools.index') }}" class="hover:text-[#E83E46]">Tools</a>
        <span>/</span>
        <span class="text-gray-800 font-medium">{{ $tool->name }}</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8 mb-8">
        <div class="flex items-center space-x-4 mb-6">
            <div class="w-12 h-12 rounded-xl bg-red-50 text-[#E83E46] flex items-center justify-center">
                <i data-lucide="{{ $tool->icon ?? 'clock' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Date of Birth</label>
                <input type="date" x-model="dob" @change="calculate" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Age at Date (Optional)</label>
                <input type="date" x-model="targetDate" @change="calculate" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
        </div>

        <button @click="calculate" class="w-full bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition">
            Calculate Age
        </button>

        <!-- Result -->
        <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4" x-show="calculated">
            <div class="bg-red-50 p-6 rounded-2xl border border-red-100 text-center">
                <div class="text-3xl font-extrabold text-[#E83E46]" x-text="years">0</div>
                <div class="text-xs text-gray-600 uppercase font-semibold mt-1">Years</div>
            </div>
            <div class="bg-red-50 p-6 rounded-2xl border border-red-100 text-center">
                <div class="text-3xl font-extrabold text-[#E83E46]" x-text="months">0</div>
                <div class="text-xs text-gray-600 uppercase font-semibold mt-1">Months</div>
            </div>
            <div class="bg-red-50 p-6 rounded-2xl border border-red-100 text-center">
                <div class="text-3xl font-extrabold text-[#E83E46]" x-text="days">0</div>
                <div class="text-xs text-gray-600 uppercase font-semibold mt-1">Days</div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function ageCalculator() {
    return {
        dob: '2000-01-01',
        targetDate: new Date().toISOString().split('T')[0],
        years: 0,
        months: 0,
        days: 0,
        calculated: false,
        calculate() {
            if (!this.dob) return;
            let birth = new Date(this.dob);
            let target = new Date(this.targetDate);

            let y = target.getFullYear() - birth.getFullYear();
            let m = target.getMonth() - birth.getMonth();
            let d = target.getDate() - birth.getDate();

            if (d < 0) {
                m--;
                let prevMonthDays = new Date(target.getFullYear(), target.getMonth(), 0).getDate();
                d += prevMonthDays;
            }
            if (m < 0) {
                y--;
                m += 12;
            }

            this.years = y;
            this.months = m;
            this.days = d;
            this.calculated = true;
        }
    }
}
</script>
@endpush
@endsection