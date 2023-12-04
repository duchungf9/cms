<?php
// app/Models/ProductImage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $primaryKey = 'image_id';
    public $timestamps = false;
    protected $fillable = ['*'];
    // Các mối quan hệ
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
