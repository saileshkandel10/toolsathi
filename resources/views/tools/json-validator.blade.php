@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="jsonValidatorTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'check-circle' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <textarea x-model="jsonText" rows="8" placeholder='Paste JSON to validate...' class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm font-mono focus:outline-hidden focus:border-[#E83E46] mb-4"></textarea>

        <button @click="validate" class="bg-[#E83E46] text-white font-semibold px-6 py-2.5 rounded-xl text-sm hover:bg-[#d23239] transition mb-6">Validate JSON</button>

        <div x-show="status" :class="isValid ? 'bg-green-50 text-green-700 border-green-200' : 'bg-red-50 text-[#E83E46] border-red-200'" class="p-4 rounded-xl border text-sm font-semibold" x-text="status" x-cloak></div>
    </div>
</div>

@push('scripts')
<script>
function jsonValidatorTool() {
    return {
        jsonText: '',
        status: '',
        isValid: false,
        validate() {
            try {
                JSON.parse(this.jsonText);
                this.isValid = true;
                this.status = 'Valid JSON! No syntax errors detected.';
            } catch (e) {
                this.isValid = false;
                this.status = 'Invalid JSON: ' + e.message;
            }
        }
    }
}
</script>
@endpush
@endsection