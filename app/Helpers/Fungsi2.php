<?php

namespace App\Helpers;

use App\Models\Siswa;
use App\Models\tapel;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class Fungsi2
{

    public static function rupiah($angka)
    {
        //inputan : angka
        $hasil = (int) filter_var($angka, FILTER_SANITIZE_NUMBER_INT);
        $hasil_rupiah = "Rp " . number_format($hasil, 2, ',', '.');
        return $hasil_rupiah;
    }


    public static function fnKecerdasanList($item)
    {
        //inputan : angka
        $hasil = 'Angka tidak valid!';

        if ($item == 'SKS') {
            $hasil = "Sangat Kurang Sekali";
        } elseif ($item == 'KS') {
            $hasil = "Kurang Sekali";
        } elseif ($item == 'K') {
            $hasil = "Kurang";
        } elseif ($item == 'HC') {
            $hasil = "Hampir Cukup";
        } elseif ($item == 'C') {
            $hasil = "Cukup";
        } elseif ($item == 'CB') {
            $hasil = "Cukup Baik";
        } elseif ($item == 'B') {
            $hasil = "Baik";
        } elseif ($item == 'BS') {
            $hasil = "Sangat Baik"; //Baik sekali
        } elseif ($item == 'SBS') {
            $hasil = "Sangat Baik Sekali";
        } else {
            $hasil = "Kode tidak ditemukan!";
        }

        // $kecerdasanList = [
        //     (object)[
        //         'label' => "Sangat Kurang Sekali",
        //         'code' => "SKS",
        //     ],
        //     (object)[
        //         'label' => "Kurang Sekali",
        //         'code' => "KS",
        //     ],
        //     (object)[
        //         'label' => "Kurang",
        //         'code' => "K",
        //     ],
        //     (object)[
        //         'label' => "Hampir Cukup",
        //         'code' => "HC",
        //     ],
        //     (object)[
        //         'label' => "Cukup",
        //         'code' => "C",
        //     ],
        //     (object)[
        //         'label' => "Cukup Baik",
        //         'code' => "CB",
        //         // alt'Code'=> "CB",
        //     ],
        //     (object)[
        //         'label' => "Baik",
        //         'code' => "B",
        //     ],
        //     (object)[
        //         'label' => "Sangat Baik", //Baik sekali
        //         'code' => "BS",
        //         // alt'Code'=> "BS",
        //     ],
        //     (object)[
        //         'label' => "Sangat Baik Sekali",
        //         'code' => "SBS",
        //     ],
        // ];

        return $hasil;
    }
    public static function singkatan($item)
    {
        //inputan : angka
        $hasil = 'Angka tidak valid!';
        if ($item > 90) {
            $hasil = "Sangat Tinggi Sekali / Sangat Mengganggu Sekali";
        } elseif (91 > $item && $item >= 81) {
            $hasil = "Tinggi Sekali / Mengganggu Sekali (TS)";
        } elseif (82 > $item && $item >= 71) {
            $hasil = "Tinggi / Mengganggu ";
        } elseif (71 > $item && $item >= 61) {
            $hasil = "Cukup Tinggi / Cukup Mengganggu ";
        } elseif (61 > $item && $item >= 41) {
            $hasil =  "Cukup / Terkendali ";
        } elseif (41 > $item && $item >= 31) {
            $hasil = "Agak Rendah / Cukup Terkendali ";
        } elseif (31 > $item && $item >= 21) {
            $hasil =  "Rendah / Terkendali Baik ";
        } elseif (21 > $item && $item >= 11) {
            $hasil = "Rendah Sekali / Terkendali Baik Sekali";
        } else {
            $hasil =  "Sangat Rendah Sekali / Sangat Terkendali Baik Sekali ";
        }
        return $hasil;
    }

    // const singkatan = (item = 99) => {
    //     let hasil = null;
    //     if (item > 90) {
    //       hasil = "Sangat Tinggi Sekali / Sangat Mengganggu Sekali";
    //     } else if (91 > item && item >= 81) {
    //       hasil = "Tinggi Sekali / Mengganggu Sekali (TS)";
    //     } else if (81 > item && item >= 71) {
    //       hasil = "Tinggi / Mengganggu";
    //     } else if (71 > item && item >= 61) {
    //       hasil = "Cukup Tinggi / Cukup Mengganggu";
    //     } else if (61 > item && item >= 41) {
    //       hasil = "Cukup / Terkendali ";
    //     } else if (41 > item && item >= 31) {
    //       hasil = "Agak Rendah / Cukup Terkendali ";
    //     } else if (31 > item && item >= 21) {
    //       hasil = "Rendah / Terkendali Baik ";
    //     } else if (21 > item && item >= 11) {
    //       hasil = "Rendah Sekali / Terkendali Baik Sekali";
    //     } else {
    //       hasil = "Sangat Rendah Sekali / Sangan Terkendali Baik Sekali ";
    //     }
    //     return hasil;
    //   };
}
