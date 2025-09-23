<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketingBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class MarketingBannerController extends Controller
{
    public function index()
    {
        $banners = MarketingBanner::ordered()->paginate(15);
        return view('frontend.admin.marketing-banners.index', compact('banners'));
    }

    public function create()
    {
        return view('frontend.admin.marketing-banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
            'welcome_message' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|url|max:500',
            'is_active' => 'boolean',
            'display_order' => 'integer|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'target_audience' => 'array',
            'target_audience.*' => 'in:all,users,guests'
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('marketing-banners', 'public');
        }

        MarketingBanner::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'welcome_message' => $request->welcome_message,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
            'is_active' => $request->boolean('is_active'),
            'display_order' => $request->display_order ?? 0,
            'start_date' => $request->start_date ? Carbon::parse($request->start_date) : null,
            'end_date' => $request->end_date ? Carbon::parse($request->end_date) : null,
            'target_audience' => $request->target_audience ?? ['all']
        ]);

        return redirect()->route('admin.marketing-banners.index')
                        ->with('success', 'Marketing banner created successfully.');
    }

    public function show(MarketingBanner $marketingBanner)
    {
        return view('frontend.admin.marketing-banners.show', compact('marketingBanner'));
    }

    public function edit(MarketingBanner $marketingBanner)
    {
        return view('frontend.admin.marketing-banners.edit', compact('marketingBanner'));
    }

    public function update(Request $request, MarketingBanner $marketingBanner)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'welcome_message' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|url|max:500',
            'is_active' => 'boolean',
            'display_order' => 'integer|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'target_audience' => 'array',
            'target_audience.*' => 'in:all,users,guests'
        ]);

        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
            'welcome_message' => $request->welcome_message,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
            'is_active' => $request->boolean('is_active'),
            'display_order' => $request->display_order ?? 0,
            'start_date' => $request->start_date ? Carbon::parse($request->start_date) : null,
            'end_date' => $request->end_date ? Carbon::parse($request->end_date) : null,
            'target_audience' => $request->target_audience ?? ['all']
        ];

        // Handle image upload if new image is provided
        if ($request->hasFile('image')) {
            // Delete old image
            if ($marketingBanner->image_path) {
                Storage::disk('public')->delete($marketingBanner->image_path);
            }
            
            $updateData['image_path'] = $request->file('image')->store('marketing-banners', 'public');
        }

        $marketingBanner->update($updateData);

        return redirect()->route('admin.marketing-banners.index')
                        ->with('success', 'Marketing banner updated successfully.');
    }

    public function destroy(MarketingBanner $marketingBanner)
    {
        // Delete image file
        if ($marketingBanner->image_path) {
            Storage::disk('public')->delete($marketingBanner->image_path);
        }

        $marketingBanner->delete();

        return redirect()->route('admin.marketing-banners.index')
                        ->with('success', 'Marketing banner deleted successfully.');
    }

    public function toggleStatus(MarketingBanner $marketingBanner)
    {
        $marketingBanner->update(['is_active' => !$marketingBanner->is_active]);

        $status = $marketingBanner->is_active ? 'activated' : 'deactivated';
        return redirect()->back()
                        ->with('success', "Marketing banner {$status} successfully.");
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'banners' => 'required|array',
            'banners.*.id' => 'required|exists:marketing_banners,id',
            'banners.*.order' => 'required|integer|min:0'
        ]);

        foreach ($request->banners as $bannerData) {
            MarketingBanner::where('id', $bannerData['id'])
                          ->update(['display_order' => $bannerData['order']]);
        }

        return response()->json(['success' => true]);
    }
}