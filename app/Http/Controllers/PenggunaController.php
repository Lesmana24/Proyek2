<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Http\Requests\DaftarRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    // Tampilkan form daftar
    public function create()
{
    return view('konten.daftar', [
        'title' => 'Daftar',
        'slug'  => 'daftar'
    ]);
}

    // Proses data daftar
    public function store(DaftarRequest $request)
    {
        Pengguna::create([
            'nama'     => $request->nama,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan masuk.');
    }
}
