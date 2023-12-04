<?php 

// app/Models/Payment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'payment_id';
    public $timestamps = false;

    // Các mối quan hệ
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
