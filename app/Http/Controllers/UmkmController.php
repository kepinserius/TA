<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index() {
        return view('admin.umkm', ['data' => Umkm::get(), 'user' => User::where('role', 'umkm')->get()]);
    }

    public function store(Request $request) {
        return Umkm::insert([
            'user_id' => $request->user_id,
            'umkm_name' => $request->name,
            'umkm_email' => $request->email,
            'description' => $request->description,
            'address' => $request->address,
            'contact' => $request->contact
        ])
        ? redirect('/admin/umkm')->with('success', 'Berhasil menambahkan data')
        : redirect()->back()->with('error', 'Gagal menambahkan data');
    }

    public function update(Request $request, $id) {
        return Umkm::where('id', $id)->update([
            'status' => $request->status,
        ])
        ? redirect('/admin/umkm')->with('success', 'Berhasil mengubah data')
        : redirect()->back()->with('error', 'Gagal mengubah data');
    }

    public function destroy($id) {
        return Umkm::where('id', $id)->delete()
        ? redirect('/admin/umkm')->with('success', 'Berhasil menghapus data')
        : redirect()->back()->with('error', 'Gagal menghapus data');
    }
}
