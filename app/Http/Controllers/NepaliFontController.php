<?php

namespace App\Http\Controllers;

use App\Models\NepaliFont;
use Illuminate\Http\Request;

class NepaliFontController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');

        $fonts = NepaliFont::where('is_active', true)
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            })
            ->when($category, function ($q) use ($category) {
                $q->where('category', $category);
            })
            ->paginate(12);

        $categories = ['Unicode Devanagari', 'Preeti-compatible', 'Decorative', 'Serif', 'Sans-serif'];

        // Get tool info for breadcrumbs / SEO
        $tool = \App\Models\Tool::where('slug', 'nepali-fonts')->first() ?? new \App\Models\Tool(['name' => 'Nepali Font Library', 'description' => 'Browse and download free Nepali fonts.']);
        $cat = \App\Models\Category::where('slug', 'nepali-tools')->first();

        return view('nepali-tools.fonts', compact('fonts', 'categories', 'search', 'category', 'tool', 'cat'));
    }
}
