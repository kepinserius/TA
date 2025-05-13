<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'xendit_user_id',
        'umkm_name',
        'umkm_email',
        'description',
        'address',
        'contact'
    ];

    protected $table = 'umkms';

    public function products() {
        return $this->belongsTo(Product::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public $timestamps = true;
}
