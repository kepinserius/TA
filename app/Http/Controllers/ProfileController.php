<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil.
     */
    public function index()
    {
        return view('profile');
    }

    /**
     * Menampilkan halaman edit profil.
     */
    public function edit()
    {
        return view('edit-profile');
    }
}
