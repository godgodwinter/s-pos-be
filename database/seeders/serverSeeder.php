<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class serverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('apiprobk_server')->truncate();
        // SEEDER
        DB::table('apiprobk_server')->insert([
            'link' => 'http://185.227.135.32:20001/api/probk/DataDeteksi_Get',
            'prefix' => 'deteksi',
            'status' => 'Aktif',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('apiprobk_server')->insert([
            'link' => 'http://185.227.135.32:20001/api/probk/DataSertifikat_Get',
            'prefix' => 'sertifikat',
            'status' => 'Aktif',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
