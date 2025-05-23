<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    protected $table = 'cart_items';

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
