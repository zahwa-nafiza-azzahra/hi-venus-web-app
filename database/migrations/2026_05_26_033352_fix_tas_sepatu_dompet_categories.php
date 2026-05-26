<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Ensure "Tas", "Dompet", "Sepatu" exist
        $catsToEnsure = ['Tas', 'Dompet', 'Sepatu'];
        foreach ($catsToEnsure as $catName) {
            $exists = DB::table('categories')->where('name', $catName)->exists();
            if (!$exists) {
                DB::table('categories')->insert([
                    'name' => $catName,
                    'slug' => Str::slug($catName),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        $tasId = DB::table('categories')->where('name', 'Tas')->value('id');
        $dompetId = DB::table('categories')->where('name', 'Dompet')->value('id');
        $sepatuId = DB::table('categories')->where('name', 'Sepatu')->value('id');

        // 2. Reassign products from old categories to appropriate new ones
        $oldCat1 = DB::table('categories')->where('name', 'Tas & Sepatu')->first();
        if ($oldCat1) {
            DB::table('products')->where('category_id', $oldCat1->id)->update(['category_id' => $tasId]);
            DB::table('categories')->where('id', $oldCat1->id)->delete();
        }

        $oldCat2 = DB::table('categories')->where('name', 'Tas & Dompet')->first();
        if ($oldCat2) {
            DB::table('products')->where('category_id', $oldCat2->id)->update(['category_id' => $tasId]);
            DB::table('categories')->where('id', $oldCat2->id)->delete();
        }

        $oldCat3 = DB::table('categories')->where('name', 'Sepatu Cantik')->first();
        if ($oldCat3) {
            DB::table('products')->where('category_id', $oldCat3->id)->update(['category_id' => $sepatuId]);
            DB::table('categories')->where('id', $oldCat3->id)->delete();
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
