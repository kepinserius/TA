<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Ads;
use App\Models\Umkm;
use App\Models\ProfileUser;

class HomeController extends Controller
{
    public function index() {
        if (session()->has('user')) {
            return view('index', [
                'product' => Product::where('status', true)->get(), 
                'category' => Category::get(), 
                'ads' => Ads::with(['product'])->get(),
                'user' => ProfileUser::where('user_id', session('user')['id'])->first(),
                'umkm' => Umkm::where('user_id', session('user')['id'])->first()
            ]);
        } else {
            return view('index', [
                'product' => Product::where('status', true)->get(), 
                'category' => Category::get(), 
                'ads' => Ads::with(['product'])->get(),
            ]);
        }
    }
}
