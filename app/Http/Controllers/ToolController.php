<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tool;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('tools')->orderBy('sort_order')->get();
        $search = $request->input('search');

        $tools = Tool::with('category')->where('is_active', true)
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            })
            ->paginate(12);

        return view('tools.index', compact('categories', 'tools', 'search'));
    }

    public function category($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $categories = Category::orderBy('sort_order')->get();
        $tools = Tool::where('category_id', $category->id)->where('is_active', true)->paginate(12);

        return view('tools.category', compact('category', 'categories', 'tools'));
    }

    public function show($categorySlug, $toolSlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $tool = Tool::where('slug', $toolSlug)->where('category_id', $category->id)->where('is_active', true)->firstOrFail();
        
        $tool->increment('views_count');

        // Log usage
        \App\Models\ToolUsageLog::create([
            'tool_id' => $tool->id,
            'user_id' => auth()->id(),
            'ip_address' => request()->ip(),
            'status' => 'success'
        ]);

        $relatedTools = Tool::where('category_id', $tool->category_id)
            ->where('id', '!=', $tool->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        $viewName = 'tools.' . $tool->slug;
        if (!view()->exists($viewName)) {
            $viewName = 'tools.generic';
        }

        return view($viewName, compact('tool', 'category', 'relatedTools'));
    }
}
