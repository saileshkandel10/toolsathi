@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="documentEditorApp()">
    <!-- Breadcrumbs -->
    <nav class="text-xs text-gray-500 mb-6 flex items-center space-x-2">
        <a href="{{ route('home') }}" class="hover:text-[#E83E46]">Home</a>
        <span>/</span>
        <a href="{{ url('/' . $category->slug) }}" class="hover:text-[#E83E46]">{{ $category->name }}</a>
        <span>/</span>
        <span class="text-gray-800 font-medium">{{ $tool->name }}</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-8">
        <!-- Top Toolbar -->
        <div class="bg-gray-100 border-b border-gray-200 px-6 py-3 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center space-x-2">
                <input type="text" x-model="docTitle" class="bg-white border border-gray-300 rounded-lg px-3 py-1 text-sm font-bold text-gray-800 w-48 focus:outline-hidden focus:border-[#E83E46]">
                <span class="text-xs text-gray-500 font-medium" x-text="saveStatus"></span>
            </div>
            <div class="flex items-center space-x-2">
                <button @click="format('bold')" class="p-2 bg-white rounded-lg border border-gray-300 hover:bg-gray-50 text-gray-700 text-xs font-bold"><b>B</b></button>
                <button @click="format('italic')" class="p-2 bg-white rounded-lg border border-gray-300 hover:bg-gray-50 text-gray-700 text-xs italic"><i>I</i></button>
                <button @click="format('underline')" class="p-2 bg-white rounded-lg border border-gray-300 hover:bg-gray-50 text-gray-700 text-xs underline"><u>U</u></button>
                <button @click="downloadTxt" class="bg-[#E83E46] text-white px-4 py-1.5 rounded-lg text-xs font-semibold hover:bg-[#d23239] transition">Download TXT</button>
                <button @click="window.print()" class="bg-gray-200 text-gray-700 px-4 py-1.5 rounded-lg text-xs font-semibold hover:bg-gray-300 transition">Print</button>
            </div>
        </div>

        <!-- Document Workspace (A4 Paper Style) -->
        <div class="p-8 sm:p-16 bg-gray-50 flex justify-center">
            <div 
                id="docEditor"
                contenteditable="true"
                @input="updateContent"
                class="w-full max-w-[210mm] min-h-[297mm] bg-white shadow-lg border border-gray-200 p-12 text-gray-900 text-base focus:outline-hidden font-sans leading-relaxed"
                placeholder="Type your Nepali or English document here..."
            ></div>
        </div>

        <!-- Footer Stats -->
        <div class="bg-gray-100 border-t border-gray-200 px-6 py-3 flex items-center justify-between text-xs text-gray-600">
            <span>Words: <strong x-text="wordCount">0</strong></span>
            <span>Characters: <strong x-text="charCount">0</strong></span>
            <span>Draft saved locally</span>
        </div>
    </div>

    <!-- Related Tools -->
    @if($relatedTools->count() > 0)
        <div class="mt-12">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Related Tools in Nepali Tools</h3>
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

@push('scripts')
<script>
function documentEditorApp() {
    return {
        docTitle: 'Untitled Document',
        content: '',
        saveStatus: 'Saved',
        get wordCount() {
            let text = document.getElementById('docEditor')?.innerText || '';
            if (!text.trim()) return 0;
            return text.trim().split(/\s+/).length;
        },
        get charCount() {
            return document.getElementById('docEditor')?.innerText.length || 0;
        },
        init() {
            let saved = localStorage.getItem('toolsathi_doc_draft');
            if (saved && document.getElementById('docEditor')) {
                document.getElementById('docEditor').innerHTML = saved;
                this.content = saved;
            }
        },
        updateContent() {
            this.content = document.getElementById('docEditor').innerHTML;
            localStorage.setItem('toolsathi_doc_draft', this.content);
            this.saveStatus = 'Saving...';
            setTimeout(() => { this.saveStatus = 'Saved'; }, 800);
        },
        format(cmd) {
            document.execCommand(cmd, false, null);
        },
        downloadTxt() {
            let text = document.getElementById('docEditor')?.innerText || '';
            let blob = new Blob([text], { type: 'text/plain;charset=utf-8' });
            let url = URL.createObjectURL(blob);
            let a = document.createElement('a');
            a.href = url;
            a.download = (this.docTitle || 'document') + '.txt';
            a.click();
        }
    }
}
</script>
@endpush
@endsection