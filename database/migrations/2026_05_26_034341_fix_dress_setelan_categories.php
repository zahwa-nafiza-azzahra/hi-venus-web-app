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
        // 1. Ensure "Setelan" exists
        $setelanExists = DB::table('categories')->where('name', 'Setelan')->exists();
        if (!$setelanExists) {
            DB::table('categories')->insert([
                'name' => 'Setelan',
                'slug' => Str::slug('Setelan'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // 2. Ensure "Dress Cantik" exists (should already exist)
        $dressCantik = DB::table('categories')->where('name', 'Dress Cantik')->first();
        if (!$dressCantik) {
            $id = DB::table('categories')->insertGetId([
                'name' => 'Dress Cantik',
                'slug' => Str::slug('Dress Cantik'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $dressCantikId = $id;
        } else {
            $dressCantikId = $dressCantik->id;
        }

        // 3. Move products from "Dress & Setelan" to "Dress Cantik" and delete "Dress & Setelan"
        $oldCat = DB::table('categories')->where('name', 'Dress & Setelan')->first();
        if ($oldCat) {
            DB::table('products')->where('category_id', $oldCat->id)->update(['category_id' => $dressCantikId]);
            DB::table('categories')->where('id', $oldCat->id)->delete();
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
