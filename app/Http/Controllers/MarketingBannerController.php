<?php

namespace App\Http\Controllers;

use App\Models\MarketingBanner;
use Illuminate\Http\Request;

class MarketingBannerController extends Controller
{
    public function getActiveBanners(Request $request)
    {
        $audience = auth()->check() ? 'users' : 'guests';
        
        $banners = MarketingBanner::currentlyActive()
            ->forAudience($audience)
            ->ordered()
            ->get();

        return response()->json($banners);
    }

    public function getBannerForUser()
    {
        $audience = auth()->check() ? 'users' : 'guests';
        
        $banner = MarketingBanner::currentlyActive()
            ->forAudience($audience)
            ->ordered()
            ->first();

        if (!$banner) {
            return response()->json(null);
        }

        return response()->json([
            'id' => $banner->id,
            'title' => $banner->title,
            'description' => $banner->description,
            'image_url' => $banner->image_url,
            'welcome_message' => $banner->welcome_message,
            'button_text' => $banner->button_text,
            'button_url' => $banner->button_url,
        ]);
    }
}