<?php 
// app/Models/Size.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';
    protected $primaryKey = 'size_id';
    public $timestamps = false;
    
    // Các mối quan hệ
    public function products()
    {
        return $this->hasMany(Product::class, 'size_id', 'size_id');
    }
}
