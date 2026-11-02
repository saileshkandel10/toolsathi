@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto px-4 py-16">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 text-center">
        <div class="w-16 h-16 bg-red-100 text-[#E83E46] rounded-full flex items-center justify-center mx-auto mb-4">
            <i data-lucide="shield-check" class="w-8 h-8"></i>
        </div>
        <h1 class="text-2xl font-bold text-[#242B36] mb-1">Secure Checkout</h1>
        <p class="text-xs text-gray-500 mb-6">Plan: <strong class="text-gray-800">{{ $plan->name }}</strong> (Rs. {{ number_format($plan->price) }})</p>

        <form action="{{ url('/payment/verify/' . $payment->id) }}" method="POST" class="space-y-4">
            @csrf
            <div class="text-left">
                <label class="block text-xs font-semibold text-gray-700 mb-1">Select Payment Gateway</label>
                <select name="gateway" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                    <option value="esewa">eSewa Digital Wallet</option>
                    <option value="khalti">Khalti Digital Wallet</option>
                    <option value="stripe">Stripe Credit Card</option>
                </select>
            </div>

            <div class="p-3 bg-gray-50 rounded-xl text-xs text-gray-500 font-mono">
                Transaction ID: {{ $payment->transaction_id }}
            </div>

            <button type="submit" class="w-full bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition shadow-xs">
                Proceed & Complete Payment
            </button>
        </form>
    </div>
</div>
@endsection