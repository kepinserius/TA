<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Umkm;

class UmkmProfileController extends Controller
{
    public function index() {
        return view('umkm.Profile', ['data' => Umkm::with(['user'])->where('user_id', session('user')['id'])->first()]);
    }
    
    public function showEdit() {
        return view('umkm.edit-profile', ['data' => Umkm::with(['user'])->where('user_id', session('user')['id'])->first()]);
    }

    public function update(Request $request, $id) {
        $getImage = Umkm::where('id', $id)->first();

        if (!$request->image) {
            return Umkm::where('id', $id)->update([
            'umkm_name' => $request->name,
            'contact' => $request->phone,
            'address' => $request->address,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'description' => $request->description
            ])
            ? redirect('/umkm/profile')->with('success', 'Berhasil mengubah data')
            : redirect()->back()->with('error', 'Gagal mengubah data');
        } else {
            $this->deleteImage($getImage['image']);

            return Umkm::where('id', $id)->update([
                'umkm_name' => $request->name,
                'contact' => $request->phone,
                'address' => $request->address,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'description' => $request->description,
                'image' => $this->storeImage($request->image)
            ])
            ? redirect('/umkm/profile')->with('success', 'Berhasil menambahkan data')
            : redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }

    public function deleteImage($name)
    {
        File::delete('uploads/profile_umkm/' . $name);
    }

    public function storeImage($file)
    {
        $image = time() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads/profile_umkm/', $image);
        return $image;
    }
}
