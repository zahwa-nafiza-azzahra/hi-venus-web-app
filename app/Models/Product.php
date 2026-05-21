<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'slug', 'description', 'price', 'image', 'images', 'is_new', 'sku', 'is_featured', 'is_visible'];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_visible' => 'boolean',
        'images' => 'array',
    ];

    /**
     * Get the product's image URL.
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) return null;
        
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        
        return asset('storage/' . $this->image);
    }

    /**
     * Get all slide URLs (including primary and additional images).
     */
    public function getSlideUrlsAttribute()
    {
        $urls = [];
        
        if ($this->image) {
            $urls[] = $this->image_url;
        }
        
        $additional = is_array($this->images) ? $this->images : [];
        foreach ($additional as $img) {
            if ($img) {
                if (str_starts_with($img, 'http')) {
                    $urls[] = $img;
                } else {
                    $urls[] = asset('storage/' . $img);
                }
            }
        }
        
        return $urls;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
