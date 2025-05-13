<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderSplits extends Model
{
    protected $table = 'order_splits';

    public function payments() {
        return $this->hasMany(Payments::class);
    }
}
