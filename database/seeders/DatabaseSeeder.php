<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call([
            UserSeeder::class,
            UiUxTestDataSeeder::class,
        ]);

        $cat1 = \App\Models\Category::create(['name' => 'Gaun Pesta', 'slug' => 'gaun-pesta']);
        $cat2 = \App\Models\Category::create(['name' => 'Blouse Sutra', 'slug' => 'blouse-sutra']);
        $cat3 = \App\Models\Category::create(['name' => 'Outerwear', 'slug' => 'outerwear']);

        $p1 = \App\Models\Product::create([
            'category_id' => $cat1->id,
            'name' => 'Rosé Silk Gala Gown',
            'slug' => 'rose-silk-gala-gown',
            'description' => 'Gaun pesta elegan berbahan sutra asli dengan potongan menawan.',
            'price' => 2499000,
            'is_new' => true,
        ]);
        
        $p2 = \App\Models\Product::create([
            'category_id' => $cat3->id,
            'name' => 'Alabaster Tailored Blazer',
            'slug' => 'alabaster-tailored-blazer',
            'description' => 'Blazer putih elegan dengan jahitan presisi untuk tampilan profesional yang mewah.',
            'price' => 1850000,
            'is_new' => true,
        ]);

        \App\Models\ProductVariant::create(['product_id' => $p1->id, 'size' => 'S', 'color' => 'Pink', 'stock' => 5]);
        \App\Models\ProductVariant::create(['product_id' => $p1->id, 'size' => 'M', 'color' => 'Pink', 'stock' => 3]);
        
        \App\Models\ProductVariant::create(['product_id' => $p2->id, 'size' => 'S', 'color' => 'White', 'stock' => 10]);
        \App\Models\ProductVariant::create(['product_id' => $p2->id, 'size' => 'M', 'color' => 'White', 'stock' => 8]);
    }
}

