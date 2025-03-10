<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Umkm;
use App\Models\Category;

class UmkmProductController extends Controller
{
    public function index() {
        $umkm = Umkm::where('id', session('user')['id'])->first();
        $data = Product::with(['umkm'])->where('umkm_id', $umkm->id)->get();
        // dd($data->toArray());
        return view('umkm.product', ['data' => $data, 'category' => Category::get(), 'umkm' => $umkm]);
    }

    public function store(Request $request) {
        $umkm = Umkm::where('id', session('user')['id'])->first();
        return Product::insert([
            'umkm_id' => $umkm->id,
            'product_name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'discount' => $request->discount,
            'image' => $this->storeImage($request->image),
            'description' => $request->description
        ])
        ? redirect('/umkm/product')->with('success', 'Berhasil menambahkan data')
        : redirect()->back()->with('error', 'Gagal menambahkan data');
    }

    public function deleteImage($name)
    {
        File::delete('uploads/products/' . $name);
    }

    public function storeImage($file)
    {
        $image = time() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads/products/', $image);
        return $image;
    }
}
