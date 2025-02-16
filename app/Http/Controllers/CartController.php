<?php

namespace App\Http\Controllers;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function index()
    {
        return view('cart');
    }
}
