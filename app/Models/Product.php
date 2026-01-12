<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name',
        'sku',
        'description',
        'price',
        'stock',
        'image',
        'is_active',
        'category',
        'rating',
        'review_count',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'rating' => 'decimal:2',
    ];

    protected $dates = ['deleted_at'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    // Scope untuk produk aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk filter berdasarkan kategori
    public function scopeByCategory($query, $category)
    {
        if ($category) {
            return $query->where('category', $category);
        }
        return $query;
    }

    // Scope untuk filter berdasarkan rating
    public function scopeByRating($query, $minRating)
    {
        if ($minRating) {
            return $query->where('rating', '>=', $minRating);
        }
        return $query;
    }

    // Scope untuk filter berdasarkan harga
    public function scopeByPriceRange($query, $minPrice, $maxPrice)
    {
        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }
        return $query;
    }

    // Scope untuk search
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }
        return $query;
    }

    // Accessor untuk gambar dengan fallback
    public function getImageUrlAttribute()
    {
        if ($this->image && \Storage::disk('public')->exists($this->image)) {
            return asset('storage/' . $this->image);
        }
        return "https://source.unsplash.com/400x300/?camping,{$this->category}";
    }

    // Accessor untuk status stock
    public function getStockStatusAttribute()
    {
        if ($this->stock <= 0) {
            return 'out_of_stock';
        } elseif ($this->stock <= 5) {
            return 'low_stock';
        }
        return 'in_stock';
    }

    // Mutator untuk SKU (auto uppercase)
    public function setSkuAttribute($value)
    {
        $this->attributes['sku'] = strtoupper($value);
    }

    // Update rating berdasarkan reviews
    public function updateRating()
    {
        $avgRating = $this->reviews()->avg('rating') ?? 0;
        $reviewCount = $this->reviews()->count();
        
        $this->update([
            'rating' => round($avgRating, 2),
            'review_count' => $reviewCount,
        ]);
    }

    // Check if product is available for purchase
    public function isAvailable($quantity = 1)
    {
        return $this->is_active && $this->stock >= $quantity;
    }
}
