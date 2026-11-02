@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="jwtTool()">
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
                <i data-lucide="{{ $tool->icon ?? 'key' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-xl text-xs text-yellow-800 mb-6">
            <strong>Security Warning:</strong> Decoding is not signature verification. This tool runs 100% locally in your browser and does not transmit tokens to any server.
        </div>

        <textarea x-model="jwtToken" @input="decodeJwt" rows="6" placeholder="Paste JWT token (eyJhbGciOi...)" class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm font-mono focus:outline-hidden focus:border-[#E83E46] mb-6"></textarea>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-2">Header</label>
                <textarea x-model="header" readonly rows="5" class="w-full bg-gray-100 border border-gray-300 rounded-xl p-4 text-xs font-mono"></textarea>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-2">Payload</label>
                <textarea x-model="payload" readonly rows="5" class="w-full bg-gray-100 border border-gray-300 rounded-xl p-4 text-xs font-mono"></textarea>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function jwtTool() {
    return {
        jwtToken: '',
        header: '',
        payload: '',
        decodeJwt() {
            try {
                let parts = this.jwtToken.split('.');
                if (parts.length !== 3) {
                    this.header = 'Invalid JWT format';
                    this.payload = 'Invalid JWT format';
                    return;
                }
                let decodeBase64 = (str) => {
                    let output = str.replace(/-/g, '+').replace(/_/g, '/');
                    let json = decodeURIComponent(atob(output).split('').map(c => '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2)).join(''));
                    return JSON.stringify(JSON.parse(json), null, 4);
                };
                this.header = decodeBase64(parts[0]);
                this.payload = decodeBase64(parts[1]);
            } catch (e) {
                this.header = 'Error decoding header';
                this.payload = 'Error decoding payload: ' + e.message;
            }
        }
    }
}
</script>
@endpush
@endsection