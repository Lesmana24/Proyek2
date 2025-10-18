<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('konten.login', [
            'title' => 'Login',
            'slug'  => 'login'
        ]);
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended('/home')->with('success', 'Berhasil masuk!');
    }

    public function destroy(Request $request)
    {
        Auth::guard('pengguna')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda keluar.');
    }
}
