@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-[#242B36]">Manage Tools</h1>
            <p class="text-sm text-gray-500">Create, edit, and configure tools across all categories</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.tools.create') }}" class="bg-[#E83E46] text-white hover:bg-[#d23239] px-4 py-2 rounded-xl text-sm font-semibold transition shadow-xs">+ Add New Tool</a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-xs text-green-700 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-xs border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 text-xs uppercase text-gray-500 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3">Tool Name</th>
                        <th class="px-6 py-3">Category</th>
                        <th class="px-6 py-3">Mode</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Featured</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($tools as $tool)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ $tool->name }}
                                <div class="text-xs text-gray-400 font-normal">slug: {{ $tool->slug }}</div>
                            </td>
                            <td class="px-6 py-4">{{ $tool->category->name ?? '-' }}</td>
                            <td class="px-6 py-4 capitalize"><span class="px-2 py-0.5 bg-gray-100 rounded text-xs">{{ $tool->processing_mode }}</span></td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $tool->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-[#E83E46]' }}">
                                    {{ $tool->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($tool->is_featured)
                                    <span class="px-2 py-0.5 bg-red-50 text-[#E83E46] rounded text-xs font-semibold">Featured</span>
                                @else
                                    <span class="text-gray-400 text-xs">Standard</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.tools.edit', $tool->id) }}" class="text-xs font-semibold text-indigo-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.tools.destroy', $tool->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this tool?')" class="text-xs font-semibold text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-200">
            {{ $tools->links() }}
        </div>
    </div>
</div>
@endsection