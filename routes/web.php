<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/api/search', [HomeController::class, 'search']);
Route::get('/tools', [ToolController::class, 'index'])->name('tools.index');
Route::get('/nepali-tools/nepali-fonts', [\App\Http\Controllers\NepaliFontController::class, 'index'])->name('tools.nepali.fonts');

Route::get('/nepali-tools/easy-nepali-typing', function() {
    $tool = \App\Models\Tool::where('slug', 'easy-nepali-typing')->firstOrFail();
    $category = $tool->category;
    $relatedTools = \App\Models\Tool::where('category_id', $category->id)->where('id', '!=', $tool->id)->take(4)->get();
    return view('tools.easy-nepali-typing', compact('tool', 'category', 'relatedTools'));
})->name('tools.nepali.easy-typing');

Route::get('/nepali-tools/nepali-voice-typing', function() {
    $tool = \App\Models\Tool::where('slug', 'nepali-voice-typing')->firstOrFail();
    $category = $tool->category;
    $relatedTools = \App\Models\Tool::where('category_id', $category->id)->where('id', '!=', $tool->id)->take(4)->get();
    return view('tools.nepali-voice-typing', compact('tool', 'category', 'relatedTools'));
})->name('tools.nepali.voice-typing');

Route::get('/nepali-tools/nepali-document-editor', [\App\Http\Controllers\DocumentEditorController::class, 'index'])->name('tools.nepali.document-editor');
Route::post('/nepali-tools/nepali-document-editor/save', [\App\Http\Controllers\DocumentEditorController::class, 'store'])->middleware('auth');

Route::get('/nepali-tools/nepali-image-maker', [\App\Http\Controllers\ImageMakerController::class, 'index'])->name('tools.nepali.image-maker');
Route::post('/nepali-tools/nepali-image-maker/save', [\App\Http\Controllers\ImageMakerController::class, 'store'])->middleware('auth');
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index']);
Route::get('/robots.txt', [\App\Http\Controllers\SitemapController::class, 'robots']);
Route::get('/blog', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');
Route::get('/contact', [\App\Http\Controllers\PageController::class, 'contact'])->name('page.contact');
Route::post('/contact', [\App\Http\Controllers\PageController::class, 'submitContact']);
Route::get('/page/{slug}', [\App\Http\Controllers\PageController::class, 'show'])->name('page.show');

// Simple Login / Logout
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended(route('admin.dashboard'));
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
});

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// User Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [\App\Http\Controllers\UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user/settings', [\App\Http\Controllers\UserController::class, 'settings'])->name('user.settings');
    Route::post('/user/settings', [\App\Http\Controllers\UserController::class, 'updateSettings']);
    Route::post('/checkout/{plan}', [\App\Http\Controllers\PaymentController::class, 'checkout']);
    Route::post('/payment/verify/{payment}', [\App\Http\Controllers\PaymentController::class, 'verify']);
});
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('tools', \App\Http\Controllers\Admin\ToolController::class);
    Route::post('/tools/{tool}/toggle', [\App\Http\Controllers\Admin\ToolController::class, 'toggle'])->name('tools.toggle');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    Route::get('/ads', [\App\Http\Controllers\Admin\AdSlotController::class, 'index'])->name('ads.index');
    Route::put('/ads/{adSlot}', [\App\Http\Controllers\Admin\AdSlotController::class, 'update'])->name('ads.update');
});

// Dynamic Category & Tool Routes (Must be at the bottom)
Route::get('/{categorySlug}', [ToolController::class, 'category'])->name('tools.category');
Route::get('/{categorySlug}/{toolSlug}', [ToolController::class, 'show'])->name('tools.show');
