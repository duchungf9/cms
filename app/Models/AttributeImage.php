<?php

// app/Models/AttributeImage.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeImage extends Model
{
    protected $table = 'attribute_images';
    protected $primaryKey = 'image_id';
    public $timestamps = false;

    // Các mối quan hệ
    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class, 'attribute_id', 'attribute_id');
    }
}
