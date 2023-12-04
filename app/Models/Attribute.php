<?php 

// app/Models/Attribute.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attributes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // Các mối quan hệ
    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'attribute_id', 'id');
    }
}
