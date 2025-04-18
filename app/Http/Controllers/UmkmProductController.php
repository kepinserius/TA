<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Umkm;
use App\Models\Category;

class UmkmProductController extends Controller
{
    public function index() {
        $umkm = Umkm::where('user_id', session('user')['id'])->first();
        $data = Product::with(['umkm'])->where('umkm_id', $umkm->id)->get();
        return view('umkm.product', ['data' => $data, 'category' => Category::get(), 'umkm' => $umkm]);
    }

    public function store(Request $request) {
        $umkm = Umkm::where('user_id', session('user')['id'])->first();
        return Product::insert([
            'umkm_id' => $umkm->id,
            'product_name' => $request->name,
            'category' => $request->category,
            'stock' => $request->stock,
            'price' => $request->price,
            'discount' => $request->discount,
            'image' => $this->storeImage($request->image),
            'description' => $request->description
        ])
        ? redirect('/umkm/product')->with('success', 'Berhasil menambahkan data')
        : redirect()->back()->with('error', 'Gagal menambahkan data');
    }

    public function update(Request $request, $id) {
        $getImage = Product::where('id', $id)->first();
        $umkm = Umkm::where('user_id', session('user')['id'])->first();
        if (!$request->image) {
            return Product::where('id', $id)->update([
            'umkm_id' => $umkm->id,
            'product_name' => $request->name,
            'category' => $request->category,
            'stock' => $request->stock,
            'price' => $request->price,
            'discount' => $request->discount,
            'description' => $request->description,
            'status' => $request->status
            ])
            ? redirect('/umkm/product')->with('success', 'Berhasil mengubah data')
            : redirect()->back()->with('error', 'Gagal mengubah data');
        } else {
            $this->deleteImage($getImage['image']);

            return Product::where('id', $id)->update([
            'umkm_id' => $umkm->id,
            'product_name' => $request->name,
            'category' => $request->category,
            'stock' => $request->stock,
            'price' => $request->price,
            'discount' => $request->discount,
            'image' => $this->storeImage($request->image),
            'description' => $request->description,
            'status' => $request->status
            ])
            ? redirect('/umkm/product')->with('success', 'Berhasil menambahkan data')
            : redirect()->back()->with('error', 'Gagal menambahkan data');
        }
        
    }

    public function destroy($id) {
        $data = Product::where('id', $id)->first();
        $this->deleteImage($data['image']);
        return $data->delete()
            ? redirect('/umkm/product')->with('success', 'Berhasil menghapus data')
            : redirect()->back()->with('error', 'Gagal menghapus data');
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
