@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        <h1 class="text-3xl font-extrabold text-[#242B36] mb-2">Contact Us</h1>
        <p class="text-sm text-gray-600 mb-6">Have questions or feedback? Send us a message and we'll get back to you promptly.</p>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-xs text-green-700 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ url('/contact') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Your Name</label>
                <input type="text" name="name" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Subject</label>
                <input type="text" name="subject" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Message</label>
                <textarea name="message" rows="5" required class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm focus:outline-hidden focus:border-[#E83E46]"></textarea>
            </div>
            <button type="submit" class="w-full bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition shadow-xs">
                Send Message
            </button>
        </form>
    </div>
</div>
@endsection