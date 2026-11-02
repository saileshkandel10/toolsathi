<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Models\Category;
use App\Models\BlogPost;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $tools = Tool::with('category')->where('is_active', true)->get();
        $categories = Category::all();
        $posts = BlogPost::where('is_published', true)->get();

        $content = view('sitemap', compact('tools', 'categories', 'posts'))->render();

        return response($content, 200)->header('Content-Type', 'text/xml');
    }

    public function robots()
    {
        $content = "User-agent: *\nDisallow: /admin/\nAllow: /\nSitemap: " . url('/sitemap.xml');
        return response($content, 200)->header('Content-Type', 'text/plain');
    }
}
