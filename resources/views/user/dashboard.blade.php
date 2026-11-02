@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-[#242B36]">User Dashboard</h1>
            <p class="text-sm text-gray-500">Welcome back, {{ $user->name }}</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ url('/user/settings') }}" class="bg-gray-100 text-gray-700 hover:bg-gray-200 px-4 py-2 rounded-xl text-sm font-semibold transition">Account Settings</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-50 text-[#E83E46] hover:bg-red-100 px-4 py-2 rounded-xl text-sm font-semibold transition">Logout</button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-xs text-green-700 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <!-- Subscription Status & Plans -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="bg-white p-6 rounded-2xl shadow-xs border border-gray-200 md:col-span-1">
            <h3 class="font-bold text-gray-900 mb-2">Current Membership</h3>
            @if($subscription)
                <div class="p-4 bg-red-50 rounded-xl border border-red-100 mb-4">
                    <div class="font-bold text-[#E83E46] text-lg">{{ optional($subscription->plan)->name }}</div>
                    <div class="text-xs text-gray-600 mt-1">Active until: {{ optional($subscription->expires_at)->format('M d, Y') }}</div>
                </div>
            @else
                <div class="p-4 bg-gray-50 rounded-xl border border-gray-200 mb-4">
                    <div class="font-bold text-gray-800 text-lg">Free Plan</div>
                    <div class="text-xs text-gray-500 mt-1">Standard file size limits and ads.</div>
                </div>
            @endif
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-xs border border-gray-200 md:col-span-2">
            <h3 class="font-bold text-gray-900 mb-4">Upgrade to Premium</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($plans as $plan)
                    <div class="border border-gray-200 rounded-xl p-4 flex flex-col justify-between">
                        <div>
                            <div class="font-bold text-gray-900">{{ $plan->name }}</div>
                            <div class="text-2xl font-extrabold text-[#E83E46] my-2">Rs. {{ number_format($plan->price) }}</div>
                            <p class="text-xs text-gray-500 mb-4">{{ $plan->features }}</p>
                        </div>
                        <form action="{{ url('/checkout/' . $plan->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-[#E83E46] text-white py-2 rounded-lg text-xs font-semibold hover:bg-[#d23239] transition">Upgrade Now</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Usage History -->
    <div class="bg-white rounded-2xl shadow-xs border border-gray-200 p-6">
        <h3 class="font-bold text-gray-900 mb-4">Recent Tool Usage History</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 text-xs uppercase text-gray-500 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-2">Tool Name</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2 text-right">Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($usageLogs as $log)
                        <tr>
                            <td class="px-4 py-3 font-semibold text-gray-900">{{ optional($log->tool)->name ?? 'Utility Tool' }}</td>
                            <td class="px-4 py-3"><span class="px-2 py-0.5 bg-green-100 text-green-700 rounded text-xs">Success</span></td>
                            <td class="px-4 py-3 text-right text-xs text-gray-400">{{ $log->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-center text-gray-400 text-xs">No tool usage history recorded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection