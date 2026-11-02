<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToolUsageLog;
use App\Models\Subscription;
use App\Models\Plan;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $usageLogs = ToolUsageLog::with('tool')->where('user_id', $user->id)->latest()->take(15)->get();
        $subscription = Subscription::with('plan')->where('user_id', $user->id)->where('status', 'active')->first();
        $plans = Plan::all();

        return view('user.dashboard', compact('user', 'usageLogs', 'subscription', 'plans'));
    }

    public function settings()
    {
        $user = auth()->user();
        return view('user.settings', compact('user'));
    }

    public function updateSettings(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully.');
    }
}
