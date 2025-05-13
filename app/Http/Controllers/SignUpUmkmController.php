<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SignUpUmkmController extends Controller
{
    public function index() {
        $checkUmkm = Umkm::where('user_id', session('user')['id'])->first();
        return view('umkm.SignUp');
    }

    public function store(Request $request) {
        $user = User::where('id', session('user')['id'])->first();
        $user->update([
            'role' => 'umkm'
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'Basic '.base64_encode(config('services.xendit.secret_key').':'),
            'Content-Type' => 'application/json'
        ])->post('https://api.xendit.co/v2/accounts', [
            'email' => $request->email,
            'type' => 'owned',
            'public_profile' => [
                'business_name' => $request->name,
            ],
            'status' => 'LIVE'
        ]);

        if (!isset($response->json()['error_code'])) {
            return Umkm::insert([
                'user_id' => $user->id,
                'xendit_user_id' => $response->json()['id'],
                'umkm_name' => $request->name,
                'umkm_email' => $request->email,
                'bank_code' => $request->bank_code,
                'bank_number' => $request->va_code,
                'address' => $request->address,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'contact' => $request->contact
            ])
            ? redirect('/umkm/status/pending')->with('success', 'Berhasil menambahkan data')
            : redurect()->back()->with('error', 'Gagal menambahkan data');
        } else {
            return redirect()->back()->with('error', 'Email telah digunakan');
        }

    }

    public function update(Request $request, $id) {
        $getImage = Umkm::where('id', $id)->first();

        if (!$request->image) {
            return Umkm::where('id', $id)->update([
                'user_id' => session('user')['id'],
                'umkm_name' => $request->name,
                'bank_code' => $request->bank_code,
                'bank_number' => $request->va_code,
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
                'bank_code' => $request->bank_code,
                'bank_number' => $request->va_code,
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
