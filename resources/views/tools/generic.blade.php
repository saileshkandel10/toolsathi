@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumbs -->
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
                <i data-lucide="{{ $tool->icon ?? 'tool' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="bg-gray-50 p-8 rounded-2xl border border-gray-200 text-center space-y-4">
            <div class="w-16 h-16 bg-red-100 text-[#E83E46] rounded-full flex items-center justify-center mx-auto">
                <i data-lucide="cpu" class="w-8 h-8"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Interactive Tool Interface</h3>
            <p class="text-sm text-gray-600 max-w-md mx-auto">{{ $tool->full_description ?? $tool->description }}</p>
            
            <div class="pt-4">
                <button onclick="alert('Tool executed successfully!')" class="bg-[#E83E46] text-white px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#d23239] transition">
                    Run {{ $tool->name }}
                </button>
            </div>
        </div>
    </div>

    <!-- Related Tools -->
    @if($relatedTools->count() > 0)
        <div class="mt-12">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Related Tools in {{ $category->name }}</h3>
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
@endsection