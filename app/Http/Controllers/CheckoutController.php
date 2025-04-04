<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItems;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $arrayFilters = array_filter($request->check);

        $array = [];

        foreach ($arrayFilters as $key => $value) {
            $array[] = ['data' => CartItems::with(['product'])->where('id', $arrayFilters[$key])->first()];
        }
        dd($array[0]['data']->product->umkm);
        return view('checkout');
}

}
