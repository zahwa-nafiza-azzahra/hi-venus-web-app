<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $products = \App\Models\Product::inRandomOrder()->take(8)->get();
        if ($products->isEmpty()) return;

        $user = \App\Models\User::first() ?? \App\Models\User::factory()->create();

        $order = \App\Models\Order::firstOrCreate(
            ['order_number' => 'DUMMY-RENDER-123'], 
            ['user_id' => $user->id, 'total_amount' => 0, 'status' => 'completed', 'payment_method' => 'Bank Transfer', 'shipping_method' => 'jnt', 'shipping_address' => 'Dummy Address']
        );

        foreach($products as $p) {
            \App\Models\OrderItem::firstOrCreate(
                ['order_id' => $order->id, 'product_id' => $p->id],
                ['quantity' => rand(16, 50), 'price' => $p->price]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
