@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="nepaliCalendarTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'calendar-days' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="flex items-center justify-between mb-6 bg-gray-50 p-4 rounded-xl border border-gray-200">
            <button @click="prevMonth" class="px-4 py-2 bg-white rounded-lg border border-gray-300 text-sm font-semibold hover:bg-gray-100 transition">&larr; Previous</button>
            <div class="text-lg font-bold text-gray-900" x-text="monthNames[currentMonth] + ' ' + currentYear + ' B.S.'"></div>
            <button @click="nextMonth" class="px-4 py-2 bg-white rounded-lg border border-gray-300 text-sm font-semibold hover:bg-gray-100 transition">Next &rarr;</button>
        </div>

        <div class="grid grid-cols-7 gap-2 text-center mb-4">
            <template x-for="day in ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']">
                <div class="font-bold text-xs text-gray-500 py-2" x-text="day"></div>
            </template>
        </div>

        <div class="grid grid-cols-7 gap-2 text-center">
            <template x-for="date in calendarDays">
                <div :class="date === 16 ? 'bg-[#E83E46] text-white font-bold' : 'bg-gray-50 text-gray-800 hover:bg-red-50'" class="p-4 rounded-xl border border-gray-200 text-sm transition cursor-pointer">
                    <span x-text="date"></span>
                </div>
            </template>
        </div>
    </div>
</div>

@push('scripts')
<script>
function nepaliCalendarTool() {
    return {
        currentYear: 2081,
        currentMonth: 6, // Kartik
        monthNames: [
            'Baisakh', 'Jestha', 'Ashadh', 'Shrawan', 'Bhadra', 'Ashwin',
            'Kartik', 'Mangsir', 'Poush', 'Magh', 'Falgun', 'Chaitra'
        ],
        get calendarDays() {
            let arr = [];
            for (let i = 1; i <= 30; i++) arr.push(i);
            return arr;
        },
        prevMonth() {
            if (this.currentMonth > 0) {
                this.currentMonth--;
            } else {
                this.currentMonth = 11;
                this.currentYear--;
            }
        },
        nextMonth() {
            if (this.currentMonth < 11) {
                this.currentMonth++;
            } else {
                this.currentMonth = 0;
                this.currentYear++;
            }
        }
    }
}
</script>
@endpush
@endsection