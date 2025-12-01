<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification; // Panggil Model

class NotificationController extends Controller
{
    // 1. Tampilkan Halaman Notifikasi (Web)
    public function index()
    {
        // Ambil data terbaru paling atas
        $notifications = Notification::orderBy('created_at', 'desc')->get();

        return view('konten.notification', [
            'title' => 'Notifikasi',
            'notifications' => $notifications
        ]);
    }

    // 2. Simpan Data dari ESP32 (API)
    public function storeLog(Request $request)
    {
        Notification::create([
            'message' => $request->message ?? 'Penyiraman selesai secara otomatis.'
        ]);

        return response()->json(['status' => 'success']);
    }
}