<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function index()
    {
        return view('cart', ['data' => Cart::get()]);
    }
}
