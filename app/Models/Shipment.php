<?php

// app/Models/Shipment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $table = 'shipments';
    protected $primaryKey = 'shipment_id';
    public $timestamps = false;

    // Các mối quan hệ
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function shipmentDetails()
    {
        return $this->hasMany(ShipmentDetail::class, 'shipment_id', 'shipment_id');
    }
}
