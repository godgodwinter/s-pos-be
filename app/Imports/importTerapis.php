<?php

namespace App\Imports;

use App\Helpers\Fungsi;
use App\Models\apiprobk;
use App\Models\buletinpsikologi;
use App\Models\klasifikasiakademis;
use App\Models\terapiskarakterpositif;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class importTerapis implements ToCollection, WithCalculatedFormulas
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

                    $periksa = terapiskarakterpositif::where('namakarakter', $row[1])->count();
                    if ($periksa > 0) {
                        terapiskarakterpositif::where('namakarakter', $row[1])->update([
                            'namakarakter' => $row[1],
                            'pemahaman' => $row[2],
                            'pembiasaansikap' => $row[3],
                            'tujuandanmanfaat' => $row[4],
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
                        $jmlDiSkip++;
                    } else {
                        terapiskarakterpositif::insert(
                            array(
                                'namakarakter'     =>  $row[1],
                                'pemahaman' => $row[2],
                                'pembiasaansikap' => $row[3],
                                'tujuandanmanfaat' => $row[4],
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
