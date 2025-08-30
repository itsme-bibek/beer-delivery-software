<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\Beer;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $beer = Beer::first();

        if ($user && $beer) {
            $groupCode = 'ORD-' . Str::random(8);
            
            // Create multiple orders in the same group
            Order::create([
                'user_id' => $user->id,
                'beer_id' => $beer->id,
                'quantity' => 3,
                'total_price' => $beer->price * 3,
                'status' => 'Processing',
                'image' => 'default-beer-image.jpg',
                'group_code' => $groupCode,
                'payment_method' => 'cod',
            ]);

            // Create another order in the same group
            Order::create([
                'user_id' => $user->id,
                'beer_id' => $beer->id,
                'quantity' => 2,
                'total_price' => $beer->price * 2,
                'status' => 'Processing',
                'image' => 'default-beer-image.jpg',
                'group_code' => $groupCode,
                'payment_method' => 'cod',
            ]);

            // Create a separate order group
            $groupCode2 = 'ORD-' . Str::random(8);
            Order::create([
                'user_id' => $user->id,
                'beer_id' => $beer->id,
                'quantity' => 1,
                'total_price' => $beer->price,
                'status' => 'Pending',
                'image' => 'default-beer-image.jpg',
                'group_code' => $groupCode2,
                'payment_method' => 'card',
            ]);
        }
    }
}
