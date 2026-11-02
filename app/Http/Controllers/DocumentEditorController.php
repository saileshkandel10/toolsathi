<?php

namespace App\Http\Controllers;

use App\Models\UserDocument;
use App\Models\Tool;
use App\Models\Category;
use Illuminate\Http\Request;

class DocumentEditorController extends Controller
{
    public function index()
    {
        $tool = Tool::where('slug', 'nepali-document-editor')->firstOrFail();
        $category = $tool->category;
        $relatedTools = Tool::where('category_id', $category->id)->where('id', '!=', $tool->id)->take(4)->get();

        $savedDocs = auth()->check() ? UserDocument::where('user_id', auth()->id())->latest()->get() : [];

        return view('tools.nepali-document-editor', compact('tool', 'category', 'relatedTools', 'savedDocs'));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string'
        ]);

        $doc = UserDocument::updateOrCreate(
            ['id' => $request->input('id'), 'user_id' => auth()->id()],
            $validated
        );

        return response()->json(['success' => true, 'message' => 'Document saved successfully', 'id' => $doc->id]);
    }
}
