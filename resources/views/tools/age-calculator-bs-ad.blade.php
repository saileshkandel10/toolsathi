@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="nepaliAgeCalculator()">
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
                <i data-lucide="{{ $tool->icon ?? 'clock' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="p-4 bg-blue-50 border border-blue-200 rounded-xl text-xs text-blue-800 mb-6">
            <strong>Privacy Notice:</strong> Entered dates are processed locally in your browser and are never stored or transmitted to any server.
        </div>

        <!-- Mode Selector -->
        <div class="flex space-x-4 mb-6 border-b border-gray-200 pb-4">
            <button @click="calendarType = 'bs'" :class="calendarType === 'bs' ? 'bg-[#E83E46] text-white shadow-xs' : 'bg-gray-100 text-gray-700'" class="px-4 py-2 rounded-xl text-sm font-semibold transition">
                Bikram Sambat (B.S.)
            </button>
            <button @click="calendarType = 'ad'" :class="calendarType === 'ad' ? 'bg-[#E83E46] text-white shadow-xs' : 'bg-gray-100 text-gray-700'" class="px-4 py-2 rounded-xl text-sm font-semibold transition">
                Gregorian (A.D.)
            </button>
        </div>

        <!-- BS Inputs -->
        <div x-show="calendarType === 'bs'" class="space-y-4 mb-6">
            <label class="block text-xs font-semibold text-gray-700">Date of Birth (B.S.)</label>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <input type="number" x-model.number="bsYear" min="2000" max="2090" placeholder="Year (2050)" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                </div>
                <div>
                    <select x-model.number="bsMonth" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                        <template x-for="(m, index) in bsMonths">
                            <option :value="index + 1" x-text="m"></option>
                        </template>
                    </select>
                </div>
                <div>
                    <input type="number" x-model.number="bsDay" min="1" max="32" placeholder="Day" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                </div>
            </div>
        </div>

        <!-- AD Inputs -->
        <div x-show="calendarType === 'ad'" class="space-y-4 mb-6" x-cloak>
            <label class="block text-xs font-semibold text-gray-700">Date of Birth (A.D.)</label>
            <input type="date" x-model="adDate" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
        </div>

        <div class="flex space-x-4">
            <button @click="calculateAge" class="bg-[#E83E46] text-white font-semibold px-6 py-3 rounded-xl hover:bg-[#d23239] transition shadow-xs">
                Calculate Age
            </button>
            <button @click="resetForm" class="bg-gray-100 text-gray-700 font-semibold px-6 py-3 rounded-xl hover:bg-gray-200 transition">
                Reset
            </button>
        </div>

        <!-- Result Panel -->
        <div class="mt-8 p-6 bg-red-50 rounded-2xl border border-red-100 text-center" x-show="calculated" x-cloak>
            <div class="text-xs font-semibold text-[#E83E46] uppercase tracking-wider mb-1">Exact Age Result</div>
            <div class="text-3xl font-extrabold text-gray-900 mb-2" x-text="ageResultText"></div>
            <div class="text-xs text-gray-600 mb-4" x-text="elapsedDaysText"></div>
            <div class="space-x-2">
                <button @click="copyResult" class="bg-[#E83E46] text-white px-4 py-2 rounded-xl text-xs font-semibold hover:bg-[#d23239] transition">Copy Result</button>
                <button @click="downloadTxt" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-xl text-xs font-semibold hover:bg-gray-200 transition">Download TXT</button>
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
function nepaliAgeCalculator() {
    return {
        calendarType: 'bs',
        bsYear: 2055,
        bsMonth: 5,
        bsDay: 15,
        adDate: '1998-08-31',
        calculated: false,
        ageResultText: '28 Years, 2 Months, 17 Days',
        elapsedDaysText: 'Total Elapsed: 10,302 Days',
        bsMonths: [
            'Baisakh', 'Jestha', 'Ashadh', 'Shrawan', 'Bhadra', 'Ashwin',
            'Kartik', 'Mangsir', 'Poush', 'Magh', 'Falgun', 'Chaitra'
        ],
        calculateAge() {
            let birthDate = new Date();
            let today = new Date();

            if (this.calendarType === 'ad') {
                birthDate = new Date(this.adDate);
            } else {
                // Approximate BS to AD for age calculation demo
                let adY = this.bsYear - 57;
                let adM = (this.bsMonth + 3) % 12 + 1;
                birthDate = new Date(adY, adM - 1, this.bsDay);
            }

            let y = today.getFullYear() - birthDate.getFullYear();
            let m = today.getMonth() - birthDate.getMonth();
            let d = today.getDate() - birthDate.getDate();

            if (d < 0) {
                m--;
                d += 30;
            }
            if (m < 0) {
                y--;
                m += 12;
            }

            let diffTime = Math.abs(today - birthDate);
            let totalDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            this.ageResultText = `${y} Years, ${m} Months, ${d} Days`;
            this.elapsedDaysText = `Total Elapsed: ${totalDays.toLocaleString()} Days`;
            this.calculated = true;
        },
        resetForm() {
            this.calculated = false;
        },
        copyResult() {
            navigator.clipboard.writeText(this.ageResultText + ' - ' + this.elapsedDaysText);
            alert('Age result copied to clipboard!');
        },
        downloadTxt() {
            let content = `Nepali Age Calculator Report\n--------------------------\nAge: ${this.ageResultText}\n${this.elapsedDaysText}`;
            let blob = new Blob([content], { type: 'text/plain;charset=utf-8' });
            let url = URL.createObjectURL(blob);
            let a = document.createElement('a');
            a.href = url;
            a.download = 'age-calculation-report.txt';
            a.click();
        }
    }
}
</script>
@endpush
@endsection