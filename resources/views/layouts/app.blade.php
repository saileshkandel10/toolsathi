<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'ToolSathi - Your Digital Tools Companion' }}</title>
    <meta name="description" content="{{ $description ?? 'Free online tools: PDF tools, Nepali date converter, image compressor, calculators, text utilities and more.' }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Noto+Sans+Devanagari:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- pdf-lib & JSZip -->
    <script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col bg-[#F6F7F9] text-[#242B36] font-sans antialiased">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <a href="{{ url('/') }}" class="flex items-center space-x-2">
                    <div class="w-10 h-10 rounded-lg bg-[#E83E46] flex items-center justify-center text-white font-bold text-xl shadow-md">
                        TS
                    </div>
                    <div>
                        <span class="text-xl font-bold tracking-tight text-[#242B36]">Tool<span class="text-[#E83E46]">Sathi</span></span>
                        <p class="text-[10px] text-gray-500 font-medium tracking-wide uppercase">Your Digital Tools Companion</p>
                    </div>
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center space-x-6 text-sm font-medium">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-[#E83E46] transition">Home</a>
                <a href="{{ route('tools.index') }}" class="text-gray-700 hover:text-[#E83E46] transition">All Tools</a>
                <a href="{{ url('/nepali-tools/nepali-date-converter') }}" class="text-gray-700 hover:text-[#E83E46] transition">Nepali Date</a>
                <a href="{{ url('/nepali-tools/preeti-to-unicode') }}" class="text-gray-700 hover:text-[#E83E46] transition">Nepali Unicode</a>
            </nav>

            <!-- Search Quick Button / User Area -->
            <div class="flex items-center space-x-4">
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = true" class="flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 px-3 py-1.5 rounded-lg text-sm text-gray-600 transition">
                        <i data-lucide="search" class="w-4 h-4"></i>
                        <span class="hidden sm:inline">Search tools...</span>
                        <kbd class="hidden sm:inline bg-white px-1.5 py-0.5 text-xs rounded border border-gray-300">Ctrl+K</kbd>
                    </button>

                    <!-- Search Modal -->
                    <div x-show="open" @click.away="open = false" class="fixed inset-0 z-50 flex items-start justify-center pt-20 bg-black/50 backdrop-blur-xs px-4" x-cloak>
                        <div class="bg-white rounded-xl shadow-2xl w-full max-w-xl overflow-hidden p-4 border border-gray-100">
                            <div class="flex items-center border-b border-gray-200 pb-3 px-2">
                                <i data-lucide="search" class="w-5 h-5 text-gray-400 mr-2"></i>
                                <input type="text" x-data x-ref="searchInput" x-init="$refs.searchInput.focus()" placeholder="Search any tool (e.g. PDF, Nepali Date, Word Counter)..." class="w-full focus:outline-hidden text-gray-800 placeholder-gray-400" @input.debounce.300ms="fetch('/api/search?q=' + $el.value).then(res => res.json()).then(data => { $dispatch('search-results', data) })">
                                <button @click="open = false" class="text-gray-400 hover:text-gray-600 font-bold text-lg">&times;</button>
                            </div>
                            <div class="mt-3 max-h-80 overflow-y-auto" x-data="{ results: [] }" @search-results.window="results = $detail">
                                <template x-for="tool in results">
                                    <a :href="'/tools/' + tool.slug" class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg transition border-b border-gray-100 last:border-none">
                                        <div>
                                            <div class="font-semibold text-gray-900" x-text="tool.name"></div>
                                            <div class="text-xs text-gray-500" x-text="tool.description"></div>
                                        </div>
                                        <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i>
                                    </a>
                                </template>
                                <div x-show="results.length === 0" class="text-center py-6 text-gray-400 text-sm">
                                    Type to search tools across all categories...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @auth
                    <a href="{{ route('admin.dashboard') }}" class="bg-[#E83E46] text-white px-4 py-1.5 rounded-lg text-sm font-medium hover:bg-[#d23239] transition shadow-xs">Admin Panel</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-[#E83E46]">Login</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#242B36] text-white pt-12 pb-8 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8 pb-8 border-b border-gray-800">
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-[#E83E46] flex items-center justify-center text-white font-bold text-lg">
                        TS
                    </div>
                    <span class="text-lg font-bold">Tool<span class="text-[#E83E46]">Sathi</span></span>
                </div>
                <p class="text-gray-400 text-sm">Your Digital Tools Companion. Fast, secure, and free online utilities designed for everyone.</p>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-wider text-gray-300 mb-4">PDF & Files</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ url('/tools/merge-pdf') }}" class="hover:text-white transition">Merge PDF</a></li>
                    <li><a href="{{ url('/tools/split-pdf') }}" class="hover:text-white transition">Split PDF</a></li>
                    <li><a href="{{ url('/tools/compress-pdf') }}" class="hover:text-white transition">Compress PDF</a></li>
                    <li><a href="{{ url('/tools/qr-code-generator') }}" class="hover:text-white transition">QR Code Generator</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-wider text-gray-300 mb-4">Nepali Utilities</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ url('/tools/nepali-date-converter') }}" class="hover:text-white transition">Nepali Date Converter</a></li>
                    <li><a href="{{ url('/tools/nepali-unicode') }}" class="hover:text-white transition">Nepali Unicode Typing</a></li>
                    <li><a href="{{ url('/tools/nepali-number-to-words') }}" class="hover:text-white transition">Number to Words</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-semibold uppercase tracking-wider text-gray-300 mb-4">Calculators & Text</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ url('/tools/age-calculator') }}" class="hover:text-white transition">Age Calculator</a></li>
                    <li><a href="{{ url('/tools/emi-calculator') }}" class="hover:text-white transition">EMI / Loan Calculator</a></li>
                    <li><a href="{{ url('/tools/word-counter') }}" class="hover:text-white transition">Word & Character Counter</a></li>
                    <li><a href="{{ url('/tools/password-generator') }}" class="hover:text-white transition">Password Generator</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 flex flex-col sm:flex-row items-center justify-between text-xs text-gray-500">
            <p>&copy; {{ date('Y') }} ToolSathi. All rights reserved.</p>
            <p class="mt-2 sm:mt-0">Made with ❤️ for everyone.</p>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>
</html>