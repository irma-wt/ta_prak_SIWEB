<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'product_id';
    public $timestamps    = false;

    protected $fillable = [
        'product_id',
        'category_id',
        'brand_id',
        'product_name',
        'product_price',
        'product_stock',
    ];

    // Relasi: Product belongsTo Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    // Relasi: Product belongsTo Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }
}