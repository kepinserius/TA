<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Menampilkan daftar produk.
     */
    public function index()
    {
        return view('produkdetail');
    }

    /**
     * Menampilkan halaman detail produk berdasarkan ID.
     */
    public function show($id)
    {
        return view('produk-detail');
    }
}
