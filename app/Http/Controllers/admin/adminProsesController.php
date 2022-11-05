<?php

namespace App\Http\Controllers\admin;

use App\Exports\exportDataSiswa;
use App\Exports\exportSiswaPerkelas;
use App\Exports\exportSiswaPerkelasBaru;
use App\Http\Controllers\Controller;
use App\Imports\importBuletin;
use App\Imports\importKatabijak;
use App\Imports\importKlasifikasi;
use App\Imports\importPenanganan;
use App\Imports\importTerapis;
use App\Models\kelas;
use App\Models\sekolah;
use App\Models\Siswa;
use App\Services\hasilPsikologiService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class adminProsesController extends Controller
{
    public function __construct(hasilPsikologiService $hasilPsikologiService)
    {
        $this->hasilPsikologiService = $hasilPsikologiService;
    }
    public function clearTemp()
    {
        // $path = storage_path('app/public/temp');
        // $files = glob($path . '/*'); // get all file names
        // foreach ($files as $file) { // iterate files
        //     if (is_file($file))
        //         unlink($file); // delete file
        // }
        $path = public_path('/file_temp/');
        $files = glob($path . '/*'); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file))
                unlink($file); // delete file
        }

        return response()->json([
            'success'    => true,
            'data'    => 'Data Temporary sudah di hapus',
        ], 200);
    }


    public function importKlasifikasi(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $file->move('file_temp', $nama_file);

        Excel::import(new importKlasifikasi, public_path('/file_temp/' . $nama_file));

        return response()->json([
            'success'    => true,
            'data'    => 'Data berhasil diImport',
        ], 200);
    }
    public function importBuletin(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $file->move('file_temp', $nama_file);

        Excel::import(new importBuletin, public_path('/file_temp/' . $nama_file));

        return response()->json([
            'success'    => true,
            'data'    => 'Data berhasil diImport',
        ], 200);
    }
    public function importTerapis(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $file->move('file_temp', $nama_file);

        Excel::import(new importTerapis, public_path('/file_temp/' . $nama_file));

        return response()->json([
            'success'    => true,
            'data'    => 'Data berhasil diImport',
        ], 200);
    }
    public function importPenanganan(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $file->move('file_temp', $nama_file);

        Excel::import(new importPenanganan, public_path('/file_temp/' . $nama_file));

        return response()->json([
            'success'    => true,
            'data'    => 'Data berhasil diImport',
        ], 200);
    }
    public function importKatabijak(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand() . $file->getClientOriginalName();

        $file->move('file_temp', $nama_file);

        Excel::import(new importKatabijak, public_path('/file_temp/' . $nama_file));

        return response()->json([
            'success'    => true,
            'data'    => 'Data berhasil diImport',
        ], 200);
    }

    public function exportDataSiswa(Siswa $siswa, Request $request)
    {
        $datas = siswa::with('siswadetailwithsertifikat')
            ->select('id', 'nama')->orderBy('kelas_id', 'asc')->orderBy('nama')
            ->get();
        $listData = $request->listData;
        foreach ($datas as $data) {
            for ($i = 0; $i < count($listData); $i++) {
                $data[$listData[$i]] =  $datas[0]->siswadetailwithsertifikat->apiprobkwithsertifikat->apiprobk_sertifikat[$listData[$i]];
            }
        }
        // $tes = $datas[0]->siswadetailwithsertifikat->apiprobkwithsertifikat->apiprobk_sertifikat->tipe_bakat_1;
        // dd($tes, $datas);
        // dd($datas);
        $tgl = date("YmdHis");
        return Excel::download(new exportDataSiswa($siswa->id, $listData), 'dataSiswa-' . $siswa->nama . '-' . $tgl . '.xlsx');
        // $headers = [
        //     'Content-Type' => 'application/vnd.ms-excel',
        // ];
        // return response()->download(Excel::download(new exportDataSiswa($siswa->id, $request->listData), 'dataSiswa-' . $siswa->nama . '-' . $tgl . '.xlsx'), 'filename.pdf', $headers);

        // return response()->json([
        //     'success'    => true,
        //     'data'    => Excel::download(new exportDataSiswa($siswa->id, $request->listData), 'dataSiswa-' . $siswa->nama . '-' . $tgl . '.xlsx'),
        // ], 200);
        // return response()->json([
        //     $listData
        // ], 200);
    }
    public function exportDataSiswaGet(sekolah $sekolah, Request $request)
    {
        $listData = preg_split("/\,/", $request->listdata);
        $hasilPsikologiService = $this->hasilPsikologiService->getHasilPsikologiWithDetail($sekolah->id);

        $datas = $hasilPsikologiService;
        foreach ($datas as $key => $data) {
            $data['id'] = $key + 1;
            $data['kelas'] = $data->kelas ? $data->kelas->nama : '';

            unset($data->kelas_id);
            if ($data->sertifikat_data) {

                for ($i = 0; $i < count($listData); $i++) {
                    $data[$listData[$i]] =  $data->sertifikat_data[$listData[$i]];

                    // dd($listData[$i], $data->sertifikat_data[$listData[$i]], $data[$listData[$i]]);

                    // $items = $this->hasilPsikologiService->getHasilPsikologiWithDetail($sekolah->id);


                }
            }

            unset($data->nomeridentitas);
            unset($data->username);
            unset($data->passworddefault);
            unset($data->apiprobk_id);
            unset($data->sertifikat);
            unset($data->sertifikat_data);
            unset($data->terapis);
            unset($data->deteksi);
            unset($data->penanganan);
            unset($data->kelas);
        }
        // dd($datas);


        $tgl = date("YmdHis");
        return Excel::download(new exportDataSiswa($sekolah->id, $listData, $datas), 'dataSiswa-' . $sekolah->nama . '-' . $tgl . '.xlsx');
    }


    public function exportDataSiswaGetPerkelas(sekolah $sekolah, kelas $kelas, Request $request)
    {
        $listData = preg_split("/\,/", $request->listdata);
        $hasilPsikologiService = $this->hasilPsikologiService->getHasilPsikologiWithDetail_perkelas($kelas->id);

        $datas = $hasilPsikologiService;
        foreach ($datas as $key => $data) {
            $data['id'] = $key + 1;
            $data['kelas'] = $data->kelas ? $data->kelas->nama : '';

            unset($data->kelas_id);
            if ($data->sertifikat_data) {

                for ($i = 0; $i < count($listData); $i++) {
                    $data[$listData[$i]] =  $data->sertifikat_data[$listData[$i]];

                    // dd($listData[$i], $data->sertifikat_data[$listData[$i]], $data[$listData[$i]]);

                    // $items = $this->hasilPsikologiService->getHasilPsikologiWithDetail($sekolah->id);


                }
            }

            unset($data->nomeridentitas);
            unset($data->username);
            unset($data->passworddefault);
            unset($data->apiprobk_id);
            unset($data->sertifikat);
            unset($data->sertifikat_data);
            unset($data->terapis);
            unset($data->deteksi);
            unset($data->penanganan);
            unset($data->kelas);
        }
        // dd($datas);


        $tgl = date("YmdHis");
        return Excel::download(new exportDataSiswa($sekolah->id, $listData, $datas), 'dataSiswa-' . $sekolah->nama . '-' . $tgl . '.xlsx');
    }

    public function exportDataSiswaPerkelas($kelas_id, Request $request)
    {
        $req = $kelas_id;
        $datenow = base64_decode($request->token); //tanggal untuk random kode harian
        $current_time = Carbon::now()->toDayDateTimeString();
        // Carbon::parse($dateTime)->format('D, d M \'y, H:i')
        // dd($datenow, date('Y-m-d'), $current_time);
        $kelas = base64_decode($req);
        $getKelas = kelas::where('id', $kelas)->first();
        $items = null;
        if ($datenow == date('Y-m-d')) {
            // dd($kelas);
            // return Excel::download(new exportSiswaPerkelas, 'data-' . $datenow . '.xlsx');
            // $tgl = date("YmdHis");
            // return Excel::download(new exportSiswaPerkelas, 'data-' . $tgl . '.xlsx');
            $tgl = date("YmdHis");
            return Excel::download(new exportSiswaPerkelasBaru($kelas), 'dataKelas-' . $getKelas->nama . '-' . $tgl . '.xlsx');
        } else {
            echo 'Token Invalid!';
        }
    }
}
