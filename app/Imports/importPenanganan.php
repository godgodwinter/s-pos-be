<?php

namespace App\Imports;

use App\Helpers\Fungsi;
use App\Models\apiprobk;
use App\Models\buletinpsikologi;
use App\Models\klasifikasiakademis;
use App\Models\masterdeteksi;
use App\Models\penanganandeteksimasalah;
use App\Models\terapiskarakterpositif;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class importPenanganan implements ToCollection, WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    protected $id;

    public function collection(Collection $rows, $calculateFormulas = false)
    {
        $jmlTerUpload = 0;
        $jmlDiSkip = 0;
        // $rows->calculate(false);
        ini_set('max_execution_time', 3000);
        $no = 0;
        foreach ($rows as $row) {
            if ($no > 0) {
                if (($row[1] != null) and ($row[1] != '')) {

                    $periksa = masterdeteksi::where('nama', $row[8])->count();
                    if ($periksa > 0) {
                        $masterdeteksi = masterdeteksi::where('nama', $row[8])->first();
                        $masterdeteksi_id = $masterdeteksi->id;
                        // $jmlDiSkip++;
                        $periksaDetail = penanganandeteksimasalah::where('batasbawah', $row[2])
                            ->where('batasatas', $row[3])
                            ->where('masterdeteksi_id', $masterdeteksi_id)
                            ->count();
                        if ($periksaDetail > 0) {
                            $periksaDetail_id = penanganandeteksimasalah::where('batasbawah', $row[2])
                                ->where('batasatas', $row[3])
                                ->where('masterdeteksi_id', $masterdeteksi_id)
                                ->first();
                            penanganandeteksimasalah::where('id', $periksaDetail_id->id)
                                ->update([
                                    'keterangan' => $row[4],
                                    'updated_at' => date("Y-m-d H:i:s")
                                ]);
                        } else {
                            penanganandeteksimasalah::insert(
                                array(
                                    'masterdeteksi_id'     =>  $masterdeteksi_id,
                                    'batasbawah'     =>  $row[2],
                                    'batasatas' => $row[3],
                                    'keterangan' => $row[4],
                                    'deleted_at' => null,
                                    'created_at' => date("Y-m-d H:i:s"),
                                    'updated_at' => date("Y-m-d H:i:s")
                                )
                            );
                        }
                    } else {
                        // insertGetID

                        $masterdeteksi_id = masterdeteksi::insertGetId(
                            array(
                                'nama'     =>  $row[8],
                                'singkatan'     =>  $row[8],
                                'deleted_at' => null,
                                'created_at' => date("Y-m-d H:i:s"),
                                'updated_at' => date("Y-m-d H:i:s")
                            )
                        );

                        $periksaDetail = penanganandeteksimasalah::where('batasbawah', $row[2])
                            ->where('batasatas', $row[3])
                            ->where('masterdeteksi_id', $masterdeteksi_id)
                            ->count();
                        if ($periksaDetail > 0) {
                            $periksaDetail_id = penanganandeteksimasalah::where('batasbawah', $row[2])
                                ->where('batasatas', $row[3])
                                ->where('masterdeteksi_id', $masterdeteksi_id)
                                ->first();
                            penanganandeteksimasalah::where('id', $periksaDetail_id->id)
                                ->update([
                                    'keterangan' => $row[4],
                                    'updated_at' => date("Y-m-d H:i:s")
                                ]);
                        } else {
                            penanganandeteksimasalah::insert(
                                array(
                                    'masterdeteksi_id'     =>  $masterdeteksi_id,
                                    'batasbawah'     =>  $row[2],
                                    'batasatas' => $row[3],
                                    'keterangan' => $row[4],
                                    'deleted_at' => null,
                                    'created_at' => date("Y-m-d H:i:s"),
                                    'updated_at' => date("Y-m-d H:i:s")
                                )
                            );
                        }
                        $jmlTerUpload++;
                    }
                }
            }
            $no++;
        }
    }
}
