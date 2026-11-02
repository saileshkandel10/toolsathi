@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-[#242B36]">Platform Settings</h1>
            <p class="text-sm text-gray-500">Configure global brand identity, site title, and colors</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-xs text-green-700 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Site Name</label>
                <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'ToolSathi' }}" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Site Tagline</label>
                <input type="text" name="site_tagline" value="{{ $settings['site_tagline'] ?? 'Your Digital Tools Companion.' }}" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Primary Brand Color</label>
                <input type="text" name="primary_color" value="{{ $settings['primary_color'] ?? '#E83E46' }}" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
            </div>

            <button type="submit" class="bg-[#E83E46] text-white font-semibold px-6 py-3 rounded-xl hover:bg-[#d23239] transition shadow-xs">
                Save Settings
            </button>
        </form>
    </div>
</div>
@endsection