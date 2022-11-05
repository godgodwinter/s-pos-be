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

class ujianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ujian_kategori')->truncate();
        $dataBankSoal = [
            (object)[
                'nama' => 'Biologi'
            ],
            (object)[
                'nama' => 'Kimia'
            ],
            (object)[
                'nama' => 'Fisika'
            ],
            (object)[
                'nama' => 'Matematika'
            ],
            (object)[
                'nama' => 'Geografi'
            ],
            (object)[
                'nama' => 'Ekonomi'
            ],
            (object)[
                'nama' => 'Sejarah'
            ],
            (object)[
                'nama' => 'Sosiologi'
            ],
            (object)[
                'nama' => 'Bahasa Indonesia'
            ],
            (object)[
                'nama' => 'Bahasa Inggris'
            ],
        ];

        foreach ($dataBankSoal as $item) {
            DB::table('ujian_kategori')->insert([
                'nama' => $item->nama,
                'prefix' => 'banksoal',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }


        // $dataPaketsoal = [
        //     (object)[
        //         'nama' => 'Paket IPA A 2022-01-01'
        //     ],
        //     (object)[
        //         'nama' => 'Paket IPA B 2022-01-01'
        //     ],
        // ];

        // foreach ($dataPaketsoal as $item) {
        //     DB::table('ujian_kategori')->insert([
        //         'nama' => $item->nama,
        //         'prefix' => 'paketsoal',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ]);
        // }
    }
}
