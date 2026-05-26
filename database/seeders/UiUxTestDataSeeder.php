<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UiUxTestDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Test User
        $user = User::updateOrCreate(
            ['email' => 'tester@hi-venus.test'],
            [
                'name' => 'Venus Tester ✨',
                'password' => Hash::make('password'),
                'role' => User::ROLE_USER,
                'phone' => '081234567890',
            ]
        );

        // 2. Create Categories
        $categories = [
            ['name' => 'Atasan Lucu', 'slug' => 'atasan-lucu'],
            ['name' => 'Bawahan Gemas', 'slug' => 'bawahan-gemas'],
            ['name' => 'Dress Cantik', 'slug' => 'dress-cantik'],
            ['name' => 'Setelan', 'slug' => 'setelan'],
            ['name' => 'Aksesoris Sparkle', 'slug' => 'aksesoris-sparkle'],
            ['name' => 'Tas', 'slug' => 'tas'],
            ['name' => 'Dompet', 'slug' => 'dompet'],
            ['name' => 'Sepatu', 'slug' => 'sepatu'],
        ];

        foreach ($categories as $catData) {
            Category::updateOrCreate(['slug' => $catData['slug']], $catData);
        }

        $allCats = Category::all();

        // 3. Create Products
        $productData = [
            // Atasan
            ['name' => 'Strawberry Milk Tee', 'price' => 125000, 'category_id' => $allCats[0]->id, 'description' => 'Kaos super lembut dengan print susu stroberi yang menggemaskan.'],
            ['name' => 'Sweet Bow Blouse', 'price' => 245000, 'category_id' => $allCats[0]->id, 'description' => 'Blouse elegan dengan aksen pita besar di bagian depan.'],
            ['name' => 'Starry Night Sweater', 'price' => 385000, 'category_id' => $allCats[0]->id, 'description' => 'Sweater rajut tebal dengan pola bintang-bintang yang berkilau.'],
            
            // Bawahan
            ['name' => 'Pink Plaid Skirt', 'price' => 195000, 'category_id' => $allCats[1]->id, 'description' => 'Rok mini motif kotak-kotak pink yang sangat trendy.'],
            ['name' => 'Cloudy Denim Shorts', 'price' => 215000, 'category_id' => $allCats[1]->id, 'description' => 'Celana pendek denim dengan bordir awan putih yang lucu.'],
            
            // Dress
            ['name' => 'Pastel Ruffle Dress', 'price' => 455000, 'category_id' => $allCats[2]->id, 'description' => 'Gaun pesta dengan banyak ruffle lembut berwarna pastel.'],
            ['name' => 'Floral Spring Sundress', 'price' => 325000, 'category_id' => $allCats[2]->id, 'description' => 'Gaun musim semi yang ringan dengan motif bunga kecil.'],
            
            // Aksesoris
            ['name' => 'Star Hair Clips', 'price' => 15000, 'category_id' => $allCats[3]->id, 'description' => 'Jepit rambut berbentuk bintang berwarna kuning cerah.'],
            ['name' => 'Bunny Ears Beanie', 'price' => 85000, 'category_id' => $allCats[3]->id, 'description' => 'Topi rajut dengan telinga kelinci yang bisa berdiri.'],
            ['name' => 'Heart Buckle Belt', 'price' => 65000, 'category_id' => $allCats[3]->id, 'description' => 'Ikat pinggang pink dengan gesper berbentuk hati.'],
            
            // Tas, Dompet, Sepatu
            ['name' => 'Berry Sweet Backpack', 'price' => 275000, 'category_id' => $allCats[4]->id, 'description' => 'Tas ransel kecil berbentuk buah stroberi.'],
            ['name' => 'Cloud Platform Shoes', 'price' => 650000, 'category_id' => $allCats[6]->id, 'description' => 'Sepatu platform putih yang membuatmu merasa berjalan di awan.'],
            ['name' => 'Sparkle Glitter Flats', 'price' => 315000, 'category_id' => $allCats[6]->id, 'description' => 'Sepatu flat penuh glitter untuk hari-harimu yang bersinar.'],
        ];

        foreach ($productData as $pData) {
            $pData['slug'] = Str::slug($pData['name']);
            $product = Product::updateOrCreate(['slug' => $pData['slug']], $pData);

            // Create Variants for each product
            $sizes = ['S', 'M', 'L', 'All Size'];
            $colors = ['Pink', 'White', 'Blue', 'Yellow'];
            
            for ($i = 0; $i < rand(2, 4); $i++) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'size' => $sizes[array_rand($sizes)],
                    'color' => $colors[array_rand($colors)],
                    'stock' => rand(10, 50),
                ]);
            }
        }

        $allProducts = Product::all();

        // 4. Create Orders for the Test User
        $statuses = ['pending', 'paid', 'completed', 'cancelled'];
        
        for ($j = 1; $j <= 10; $j++) {
            $status = $statuses[($j-1) % 4];
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'HV-' . strtoupper(Str::random(8)),
                'status' => $status,
                'total_amount' => 0, // Will update after items
                'notes' => 'Catatan untuk pesanan HV-' . $j,
                'created_at' => now()->subDays(rand(1, 30)),
            ]);

            $totalAmount = 0;
            $itemCount = rand(1, 3);
            $selectedProducts = $allProducts->random($itemCount);

            foreach ($selectedProducts as $prod) {
                $qty = rand(1, 2);
                $subtotal = $prod->price * $qty;
                $totalAmount += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $prod->id,
                    'quantity' => $qty,
                    'price' => $prod->price,
                ]);
            }

            $order->update(['total_amount' => $totalAmount]);
        }
    }
}
