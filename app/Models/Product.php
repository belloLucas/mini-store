<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
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
