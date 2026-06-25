<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedInteger('total_sold')->default(0)->after('is_visible');
        });

        // Hitung ulang total_sold dari order items yang sudah completed
        DB::statement("
            UPDATE products p
            SET total_sold = (
                SELECT COALESCE(SUM(oi.quantity), 0)
                FROM order_items oi
                JOIN orders o ON oi.order_id = o.id
                WHERE oi.product_id = p.id
                AND o.status = 'completed'
            )
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('total_sold');
        });
    }
};
