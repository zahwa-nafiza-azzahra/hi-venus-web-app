<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Extend status enum to include processing and shipped
        DB::statement("ALTER TABLE orders MODIFY status ENUM('pending','paid','processing','shipped','completed','cancelled') DEFAULT 'pending'");

        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_address')->nullable()->after('notes');
            $table->string('recipient_name')->nullable()->after('shipping_address');
            $table->string('recipient_phone')->nullable()->after('recipient_name');
            $table->text('cashier_note')->nullable()->after('recipient_phone');
            $table->string('tracking_number')->nullable()->after('cashier_note');
            $table->timestamp('confirmed_at')->nullable()->after('tracking_number');
            $table->timestamp('processed_at')->nullable()->after('confirmed_at');
            $table->timestamp('shipped_at')->nullable()->after('processed_at');
            $table->timestamp('completed_at')->nullable()->after('shipped_at');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'shipping_address', 'recipient_name', 'recipient_phone',
                'cashier_note', 'tracking_number', 'confirmed_at',
                'processed_at', 'shipped_at', 'completed_at'
            ]);
        });
        DB::statement("ALTER TABLE orders MODIFY status ENUM('pending','paid','completed','cancelled') DEFAULT 'pending'");
    }
};
