<?php

namespace App\Imports;

use App\Helpers\Fungsi;
use App\Models\apiprobk;
use App\Models\buletinpsikologi;
use App\Models\katabijak;
use App\Models\katabijakdetail;
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

class importKatabijak implements ToCollection, WithCalculatedFormulas
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

                    $periksa = katabijak::where('judul', $row[6])->count();
                    if ($periksa > 0) {
                        $katabijak = katabijak::where('judul', $row[6])->first();
                        $katabijak_id = $katabijak->id;
                        // $jmlDiSkip++;
                        $periksaDetail = katabijakdetail::where('katabijak_id', $katabijak_id)
                            ->where('penjelasan', $row[1])->count();
                        if ($periksaDetail > 0) {
                            $periksaDetail_id = katabijakdetail::where('katabijak_id', $katabijak_id)
                                ->where('penjelasan', $row[1])->first();
                            katabijakdetail::where('id', $periksaDetail_id->id)
                                ->update([
                                    'penjelasan' => $row[1],
                                    'updated_at' => date("Y-m-d H:i:s")
                                ]);
                        } else {
                            katabijakdetail::insert(
                                array(
                                    'katabijak_id'     =>  $katabijak_id,
                                    'penjelasan' => $row[1],
                                    'deleted_at' => null,
                                    'created_at' => date("Y-m-d H:i:s"),
                                    'updated_at' => date("Y-m-d H:i:s")
                                )
                            );
                        }
                    } else {
                        // insertGetID

                        $katabijak_id = katabijak::insertGetId(
                            array(
                                'judul'     =>  $row[6],
                                'status'     =>  'Ditampilkan',
                                'deleted_at' => null,
                                'created_at' => date("Y-m-d H:i:s"),
                                'updated_at' => date("Y-m-d H:i:s")
                            )
                        );

                        $periksaDetail = katabijakdetail::where('katabijak_id', $katabijak_id)
                            ->where('penjelasan', $row[1])->count();
                        if ($periksaDetail > 0) {

                            $periksaDetail_id = katabijakdetail::where('katabijak_id', $katabijak_id)
                                ->where('penjelasan', $row[1])->first();
                            katabijakdetail::where('id', $periksaDetail_id->id)
                                ->update([
                                    'penjelasan' => $row[1],
                                    'updated_at' => date("Y-m-d H:i:s")
                                ]);
                        } else {
                            katabijakdetail::insert(
                                array(
                                    'katabijak_id'     =>  $katabijak_id,
                                    'penjelasan' => $row[1],
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
