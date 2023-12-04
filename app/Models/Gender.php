<?php 
// app/Models/Gender.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table = 'genders';
    protected $primaryKey = 'gender_id';
    public $timestamps = false;
    
    // Các mối quan hệ
    public function products()
    {
        return $this->hasMany(Product::class, 'gender_id', 'gender_id');
    }
}
