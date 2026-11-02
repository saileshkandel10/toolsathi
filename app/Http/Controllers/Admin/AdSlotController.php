<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdSlot;
use Illuminate\Http\Request;

class AdSlotController extends Controller
{
    public function index()
    {
        $adSlots = AdSlot::all();
        return view('admin.ads.index', compact('adSlots'));
    }

    public function update(Request $request, AdSlot $adSlot)
    {
        $validated = $request->validate([
            'code' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $adSlot->update([
            'code' => $validated['code'] ?? '',
            'is_active' => $request->has('is_active')
        ]);

        return back()->with('success', 'Ad slot updated successfully.');
    }
}
