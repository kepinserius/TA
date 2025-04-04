<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\ProfileUser;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil.
     */
    public function index()
    {
        $data = ProfileUser::with(['user'])->where('user_id', session('user')['id'])->first();
        if (!$data) {
            return ProfileUser::insert([
                'user_id' => session('user')['id']
            ])
            ? redirect('/profile')
            : redirect()->back();
        }

        return view('profile', ['data' => $data]);
    }

    /**
     * Menampilkan halaman edit profil.
     */
    public function showEdit()
    {
        return view('edit-profile', ['data' => ProfileUser::with(['user'])->where('user_id', session('user')['id'])->first()]);
    }

    public function update(Request $request, $id) {
        $getImage = ProfileUser::where('id', $id)->first();

        if (!$request->image) {
            if ($request->email) {
                $this->validateEmail($request, session('user')['id']);
            }
            return ProfileUser::where('id', $id)->update([
                
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
            ])
            ? redirect('/profile')->with('success', 'Berhasil mengubah data')
            : redirect()->back()->with('error', 'Gagal mengubah data');
        } else {
            $this->deleteImage($getImage['image']);

            if ($request->email) {
                $this->validateEmail($request, session('user')['id']);
            }
            return ProfileUser::where('id', $id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'image' => $this->storeImage($request->image)
            ])
            ? redirect('/profile')->with('success', 'Berhasil menambahkan data')
            : redirect()->back()->with('error', 'Gagal menambahkan data');
        }
    }

    public function validateEmail($request, $id) {
        $email = User::where('email', $request->email)->first();
        if (!$email) {
            User::where('id', session('user')['id'])->update([
                'email' => $request->email
            ]);
        }
        if ($email && $email->id == (int) $id) {
            User::where('id', session('user')['id'])->update([
                'email' => $request->email
            ]);
        } else {
            return redirect()->back()->with('error', 'email telah terdaftar !');
        }
    }

    public function deleteImage($name)
    {
        File::delete('uploads/profile_user/' . $name);
    }

    public function storeImage($file)
    {
        $image = time() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads/profile_user/', $image);
        return $image;
    }
}
