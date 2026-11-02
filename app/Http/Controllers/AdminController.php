<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tool;
use App\Models\Setting;
use App\Models\User;
use App\Models\ToolUsageLog;
use App\Models\ProcessingJob;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalTools = Tool::count();
        $activeTools = Tool::where('is_active', true)->count();
        $totalUsers = User::count();
        $totalToolUses = ToolUsageLog::count();
        $totalCategories = Category::count();
        $totalViews = Tool::sum('views_count');

        $popularTools = Tool::with('category')->orderBy('views_count', 'desc')->take(5)->get();
        $recentJobs = ProcessingJob::with('tool')->latest()->take(5)->get();
        $failedJobsCount = ProcessingJob::where('status', 'failed')->count();
        $activityLogs = AdminActivityLog::latest()->take(10)->get();

        $tools = Tool::with('category')->orderBy('views_count', 'desc')->get();

        return view('admin.dashboard', compact(
            'totalTools', 'activeTools', 'totalUsers', 'totalToolUses',
            'totalCategories', 'totalViews', 'popularTools', 'recentJobs',
            'failedJobsCount', 'activityLogs', 'tools'
        ));
    }

    public function toggleTool($id)
    {
        $tool = Tool::findOrFail($id);
        $tool->is_active = !$tool->is_active;
        $tool->save();

        return back()->with('success', 'Tool status updated successfully.');
    }

    public function settings()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Updated Settings',
            'description' => 'Updated platform settings',
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Settings updated successfully.');
    }
}
