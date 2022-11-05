<?php

namespace Database\Seeders;

use App\Models\Gurubk;
use App\Models\masterdeteksi;
use App\Models\Ortu;
use App\Models\Owner;
use App\Models\Pegawai;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Yayasan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class oneseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();
        //settings SEEDER
        DB::table('settings')->insert([
            'app_nama' => 'Nama App',
            'app_namapendek' => 'Bae',
            'paginationjml' => '10',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('users')->truncate();
        // admin
        User::insert([
            'name' => 'Admin Paijo',
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'nomeridentitas' => '1',
            'password' => Hash::make('admin'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);


        // DB::table('siswa')->truncate();
        // // admin
        // Siswa::insert([
        //     'nama' => 'Siswa Sri',
        //     'email' => 'siswa@gmail.com',
        //     'username' => 'siswa',
        //     'nomeridentitas' => '1111',
        //     'sekolah_id' => '1',
        //     'password' => Hash::make('siswa'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);


        // DB::table('gurubk')->truncate();
        // // admin
        // Gurubk::insert([
        //     'nama' => 'Guru Bk ',
        //     'email' => 'bk@gmail.com',
        //     'username' => 'bk',
        //     'nomeridentitas' => null,
        //     'sekolah_id' => '1',
        //     'password' => Hash::make('bk'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);

        // DB::table('yayasan')->truncate();
        // // admin
        // Yayasan::insert([
        //     'nama' => 'yayasan ',
        //     'email' => 'yayasan@gmail.com',
        //     'username' => 'yayasan',
        //     'nomeridentitas' => null,
        //     'password' => Hash::make('yayasan'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);

        DB::table('pegawai')->truncate();
        // admin
        Pegawai::insert([
            'nama' => 'Pegawai  ',
            'email' => 'pegawai@gmail.com',
            'username' => 'pegawai',
            'nomeridentitas' => null,
            'password' => Hash::make('pegawai'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // DB::table('ortu')->truncate();
        // // admin
        // Ortu::insert([
        //     'nama' => 'ortu  ',
        //     'email' => 'ortu@gmail.com',
        //     'username' => 'ortu',
        //     'nomeridentitas' => null,
        //     'siswa_id' => '1',
        //     'password' => Hash::make('ortu'),
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);


    }
}
