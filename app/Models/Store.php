<?php 
// app/Models/Store.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'stores';
    protected $primaryKey = 'store_id';
    public $timestamps = false;

    // Các mối quan hệ
    public function products()
    {
        return $this->hasMany(Product::class, 'store_id', 'store_id');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'store_id', 'store_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'store_id', 'store_id');
    }
}
