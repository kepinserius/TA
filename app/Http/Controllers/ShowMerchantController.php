<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Umkm;

class ShowMerchantController extends Controller
{
    //
    public function index($id) {
        $umkm = Umkm::where('id', $id)->first();
        $product = Product::with(['umkm'])->where('umkm_id', $id)->get();
        return view('showMerchant', ['umkm' => $umkm, 'product' => $product]);
    }
}
