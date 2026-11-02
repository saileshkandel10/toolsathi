<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel - ToolSathi' }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F6F7F9] text-[#242B36] font-sans antialiased flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-[#242B36] text-white flex flex-col shrink-0 min-h-screen shadow-xl">
        <div class="p-6 border-b border-gray-800 flex items-center space-x-3">
            <div class="w-10 h-10 rounded-xl bg-[#E83E46] flex items-center justify-center font-bold text-xl shadow-md">
                TS
            </div>
            <div>
                <span class="text-lg font-bold tracking-tight">Tool<span class="text-[#E83E46]">Sathi</span></span>
                <p class="text-[10px] text-gray-400 uppercase tracking-widest">Admin Control</p>
            </div>
        </div>

        <nav class="flex-grow p-4 space-y-1 text-sm font-medium">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-gray-800 transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#E83E46] text-white shadow-md' : 'text-gray-300' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.tools.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-gray-800 transition {{ request()->routeIs('admin.tools.*') ? 'bg-[#E83E46] text-white shadow-md' : 'text-gray-300' }}">
                <i data-lucide="tool" class="w-5 h-5"></i>
                <span>Tools Management</span>
            </a>
            <a href="{{ route('admin.ads.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-gray-800 transition {{ request()->routeIs('admin.ads.*') ? 'bg-[#E83E46] text-white shadow-md' : 'text-gray-300' }}">
                <i data-lucide="dollar-sign" class="w-5 h-5"></i>
                <span>Ad Slots Settings</span>
            </a>
            <a href="{{ route('admin.settings') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-gray-800 transition {{ request()->routeIs('admin.settings') ? 'bg-[#E83E46] text-white shadow-md' : 'text-gray-300' }}">
                <i data-lucide="settings" class="w-5 h-5"></i>
                <span>Platform Settings</span>
            </a>
            <a href="{{ url('/') }}" target="_blank" class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-gray-800 transition text-gray-300">
                <i data-lucide="external-link" class="w-5 h-5"></i>
                <span>View Live Site</span>
            </a>
        </nav>

        <div class="p-4 border-t border-gray-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center space-x-2 bg-red-500/10 hover:bg-red-500/20 text-[#E83E46] font-semibold py-2.5 rounded-xl transition text-sm">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-grow flex flex-col min-w-0">
        <header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-8 shadow-xs">
            <h2 class="text-lg font-bold text-gray-800">Admin Control Panel</h2>
            <div class="flex items-center space-x-3 text-sm font-medium text-gray-700">
                <span>{{ auth()->user()->name ?? 'Administrator' }}</span>
                <div class="w-8 h-8 rounded-full bg-[#E83E46] text-white flex items-center justify-center font-bold text-xs">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
            </div>
        </header>

        <main class="flex-grow p-8 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>