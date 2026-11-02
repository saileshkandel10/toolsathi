<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tool;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('tools')->orderBy('sort_order')->get();
        $featuredTools = Tool::with('category')->where('is_featured', true)->where('is_active', true)->take(8)->get();
        $popularTools = Tool::with('category')->where('is_active', true)->orderBy('views_count', 'desc')->take(8)->get();
        $recentTools = Tool::with('category')->where('is_active', true)->latest()->take(8)->get();

        return view('home', compact('categories', 'featuredTools', 'popularTools', 'recentTools'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        if (!$query) {
            return response()->json([]);
        }

        $tools = Tool::with('category')->where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->take(10)
            ->get()
            ->map(function($tool) {
                return [
                    'name' => $tool->name,
                    'description' => $tool->description,
                    'url' => url('/' . $tool->category->slug . '/' . $tool->slug),
                    'category' => $tool->category->name ?? '',
                    'icon' => $tool->icon ?? 'tool'
                ];
            });

        return response()->json($tools);
    }
}
