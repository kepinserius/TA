<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Umkm;

class ProdukController extends Controller
{
    /**
     * Menampilkan daftar produk.
     */
    public function index($id)
    {
        $data = Product::with(['umkm'])->where('id', $id)->first();
        if (session()->has('user')) {
            return view('produkdetail', [
                'data' => $data,
                'umkm' => Umkm::where('user_id', session('user')['id'])->first()
            ]);
        } else {
            return view('produkdetail', [
                'data' => $data,
            ]);
        }
    }
    

    /**
     * Menampilkan halaman detail produk berdasarkan ID.
     */
    public function show($id)
    {
        
    }
}
