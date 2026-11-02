@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="passwordGenerator()">
    <nav class="text-xs text-gray-500 mb-6 flex items-center space-x-2">
        <a href="{{ route('home') }}" class="hover:text-[#E83E46]">Home</a>
        <span>/</span>
        <a href="{{ route('tools.index') }}" class="hover:text-[#E83E46]">Tools</a>
        <span>/</span>
        <span class="text-gray-800 font-medium">{{ $tool->name }}</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8">
        <div class="flex items-center space-x-4 mb-6">
            <div class="w-12 h-12 rounded-xl bg-red-50 text-[#E83E46] flex items-center justify-center">
                <i data-lucide="{{ $tool->icon ?? 'lock' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <!-- Password Display -->
        <div class="flex items-center bg-gray-50 border border-gray-300 rounded-xl p-4 mb-6">
            <input type="text" x-model="password" readonly class="w-full bg-transparent text-lg font-mono font-bold text-gray-800 focus:outline-hidden">
            <button @click="copyPassword" class="bg-[#E83E46] text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-[#d23239] transition shrink-0 ml-2">Copy</button>
        </div>

        <!-- Options -->
        <div class="space-y-4 mb-6">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Length: <span x-text="length"></span></label>
                <input type="range" x-model.number="length" min="6" max="64" @input="generate" class="w-full accent-[#E83E46]">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <label class="flex items-center space-x-2 text-sm text-gray-700 cursor-pointer">
                    <input type="checkbox" x-model="includeUpper" @change="generate" class="rounded text-[#E83E46] focus:ring-[#E83E46]">
                    <span>Uppercase Letters (A-Z)</span>
                </label>
                <label class="flex items-center space-x-2 text-sm text-gray-700 cursor-pointer">
                    <input type="checkbox" x-model="includeLower" @change="generate" class="rounded text-[#E83E46] focus:ring-[#E83E46]">
                    <span>Lowercase Letters (a-z)</span>
                </label>
                <label class="flex items-center space-x-2 text-sm text-gray-700 cursor-pointer">
                    <input type="checkbox" x-model="includeNumbers" @change="generate" class="rounded text-[#E83E46] focus:ring-[#E83E46]">
                    <span>Numbers (0-9)</span>
                </label>
                <label class="flex items-center space-x-2 text-sm text-gray-700 cursor-pointer">
                    <input type="checkbox" x-model="includeSymbols" @change="generate" class="rounded text-[#E83E46] focus:ring-[#E83E46]">
                    <span>Symbols (!@#$%)</span>
                </label>
            </div>
        </div>

        <button @click="generate" class="w-full bg-[#E83E46] text-white font-semibold py-3 rounded-xl hover:bg-[#d23239] transition">
            Generate New Password
        </button>
    </div>
</div>

@push('scripts')
<script>
function passwordGenerator() {
    return {
        password: '',
        length: 16,
        includeUpper: true,
        includeLower: true,
        includeNumbers: true,
        includeSymbols: true,
        init() {
            this.generate();
        },
        generate() {
            let chars = '';
            if (this.includeUpper) chars += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            if (this.includeLower) chars += 'abcdefghijklmnopqrstuvwxyz';
            if (this.includeNumbers) chars += '0123456789';
            if (this.includeSymbols) chars += '!@#$%^&*()_+-=[]{}|;:,.<>?';

            if (!chars) {
                this.password = 'Please select at least one option.';
                return;
            }

            let result = '';
            for (let i = 0; i < this.length; i++) {
                result += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            this.password = result;
        },
        copyPassword() {
            navigator.clipboard.writeText(this.password);
            alert('Password copied to clipboard!');
        }
    }
}
</script>
@endpush
@endsection