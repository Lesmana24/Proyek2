<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notification;

class ResetNotifikasi extends Command
{
    protected $signature = 'notifikasi:reset';
    protected $description = 'Menghapus semua notifikasi mingguan';

    public function handle()
    {
        // HAPUS SEMUA DATA (RESET)
        Notification::truncate();
        $this->info('Notifikasi berhasil direset bersih!');
    }
}