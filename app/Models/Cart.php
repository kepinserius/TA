<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = ['user_id', 'total'];

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function items() {
        return $this->hasMany(CartItems::class);
    }
} 
