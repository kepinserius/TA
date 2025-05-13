<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\orderItems;
use App\Models\orderSplits;

class Order extends Model
{
    //
    protected $table = 'orders';

    protected $fillable = [
        'parent_id',
        'merchant_id',
        'user_id',
        'splits_id',
        'xendit_reference_id',
        'total',
        'service_fee',
        'shipping_cost',
        'address',
        'payment_method',
        'status'
    ];

    public function orderItems() {
        return $this->hasMany(orderItems::class);
    }

    public function children() {
        return $this->hasMany(Order::class, 'parent_id');
    }

    public function merchants() {
        return $this->belongsTo(Umkm::class, 'merchant_id');
    }
}
