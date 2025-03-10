<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('admin.user', ['data' => User::get()]);
    }

    public function store(Request $request) {
        $username = User::where('username', $request->username)->first();
        $email = User::where('email', $request->email)->first();

        if ($username) {
            return redirect()->back()->with('error', 'Username telah terdaftar !');
        } elseif ($email) {
            return redirect()->back()->with('error', 'Email telah terdaftar !');
        }
        
        return User::insert([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'name' => $request->name,
            'role' => $request->role,
            'nonhash' => $request->password
        ]) 
        ? redirect('/admin/user')->with('success', 'sukses menambahkan data')
        : redirect()->back()->with('error', 'gagal menambahkan data');

    }

    public function update(Request $request, $id) {
        $username = User::where('username', $request->username)->first();
        $email = User::where('email', $request->email)->first();
        if ($username && $username->id == (int) $id) {
            if ($email && $email->id == (int) $id) {
                return $this->saveUpdate($request, $id);
            } else {
                return redirect()->back()->with('error', 'email telah terdaftar !');
            }
        } else {
            return redirect()->back()->with('error', 'username telah terdaftar !');
        }

        
    }

    public function saveUpdate(Request $request, $id) {
        return User::where('id', $id)->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'name' => $request->name,
            'role' => $request->role
        ])
        ? redirect('/admin/user')->with('success', 'Berhasil mengubah data !')
        : redirect()->back()->with('error', 'Gagal mengubah data !');
    }

    public function destroy($id) {
        return User::where('id', $id)->delete()
        ? redirect('/admin/user')->with('success', 'Berhasil menghapus data')
        : redirect()->back()->with('error', 'Gagal menghapus data');
    }
}
