<?php

namespace App\Exports;

use App\Http\Resources\bukudetailresource;
use App\Http\Resources\bukurakresource;
use App\Http\Resources\bukuresource;
use App\Http\Resources\kelasresource;
use App\Http\Resources\peralatanresource;
use App\Http\Resources\sekolahresource;
use App\Http\Resources\siswaresource;
use App\Http\Resources\tapelresource;
use App\Http\Resources\usersresource;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use App\Services\hasilPsikologiService;

class exportDataSiswa implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */

    // public function styles(Worksheet $sheet)
    // {
    //     return [
    //         // Style the first row as bold text.
    //         1    => ['font' => ['bold' => true]],


    //     ];
    // }
    protected $id;
    protected $listData;

    function __construct($id, $listData, $hasilPsikologiService)
    {
        $this->id = $id;
        $this->listData = $listData;
        $this->hasilPsikologiService = $hasilPsikologiService;
    }

    public function headings(): array
    {
        $thead = ['id', 'nama', 'kelas'];
        $jml = count($this->listData);
        for ($i = 0; $i < $jml; $i++) {
            array_push($thead, $this->listData[$i]);
        }
        // arraypush
        return $thead;
    }
    public function collection()
    {

        $listData = $this->listData;
        $datas = Siswa::with('siswadetailwithsertifikat')->with('kelas')
            ->where('sekolah_id', $this->id)
            ->select('id', 'nama', 'kelas_id')->orderBy('kelas_id', 'asc')->orderBy('nama')
            ->get();
        $datas = $this->hasilPsikologiService;
        // foreach ($datas as $key => $data) {
        //     $data['id'] = $key + 1;
        //     $data['kelas'] = $data->kelas ? $data->kelas->nama : '';

        //     unset($data->kelas_id);
        //     if ($data->sertifikat_data) {

        //         for ($i = 0; $i < count($listData); $i++) {
        //             $data[$listData[$i]] =  $data->sertifikat_data[$listData[$i]];

        //             // $items = $this->hasilPsikologiService->getHasilPsikologiWithDetail($sekolah->id);


        //         }
        //     }
        // }
        // foreach ($datas as $data) {
        //     for ($i = 0; $i < count($listData); $i++) {
        //         $data[$listData[$i]] =  $datas[0]->siswadetailwithsertifikat->apiprobkwithsertifikat->apiprobk_sertifikat[$listData[$i]];
        //     }
        // }
        // $tes = $datas[0]->siswadetailwithsertifikat->apiprobkwithsertifikat->apiprobk_sertifikat->tipe_bakat_1;
        // dd($tes, $datas);

        return $datas;
    }
}
