<?php
// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = ['*'];
    public $timestamps = false;

    // Các mối quan hệ
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'store_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function sizes()
    {
        return $this->belongsTo(Size::class, 'size_id', 'size_id');
    }

    public function colors()
    {
        return $this->belongsTo(Color::class, 'color_id', 'color_id');
    }

    public function genders()
    {
        return $this->belongsTo(Gender::class, 'gender_id', 'gender_id');
    }

    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id', 'id');
    }

}

