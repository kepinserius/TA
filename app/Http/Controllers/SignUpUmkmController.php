<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;

class SignUpUmkmController extends Controller
{
    public function index() {
        return view('umkm.SignUp');
    }

    public function store(Request $request) {
        $user = User::where('id', session('user')['id'])->first();
        $user->update([
            'role' => 'umkm'
        ]);

        return Umkm::insert([
            'user_id' => $user->id,
            'umkm_name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'contact' => $request->contact
        ])
        ? redirect('/umkm/profile')->with('success', 'Berhasil menambahkan data')
        : redurect()->back()->with('error', 'Gagal menambahkan data');
    }

    public function update(Request $request, $id) {
        $getImage = Umkm::where('id', $id)->first();

        if (!$request->image) {
            return Umkm::where('id', $id)->update([
                'user_id' => session('user')['id'],
                'umkm_name' => $request->name,
                'description' => $request->description,
                'address' => $request->address,
                'contact' => $request->contact
            ])
            ? redirect('/umkm/profile')->with('success', 'Berhasil mengubah data')
            : redirect()->back()->with('error', 'Gagal mengubah data');
        } else {
            $this->deleteImage($getImage['image']);

            return Umkm::where('id', $id)->update([
                'user_id' => session('user')['id'],
                'umkm_name' => $request->name,
                'image' => $this->storeImage($request->image),
                'description' => $request->description,
                'address' => $request->address,
                'contact' => $request->contact
            ])
            ? redirect('/umkm/profile')->with('success', 'Berhasil mengubah data')
            : redirect()->back()->with('error', 'Gagal mengubah data');
        }
    }

    public function deleteImage($name)
    {
        File::delete('uploads/umkms/' . $name);
    }

    public function storeImage($file)
    {
        $image = time() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads/umkms/', $image);
        return $image;
    }
}
