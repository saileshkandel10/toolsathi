@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto px-4 py-16">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-xl bg-[#E83E46] flex items-center justify-center text-white font-bold text-2xl mx-auto mb-3 shadow-md">
                TS
            </div>
            <h1 class="text-2xl font-bold text-[#242B36]">Admin Login</h1>
            <p class="text-xs text-gray-500 mt-1">Sign in to manage ToolSathi platform</p>
        </div>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl text-xs text-[#E83E46]">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" value="admin@toolsathi.com" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Password</label>
                <input type="password" name="password" value="password" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
            <button type="submit" class="w-full bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition shadow-xs">
                Sign In
            </button>
        </form>
    </div>
</div>
@endsection