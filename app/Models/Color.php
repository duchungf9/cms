<?php 
// app/Models/Color.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';
    protected $primaryKey = 'color_id';
    public $timestamps = false;
    
    // Các mối quan hệ
    public function products()
    {
        return $this->hasMany(Product::class, 'color_id', 'color_id');
    }
}
