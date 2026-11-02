@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-[#242B36]">Create New Tool</h1>
            <p class="text-sm text-gray-500">Add a new utility tool to the ToolSathi registry</p>
        </div>
        <a href="{{ route('admin.tools.index') }}" class="text-sm font-semibold text-[#E83E46] hover:underline">&larr; Back to Tools</a>
    </div>

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-xs text-[#E83E46]">
            <ul class="list-disc pl-4 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        <form action="{{ route('admin.tools.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Tool Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Category</label>
                    <select name="category_id" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                        @foreach(\App\Models\Category::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Route Name (Unique)</label>
                    <input type="text" name="route_name" value="{{ old('route_name') }}" placeholder="tools.pdf.merge" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Lucide Icon</label>
                    <input type="text" name="icon" value="{{ old('icon', 'tool') }}" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Processing Mode</label>
                    <select name="processing_mode" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                        <option value="browser">Browser-side (Alpine/JS/Canvas)</option>
                        <option value="server">Server-side (Laravel Backend)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Component Key (Registry)</label>
                    <input type="text" name="component_key" value="{{ old('component_key', 'generic') }}" required class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Short Description</label>
                <textarea name="description" rows="2" required class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm focus:outline-hidden focus:border-[#E83E46]">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Full Description (SEO Content)</label>
                <textarea name="full_description" rows="4" class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm focus:outline-hidden focus:border-[#E83E46]">{{ old('full_description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">SEO Title</label>
                    <input type="text" name="seo_title" value="{{ old('seo_title') }}" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">SEO Meta Description</label>
                    <input type="text" name="seo_description" value="{{ old('seo_description') }}" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-hidden focus:border-[#E83E46]">
                </div>
            </div>

            <div class="flex items-center space-x-6 pt-2">
                <label class="flex items-center space-x-2 text-sm text-gray-700 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked class="rounded text-[#E83E46] focus:ring-[#E83E46]">
                    <span>Active</span>
                </label>
                <label class="flex items-center space-x-2 text-sm text-gray-700 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" class="rounded text-[#E83E46] focus:ring-[#E83E46]">
                    <span>Featured</span>
                </label>
                <label class="flex items-center space-x-2 text-sm text-gray-700 cursor-pointer">
                    <input type="checkbox" name="is_premium" value="1" class="rounded text-[#E83E46] focus:ring-[#E83E46]">
                    <span>Premium Only</span>
                </label>
            </div>

            <div class="pt-4">
                <button type="submit" class="bg-[#E83E46] text-white font-semibold px-6 py-3 rounded-xl hover:bg-[#d23239] transition shadow-xs">
                    Create Tool
                </button>
            </div>
        </form>
    </div>
</div>
@endsection