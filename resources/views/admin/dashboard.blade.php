@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-[#242B36]">Admin Dashboard</h1>
            <p class="text-sm text-gray-500">Real-time overview of ToolSathi platform metrics and performance</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.tools.create') }}" class="bg-[#E83E46] text-white hover:bg-[#d23239] px-4 py-2 rounded-xl text-sm font-semibold transition shadow-xs">+ Add New Tool</a>
        </div>
    </div>

    <!-- Quick Metrics Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-xs border border-gray-200">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-400 uppercase">Total Tools</span>
                <span class="text-xs font-bold px-2 py-0.5 rounded-full bg-green-50 text-green-600">{{ $activeTools }} Active</span>
            </div>
            <div class="text-3xl font-extrabold text-[#242B36] mt-2">{{ $totalTools }}</div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-xs border border-gray-200">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-400 uppercase">Total Tool Uses</span>
                <i data-lucide="zap" class="w-4 h-4 text-[#E83E46]"></i>
            </div>
            <div class="text-3xl font-extrabold text-[#242B36] mt-2">{{ number_format($totalToolUses) }}</div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-xs border border-gray-200">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-400 uppercase">Registered Users</span>
                <i data-lucide="users" class="w-4 h-4 text-indigo-500"></i>
            </div>
            <div class="text-3xl font-extrabold text-[#242B36] mt-2">{{ $totalUsers }}</div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-xs border border-gray-200">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold text-gray-400 uppercase">Failed Jobs</span>
                <span class="text-xs font-bold px-2 py-0.5 rounded-full {{ $failedJobsCount > 0 ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-500' }}">{{ $failedJobsCount }} Failed</span>
            </div>
            <div class="text-3xl font-extrabold text-[#E83E46] mt-2">{{ $failedJobsCount }}</div>
        </div>
    </div>

    <!-- Charts & Analytics -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Daily Usage Chart Widget -->
        <div class="bg-white p-6 rounded-2xl shadow-xs border border-gray-200">
            <h3 class="font-bold text-gray-900 mb-4 flex items-center justify-between">
                <span>Tool Usage Analytics</span>
                <span class="text-xs font-normal text-gray-400">Past 7 Days</span>
            </h3>
            <div class="h-64 flex items-end justify-between px-4 pt-8 border-b border-gray-100">
                <div class="flex flex-col items-center space-y-2">
                    <div class="w-8 bg-red-100 rounded-t-lg" style="height: 45%;"></div>
                    <span class="text-[10px] text-gray-400">Mon</span>
                </div>
                <div class="flex flex-col items-center space-y-2">
                    <div class="w-8 bg-red-200 rounded-t-lg" style="height: 60%;"></div>
                    <span class="text-[10px] text-gray-400">Tue</span>
                </div>
                <div class="flex flex-col items-center space-y-2">
                    <div class="w-8 bg-red-300 rounded-t-lg" style="height: 80%;"></div>
                    <span class="text-[10px] text-gray-400">Wed</span>
                </div>
                <div class="flex flex-col items-center space-y-2">
                    <div class="w-8 bg-red-200 rounded-t-lg" style="height: 55%;"></div>
                    <span class="text-[10px] text-gray-400">Thu</span>
                </div>
                <div class="flex flex-col items-center space-y-2">
                    <div class="w-8 bg-red-400 rounded-t-lg" style="height: 90%;"></div>
                    <span class="text-[10px] text-gray-400">Fri</span>
                </div>
                <div class="flex flex-col items-center space-y-2">
                    <div class="w-8 bg-red-200 rounded-t-lg" style="height: 70%;"></div>
                    <span class="text-[10px] text-gray-400">Sat</span>
                </div>
                <div class="flex flex-col items-center space-y-2">
                    <div class="w-8 bg-[#E83E46] rounded-t-lg" style="height: 95%;"></div>
                    <span class="text-[10px] text-[#E83E46] font-bold">Today</span>
                </div>
            </div>
        </div>

        <!-- Most Popular Tools -->
        <div class="bg-white p-6 rounded-2xl shadow-xs border border-gray-200">
            <h3 class="font-bold text-gray-900 mb-4">Most Popular Tools</h3>
            <div class="divide-y divide-gray-100">
                @foreach($popularTools as $tool)
                    <div class="py-3 flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-lg bg-red-50 text-[#E83E46] flex items-center justify-center font-bold text-xs">
                                <i data-lucide="{{ $tool->icon ?? 'tool' }}" class="w-4 h-4"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 text-sm">{{ $tool->name }}</h4>
                                <span class="text-xs text-gray-400">{{ $tool->category->name ?? 'General' }}</span>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="font-bold text-gray-900 text-sm">{{ number_format($tool->views_count) }}</span>
                            <div class="text-[10px] text-gray-400">views</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Recent Activity & Audit Logs -->
    <div class="bg-white rounded-2xl shadow-xs border border-gray-200 p-6">
        <h3 class="font-bold text-gray-900 mb-4">Recent Admin Activity Logs</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 text-xs uppercase text-gray-500 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-2">Action</th>
                        <th class="px-4 py-2">Details</th>
                        <th class="px-4 py-2">IP Address</th>
                        <th class="px-4 py-2 text-right">Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($activityLogs as $log)
                        <tr>
                            <td class="px-4 py-3 font-semibold text-gray-900">{{ $log->action }}</td>
                            <td class="px-4 py-3">{{ $log->description }}</td>
                            <td class="px-4 py-3 font-mono text-xs">{{ $log->ip_address }}</td>
                            <td class="px-4 py-3 text-right text-xs text-gray-400">{{ $log->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-400 text-xs">No admin activity recorded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection