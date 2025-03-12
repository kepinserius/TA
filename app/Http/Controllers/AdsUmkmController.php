<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ads;
use App\Models\Product;
use App\Models\Umkm;

class AdsUmkmController extends Controller
{
    public function index() {
        $umkm = Umkm::where('user_id', session('user')['id'])->first();
        $data = Ads::with(['product'])->where('umkm_id', $umkm->id)->get();
        return view('umkm.ads', ['data' => $data, 'product' => Product::where('umkm_id', $umkm->id)->get(), 'umkm' => $umkm]);
    }
    
    public function store(Request $request) {
        $umkm = Umkm::where('user_id', session('user')['id'])->first();
        return Ads::insert([
            'product_id' => $request->product_id,
            'umkm_id' => $umkm->id,
            'ad_image' => $this->storeImage($request->image),
            'ad_title' => $request->ad_title,
            'ad_content' => $request->ad_content,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ])
        ? redirect('/umkm/ads')->with('success', 'Berhasil menambahkan data')
        : redirect()->back()->with('error', 'Gagal menambahkan data');
    }

    public function update(Request $request, $id) {
        $getImage = Ads::where('id', $id)->first();
        $umkm = Umkm::where('user_id', session('user')['id'])->first();

        if (!$request->image) {
            return Ads::where('id', $id)->update([
                'product_id' => $request->product_id,
                'umkm_id' => $umkm->id,
                'ad_title' => $request->ad_title,
                'ad_content' => $request->ad_content,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
                ])
            ? redirect('/umkm/ads')->with('success', 'Berhasil mengubah data')
            : redirect()->back()->with('error', 'Gagal mengubah data');
        } else {
            $this->deleteImage($getImage['ad_image']);
            return Ads::where('id', $id)->update([
                'product_id' => $request->product_id,
                'umkm_id' => $umkm->id,
                'ad_image' => $this->storeImage($request->image),
                'ad_title' => $request->ad_title,
                'ad_content' => $request->ad_content,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
                ])
            ? redirect('/umkm/ads')->with('success', 'Berhasil mengubah data')
            : redirect()->back()->with('error', 'Gagal mengubah data');
        }
        
    }

    public function destroy($id) {
        return Ads::where('id', $id)->delete()
        ? redirect('/umkm/ads')->with('success', 'Berhasil menghapus data')
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
