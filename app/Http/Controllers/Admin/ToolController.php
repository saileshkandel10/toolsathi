<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tool;
use App\Models\Category;
use App\Models\AdminActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::with('category')->latest()->paginate(15);
        return view('admin.tools.index', compact('tools'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.tools.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'full_description' => 'nullable|string',
            'icon' => 'nullable|string',
            'route_name' => 'required|string|unique:tools',
            'processing_mode' => 'required|string',
            'component_key' => 'required|string',
            'is_featured' => 'boolean',
            'is_premium' => 'boolean',
            'is_active' => 'boolean',
            'seo_title' => 'nullable|string',
            'seo_description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_premium'] = $request->has('is_premium');
        $validated['is_active'] = $request->has('is_active');

        Tool::create($validated);

        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Created Tool',
            'description' => 'Created tool: ' . $validated['name'],
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.tools.index')->with('success', 'Tool created successfully.');
    }

    public function edit(Tool $tool)
    {
        $categories = Category::all();
        return view('admin.tools.edit', compact('tool', 'categories'));
    }

    public function update(Request $request, Tool $tool)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'full_description' => 'nullable|string',
            'icon' => 'nullable|string',
            'route_name' => 'required|string|unique:tools,route_name,' . $tool->id,
            'processing_mode' => 'required|string',
            'component_key' => 'required|string',
            'is_featured' => 'boolean',
            'is_premium' => 'boolean',
            'is_active' => 'boolean',
            'seo_title' => 'nullable|string',
            'seo_description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_premium'] = $request->has('is_premium');
        $validated['is_active'] = $request->has('is_active');

        $tool->update($validated);

        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Updated Tool',
            'description' => 'Updated tool: ' . $tool->name,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.tools.index')->with('success', 'Tool updated successfully.');
    }

    public function destroy(Tool $tool, Request $request)
    {
        $name = $tool->name;
        $tool->delete();

        AdminActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Deleted Tool',
            'description' => 'Deleted tool: ' . $name,
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Tool deleted successfully.');
    }

    public function toggle(Tool $tool, Request $request)
    {
        $tool->is_active = !$tool->is_active;
        $tool->save();

        return back()->with('success', 'Tool status updated.');
    }
}
