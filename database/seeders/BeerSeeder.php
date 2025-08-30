<?php

namespace Database\Seeders;

use App\Models\Beer;
use Illuminate\Database\Seeder;

class BeerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Beer::create([
            'name' => 'Golden Lager',
            'category' => 'Lager',
            'image' => 'beers/lager.png',
            'stock' => 120,
            'price' => 3.50,
            'description' => 'A crisp and refreshing lager with a smooth finish.',
            'alcohol_percentage' => 5.0,
            'origin' => 'Germany',
        ]);

        Beer::create([
            'name' => 'Hoppy IPA',
            'category' => 'IPA',
            'image' => 'beers/ipa.png',
            'stock' => 85,
            'price' => 4.20,
            'description' => 'Bold and bitter with citrus and pine notes.',
            'alcohol_percentage' => 6.5,
            'origin' => 'USA',
        ]);
    }
}
