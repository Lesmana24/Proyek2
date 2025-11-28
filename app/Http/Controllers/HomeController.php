<?php

namespace App\Http\Controllers;

use App\Models\Setting; // Jangan lupa import
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // 1. Fungsi Menampilkan Dashboard
    public function index()
    {
        // Ambil data dari database
        $batasSuhu = Setting::where('key', 'batas_suhu')->first()->value ?? 24;
        $batasLembab = Setting::where('key', 'batas_lembab')->first()->value ?? 60;

        return view('konten.home', [
            'title' => 'Dashboard IoT',
            'batasSuhu' => $batasSuhu,     // Kirim ke View
            'batasLembab' => $batasLembab  // Kirim ke View
        ]);
    }

    // 2. Fungsi Update Data (Dipanggil via AJAX nanti)
    public function updateSettings(Request $request)
    {
        $key = $request->input('key');   // 'batas_suhu' atau 'batas_lembab'
        $value = $request->input('value');

        // Update Database
        Setting::where('key', $key)->update(['value' => $value]);

        return response()->json(['status' => 'success']);
    }
}