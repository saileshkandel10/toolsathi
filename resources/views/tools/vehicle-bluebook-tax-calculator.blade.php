@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="vehicleTaxTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'truck' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-xl text-xs text-yellow-800 mb-6">
            <strong>Disclaimer:</strong> Vehicle tax and renewal charges vary according to provincial financial legislation and fiscal year. Confirm final amounts with the relevant transport management office.
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Province</label>
                <select x-model="province" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                    <option value="Bagmati Province">Bagmati Province</option>
                    <option value="Koshi Province">Koshi Province</option>
                    <option value="Madhesh Province">Madhesh Province</option>
                    <option value="Gandaki Province">Gandaki Province</option>
                    <option value="Lumbini Province">Lumbini Province</option>
                    <option value="Karnali Province">Karnali Province</option>
                    <option value="Sudurpashchim Province">Sudurpashchim Province</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Vehicle Category</label>
                <select x-model="category" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                    <option value="two-wheeler">Two-Wheeler</option>
                    <option value="four-wheeler">Four-Wheeler</option>
                    <option value="commercial">Commercial Vehicle</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Vehicle Type</label>
                <select x-model="vehicleType" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                    <option value="motorcycle">Motorcycle</option>
                    <option value="scooter">Scooter</option>
                    <option value="private car">Private Car</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Engine Capacity (CC)</label>
                <input type="number" x-model.number="cc" placeholder="150" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Fiscal Year</label>
                <select x-model="fiscalYear" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                    <option value="2080/81">2080/81</option>
                    <option value="2081/82">2081/82</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Previous Unpaid Years</label>
                <input type="number" x-model.number="unpaidYears" min="0" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
        </div>

        <button @click="calculateTax" class="w-full bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition shadow-xs mb-6">
            Calculate Tax & Renewal Fees
        </button>

        <!-- Breakdown Table -->
        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200" x-show="calculated" x-cloak>
            <h3 class="font-bold text-gray-900 mb-4">Tax & Renewal Breakdown</h3>
            <table class="w-full text-left text-sm text-gray-700 mb-6">
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="py-2 font-semibold">Annual Vehicle Tax</td>
                        <td class="py-2 text-right font-mono" x-text="'NPR ' + annualTax.toLocaleString()"></td>
                    </tr>
                    <tr>
                        <td class="py-2 font-semibold">Previous Unpaid Tax</td>
                        <td class="py-2 text-right font-mono" x-text="'NPR ' + previousTax.toLocaleString()"></td>
                    </tr>
                    <tr>
                        <td class="py-2 font-semibold">Bluebook Renewal Fee</td>
                        <td class="py-2 text-right font-mono" x-text="'NPR ' + renewalFee.toLocaleString()"></td>
                    </tr>
                    <tr>
                        <td class="py-2 font-semibold">Late Fine Penalty</td>
                        <td class="py-2 text-right font-mono text-[#E83E46]" x-text="'NPR ' + lateFine.toLocaleString()"></td>
                    </tr>
                    <tr class="border-t-2 border-gray-300 text-base font-bold text-gray-900">
                        <td class="py-3">Estimated Total Payable</td>
                        <td class="py-3 text-right font-mono text-[#E83E46]" x-text="'NPR ' + totalPayable.toLocaleString()"></td>
                    </tr>
                </tbody>
            </table>

            <div class="flex space-x-3">
                <button @click="copyResult" class="bg-[#E83E46] text-white px-4 py-2 rounded-xl text-xs font-semibold hover:bg-[#d23239] transition">Copy Summary</button>
                <button @click="downloadTxt" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-xl text-xs font-semibold hover:bg-gray-300 transition">Download TXT</button>
            </div>
        </div>
    </div>

    <!-- Related Tools -->
    @if($relatedTools->count() > 0)
        <div class="mt-12">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Related Tools in Calculators</h3>
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
function vehicleTaxTool() {
    return {
        province: 'Bagmati Province',
        category: 'two-wheeler',
        vehicleType: 'motorcycle',
        cc: 150,
        fiscalYear: '2080/81',
        unpaidYears: 0,
        calculated: true,
        annualTax: 5000,
        previousTax: 0,
        renewalFee: 250,
        lateFine: 0,
        totalPayable: 5250,
        calculateTax() {
            let tax = 5000;
            if (this.vehicleType === 'motorcycle') {
                if (this.cc <= 125) tax = 3000;
                else if (this.cc <= 150) tax = 5000;
                else if (this.cc <= 225) tax = 6500;
                else tax = 11000;
            } else if (this.vehicleType === 'scooter') {
                tax = 3000;
            } else if (this.vehicleType === 'private car') {
                tax = 22000;
            }

            this.annualTax = tax;
            this.previousTax = tax * (parseInt(this.unpaidYears) || 0);
            this.renewalFee = 250;
            this.lateFine = (this.unpaidYears > 0) ? tax * 0.2 : 0;
            this.totalPayable = this.annualTax + this.previousTax + this.renewalFee + this.lateFine;
            this.calculated = true;
        },
        copyResult() {
            let summary = `Vehicle Tax Summary (${this.province}): Total NPR ${this.totalPayable}`;
            navigator.clipboard.writeText(summary);
            alert('Tax summary copied to clipboard!');
        },
        downloadTxt() {
            let content = `Nepal Vehicle Tax Calculation\n---------------------------\nProvince: ${this.province}\nVehicle: ${this.vehicleType} (${this.cc} CC)\nAnnual Tax: NPR ${this.annualTax}\nTotal Payable: NPR ${this.totalPayable}`;
            let blob = new Blob([content], { type: 'text/plain;charset=utf-8' });
            let url = URL.createObjectURL(blob);
            let a = document.createElement('a');
            a.href = url;
            a.download = 'vehicle-tax-summary.txt';
            a.click();
        }
    }
}
</script>
@endpush
@endsection