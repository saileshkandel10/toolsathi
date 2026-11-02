<?php

namespace App\Http\Controllers;

use App\Models\ImageTemplate;
use App\Models\UserImageDesign;
use App\Models\Tool;
use App\Models\Category;
use Illuminate\Http\Request;

class ImageMakerController extends Controller
{
    public function index()
    {
        $tool = Tool::where('slug', 'nepali-image-maker')->firstOrFail();
        $category = $tool->category;
        $relatedTools = Tool::where('category_id', $category->id)->where('id', '!=', $tool->id)->take(4)->get();
        $templates = ImageTemplate::where('is_active', true)->get();

        return view('tools.nepali-image-maker', compact('tool', 'category', 'relatedTools', 'templates'));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'design_data' => 'required|string'
        ]);

        $design = UserImageDesign::updateOrCreate(
            ['id' => $request->input('id'), 'user_id' => auth()->id()],
            $validated
        );

        return response()->json(['success' => true, 'message' => 'Design saved successfully', 'id' => $design->id]);
    }
}
