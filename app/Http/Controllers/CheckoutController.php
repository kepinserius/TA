<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout'); // Pastikan ada file resources/views/cart.blade.php
    }
}
