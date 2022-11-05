<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\apiprobk_deteksi;
use App\Models\apiprobk_sertifikat;
use App\Models\kelas;
use App\Models\Siswa;
use App\Models\siswadetail;
use App\Services\hasilPsikologiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ownerHasilPsikologiController extends Controller
{
    protected $me;
    protected $mySekolahId;
    // construct
    public function __construct(hasilPsikologiService $hasilPsikologiService)
    {
        $this->hasilPsikologiService = $hasilPsikologiService;
    }
    // public function __construct()
    // {
    //     // $this->me = $this->guard()->user();
    //     // $this->mySekolahId = $this->me->sekolah_id;
    // }
    // public function guard()
    // {
    //     return Auth::guard('owner');
    // }
    public function withdetail($sekolah_id)
    {
        $kode = 500;
        $items = [];
        $items = Siswa::with('kelas')->with('siswadetailwithsertifikat')
            ->select('id', 'nomeridentitas', 'nama', 'kelas_id', 'username', 'passworddefault')
            ->where('sekolah_id', $sekolah_id)
            ->orderBy('kelas_id', 'asc')
            ->orderBy('nama', 'asc')
            ->get();
        foreach ($items as $key => $item) {
            $items[$key]->kelas_nama = $item->kelas->nama;
            $items[$key]->apiprobk_id = $item->siswadetailwithsertifikat ? $item->siswadetailwithsertifikat->apiprobk_id : null;
            $items[$key]->sertifikat = null;
            $getSertifikat = apiprobk_sertifikat::where('apiprobk_id', $item->siswadetailwithsertifikat ? $item->siswadetailwithsertifikat->apiprobk_id : '');
            if ($getSertifikat->count() > 0) {
                $items[$key]->sertifikat = $getSertifikat->count();
                $items[$key]->sertifikat_data = $getSertifikat->first();
                $items[$key]->terapis = $getSertifikat->count();
            }
            $getDeteksi = apiprobk_deteksi::where('apiprobk_id', $item->siswadetailwithsertifikat ? $item->siswadetailwithsertifikat->apiprobk_id : '');
            if ($getDeteksi->count() > 0) {
                $items[$key]->deteksi = $getDeteksi->count();
                // $items[$key]->deteksi_data = $getDeteksi->first();
                $items[$key]->penanganan = $getDeteksi->count();
            }
            unset($items[$key]->siswadetailwithsertifikat);
            unset($items[$key]->kelas);
        }

        $kode = 200;
        return response()->json([
            'status' => 'success',
            'data' => $items
        ], $kode);
    }
    public function withdetail_perkelas(kelas $kelas)
    {
        $kode = 500;
        $items = [];
        $items = Siswa::with('kelas')
            // ->with('siswadetailwithsertifikat')
            ->where('kelas_id', $kelas->id)
            ->select('id', 'nomeridentitas', 'nama', 'kelas_id', 'username', 'passworddefault')
            // ->orderBy('kelas_id', 'asc')
            ->orderBy('nama', 'asc')
            // ->where('sekolah_id', $me->sekolah_id)
            ->get();
        // foreach ($items as $key => $item) {
        //     $items[$key]->kelas_nama = $item->kelas->nama;
        //     $items[$key]->apiprobk_id = $item->siswadetailwithsertifikat ? $item->siswadetailwithsertifikat->apiprobk_id : null;
        //     $items[$key]->sertifikat = null;
        //     $getSertifikat = apiprobk_sertifikat::where('apiprobk_id', $item->siswadetailwithsertifikat ? $item->siswadetailwithsertifikat->apiprobk_id : '');
        //     if ($getSertifikat->count() > 0) {
        //         $items[$key]->sertifikat = $getSertifikat->count();
        //         $items[$key]->sertifikat_data = $getSertifikat->first();
        //         $items[$key]->terapis = $getSertifikat->count();
        //     }
        //     $getDeteksi = apiprobk_deteksi::where('apiprobk_id', $item->siswadetailwithsertifikat ? $item->siswadetailwithsertifikat->apiprobk_id : '');
        //     if ($getDeteksi->count() > 0) {
        //         $items[$key]->deteksi = $getDeteksi->count();
        //         // $items[$key]->deteksi_data = $getDeteksi->first();
        //         $items[$key]->penanganan = $getDeteksi->count();
        //     }
        //     unset($items[$key]->siswadetailwithsertifikat);
        //     unset($items[$key]->kelas);
        // }


        foreach ($items as $key => $item) {
            $getApiprobk = siswadetail::where('siswa_id', $item->id)->first();
            $items[$key]->apiprobk_id = $getApiprobk ? $getApiprobk->apiprobk_id : null;
            $getSertifikat = apiprobk_sertifikat::where('apiprobk_id', $getApiprobk ? $getApiprobk->apiprobk_id : '')->count();
            $items[$key]->sertifikat = $getSertifikat;
            $items[$key]->terapis = $getSertifikat;
            $getDeteksi = apiprobk_deteksi::where('apiprobk_id', $getApiprobk ? $getApiprobk->apiprobk_id : '')->count();
            $items[$key]->deteksi = $getDeteksi;
            $items[$key]->penanganan = $getDeteksi;

            unset($items[$key]->kelas);
        }
        $kode = 200;
        return response()->json([
            'status' => 'success',
            'data' => $items
        ], $kode);
    }


    public function detail(Siswa $siswa)
    {
        $kode = 500;
        $status = 'failed';
        $items = 'Anda tidak memiliki akses ke kelas ini!';
        $items = [];
        $items = Siswa::with('kelas')
            ->with('sekolah')
            ->with('siswadetailwithsertifikat')
            // ->select('id', 'nomeridentitas', 'nama', 'kelas_id', 'username', 'passworddefault')
            ->where('id', $siswa->id)->first();
        $items->paket_nama = $items->sekolah->paket ? $items->sekolah->paket->nama : 'Premium';
        $items->paket_id = $items->sekolah->paket ? $items->sekolah->paket->id : '1';
        $items->kelas_nama = $items->kelas->nama;
        $items->sekolah_nama = $items->sekolah->nama;
        $items->apiprobk_id = $items->siswadetailwithsertifikat ? $items->siswadetailwithsertifikat->apiprobk_id : null;
        $items->sertifikat = null;
        $getSertifikat = apiprobk_sertifikat::where('apiprobk_id', $items->siswadetailwithsertifikat ? $items->siswadetailwithsertifikat->apiprobk_id : '');
        if ($getSertifikat->count() > 0) {
            $items->sertifikat = $getSertifikat->first();
        }
        $getDeteksi = apiprobk_deteksi::where('apiprobk_id', $items->siswadetailwithsertifikat ? $items->siswadetailwithsertifikat->apiprobk_id : '');
        if ($getDeteksi->count() > 0) {
            $items->deteksi = $getDeteksi->with('apiprobk_deteksi_list')->first();
        }
        unset($items->siswadetailwithsertifikat);
        unset($items->kelas);

        $status = 'success';

        $kode = 200;
        return response()->json([
            'status' => $status,
            'data' => $items
        ], $kode);
    }

    public function kecerdasanmajemuk(Siswa $siswa)
    {
        $kode = 500;
        $status = 'failed';
        $items = 'Anda tidak memiliki akses ke kelas ini!';
        $items = [];

        $items = $this->hasilPsikologiService->getKecerdasanMajemuk($siswa->id);
        $siswa = $this->hasilPsikologiService->getSiswa($siswa->id);

        $status = 'success';

        $kode = 200;
        return response()->json([
            'status' => $status,
            'data' => $items,
            'siswa' => $siswa
        ], $kode);
    }
}
