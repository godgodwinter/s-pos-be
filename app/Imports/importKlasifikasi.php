<?php

namespace App\Imports;

use App\Helpers\Fungsi;
use App\Models\apiprobk;
use App\Models\klasifikasiakademis;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class importKlasifikasi implements ToCollection, WithCalculatedFormulas
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

                    $periksa = klasifikasiakademis::where('bidang', $row[1])->count();
                    if ($periksa > 0) {
                        klasifikasiakademis::where('bidang', $row[1])->update([
                            'bidang' => $row[1],
                            'akademis' => $row[11],
                            'profesi' => $row[2],
                            'nilaistandart' => $row[3],
                            'iqstandart' => $row[4],
                            'jurusandanbidangstudi' => $row[5],
                            'pekerjaandanketerangan' => $row[6],
                            'ket' => $row[7],
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
                        $jmlDiSkip++;
                    } else {
                        klasifikasiakademis::insert(
                            array(
                                'bidang' => $row[1],
                                'akademis' => $row[11],
                                'profesi' => $row[2],
                                'nilaistandart' => $row[3],
                                'iqstandart' => $row[4],
                                'jurusandanbidangstudi' => $row[5],
                                'pekerjaandanketerangan' => $row[6],
                                'ket' => $row[7],
                                'deleted_at' => null,
                                'created_at' => date("Y-m-d H:i:s"),
                                'updated_at' => date("Y-m-d H:i:s")
                            )
                        );
                        $jmlTerUpload++;
                    }
                }
            }
            $no++;
        }
    }
}
