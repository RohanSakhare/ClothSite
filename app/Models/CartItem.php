<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductVariant;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'variant_id',
        'user_id',
        'session_id',
        'name',
        'price',
        'size',
        'color',
        'quantity',
        'image',
        'stock',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    public static function ownerQuery()
    {
        if (auth()->check()) {
            return self::where('user_id', auth()->id());
        }
        return self::where('session_id', session()->getId());
    }

    public static function countForCurrentUser()
    {
        return (int) self::ownerQuery()->sum('quantity');
    }
}
