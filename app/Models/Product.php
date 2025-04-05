<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'product_category_id',
        'description',
        'price',
        'image_url',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
