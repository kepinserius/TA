<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProdukController extends Controller
{
    /**
     * Menampilkan daftar produk.
     */
    public function index($id)
    {
        $data = Product::where('id', $id)->first();
        return view('produkdetail', ['data' => $data]);
    }

    /**
     * Menampilkan halaman detail produk berdasarkan ID.
     */
    public function show($id)
    {
        
    }
}
