<?php

namespace App\Http\Controllers;

use App\Exports\exportSiswaPerkelas;
use App\Models\apiprobk;
use App\Models\apiprobk_deteksi;
use App\Models\apiprobk_deteksi_list;
use App\Models\catatankasussiswa;
use App\Models\catatanpengembangandirisiswa;
use App\Models\catatanprestasisiswa;
use App\Models\klasifikasiakademis;
use App\Models\Siswa;
use App\Models\siswadetail;
use App\Models\SiswaPublic;
use App\Services\hasilPsikologiService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
// use Barryvdh\DomPDF\Facade\Pdf;
use PDF;

class cetakController extends Controller
{
    public function __construct(hasilPsikologiService $hasilPsikologiService)
    {
        $this->hasilPsikologiService = $hasilPsikologiService;
    }

    public function catatankasus($siswa_id, Request $request)
    {
        $req = $siswa_id;
        $datenow = base64_decode($request->token); //tanggal untuk random kode harian
        $siswa = base64_decode($req);
        $datasiswa = Siswa::with('kelas')->with('sekolah')->where('id', $siswa)->first();
        $items = catatankasussiswa::with('siswa')
            ->where('siswa_id', $siswa)
            ->get();
        if ($datenow == date('Y-m-d')) {
            // dd($req, $siswa, $items, $datenow);
            $tgl = date("YmdHis");
            $pdf = PDF::loadview('dev.cetak.catatankasus', compact('items', 'datasiswa'))->setPaper('legal', 'potrait');
            return $pdf->stream('data' . $tgl . '.pdf');
        } else {
            echo 'Token Invalid!';
        }
    }
    public function catatanpengembangandiri($siswa_id, Request $request)
    {
        $req = $siswa_id;
        $datenow = base64_decode($request->token); //tanggal untuk random kode harian
        $siswa = base64_decode($req);
        $datasiswa = Siswa::with('kelas')->with('sekolah')->where('id', $siswa)->first();
        $items = catatanpengembangandirisiswa::with('siswa')
            ->where('siswa_id', $siswa)
            ->get();
        if ($datenow == date('Y-m-d')) {
            // dd($req, $siswa, $items, $datenow);
            $tgl = date("YmdHis");
            $pdf = PDF::loadview('dev.cetak.catatanpengembangandiri', compact('items', 'datasiswa'))->setPaper('legal', 'potrait');
            return $pdf->stream('data' . $tgl . '.pdf');
        } else {
            echo 'Token Invalid!';
        }
    }
    public function catatanprestasi($siswa_id, Request $request)
    {
        $req = $siswa_id;
        $datenow = base64_decode($request->token); //tanggal untuk random kode harian
        $current_time = Carbon::now()->toDayDateTimeString();
        // Carbon::parse($dateTime)->format('D, d M \'y, H:i')
        // dd($datenow, date('Y-m-d'), $current_time);
        $siswa = base64_decode($req);
        $datasiswa = Siswa::with('kelas')->with('sekolah')->where('id', $siswa)->first();
        $items = catatanprestasisiswa::with('siswa')
            ->where('siswa_id', $siswa)
            ->get();
        if ($datenow == date('Y-m-d')) {
            // dd($req, $siswa, $items, $datenow);
            $tgl = date("YmdHis");
            $pdf = PDF::loadview('dev.cetak.catatanprestasi', compact('items', 'datasiswa'))->setPaper('legal', 'potrait');
            return $pdf->stream('data' . $tgl . '.pdf');
        } else {
            echo 'Token Invalid!';
        }
    }

    public function klasifikasi(Request $request)
    {
        $datenow = base64_decode($request->token); //tanggal untuk random kode harian
        $current_time = Carbon::now()->toDayDateTimeString();
        $dataMentah = base64_decode($request->data);
        $datas = json_decode($dataMentah, true);
        // Carbon::parse($dateTime)->format('D, d M \'y, H:i')
        // dd($datenow, date('Y-m-d'), $current_time);
        $dataCetak = [];
        foreach ($datas as $value) {
            $getData = klasifikasiakademis::where('id', $value)->first();
            array_push($dataCetak, $getData);
        }
        $items = $dataCetak;
        if ($datenow == date('Y-m-d')) {
            // dd($dataCetak);
            // dd($req, $siswa, $items, $datenow);
            $tgl = date("YmdHis");
            $pdf = PDF::loadview('dev.cetak.cetakKlasifikasi', compact('items', 'dataCetak'))->setPaper('legal', 'potrait');
            return $pdf->stream('data' . $tgl . '.pdf');
        } else {
            echo 'Token Invalid!';
        }
    }

