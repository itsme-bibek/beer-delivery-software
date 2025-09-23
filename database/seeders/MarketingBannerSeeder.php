<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MarketingBanner;
use Carbon\Carbon;

class MarketingBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample marketing banners
        MarketingBanner::create([
            'title' => 'Welcome to Peaksip!',
            'description' => 'Discover our premium collection of craft beers from around the world. From refreshing lagers to rich stouts, we have something for every beer lover.',
            'image_path' => 'marketing-banners/welcome-banner.jpg',
            'welcome_message' => 'Welcome to our beer paradise!',
            'button_text' => 'Explore Our Collection',
            'button_url' => '/buybeer',
            'is_active' => true,
            'display_order' => 1,
            'start_date' => null,
            'end_date' => null,
            'target_audience' => ['all']
        ]);

        MarketingBanner::create([
            'title' => 'New Arrivals This Week',
            'description' => 'Check out our latest additions to the collection. Fresh brews from local and international breweries are now available.',
            'image_path' => 'marketing-banners/new-arrivals.jpg',
            'welcome_message' => 'Fresh brews just arrived!',
            'button_text' => 'Shop New Beers',
            'button_url' => '/buybeer',
            'is_active' => true,
            'display_order' => 2,
            'start_date' => Carbon::now()->startOfWeek(),
            'end_date' => Carbon::now()->endOfWeek(),
            'target_audience' => ['users']
        ]);

        MarketingBanner::create([
            'title' => 'Seasonal Specials',
            'description' => 'Limited time seasonal beers perfect for the current weather. Don\'t miss out on these exclusive flavors.',
            'image_path' => 'marketing-banners/seasonal-specials.jpg',
            'welcome_message' => 'Seasonal favorites are here!',
            'button_text' => 'View Seasonal Collection',
            'button_url' => '/buybeer',
            'is_active' => true,
            'display_order' => 3,
            'start_date' => null,
            'end_date' => Carbon::now()->addMonths(2),
            'target_audience' => ['all']
        ]);

        MarketingBanner::create([
            'title' => 'Premium Craft Collection',
            'description' => 'Indulge in our handpicked selection of premium craft beers. Each bottle tells a story of passion and craftsmanship.',
            'image_path' => 'marketing-banners/premium-craft.jpg',
            'welcome_message' => 'Premium quality awaits!',
            'button_text' => 'Explore Premium Beers',
            'button_url' => '/buybeer',
            'is_active' => true,
            'display_order' => 4,
            'start_date' => null,
            'end_date' => null,
            'target_audience' => ['users']
        ]);

        // Create a banner for guests (non-authenticated users)
        MarketingBanner::create([
            'title' => 'Join Our Beer Community',
            'description' => 'Sign up today and get access to exclusive deals, new releases, and personalized recommendations.',
            'image_path' => 'marketing-banners/join-community.jpg',
            'welcome_message' => 'Welcome to our community!',
            'button_text' => 'Sign Up Now',
            'button_url' => '/register',
            'is_active' => true,
            'display_order' => 5,
            'start_date' => null,
            'end_date' => null,
            'target_audience' => ['guests']
        ]);
    }
}