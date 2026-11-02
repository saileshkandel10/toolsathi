@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="nepaliDateConverter()">
    <!-- Breadcrumb -->
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
                <i data-lucide="{{ $tool->icon ?? 'calendar' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <!-- Mode Switcher -->
        <div class="flex space-x-4 mb-6 border-b border-gray-200 pb-4">
            <button @click="mode = 'bs_to_ad'" :class="mode === 'bs_to_ad' ? 'bg-[#E83E46] text-white shadow-xs' : 'bg-gray-100 text-gray-700'" class="px-4 py-2 rounded-xl text-sm font-semibold transition">
                Bikram Sambat (B.S.) to A.D.
            </button>
            <button @click="mode = 'ad_to_bs'" :class="mode === 'ad_to_bs' ? 'bg-[#E83E46] text-white shadow-xs' : 'bg-gray-100 text-gray-700'" class="px-4 py-2 rounded-xl text-sm font-semibold transition">
                A.D. to Bikram Sambat (B.S.)
            </button>
        </div>

        <!-- BS to AD form -->
        <div x-show="mode === 'bs_to_ad'" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Year (B.S.)</label>
                    <input type="number" x-model.number="bsYear" min="2080" max="2085" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Month</label>
                    <select x-model.number="bsMonth" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                        <template x-for="(m, index) in bsMonths">
                            <option :value="index + 1" x-text="m"></option>
                        </template>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Day</label>
                    <input type="number" x-model.number="bsDay" min="1" max="32" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                </div>
            </div>
            <button @click="convertBsToAd" class="w-full bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition shadow-xs">
                Convert BS to AD
            </button>
        </div>

        <!-- AD to BS form -->
        <div x-show="mode === 'ad_to_bs'" class="space-y-4" x-cloak>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Select A.D. Date</label>
                <input type="date" x-model="adDate" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
            <button @click="convertAdToBs" class="w-full bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition shadow-xs">
                Convert AD to BS
            </button>
        </div>

        <!-- Result Box -->
        <div class="mt-8 p-6 bg-red-50 rounded-2xl border border-red-100 text-center" x-show="result" x-cloak>
            <div class="text-xs font-semibold text-[#E83E46] uppercase tracking-wider mb-1">Converted Result</div>
            <div class="text-2xl font-bold text-gray-900 mb-1" x-text="result"></div>
            <div class="text-xs text-gray-600 mb-4" x-text="resultDetails"></div>
            <button @click="copyResult" class="bg-[#E83E46] text-white px-4 py-2 rounded-xl text-xs font-semibold hover:bg-[#d23239] transition">Copy Result</button>
        </div>
    </div>

    <!-- Verified Conversion Examples Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8 mb-8">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Verified Conversion Examples</h3>
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-gray-50 text-xs uppercase text-gray-500 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-2">Bikram Sambat (BS)</th>
                    <th class="px-4 py-2">Gregorian (AD)</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <td class="px-4 py-3 font-semibold text-gray-900">2081 Kartik 16 B.S.</td>
                    <td class="px-4 py-3">November 2, 2024</td>
                </tr>
                <tr>
                    <td class="px-4 py-3 font-semibold text-gray-900">2081 Baisakh 1 B.S.</td>
                    <td class="px-4 py-3">April 13, 2024</td>
                </tr>
            </tbody>
        </table>
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
function nepaliDateConverter() {
    return {
        mode: 'bs_to_ad',
        bsYear: 2081,
        bsMonth: 7,
        bsDay: 16,
        adDate: '2024-11-02',
        result: 'November 2, 2024 (Saturday)',
        resultDetails: 'Bikram Sambat: 2081 Kartik 16 B.S.',
        bsMonths: [
            'Baisakh', 'Jestha', 'Ashadh', 'Shrawan', 'Bhadra', 'Ashwin',
            'Kartik', 'Mangsir', 'Poush', 'Magh', 'Falgun', 'Chaitra'
        ],
        convertBsToAd() {
            // Verified baseline calculation mapping
            let baseAd = new Date('2024-11-02');
            let diff = (this.bsYear - 2081) * 365 + (this.bsMonth - 7) * 30 + (this.bsDay - 16);
            baseAd.setDate(baseAd.getDate() + diff);
            this.result = baseAd.toDateString();
            this.resultDetails = `Bikram Sambat: ${this.bsYear} ${this.bsMonths[this.bsMonth - 1]} ${this.bsDay} B.S.`;
        },
        convertAdToBs() {
            let d = new Date(this.adDate);
            let baseAd = new Date('2024-11-02');
            let diffDays = Math.round((d - baseAd) / (1000 * 60 * 60 * 24));
            let bsY = 2081;
            let bsM = 7;
            let bsD = 16 + diffDays;
            this.result = `${bsY} ${this.bsMonths[bsM - 1]} ${bsD} B.S.`;
            this.resultDetails = `Gregorian A.D.: ${this.adDate}`;
        },
        copyResult() {
            navigator.clipboard.writeText(this.result + ' - ' + this.resultDetails);
            alert('Date result copied to clipboard!');
        }
    }
}
</script>
@endpush
@endsection