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
            'login_siswa' => 'Aktif',
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

        DB::table('owner')->truncate();
        // admin
        Owner::insert([
            'nama' => 'Owner  ',
            'email' => 'owner@gmail.com',
            'username' => 'owner',
            'nomeridentitas' => null,
            'password' => Hash::make('owner'),
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


        masterdeteksi::truncate();
        $dataku = collect([
            [
                'nama' => 'AGRESIF',
                'singkatan' => 'AGRESIF',
            ],
            [
                'nama' => 'MELAMUN',
                'singkatan' => 'MELAMUN',
            ],
            [
                'nama' => 'MALAS',
                'singkatan' => 'MALAS',
            ],
            [
                'nama' => 'MEMBANGKANG',
                'singkatan' => 'MEMBANGKANG',
            ],
            [
                'nama' => 'DEPRESI',
                'singkatan' => 'DEPRESI',
            ],
            [
                'nama' => 'FOBIA',
                'singkatan' => 'FOBIA',
            ],
            [
                'nama' => 'INDIVIDUALIS',
                'singkatan' => 'INDIVIDUALIS',
            ],
            [
                'nama' => 'KAKU',
                'singkatan' => 'KAKU',
            ],
            [
                'nama' => 'KECEMASAN',
                'singkatan' => 'KECEMASAN',
            ],
            [
                'nama' => 'KERAS KEPALA',
                'singkatan' => 'KERAS KEPALA',
            ],
            [
                'nama' => 'KERJA KURANG SERIUS',
                'singkatan' => 'KERJA KURANG SERIUS',
            ],
            [
                'nama' => 'KURANG DIANDALKAN DALAM BEKERJA',
                'singkatan' => 'KURANG DIANDALKAN DALAM BEKERJA',
            ],
            [
                'nama' => 'KURANG DISIPLIN ',
                'singkatan' => 'KURANG DISIPLIN ',
            ],
            [
                'nama' => 'KURANG ENERGIK',
                'singkatan' => 'KURANG ENERGIK',
            ],
            [
                'nama' => 'KURANG KOMUNIKASI',
                'singkatan' => 'KURANG KOMUNIKASI',
            ],
            [
                'nama' => 'KURANG PENGENDALIAN DIRI',
                'singkatan' => 'KURANG PENGENDALIAN DIRI',
            ],
            [
                'nama' => 'KURANG PUNYA IDE',
                'singkatan' => 'KURANG PUNYA IDE',
            ],
            [
                'nama' => 'KURANG RAPI',
                'singkatan' => 'KURANG RAPI',
            ],
            [
                'nama' => 'KURANG TERATUR',
                'singkatan' => 'KURANG TERATUR',
            ],
            [
                'nama' => 'LAMBAT ATAU LAMBAN',
                'singkatan' => 'LAMBAT ATAU LAMBAN',
            ],
            [
                'nama' => 'MENUNTUT DAN MEMAKSA',
                'singkatan' => 'MENUNTUT DAN MEMAKSA',
            ],
            [
                'nama' => 'MINAT KURANG DAN LEMAH',
                'singkatan' => 'MINAT KURANG DAN LEMAH',
            ],
            [
                'nama' => 'MUDAH BOSAN DAN JENUH',
                'singkatan' => 'MUDAH BOSAN DAN JENUH',
            ],
            [
                'nama' => 'MOTIVASI DAN DORONGAN LEMAH',
                'singkatan' => 'MOTIVASI DAN DORONGAN LEMAH',
            ],
            [
                'nama' => 'MUDAH MENGELUH',
                'singkatan' => 'MUDAH MENGELUH',
            ],
            [
                'nama' => 'SEDIKIT TEMAN',
                'singkatan' => 'SEDIKIT TEMAN',
            ],
            [
                'nama' => 'SIKAP ACUH TAK ACUH',
                'singkatan' => 'SIKAP ACUH TAK ACUH',
            ],
            [
                'nama' => 'SIKAP ANTI SOSIAL ATAU KURANG SOSIALISASI',
                'singkatan' => 'SIKAP ANTI SOSIAL ATAU KURANG SOSIALISASI',
            ],
            [
                'nama' => 'SIKAP CEMBERUT',
                'singkatan' => 'SIKAP CEMBERUT',
            ],
            [
                'nama' => 'SIKAP CEMBURU',
                'singkatan' => 'SIKAP CEMBURU',
            ],
            [
                'nama' => 'SIKAP CENDERUNG DINGIN',
                'singkatan' => 'SIKAP CENDERUNG DINGIN',
            ],
            [
                'nama' => 'SIKAP CENDERUNG KASAR',
                'singkatan' => 'SIKAP CENDERUNG KASAR',
            ],
            [
                'nama' => 'SIKAP CENDERUNG KURANG RAMAH',
                'singkatan' => 'SIKAP CENDERUNG KURANG RAMAH',
            ],
            [
                'nama' => 'SIKAP CENDERUNG MEMUSUHI',
                'singkatan' => 'SIKAP CENDERUNG MEMUSUHI',
            ],
            [
                'nama' => 'SIKAP CENDERUNG SINIS',
                'singkatan' => 'SIKAP CENDERUNG SINIS',
            ],
            [
                'nama' => 'SIKAP CENDERUNG SOMBONG',
                'singkatan' => 'SIKAP CENDERUNG SOMBONG',
            ],
            [
                'nama' => 'SIKAP CENDERUNG TEGANG',
                'singkatan' => 'SIKAP CENDERUNG TEGANG',
            ],
            [
                'nama' => 'SIKAP CEROBOH DAN SEMBRONO',
                'singkatan' => 'SIKAP CEROBOH DAN SEMBRONO',
            ],
            [
                'nama' => 'SIKAP DENDAM',
                'singkatan' => 'SIKAP DENDAM',
            ],
            [
                'nama' => 'SIKAP EGOIS',
                'singkatan' => 'SIKAP EGOIS',
            ],
            [
                'nama' => 'SIKAP FRUSTASI DAN PUTUS ASA',
                'singkatan' => 'SIKAP FRUSTASI DAN PUTUS ASA',
            ],
            [
                'nama' => 'SIKAP IRI HATI',
                'singkatan' => 'SIKAP IRI HATI',
            ],
            [
                'nama' => 'SIKAP JENGKEL',
                'singkatan' => 'SIKAP JENGKEL',
            ],
            [
                'nama' => 'SIKAP KHAWATIR',
                'singkatan' => 'SIKAP KHAWATIR',
            ],
            [
                'nama' => 'SIKAP KERAS',
                'singkatan' => 'SIKAP KERAS',
            ],
            [
                'nama' => 'SIKAP KERJA KURANG KONSENTRASI',
                'singkatan' => 'SIKAP KERJA KURANG KONSENTRASI',
            ],
            [
                'nama' => 'SIKAP KERJA KURANG TELITI',
                'singkatan' => 'SIKAP KERJA KURANG TELITI',
            ],
            [
                'nama' => 'SIKAP SEENAKNYA',
                'singkatan' => 'SIKAP SEENAKNYA',
            ],
            [
                'nama' => 'SIKAP KETAKUTAN',
                'singkatan' => 'SIKAP KETAKUTAN',
            ],
            [
                'nama' => 'SIKAP KURANG BERANI',
                'singkatan' => 'SIKAP KURANG BERANI',
            ],
            [
                'nama' => 'SIKAP KURANG MANDIRI ATAU BERGANTUNG',
                'singkatan' => 'SIKAP KURANG MANDIRI ATAU BERGANTUNG',
            ],
            [
                'nama' => 'SIKAP KURANG PERCAYA DIRI',
                'singkatan' => 'SIKAP KURANG PERCAYA DIRI',
            ],
            [
                'nama' => 'SIKAP KURANG TANGGUNG JAWAB',
                'singkatan' => 'SIKAP KURANG TANGGUNG JAWAB',
            ],
            [
                'nama' => 'SIKAP KURANG TEGAS',
                'singkatan' => 'SIKAP KURANG TEGAS',
            ],
            [
                'nama' => 'SIKAP KURANG TERBUKA',
                'singkatan' => 'SIKAP KURANG TERBUKA',
            ],
            [
                'nama' => 'SIKAP KURANG ATAU TIDAK SETIA',
                'singkatan' => 'SIKAP KURANG ATAU TIDAK SETIA',
            ],
            [
                'nama' => 'SIKAP MARAH',
                'singkatan' => 'SIKAP MARAH',
            ],
            [
                'nama' => 'SIKAP MEMBATASI TUGAS',
                'singkatan' => 'SIKAP MEMBATASI TUGAS',
            ],
            [
                'nama' => 'SIKAP MENYALAHKAN DIRI SENDIRI',
                'singkatan' => 'SIKAP MENYALAHKAN DIRI SENDIRI',
            ],
            [
                'nama' => 'SIKAP MERASA KESEPIAN',
                'singkatan' => 'SIKAP MERASA KESEPIAN',
            ],
            [
                'nama' => 'SIKAP MINDER DAN MENARIK DIRI',
                'singkatan' => 'SIKAP MINDER DAN MENARIK DIRI',
            ],
            [
                'nama' => 'SIKAP MUDAH BIMBANG DAN RAGU-RAGU',
                'singkatan' => 'SIKAP MUDAH BIMBANG DAN RAGU-RAGU',
            ],
            [
                'nama' => 'SIKAP MUDAH BINGUNG',
                'singkatan' => 'SIKAP MUDAH BINGUNG',
            ],
            [
                'nama' => 'SIKAP MUDAH GUGUP DAN TERGESA-GESA',
                'singkatan' => 'SIKAP MUDAH GUGUP DAN TERGESA-GESA',
            ],
            [
                'nama' => 'SIKAP MUDAH SEDIH',
                'singkatan' => 'SIKAP MUDAH SEDIH',
            ],
            [
                'nama' => 'SIKAP MUDAH TERHARU',
                'singkatan' => 'SIKAP MUDAH TERHARU',
            ],
            [
                'nama' => 'SIKAP PEMALU',
                'singkatan' => 'SIKAP PEMALU',
            ],
            [
                'nama' => 'SIKAP PENDIAM',
                'singkatan' => 'SIKAP PENDIAM',
            ],
            [
                'nama' => 'SIKAP PESIMIS',
                'singkatan' => 'SIKAP PESIMIS',
            ],
            [
                'nama' => 'SIKAP SOK BERKUASA',
                'singkatan' => 'SIKAP SOK BERKUASA',
            ],
            [
                'nama' => 'SIKAP SUKA BERONTAK',
                'singkatan' => 'SIKAP SUKA BERONTAK',
            ],
            [
                'nama' => 'SIKAP BERSAING DAN PAMER',
                'singkatan' => 'SIKAP BERSAING DAN PAMER',
            ],
            [
                'nama' => 'SIKAP SUKA MENYENDIRI',
                'singkatan' => 'SIKAP SUKA MENYENDIRI',
            ],
            [
                'nama' => 'SIKAP SULIT ADAPTASI',
                'singkatan' => 'SIKAP SULIT ADAPTASI',
            ],
            [
                'nama' => 'SIKAP TIDAK SABAR',
                'singkatan' => 'SIKAP TIDAK SABAR',
            ],
            [
                'nama' => 'SIKAP LUNAK DAN TERUS MENGALAH',
                'singkatan' => 'SIKAP LUNAK DAN TERUS MENGALAH',
            ],
            [
                'nama' => 'TERLALU DILINDUNGI ATAU TIDAK MANDIRI',
                'singkatan' => 'TERLALU DILINDUNGI ATAU TIDAK MANDIRI',
            ],
            [
                'nama' => 'TIDAK AKTIF DAN MUDAH LELAH',
                'singkatan' => 'TIDAK AKTIF DAN MUDAH LELAH',
            ],
            [
                'nama' => 'TRAUMA',
                'singkatan' => 'TRAUMA',
            ],
        ]);


        foreach ($dataku as $data) {
            // dd($data['nama']);
            DB::table('masterdeteksi')->insert([
                'nama' => $data['nama'],
                'singkatan' => $data['singkatan'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        // paket
        DB::table('paket')->insert([
            'nama' => 'Premuim',
            'harga' => '10000',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
