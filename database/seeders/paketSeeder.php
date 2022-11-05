<?php

namespace Database\Seeders;

use App\Models\Gurubk;
use App\Models\masterdeteksi;
use App\Models\Ortu;
use App\Models\Owner;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Yayasan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class paketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('paket')->truncate();
        // paket
        DB::table('paket')->insert([
            'nama' => 'Premium',
            'ist' => 'Nonaktif',
            'penanganandeteksi' => 'Nonaktif',
            'terapiskarakterpositif' => 'Nonaktif',
            'pengolahandatates' => 'Nonaktif',
            'kecerdasanmajemuk' => 'Nonaktif',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('paket')->insert([
            'nama' => 'Gold',
            'terapiskarakterpositif' => 'Nonaktif',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('paket')->insert([
            'nama' => 'Platinum',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('paket')->insert([
            'nama' => 'Diamond',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
