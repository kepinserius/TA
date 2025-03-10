<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'umkm_id',
        'product_name',
        'category',
        'price',
        'image',
        'description'
    ];

    protected $table = 'products';

    public function umkm() {
        return $this->belongsTo(Umkm::class);
    }

    public $timestamps = true;
}
