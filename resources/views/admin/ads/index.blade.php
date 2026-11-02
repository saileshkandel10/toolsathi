@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-[#242B36]">Advertisement Settings</h1>
        <p class="text-sm text-gray-500">Configure banner and ad slot codes across platform pages</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-xs text-green-700 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-6">
        @foreach($adSlots as $slot)
            <div class="bg-white rounded-2xl shadow-xs border border-gray-200 p-6">
                <form action="{{ route('admin.ads.update', $slot->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-bold text-gray-900 text-base" x-text="'{{ $slot->name }}'"></h3>
                            <span class="text-xs text-gray-400 font-mono">Identifier: {{ $slot->identifier }}</span>
                        </div>
                        <label class="flex items-center space-x-2 text-sm text-gray-700 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ $slot->is_active ? 'checked' : '' }} class="rounded text-[#E83E46] focus:ring-[#E83E46]">
                            <span class="font-semibold text-xs">Active</span>
                        </label>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 mb-1">Ad HTML / Script Code</label>
                        <textarea name="code" rows="3" class="w-full bg-gray-50 border border-gray-300 rounded-xl p-3 text-xs font-mono focus:outline-hidden focus:border-[#E83E46]">{{ $slot->code }}</textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-[#E83E46] text-white text-xs font-semibold px-5 py-2 rounded-xl hover:bg-[#d23239] transition shadow-xs">
                            Update Ad Slot
                        </button>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection