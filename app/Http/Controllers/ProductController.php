<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Umkm;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index() {
        $data = Product::with(['umkm'])->get();
        // dd($data->toArray());
        return view('admin.product', ['data' => $data, 'category' => Category::get(), 'umkm' => Umkm::get()]);
    }

    public function store(Request $request) {
        return Product::insert([
            'umkm_id' => $request->umkm,
            'product_name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'discount' => $request->discount,
            'image' => $this->storeImage($request->image),
            'description' => $request->description
        ])
        ? redirect('/admin/products')->with('success', 'Berhasil menambahkan data')
        : redirect()->back()->with('error', 'Gagal menambahkan data');
    }

    public function update(Request $request, $id) {
        $getImage = Product::where('id', $id)->first();

        if (!$request->image) {
            return Product::where('id', $id)->update([
                
            'umkm_id' => $request->umkm,
            'product_name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'discount' => $request->discount,
            'description' => $request->description
            ])
            ? redirect('/admin/products')->with('success', 'Berhasil mengubah data')
            : redirect()->back()->with('error', 'Gagal mengubah data');
        } else {
            $this->deleteImage($getImage['image']);

            return Product::where('id', $id)->update([
                'product_name' => $request->name,
                'category' => $request->category,
                'price' => $request->price,
                'discount' => $request->discount,
                'image' => $this->storeImage($request->image),
                'description' => $request->description
            ])
            ? redirect('/admin/products')->with('success', 'Berhasil menambahkan data')
            : redirect()->back()->with('error', 'Gagal menambahkan data');
        }
        
    }

    public function destroy($id) {
        $data = Product::where('id', $id)->first();
        $this->deleteImage($data['picture']);
        return $data->delete()
            ? redirect('/admin/products')->with('success', 'Berhasil menghapus data')
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
