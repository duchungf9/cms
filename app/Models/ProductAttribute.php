<?php

// app/Models/ProductAttribute.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $table = 'product_attributes';
    protected $primaryKey = 'attribute_id';
    public $timestamps = false;

    // Các mối quan hệ
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function attributeImages()
    {
        return $this->hasMany(AttributeImage::class, 'attribute_id', 'attribute_id');
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id', 'id');
    }
}
