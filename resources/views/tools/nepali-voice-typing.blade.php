@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="nepaliVoiceTyping()">
    <!-- Breadcrumbs -->
    <nav class="text-xs text-gray-500 mb-6 flex items-center space-x-2">
        <a href="{{ route('home') }}" class="hover:text-[#E83E46]">Home</a>
        <span>/</span>
        <a href="{{ url('/' . $category->slug) }}" class="hover:text-[#E83E46]">{{ $category->name }}</a>
        <span>/</span>
        <span class="text-gray-800 font-medium">{{ $tool->name }}</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8 mb-8">
        <div class="flex items-center space-x-4 mb-6">
            <div class="w-12 h-12 rounded-xl bg-red-50 text-[#E83E46] flex items-center justify-center">
                <i data-lucide="{{ $tool->icon ?? 'mic' }}" class="w-6 h-6"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-[#242B36]">{{ $tool->name }}</h1>
                <p class="text-sm text-gray-600">{{ $tool->description }}</p>
            </div>
        </div>

        <div class="p-4 bg-blue-50 border border-blue-200 rounded-xl text-xs text-blue-800 mb-6">
            <strong>Privacy Notice:</strong> Speech recognition uses your browser's Web Speech API. Audio is processed by your browser's speech service and is never stored on ToolSathi servers.
        </div>

        <div class="flex items-center justify-between mb-4 bg-gray-50 p-4 rounded-xl border border-gray-200">
            <div class="flex items-center space-x-3">
                <button @click="toggleListening" :class="listening ? 'bg-red-600 animate-pulse' : 'bg-[#E83E46] hover:bg-[#d23239]'" class="text-white px-6 py-3 rounded-xl text-sm font-semibold transition flex items-center space-x-2 shadow-xs">
                    <i data-lucide="mic" class="w-5 h-5"></i>
                    <span x-text="listening ? 'Stop Recording' : 'Start Nepali Voice Typing'"></span>
                </button>
                <span class="text-xs text-gray-500 font-semibold" x-text="statusText"></span>
            </div>
        </div>

        <textarea x-model="transcript" rows="10" placeholder="Speak in Nepali and your transcribed text will appear here..." class="w-full bg-gray-50 border border-gray-300 rounded-xl p-4 text-sm focus:outline-hidden focus:border-[#E83E46] mb-4"></textarea>

        <div class="flex space-x-4">
            <button @click="copyText" class="bg-[#E83E46] text-white font-semibold px-6 py-2.5 rounded-xl text-sm hover:bg-[#d23239] transition">Copy Text</button>
            <button @click="downloadTxt" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-2.5 rounded-xl text-sm transition">Download TXT</button>
            <button @click="transcript = ''" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2.5 rounded-xl text-sm transition">Clear</button>
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
function nepaliVoiceTyping() {
    return {
        listening: false,
        transcript: '',
        statusText: 'Ready to listen...',
        recognition: null,
        init() {
            if (!('webkitSpeechRecognition' in window) && !('SpeechRecognition' in window)) {
                this.statusText = 'Speech recognition not supported in this browser.';
                return;
            }
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            this.recognition = new SpeechRecognition();
            this.recognition.lang = 'ne-NP';
            this.recognition.continuous = true;
            this.recognition.interimResults = true;

            this.recognition.onresult = (event) => {
                let interim = '';
                let final = '';
                for (let i = event.resultIndex; i < event.results.length; ++i) {
                    if (event.results[i].isFinal) {
                        final += event.results[i][0].transcript;
                    } else {
                        interim += event.results[i][0].transcript;
                    }
                }
                if (final) {
                    this.transcript += (this.transcript ? ' ' : '') + final;
                }
            };

            this.recognition.onerror = (event) => {
                this.statusText = 'Error occurred in recognition: ' + event.error;
                this.listening = false;
            };

            this.recognition.onend = () => {
                this.listening = false;
                this.statusText = 'Recording stopped.';
            };
        },
        toggleListening() {
            if (!this.recognition) {
                alert('Speech recognition is not supported in your current browser. Please use Google Chrome.');
                return;
            }
            if (this.listening) {
                this.recognition.stop();
                this.listening = false;
            } else {
                try {
                    this.recognition.start();
                    this.listening = true;
                    this.statusText = 'Listening in Nepali... Speak now.';
                } catch (e) {
                    console.error(e);
                }
            }
        },
        copyText() {
            navigator.clipboard.writeText(this.transcript);
            alert('Copied to clipboard!');
        },
        downloadTxt() {
            let blob = new Blob([this.transcript], { type: 'text/plain;charset=utf-8' });
            let url = URL.createObjectURL(blob);
            let a = document.createElement('a');
            a.href = url;
            a.download = 'nepali-voice-typing.txt';
            a.click();
        }
    }
}
</script>
@endpush
@endsection