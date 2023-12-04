<?php 
// app/Models/ShipmentDetail.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentDetail extends Model
{
    protected $table = 'shipment_details';
    protected $primaryKey = 'shipment_detail_id';
    public $timestamps = false;

    // Các mối quan hệ
    public function shipment()
    {
        return $this->belongsTo(Shipment::class, 'shipment_id', 'shipment_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
