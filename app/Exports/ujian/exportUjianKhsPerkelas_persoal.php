<?php

namespace App\Exports\ujian;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use App\Services\hasilPsikologiService;

class exportUjianKhsPerkelas_persoal implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $id;
    protected $items;
    protected $kategoris;

    function __construct($id, $items, $kategoris)
    {
        $this->id = $id;
        $this->items = $items;
        $this->kategoris = $kategoris;
    }

    public function headings(): array
    {
        $thead = ["-", "-", "-"];
        // $thead = ['id', 'nama', 'kelas'];
        // // $jml = count($this->listData);
        // // for ($i = 0; $i < $jml; $i++) {
        // //     array_push($thead, $this->listData[$i]);
        // // }
        foreach ($this->kategoris as $kategori) {
            $thead[] = $kategori->nama;
            for ($i = 1; $i < $kategori->jmlSoal; $i++) {
                $thead[] = null;
            }
            // $thead[] = $kategori->jmlSoal;
        }

        // ----------------------------
        // getData Kategori paketsoal
        // push to thead
        // // arraypush
        return $thead;
    }
    public function collection()
    {

        // testing push
        $items = $this->items;
        $kategoris = $this->kategoris;
        $datas = collect([]);

        $itemHeader = ['id', 'nama', 'kelas'];
        foreach ($this->kategoris as $kategori) {
            // $itemHeader[] = $kategori->nama;
            for ($i = 0; $i < $kategori->jmlSoal; $i++) {
                $itemHeader[] = $i + 1;
            }
            // $itemHeader[] = $kategori->jmlSoal;
        }
        $datas[] = $itemHeader;

        // kategori foreach then push to parrent
        foreach ($items as $item) {
            $temp = (object)[];
            $temp->id = $item->id;
            $temp->nama = $item->nama;
            $temp->kelas = $item->kelas_nama;
            // foreach ($item->kategori as $key => $kategori) {
            //     $temp->$key = $kategori->skor ? $kategori->skor : '-';
            // }
            $no = 0;
            foreach ($item->kategori as $key => $kategori) {
                foreach ($kategori->listSoal as $key => $list) {
                    $temp->$no = $list->nilai != null ? $list->nilai : '-';
                    $no++;
                }
            }
            $datas[] = $temp;
        }
        return $datas;
    }
}
