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

class exportSiswaPerkelasBaru implements FromCollection, WithHeadings, ShouldAutoSize
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

    function __construct($id)
    {
        $this->id = $id;
    }

    public function headings(): array
    {
        $thead = [
            'id',
            'nis',
            'nama', 'kelas',
            'username',
            'password Default',
            'username_ortu',
            'passwort_ortu Default',
        ];
        return $thead;
    }
    public function collection()
    {

        $kelas_id = $this->id;
        $datas = Siswa::with('kelas')->where('kelas_id', $this->id)
            ->select('id', 'nomeridentitas', 'nama', 'kelas_id')->orderBy('kelas_id', 'asc')->orderBy('nama')
            ->get();
        foreach ($datas as $key => $data) {
            $getDataSiswa = Siswa::where('id', $data->id)->with('ortu')->first();
            $data['id'] = $key + 1;
            $data['kelas'] = $data->kelas ? $data->kelas->nama : '';

            // dd($getDataSiswa);
            $data['username'] = $getDataSiswa ? $getDataSiswa->username : '';
            $data['passworddefault'] = $getDataSiswa ? $getDataSiswa->passworddefault : '';
            $data['username_ortu'] = $getDataSiswa->ortu ? $getDataSiswa->ortu->username : '';
            $data['password_ortu'] = $getDataSiswa->ortu ? $getDataSiswa->ortu->passworddefault : '';


            unset($data->kelas_id);
        }
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