    public function terapis($siswa_id, Request $request)
    {
        $req = $siswa_id;
        $datenow = base64_decode($request->token); //tanggal untuk random kode harian
        $current_time = Carbon::now()->toDayDateTimeString();
        // Carbon::parse($dateTime)->format('D, d M \'y, H:i')
        // dd($datenow, date('Y-m-d'), $current_time);
        $siswa = base64_decode($req);
        $items = null;
        if ($datenow == date('Y-m-d')) {
            // dd($this->hasilPsikologiService->getTerapis($siswa));
            $datasiswa = $this->hasilPsikologiService->getSiswa($siswa);
            $items = $this->hasilPsikologiService->getTerapis($siswa);
            $tgl = date("YmdHis");
            $pdf = PDF::loadview('dev.cetak.cetakTerapis', compact('items', 'datasiswa'))->setPaper('legal', 'potrait');
            return $pdf->stream('data' . $tgl . '.pdf');
        } else {
            echo 'Token Invalid!';
        }
    }
    public function penanganan($siswa_id, Request $request)
    {
        $req = $siswa_id;
        $datenow = base64_decode($request->token); //tanggal untuk random kode harian
        $current_time = Carbon::now()->toDayDateTimeString();
        // Carbon::parse($dateTime)->format('D, d M \'y, H:i')
        // dd($datenow, date('Y-m-d'), $current_time);
        $siswa = base64_decode($req);
        $items = null;
        if ($datenow == date('Y-m-d')) {
            // dd('penanganan');
            // dd($this->hasilPsikologiService->getPenanganan($siswa));
            $datasiswa = $this->hasilPsikologiService->getSiswa($siswa);
            $items = $this->hasilPsikologiService->getPenanganan($siswa);
            $tgl = date("YmdHis");
            $pdf = PDF::loadview('dev.cetak.cetakPenanganan', compact('items', 'datasiswa'))->setPaper('legal', 'potrait');
            return $pdf->stream('data' . $tgl . '.pdf');
        } else {
            echo 'Token Invalid!';
        }
    }
    public function kecerdasanmajemuk($siswa_id, Request $request)
    {
        $req = $siswa_id;
        $datenow = base64_decode($request->token); //tanggal untuk random kode harian
        $current_time = Carbon::now()->toDayDateTimeString();
        // Carbon::parse($dateTime)->format('D, d M \'y, H:i')
        // dd($datenow, date('Y-m-d'), $current_time);
        $siswa = base64_decode($req);
        $items = null;
        if ($datenow == date('Y-m-d')) {
            // dd('penanganan');
            // dd($this->hasilPsikologiService->getPenanganan($siswa));
            $items = $this->hasilPsikologiService->getKecerdasanMajemuk($siswa);
            $datasiswa = $this->hasilPsikologiService->getSiswa($siswa);
            $tgl = date("YmdHis");
            $pdf = PDF::loadview('dev.cetak.cetakKecerdasanMajemuk', compact('items', 'datasiswa'))->setPaper('legal', 'potrait');
            return $pdf->stream('data' . $tgl . '.pdf');
        } else {
            echo 'Token Invalid!';
        }
    }




    // public function exportDataSiswaPerkelas($kelas_id, Request $request)
    // {
    //     $req = $kelas_id;
    //     $datenow = base64_decode($request->token); //tanggal untuk random kode harian
    //     $current_time = Carbon::now()->toDayDateTimeString();
    //     // Carbon::parse($dateTime)->format('D, d M \'y, H:i')
    //     // dd($datenow, date('Y-m-d'), $current_time);
    //     $kelas = base64_decode($req);
    //     $items = null;
    //     if ($datenow == date('Y-m-d')) {
    //         // dd($kelas);
    //         // return Excel::download(new exportSiswaPerkelas, 'data-' . $datenow . '.xlsx');
    //         $tgl = date("YmdHis");
    //         return Excel::download(new exportSiswaPerkelas, 'data-' . $tgl . '.xlsx');
    //     } else {
    //         echo 'Token Invalid!';
    //     }
    // }


    public function deteksisq($siswa_id, Request $request)
    {
        $req = $siswa_id;
        $datenow = base64_decode($request->token); //tanggal untuk random kode harian
        $current_time = Carbon::now()->toDayDateTimeString();
        // Carbon::parse($dateTime)->format('D, d M \'y, H:i')
        // dd($datenow, date('Y-m-d'), $current_time);
        $siswa = base64_decode($req);
        $items = null;
        if ($datenow == date('Y-m-d')) {
            // dd($this->hasilPsikologiService->getTerapis($siswa));
            // dd($siswa);
            $datasiswa = $this->hasilPsikologiService->getSiswa($siswa);
            // $items = $this->hasilPsikologiService->getTerapis($siswa);
            // $datasiswa = SiswaPublic::where('id', $siswa)->first();
            // $datasiswa = null;
            $items = null;
            $getApiprobk = siswadetail::where('siswa_id', $siswa)->first();
            $getApiprobk_username = apiprobk::where('id', $getApiprobk->apiprobk_id)->first();
            $deteksi = apiprobk_deteksi::where('apiprobk_id', $getApiprobk_username->id)->first();
            $deteksiList = apiprobk_deteksi_list::where('apiprobk_deteksi_id', $deteksi->id)->get();
            // dd($datasiswa, $getApiprobk, $getApiprobk_username, $deteksi, $deteksiList);
            // dd($items);
            $tgl = date("YmdHis");
            $pdf = PDF::loadview('dev.cetak.cetakDeteksiSq', compact('items', 'datasiswa', 'deteksi', 'deteksiList'))->setPaper('legal', 'potrait');
            return $pdf->stream('data' . $tgl . '.pdf');
        } else {
            echo 'Token Invalid!';
        }
    }
}
