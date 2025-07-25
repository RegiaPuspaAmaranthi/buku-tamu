<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        return redirect()->route('dashboard')->with('success', 'Login berhasil');
    }

    return back()->withErrors(['loginError' => 'Username atau password salah']);
}


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('buku-tamus.create');
    }
}
