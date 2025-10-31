<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $title = 'Notifikasi';
        $slug = 'notification';
        
        return view('konten.notification', compact('title', 'slug'));
    }
}
