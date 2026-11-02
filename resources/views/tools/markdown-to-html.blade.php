@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="markdownTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'file-text' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-2">Markdown Input</label>
                <textarea x-model="markdownText" @input="convert" rows="8" placeholder="# Heading\n\nWrite markdown here..." class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm font-mono focus:outline-hidden focus:border-[#E83E46]"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-2">HTML Output</label>
                <textarea x-model="htmlOutput" readonly rows="8" class="w-full bg-gray-100 border border-gray-300 rounded-xl p-4 text-sm font-mono focus:outline-hidden" placeholder="Rendered HTML output..."></textarea>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function markdownTool() {
    return {
        markdownText: '# Hello ToolSathi\n\nThis is **Markdown** rendered to HTML.',
        htmlOutput: '<h1>Hello ToolSathi</h1>\n<p>This is <strong>Markdown</strong> rendered to HTML.</p>',
        init() {
            this.convert();
        },
        convert() {
            let m = this.markdownText;
            // Basic Markdown regex parser
            let h = m
                .replace(/^# (.*$)/gim, '<h1>$1</h1>')
                .replace(/^## (.*$)/gim, '<h2>$1</h2>')
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                .replace(/\*(.*?)\*/g, '<em>$1</em>');
            this.htmlOutput = h;
        }
    }
}
</script>
@endpush
@endsection