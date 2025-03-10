<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $table = 'ads';

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
