<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        return view('admin.category', ['data' => Category::get()]);
    }

    public function store(Request $request) {
        return Category::insert([
            'name' => $request->name
        ])
        ? redirect('/admin/category')->with('success', 'Berhasil menambahkan data')
        : redirect()->back()->with('error', 'Gagal menambahkan data');
    }

    public function update(Request $request, $id) {
        return Category::where('id', $id)->update([
            'name' => $request->name
        ])
        ? redirect('/admin/category')->with('success', 'Berhasil mengubah data')
        : redirect()->back()->with('error', 'Gagal mengubah data');
    }

    public function destroy($id) {
        return Category::where('id', $id)->delete()
        ? redirect('/admin/category')->with('success', 'Berhasil menghapus data')
        : redirect()->back()->with('error', 'Gagal menghapus data');
    }
}
