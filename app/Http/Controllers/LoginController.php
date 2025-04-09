<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // View langsung di folder views/
    }

    public function getUser($username)
    {
        $user = User::where('username', $username)->first();
        return ['data' => $user];
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $validate = $this->getUser($request->username);
        
        if ($validate['data'] === null) {
            return redirect()->back()->with('error', 'username yang anda masukkan salah');
        } else {
            $this->createSession($request, $validate['data']);
            if ($validate['data']['role'] === 'user' || $validate['data']['role'] === 'umkm') {
                return password_verify($request->password, $validate['data']['password'])
                    ? redirect('/')
                    : redirect()->back()->with('error', 'password yang anda masukkan salah');
                } else {
                return password_verify($request->password, $validate['data']['password'])
                    ? redirect('/admin')
                    : redirect()->back()->with('error', 'password yang anda masukkan salah');
            }
        }
    }

    public function createSession($req, $validate)
    {
        $req->session()->put('user', 
        [
            'username' => $validate['username'],
            'email' => $validate['email'],
            'role' => $validate['role'],
            'id' => $validate['id'],
        ]);
    }

    public function logout()
    {
        if (session()->has('user')) {
            session()->pull('user');
        }
        return redirect('/login');
    }
}
