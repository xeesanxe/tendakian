<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create or get sample user
            // create sample user and admin
            $user = User::firstOrCreate(
                ['email' => 'user@example.com'],
                [
                    'name' => 'Sample User',
                    'password' => bcrypt('password'),
                    'is_admin' => false,
                ]
            );

            $admin = User::firstOrCreate(
                ['email' => 'admin@tendakian.test'],
                [
                    'name' => 'Admin',
                    'password' => bcrypt('secret'),
                    'is_admin' => true,
                ]
            );

        // Create products
        $products = \App\Models\Product::factory()->count(10)->create();

        // Assign sample images to created products (if sample images exist in storage/app/public/products)
        $sampleImages = [
            'products/tent.jpg',
            'products/backpack.jpg',
            'products/stove.jpg',
            'products/sleepingbag.jpg',
            'products/boots.jpg',
            'products/lantern.jpg',
        ];
        $i = 0;
        foreach($products as $p){
            $p->image = $sampleImages[$i % count($sampleImages)];
            $p->save();
            $i++;
        }

        // Create orders with items for the sample user
        \App\Models\Order::factory()->count(3)->create([
            'user_id' => $user->id,
        ])->each(function($order){
            $items = \App\Models\Product::inRandomOrder()->limit(3)->get();
            $total = 0;
            foreach($items as $p){
                $qty = rand(1,3);
                $price = $p->price;
                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $p->id,
                    'quantity' => $qty,
                    'price' => $price,
                    'total' => $price * $qty,
                ]);
                $total += $price * $qty;
            }
            $order->update(['total' => $total]);
        });
    }
}
