@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="landConverterTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'maximize-2' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <!-- Tabs -->
        <div class="flex space-x-4 mb-6 border-b border-gray-200 pb-4">
            <button @click="tab = 'standard'" :class="tab === 'standard' ? 'bg-[#E83E46] text-white shadow-xs' : 'bg-gray-100 text-gray-700'" class="px-4 py-2 rounded-xl text-sm font-semibold transition">
                Standard Converter
            </button>
            <button @click="tab = 'mixed'" :class="tab === 'mixed' ? 'bg-[#E83E46] text-white shadow-xs' : 'bg-gray-100 text-gray-700'" class="px-4 py-2 rounded-xl text-sm font-semibold transition">
                Mixed Land Measurement
            </button>
            <button @click="tab = 'price'" :class="tab === 'price' ? 'bg-[#E83E46] text-white shadow-xs' : 'bg-gray-100 text-gray-700'" class="px-4 py-2 rounded-xl text-sm font-semibold transition">
                Land Price Calculator
            </button>
        </div>

        <!-- Standard Tab -->
        <div x-show="tab === 'standard'" class="space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Amount</label>
                    <input type="number" x-model.number="amount" @input="convert" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">From Unit</label>
                    <select x-model="fromUnit" @change="convert" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                        <option value="ropani">Ropani</option>
                        <option value="aana">Aana</option>
                        <option value="paisa">Paisa</option>
                        <option value="daam">Daam</option>
                        <option value="bigha">Bigha</option>
                        <option value="kattha">Kattha</option>
                        <option value="dhur">Dhur</option>
                        <option value="sqft">Square Feet</option>
                        <option value="sqm">Square Meter</option>
                    </select>
                </div>
            </div>

            <div class="p-6 bg-red-50 rounded-2xl border border-red-100 text-center">
                <div class="text-xs font-semibold text-[#E83E46] uppercase mb-1">Converted Square Feet</div>
                <div class="text-3xl font-extrabold text-gray-900 mb-2" x-text="sqftResult + ' sq. ft.'"></div>
                <button @click="copyResult" class="bg-[#E83E46] text-white px-4 py-2 rounded-xl text-xs font-semibold hover:bg-[#d23239] transition">Copy Result</button>
            </div>
        </div>

        <!-- Mixed Tab -->
        <div x-show="tab === 'mixed'" class="space-y-6" x-cloak>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Ropani</label>
                    <input type="number" x-model.number="mixedRopani" @input="calcMixed" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Aana</label>
                    <input type="number" x-model.number="mixedAana" @input="calcMixed" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Paisa</label>
                    <input type="number" x-model.number="mixedPaisa" @input="calcMixed" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Daam</label>
                    <input type="number" x-model.number="mixedDaam" @input="calcMixed" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2 text-sm">
                </div>
            </div>

            <div class="p-6 bg-red-50 rounded-2xl border border-red-100 text-center">
                <div class="text-xs font-semibold text-[#E83E46] uppercase mb-1">Total Mixed Area</div>
                <div class="text-2xl font-extrabold text-gray-900" x-text="mixedSqft + ' sq. ft.'"></div>
            </div>
        </div>

        <!-- Price Tab -->
        <div x-show="tab === 'price'" class="space-y-6" x-cloak>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Land Area (Aana)</label>
                    <input type="number" x-model.number="priceArea" @input="calcPrice" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Price per Aana (NPR)</label>
                    <input type="number" x-model.number="priceRate" @input="calcPrice" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm">
                </div>
            </div>

            <div class="p-6 bg-red-50 rounded-2xl border border-red-100 text-center">
                <div class="text-xs font-semibold text-[#E83E46] uppercase mb-1">Estimated Total Land Value</div>
                <div class="text-3xl font-extrabold text-gray-900" x-text="'NPR ' + totalPrice"></div>
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
function landConverterTool() {
    return {
        tab: 'standard',
        amount: 1,
        fromUnit: 'ropani',
        sqftResult: '5,476.00',
        mixedRopani: 1,
        mixedAana: 2,
        mixedPaisa: 3,
        mixedDaam: 0,
        mixedSqft: '6,667.19',
        priceArea: 5,
        priceRate: 800000,
        totalPrice: '40,00,000.00',
        factors: {
            ropani: 5476,
            aana: 342.25,
            paisa: 85.5625,
            daam: 21.390625,
            bigha: 72900,
            kattha: 3645,
            dhur: 182.25,
            sqft: 1,
            sqm: 10.7639104
        },
        convert() {
            let a = parseFloat(this.amount) || 0;
            let sqft = a * (this.factors[this.fromUnit] || 1);
            this.sqftResult = sqft.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        },
        calcMixed() {
            let r = parseFloat(this.mixedRopani) || 0;
            let an = parseFloat(this.mixedAana) || 0;
            let p = parseFloat(this.mixedPaisa) || 0;
            let d = parseFloat(this.mixedDaam) || 0;
            let total = (r * this.factors.ropani) + (an * this.factors.aana) + (p * this.factors.paisa) + (d * this.factors.daam);
            this.mixedSqft = total.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        },
        calcPrice() {
            let area = parseFloat(this.priceArea) || 0;
            let rate = parseFloat(this.priceRate) || 0;
            let total = area * rate;
            this.totalPrice = total.toLocaleString('en-IN', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        },
        copyResult() {
            navigator.clipboard.writeText(this.sqftResult + ' sq. ft.');
            alert('Result copied to clipboard!');
        }
    }
}
</script>
@endpush
@endsection