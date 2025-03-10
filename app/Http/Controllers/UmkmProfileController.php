<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm;

class UmkmProfileController extends Controller
{
    public function index() {
        return view('umkm.Profile', ['umkm' => Umkm::with(['user'])->where('user_id', session('user')['id'])->first()]);
    }
}
