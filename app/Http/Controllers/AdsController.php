<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdsController extends Controller
{
    public function index() {
        $data = Ads::with(['product'])->get();
        return view('admin.ads', ['data' => $data, 'product' => Product::get()]);
    }

    public function store(Request $request) {
        return Ads::insert([
            'product_id' => $request->product_id,
            'ad_image' => $this->storeImage($request->image),
            'ad_title' => $request->ad_title,
            'ad_content' => $request->ad_content,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
            ])
        ? redirect('/admin/ads')->with('success', 'Berhasil menambahkan data')
        : redirect()->back()->with('error', 'Gagal menambahkan data');
    }

    public function update(Request $request, $id) {
        $getImage = Ads::where('id', $id)->first();

        if (!$request->image) {
            return Ads::where('id', $id)->update([
                'ad_title' => $request->ad_title,
                'ad_content' => $request->ad_content,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
                ])
            ? redirect('/admin/ads')->with('success', 'Berhasil mengubah data')
            : redirect()->back()->with('error', 'Gagal mengubah data');
        } else {
            $this->deleteImage($getImage['ad_image']);
            return Ads::where('id', $id)->update([
                'ad_image' => $this->storeImage($request->image),
                'ad_title' => $request->ad_title,
                'ad_content' => $request->ad_content,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
                ])
            ? redirect('/admin/ads')->with('success', 'Berhasil mengubah data')
            : redirect()->back()->with('error', 'Gagal mengubah data');
        }
        
    }

    public function destroy($id) {
        return Ads::where('id', $id)->delete()
        ? redirect('/admin/ads')->with('success', 'Berhasil menghapus data')
        : redirect()->back()->with('error', 'Gagal menghapus data');
    }

    public function deleteImage($name)
    {
        File::delete('uploads/ads/' . $name);
    }

    public function storeImage($file)
    {
        $image = time() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads/ads/', $image);
        return $image;
    }
}
