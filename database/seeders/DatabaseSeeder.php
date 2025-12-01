<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        Setting::create([
            'key' => 'batas_suhu',
            'value' => '24'
        ]);

        Setting::create([
            'key' => 'batas_lembab',
            'value' => '60'
        ]);

        Setting::create([
            'key' => 'jadwal_hari', 
            'value' => '0,0,0,0,0,0,0'
        ]);

        Setting::create([
            'key' => 'jadwal_jam',  
            'value' => '07:00'
        ]);
    }
}
