<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = ['product_id', 'size', 'color', 'color_hex', 'stock', 'sku'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getColorHexAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }

        $colorMap = [
            'pink' => '#ff85d0',
            'blue' => '#38bbef',
            'yellow' => '#fdd73b',
            'white' => '#ffffff',
            'black' => '#000000',
            'red' => '#ef4444',
            'green' => '#22c55e',
            'purple' => '#a855f7',
            'orange' => '#f97316',
            'brown' => '#a16207',
            'grey' => '#6b7280',
            'gray' => '#6b7280',
        ];

        $colorKey = strtolower($this->attributes['color'] ?? '');
        return $colorMap[$colorKey] ?? null;
    }
}
