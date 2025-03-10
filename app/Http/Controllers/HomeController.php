<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Ads;
use App\Models\Umkm;
class HomeController extends Controller
{
    public function index() {
        // dd(session());
        return view('index', [
            'product' => Product::get(), 
            'category' => Category::get(), 
            'ads' => Ads::with(['product'])->get(),
            'umkm' => Umkm::where('user_id', session('user')['id'])->first()
        ]);
    }
}
