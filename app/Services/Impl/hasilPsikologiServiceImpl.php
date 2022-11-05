<?php

namespace App\Services\Impl;

use App\Helpers\Fungsi2;
use App\Models\apiprobk;
use App\Models\apiprobk_deteksi;
use App\Models\apiprobk_sertifikat;
use App\Models\kecerdasanmajemuk;
use App\Models\kelas;
use App\Models\master_minatbakat;
use App\Models\master_penjurusan;
use App\Models\masterdeteksi;
use App\Models\paket;
use App\Models\sekolah;
use App\Models\Siswa;
use App\Models\siswadetail;
use App\Models\terapiskarakterpositif;
use App\Services\hasilPsikologiService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class hasilPsikologiServiceImpl implements hasilPsikologiService
{
    public function getSiswa(string $siswa_id)
    {

        $item = Siswa::where('id', $siswa_id)
            ->first();
        $getSekolah = sekolah::where('id', $item->sekolah_id)->first();
        $item->sekolah_nama = $getSekolah ? $getSekolah->nama : '';
        $getKelas = kelas::where('id', $item->kelas_id)->first();
        $item->kelas_nama = $getKelas ? $getKelas->nama : '';
        $getApiprobk = siswadetail::where('siswa_id', $item->id)->where('status', 'Aktif')->first();
        $getDataDeteksi = apiprobk_deteksi::where('apiprobk_id', $getApiprobk->id)->first();
        $item->umur = $getDataDeteksi ? $getDataDeteksi->umur : '';
        $getDataPaket = paket::where('id', $getSekolah->paket_id)->first();
        $item->paket = $getDataPaket ? $getDataPaket : $this->fnGetPaket();
        return $item;
    }


    // DETEKSI KARAKTER POSITIF
    public function getDeteksi(string $siswa_id)
    {
        $item = [];
        $siswadetail = siswadetail::where('siswa_id', $siswa_id)
            ->where('status', 'Aktif')
            ->first();
        $apiprobk_id = $siswadetail->apiprobk_id;
        $getDeteksi = apiprobk_deteksi::with('apiprobk_deteksi_list')->where('apiprobk_id', $apiprobk_id)
            ->first();
        $item = $getDeteksi;
        return $item;
    }
    protected $siswa_id;
    public function getPenanganan(string $siswa_id)
    {
        $this->siswa_id = $siswa_id;
        $item = [];
        $siswadetail = siswadetail::where('siswa_id', $siswa_id)
            ->where('status', 'Aktif')
            ->first();


        $masterdeteksi = masterdeteksi::get();
        $getDeteksi = apiprobk_deteksi::with('apiprobk_deteksi_list')->with('apiprobk')->whereHas('apiprobk', function ($query) {
            $query->whereHas('siswadetail', function ($query2) {
                $query2->where('siswadetail.siswa_id', $this->siswa_id);
            });
        })
            ->first();
        $items = (object)[];
        $items->id = $siswa_id;
        $items->nama = $siswadetail->nama;
        $items->umur = $getDeteksi->umur;
        $deteksi = [];
        foreach ($getDeteksi->apiprobk_deteksi_list as $md) {
            $penanganan = null;

            if ($md->deteksi_score > 54 && $md->deteksi_score < 100) {
                $getKet = $this->fnPenangananCariKet($md->deteksi_score, $md->deteksi_nama);
                if ($getKet) {
                    $penanganan = $getKet;
                }

                // jika dimaster tidak ditemukan maka tidak diinput
                if ($penanganan) {
                    $subDeteksi = (object)[];
                    $subDeteksi->id = $md->id;
                    $subDeteksi->nama = $md->deteksi_nama;
                    $subDeteksi->score = $md->deteksi_score;
                    $subDeteksi->keterangan = $md->deteksi_keterangan;
                    $subDeteksi->penanganan = $penanganan;
                    $subDeteksi->singkatan = Fungsi2::singkatan($md->deteksi_score);
                    array_push($deteksi, $subDeteksi);
                }
            }


            // dd($md, $getNamaMaster);
        }
        $item = $deteksi;
        return $item;
    }


    //SERTIFIKAT
    public function getSertifikat(string $siswa_id)
    {
        $item = [];
        $siswadetail = siswadetail::where('siswa_id', $siswa_id)
            ->where('status', 'Aktif')
            ->first();
        $apiprobk_id = $siswadetail->apiprobk_id;
        $getSertifikat = apiprobk_sertifikat::where('apiprobk_id', $apiprobk_id)
            ->first();
        $item = $getSertifikat;
        return $item;
    }

    //GAYA BELAJAR
    public function getGayaBelajar($sertifikat_id)
    {
        $item = (object)[];
        // $siswadetail = siswadetail::where('siswa_id', $siswa_id)
        //     ->where('status', 'Aktif')
        //     ->first();
        // $apiprobk_id = $siswadetail->apiprobk_id;
        // bug
        $getSertifikat = apiprobk_sertifikat::where('id', $sertifikat_id)
            ->select(
                'id',
                'iq',
                // KM LIST
                'kb_persen',
                'km_persen',
                'ks_persen',
                'kk_persen',
                'kbh',
                'kb_persen',
                'ksh',
                'ks_persen',
                'kkh',
                'kk_persen',
                // NILAI PSIKOLOGI

            )
            ->first();

        $item->iq = $getSertifikat->iq;
        $item->kb_persen = $getSertifikat->kb_persen;
        $item->km_persen = $getSertifikat->km_persen;
        // 2 angka dibelakang koma
        $item->prosentase_auditif = number_format(($getSertifikat->km_persen + $getSertifikat->kb_persen) / 2, 2, '.', '');
        $item->prosentase_visual = $getSertifikat->ks_persen;
        $item->prosentase_kinestetik = $getSertifikat->kk_persen;
        $item->keterangan_auditif = $getSertifikat->kbh;
        $item->keterangan_auditif_persen = $getSertifikat->kb_persen;
        $item->keterangan_visual = $getSertifikat->ksh;
        $item->keterangan_visual_persen = $getSertifikat->ks_persen;
        $item->keterangan_kinestetik = $getSertifikat->kkh;
        $item->keterangan_kinestetik_persen = $getSertifikat->kk_persen;

        // urutkan
        $tempData = [];
        $objAuditif = (object)[];
        $objAuditif->id = 1;
        $objAuditif->nama = 'Auditif';
        $objAuditif->persen = $item->keterangan_auditif_persen;
        $objAuditif->keterangan = $item->keterangan_auditif;
        array_push($tempData, $objAuditif);

        $objVisual = (object)[];
        $objVisual->id = 2;
        $objVisual->nama = 'Visual';
        $objVisual->persen = $item->keterangan_visual_persen;
        $objVisual->keterangan = $item->keterangan_visual;
        array_push($tempData, $objVisual);

        $objKinestetik = (object)[];
        $objKinestetik->id = 3;
        $objKinestetik->nama = 'Kinestetik';
        $objKinestetik->persen = $item->keterangan_kinestetik_persen;
        $objKinestetik->keterangan = $item->keterangan_kinestetik;
        array_push($tempData, $objKinestetik);

        $item->data = $tempData;
        // sort Data by persen desc
        usort($item->data, function ($a, $b) {
            return $b->persen - $a->persen;
        });
        // get position where nama == 'Auditif'
        $item->rank_auditif = array_search('Auditif', array_column($item->data, 'nama')) + 1;
        $item->rank_visual = array_search('Visual', array_column($item->data, 'nama')) + 1;
        $item->rank_kinestetik = array_search('Kinestetik', array_column($item->data, 'nama')) + 1;

        return $item;
    }



    // TERAPIS
    public function getKecerdasanMajemuk(string $siswa_id) //sudah diurutkan
    {
        $item = [];
        //create objeckt Data Kecerdasan Majemuk
        $dataSertifikat = $this->getSertifikat($siswa_id);

        $datas = [
            (object)[
                'nama' => "Kecerdasan Linguistik",
                'persen' => $dataSertifikat->kb_persen,
                'ket' => $dataSertifikat->kbh,
                'kepanjangan' => Fungsi2::fnKecerdasanList($dataSertifikat->kbh),
                'data' => $this->fnGetKeteranganKecerdasanMajemuk("Kecerdasan Linguistik"),
            ],
            (object)[
                'nama' => "Kecerdasan Logis - Matematis",
                'persen' => $dataSertifikat->lm_persen,
                'ket' => $dataSertifikat->lmh,
                'kepanjangan' => Fungsi2::fnKecerdasanList($dataSertifikat->lmh),
                'data' => $this->fnGetKeteranganKecerdasanMajemuk("Kecerdasan Logis - Matematis"),
            ],
            (object)[
                // 'nama' => "Kecerdasan Spasial",
                'nama' => "Kecerdasan Spasial",
                'persen' => $dataSertifikat->ks_persen,
                'ket' => $dataSertifikat->ksh,
                'kepanjangan' => Fungsi2::fnKecerdasanList($dataSertifikat->ksh),
                'data' => $this->fnGetKeteranganKecerdasanMajemuk("Kecerdasan Spasial"),
            ],
            (object)[
                'nama' => "Kecerdasan Musikal",
                'persen' => $dataSertifikat->km_persen,
                'ket' => $dataSertifikat->kmh,
                'kepanjangan' => Fungsi2::fnKecerdasanList($dataSertifikat->kmh),
                'data' => $this->fnGetKeteranganKecerdasanMajemuk("Kecerdasan Musikal"),
            ],
            (object)[
                // 'nama' => "Kecerdasan Kinetik",
                'nama' => "Kecerdasan Kinetik",
                'persen' => $dataSertifikat->kk_persen,
                'ket' => $dataSertifikat->kkh,
                'kepanjangan' => Fungsi2::fnKecerdasanList($dataSertifikat->kkh),
                'data' => $this->fnGetKeteranganKecerdasanMajemuk("Kecerdasan Kinetik"),
            ],
            (object)[
                'nama' => "Kecerdasan Interpersonal",
                'persen' => $dataSertifikat->ki_persen,
                'ket' => $dataSertifikat->kih,
                'kepanjangan' => Fungsi2::fnKecerdasanList($dataSertifikat->kih),
                'data' => $this->fnGetKeteranganKecerdasanMajemuk("Kecerdasan Interpersonal"),
            ],
            (object)[
                'nama' => "Kecerdasan Intrapersonal",
                'persen' => $dataSertifikat->ka_persen,
                'ket' => $dataSertifikat->kah,
                'kepanjangan' => Fungsi2::fnKecerdasanList($dataSertifikat->kah),
                'data' => $this->fnGetKeteranganKecerdasanMajemuk("Kecerdasan Intrapersonal"),
            ],
            (object)[
                'nama' => "Kecerdasan Natural",
                'persen' => $dataSertifikat->kn_persen,
                'ket' => $dataSertifikat->knh,
                'kepanjangan' => Fungsi2::fnKecerdasanList($dataSertifikat->knh),
                'data' => $this->fnGetKeteranganKecerdasanMajemuk("Kecerdasan Natural"),
            ],
        ];

        // DESC sort
        usort($datas, fn ($a, $b) => $a->persen < $b->persen);
        // $datas=
        // ambil data dari sertifikat sesuai nama field
        // urutkan sesuai rank
        return $datas;
    }

    // TERAPIS
    public function getTerapis(string $siswa_id)
    {
        $item = [];
        $dataSertifikat = $this->getSertifikat($siswa_id);
        $getAspekKepribadian = $this->getAspekKepribadian($dataSertifikat);
        // dd($getAspekKepribadian);
        $getAspekKepribadianTerkuat = $this->getAnalisaKepribadianTerkuat($getAspekKepribadian);
        // dd($getAspekKepribadianTerkuat);
        $getPositifDiungkap = $this->getPositifDiungkap($getAspekKepribadianTerkuat);
        $item = $getPositifDiungkap;
        return $item;
    }

    // Fungsi

    public function fnGetPaket()
    {

        $hasil = paket::first();
        return $hasil;
    }
    public function fnGetKeteranganKecerdasanMajemuk($nama)
    {
        $hasil = kecerdasanmajemuk::where('nama', 'LIKE', "%$nama%")->first();
        return $hasil;
    }

    public function fnPenangananCariKet($score, $nama)
    {
        $hasil = null;
        $periksa = masterdeteksi::with('penanganandeteksimasalah')->where('nama', $nama)->count();
        if ($periksa > 0) {
            $getMasterDeteksi = masterdeteksi::with('penanganandeteksimasalah')->where('nama', $nama)->first();
            foreach ($getMasterDeteksi->penanganandeteksimasalah as $item) {
                if ($score <= $item->batasatas && $score >= $item->batasbawah) {
                    $hasil = $item->keterangan;
                }
            }
        } else {
            $hasil = '';
        }

        return $hasil;
    }

    public function fnSplitParsingKata(string $kalimat)
    {
        $item = [];
        $str_arr = preg_split("/\,/", $kalimat);

        foreach ($str_arr as $value) {
            // $replace = str_replace('/[^a-z0-9\s\-]/gi', '', strtolower(trim($value)));
            $replace = preg_replace('[^a-z0-9\s\-]', '', strtolower(trim($value)));
            $removeSikap = trim(str_replace(':', '', str_replace('sikap', '', $replace)));
            $item[] = $removeSikap;
        }
        // pisahkan per koma (,)
        // pisahkan titik (2) : .replace("Sikap", "")
        // replace(/[^a-z0-9\s\-]/gi, "")


        // jadikan hurufkecil semua , trim
        // $item = $str_arr;
        return $item; //array dengan kata yang sudah di parsing
    }


    public function fnTerapisSolusi(array $dataParsing)
    {
        $item = [];
        foreach ($dataParsing as $data) {
            $obj = (object)[];
            $cari = terapiskarakterpositif::where('namakarakter', 'LIKE', "%$data%")->first();
            $obj->kata = $data;
            $obj->namakarakter = $cari ? $cari->namakarakter : '';
            $obj->pemahaman = $cari ? $cari->pemahaman : '';
            $obj->tujuandanmanfaat = $cari ? $cari->tujuandanmanfaat : '';
            $obj->pembiasaansikap = $cari ? $cari->pembiasaansikap : '';
            $item[] = $obj;
        }
        return $item;
    }

    // data

    // HASIL PSIKOLOGI
    public function getHasilPsikologiWithDetail($sekolah_id)
    {
        $items = Siswa::with('kelas')
            ->with('siswadetailwithsertifikat') //bug terlalu banyak data
            // ->with('siswadetail')
            ->select('id', 'nomeridentitas', 'nama', 'kelas_id', 'username', 'passworddefault')
            ->where('sekolah_id', $sekolah_id)
            // ->where('id', 31)
            // ->skip(0)
            // ->take(2)
            ->orderBy('kelas_id', 'asc')
            ->orderBy('nama', 'asc')
            ->get();

        // $getSertifikat = apiprobk_sertifikat::where('apiprobk_id', $items[0]->siswadetailwithsertifikat ? $items[0]->siswadetailwithsertifikat->apiprobk_id : '')->count();
        // dd($getSertifikat);
        // dd($items);
        // $items = $sekolah_id;

        foreach ($items as $key => $item) {
            $items[$key]->kelas_nama = $item->kelas->nama;
            // dd($item);
            $items[$key]->apiprobk_id = $item->siswadetailwithsertifikat ? $item->siswadetailwithsertifikat->apiprobk_id : null;
            $items[$key]->sertifikat = null;
            // dd($item->siswadetailwithsertifikat);
            //gak boleh select all
            // $getSertifikat = apiprobk_sertifikat::where('apiprobk_id', $item->siswadetailwithsertifikat->apiprobk_id)->select('id', 'nama')->first();
            $getSertifikat = apiprobk_sertifikat::where('apiprobk_id', $item->siswadetailwithsertifikat ? $item->siswadetailwithsertifikat->apiprobk_id : '')
                ->select(
                    '*'
                );
            // dd($getSertifikat->first());
            if ($getSertifikat->count() > 0) {
                $items[$key]->sertifikat = $getSertifikat->count();
                $items[$key]->sertifikat_data = $getSertifikat->first();

                $dataBelajar = $this->getGayaBelajar($items[$key]->sertifikat_data->id); //sertifikat_id
                // dd($dataBelajar);
                // merge property dataBelajar ke items property
                // $items[$key]->sertifikat_data->gayaBelajar = $dataBelajar;
                $items[$key]->sertifikat_data->iq = $dataBelajar->iq;
                $items[$key]->sertifikat_data->kb_persen = $dataBelajar->kb_persen;
                $items[$key]->sertifikat_data->km_persen = $dataBelajar->km_persen;
                $items[$key]->sertifikat_data->prosentase_auditif = $dataBelajar->prosentase_auditif;
                $items[$key]->sertifikat_data->prosentase_visual = $dataBelajar->prosentase_visual;
                $items[$key]->sertifikat_data->prosentase_kinestetik = $dataBelajar->prosentase_kinestetik;
                $items[$key]->sertifikat_data->keterangan_auditif = $dataBelajar->keterangan_auditif;
                $items[$key]->sertifikat_data->keterangan_visual = $dataBelajar->keterangan_visual;
                $items[$key]->sertifikat_data->keterangan_kinestetik = $dataBelajar->keterangan_kinestetik;
                $items[$key]->sertifikat_data->rank_auditif = $dataBelajar->rank_auditif;
                $items[$key]->sertifikat_data->rank_visual = $dataBelajar->rank_visual;
                $items[$key]->sertifikat_data->rank_kinestetik = $dataBelajar->rank_kinestetik;


                $getDataMasterAnalisaMinatBakat = master_minatbakat::where('siswa_id', $item->id);
                // dd($items[$key]->sertifikat_data);
                // dd($getDataMasterAnalisaMinatBakat->count());

                if ($getDataMasterAnalisaMinatBakat->count() > 0) {
                    $dataMasterAnalisaMinatBakat = $getDataMasterAnalisaMinatBakat->first();
                    $items[$key]->sertifikat_data->hobi = $dataMasterAnalisaMinatBakat->hobi;
                    $items[$key]->sertifikat_data->pekerjaanbapak = $dataMasterAnalisaMinatBakat->pekerjaanbapak;
                    $items[$key]->sertifikat_data->pekerjaanibu = $dataMasterAnalisaMinatBakat->pekerjaanibu;
                    $items[$key]->sertifikat_data->pekerjaankakek = $dataMasterAnalisaMinatBakat->pekerjaankakek;
                    $items[$key]->sertifikat_data->analisapekerjaan = $dataMasterAnalisaMinatBakat->analisapekerjaan;
                }
                // dd($items[$key]->sertifikat_data);
                $getDataMasterAnalisaPenjurusan = master_penjurusan::where('siswa_id', $item->id);
                if ($getDataMasterAnalisaPenjurusan->count() > 0) {
                    $dataMasterAnalisaPenjurusan = $getDataMasterAnalisaPenjurusan->first();
                    $items[$key]->sertifikat_data->keterangan = $dataMasterAnalisaPenjurusan->keterangan;
                }

                $items[$key]->terapis = $getSertifikat->count();
            }
            // dd($getSertifikat->count());
            $getDeteksi = apiprobk_deteksi::where('apiprobk_id', $item->siswadetailwithsertifikat ? $item->siswadetailwithsertifikat->apiprobk_id : '');
            // dd($getDeteksi->first());
            if ($getDeteksi->count() > 0) {
                $items[$key]->deteksi = $getDeteksi->count();
                // $items[$key]->deteksi_data = $getDeteksi->first();
                $items[$key]->penanganan = $getDeteksi->count();
            }
            // dd($getDeteksi);
            unset($items[$key]->siswadetailwithsertifikat);
            unset($items[$key]->kelas);
            // dd($items[$key]->sertifikat_data);
        }
        // dd($items, 'akhir');
        return $items;
    }
    public function getHasilPsikologiWithDetail_perkelas($kelas_id)
    {
        $items = Siswa::with('kelas')
            ->with('siswadetailwithsertifikat') //bug terlalu banyak data
            // ->with('siswadetail')
            ->select('id', 'nomeridentitas', 'nama', 'kelas_id', 'username', 'passworddefault',)
            ->where('kelas_id', $kelas_id)
            // ->where('id', 31)
            // ->skip(0)
            // ->take(2)
            ->orderBy('kelas_id', 'asc')
            ->orderBy('nama', 'asc')
            ->get();
        // dd($items->nama, $items->siswadetailwithsertifikat->apiprobkwithsertifikat->apiprobk_sertifikat);
        // $getSertifikat = apiprobk_sertifikat::where('apiprobk_id', $items[0]->siswadetailwithsertifikat ? $items[0]->siswadetailwithsertifikat->apiprobk_id : '')->count();
        // dd($getSertifikat);
        // dd($items);
        // $items = $sekolah_id;

        foreach ($items as $key => $item) {
            $items[$key]->kelas_nama = $item->kelas->nama;
            // dd($item);
            $items[$key]->apiprobk_id = $item->siswadetailwithsertifikat ? $item->siswadetailwithsertifikat->apiprobk_id : null;
            $items[$key]->sertifikat = null;
            // dd($item->siswadetailwithsertifikat);
            //gak boleh select all
            // $getSertifikat = apiprobk_sertifikat::where('apiprobk_id', $item->siswadetailwithsertifikat->apiprobk_id)->select('id', 'nama')->first();
            // $getSertifikat = apiprobk_sertifikat::where('apiprobk_id', $item->siswadetailwithsertifikat ? $item->siswadetailwithsertifikat->apiprobk_id : '')
            //     ->select(
            //     );
            $getSertifikat = $item->siswadetailwithsertifikat->apiprobkwithsertifikat->apiprobk_sertifikat;
            // dd($item->nama, $getSertifikat);
            // dd($getSertifikat->first());
            // dd($getSertifikat->first());
            if ($getSertifikat) {
                $items[$key]->sertifikat = 1;
                $items[$key]->sertifikat_data = $getSertifikat;

                $dataBelajar = $this->getGayaBelajar($items[$key]->sertifikat_data->id); //sertifikat_id
                // dd($dataBelajar);
                // merge property dataBelajar ke items property
                // $items[$key]->sertifikat_data->gayaBelajar = $dataBelajar;
                $items[$key]->sertifikat_data->iq = $dataBelajar->iq;
                $items[$key]->sertifikat_data->kb_persen = $dataBelajar->kb_persen;
                $items[$key]->sertifikat_data->km_persen = $dataBelajar->km_persen;
                $items[$key]->sertifikat_data->prosentase_auditif = $dataBelajar->prosentase_auditif;
                $items[$key]->sertifikat_data->prosentase_visual = $dataBelajar->prosentase_visual;
                $items[$key]->sertifikat_data->prosentase_kinestetik = $dataBelajar->prosentase_kinestetik;
                $items[$key]->sertifikat_data->keterangan_auditif = $dataBelajar->keterangan_auditif;
                $items[$key]->sertifikat_data->keterangan_visual = $dataBelajar->keterangan_visual;
                $items[$key]->sertifikat_data->keterangan_kinestetik = $dataBelajar->keterangan_kinestetik;
                $items[$key]->sertifikat_data->rank_auditif = $dataBelajar->rank_auditif;
                $items[$key]->sertifikat_data->rank_visual = $dataBelajar->rank_visual;
                $items[$key]->sertifikat_data->rank_kinestetik = $dataBelajar->rank_kinestetik;


                $getDataMasterAnalisaMinatBakat = master_minatbakat::where('siswa_id', $item->id);
                // dd($items[$key]->sertifikat_data);
                // dd($getDataMasterAnalisaMinatBakat->count());

                if ($getDataMasterAnalisaMinatBakat->count() > 0) {
                    $dataMasterAnalisaMinatBakat = $getDataMasterAnalisaMinatBakat->first();
                    $items[$key]->sertifikat_data->hobi = $dataMasterAnalisaMinatBakat->hobi;
                    $items[$key]->sertifikat_data->pekerjaanbapak = $dataMasterAnalisaMinatBakat->pekerjaanbapak;
                    $items[$key]->sertifikat_data->pekerjaanibu = $dataMasterAnalisaMinatBakat->pekerjaanibu;
                    $items[$key]->sertifikat_data->pekerjaankakek = $dataMasterAnalisaMinatBakat->pekerjaankakek;
                    $items[$key]->sertifikat_data->analisapekerjaan = $dataMasterAnalisaMinatBakat->analisapekerjaan;
                }
                // dd($items[$key]->sertifikat_data);
                $getDataMasterAnalisaPenjurusan = master_penjurusan::where('siswa_id', $item->id);
                if ($getDataMasterAnalisaPenjurusan->count() > 0) {
                    $dataMasterAnalisaPenjurusan = $getDataMasterAnalisaPenjurusan->first();
                    $items[$key]->sertifikat_data->keterangan = $dataMasterAnalisaPenjurusan->keterangan;
                }

                $items[$key]->terapis = $getSertifikat->count();
            }
            // dd($getSertifikat->count());
            $getDeteksi = apiprobk_deteksi::where('apiprobk_id', $item->siswadetailwithsertifikat ? $item->siswadetailwithsertifikat->apiprobk_id : '');
            // dd($getDeteksi->first());
            if ($getDeteksi->count() > 0) {
                $items[$key]->deteksi = $getDeteksi->count();
                // $items[$key]->deteksi_data = $getDeteksi->first();
                $items[$key]->penanganan = $getDeteksi->count();
            }
            // dd($getDeteksi);
            unset($items[$key]->siswadetailwithsertifikat);
            unset($items[$key]->kelas);
            // dd($items[$key]->sertifikat_data);
        }
        // dd($items, 'akhir');
        return $items;
    }

    // ANALISA KEPRIBADIAN TERKUAT

    public function getPositifDiungkap(array $getAspekKepribadianTerkuat)
    {
        $item = [];
        foreach ($getAspekKepribadianTerkuat as $data) {
            $temp = (object)[];
            $temp->label = $data->positif_diungkap;
            $dataParsing = $this->fnSplitParsingKata($data->positif_diungkap);
            $data = $this->fnTerapisSolusi($dataParsing);
            $temp->data = $data;
            array_push($item,  $temp);
        }
        return $item; //array 5 data teratas dari aspek yang telah diurutkan //asc
    }

    public function getAnalisaKepribadianTerkuat(array $aspekKepribadianRank)
    {
        $item = [];

        $item = array_slice($aspekKepribadianRank, 0, 5);
        return $item; //array 5 data teratas dari aspek yang telah diurutkan //asc
    }


    public function getAspekKepribadian(object $dataSertifikat)
    {
        // $item = $dataSertifikat->hspq_a_kr_rank;
        $item = [];
        $aspekKepribadianRank = [
            (object) [
                'nama' => "Faktor Sikap Dingin",
                'rank' => $dataSertifikat->hspq_a_kr_rank,
                'persen' => $dataSertifikat->hspq_a_kr_persen,
                'ket' => $dataSertifikat->hspq_a_kr_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_a_kr_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_a_kr_aspek_negatif_di_ungkap,
            ],
            (object) [
                'nama' => "Faktor Sikap Emosi Labil",
                'rank' => $dataSertifikat->hspq_c_kr_rank,
                'persen' => $dataSertifikat->hspq_c_kr_persen,
                'ket' => $dataSertifikat->hspq_c_kr_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_c_kr_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_c_kr_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Sikap Sulit Bergairah",
                'rank' => $dataSertifikat->hspq_d_kr_rank,
                'persen' => $dataSertifikat->hspq_d_kr_persen,
                'ket' => $dataSertifikat->hspq_d_kr_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_d_kr_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_d_kr_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Patuh atau Tunduk",
                'rank' => $dataSertifikat->hspq_e_kr_rank,
                'persen' => $dataSertifikat->hspq_e_kr_persen,
                'ket' => $dataSertifikat->hspq_e_kr_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_e_kr_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_e_kr_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Sungguh-sungguh",
                'rank' => $dataSertifikat->hspq_f_kr_rank,
                'persen' => $dataSertifikat->hspq_f_kr_persen,
                'ket' => $dataSertifikat->hspq_f_kr_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_f_kr_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_f_kr_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Menolak Peraturan",
                'rank' => $dataSertifikat->hspq_g_kr_rank,
                'persen' => $dataSertifikat->hspq_g_kr_persen,
                'ket' => $dataSertifikat->hspq_g_kr_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_g_kr_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_g_kr_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Sikap Keras Hati",
                'rank' => $dataSertifikat->hspq_h_kr_rank,
                'persen' => $dataSertifikat->hspq_h_kr_persen,
                'ket' => $dataSertifikat->hspq_h_kr_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_h_kr_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_h_kr_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' =>  "Faktor Sikap Pemalu",
                'rank' => $dataSertifikat->hspq_i_kr_rank,
                'persen' => $dataSertifikat->hspq_i_kr_persen,
                'ket' => $dataSertifikat->hspq_i_kr_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_i_kr_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_i_kr_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Sikap Bersemangat",
                'rank' => $dataSertifikat->hspq_j_kr_rank,
                'persen' => $dataSertifikat->hspq_j_kr_persen,
                'ket' => $dataSertifikat->hspq_j_kr_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_j_kr_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_j_kr_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Sikap Percaya Diri",
                'rank' => $dataSertifikat->hspq_o_kr_rank,
                'persen' => $dataSertifikat->hspq_o_kr_persen,
                'ket' => $dataSertifikat->hspq_o_kr_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_o_kr_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_o_kr_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Sikap Kurang Mandiri",
                'rank' => $dataSertifikat->hspq_q2_kr_rank,
                'persen' => $dataSertifikat->hspq_q2_kr_persen,
                'ket' => $dataSertifikat->hspq_q2_kr_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_q2_kr_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_q2_kr_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Sikap Kurang Disiplin",
                'rank' => $dataSertifikat->hspq_q3_kr_rank,
                'persen' => $dataSertifikat->hspq_q3_kr_persen,
                'ket' => $dataSertifikat->hspq_q3_kr_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_q3_kr_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_q3_kr_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Sikap Rileks atau santai",
                'rank' => $dataSertifikat->hspq_q4_kr_rank,
                'persen' => $dataSertifikat->hspq_q4_kr_persen,
                'ket' => $dataSertifikat->hspq_q4_kr_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_q4_kr_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_q4_kr_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' =>  "Faktor Sikap Hangat",
                'rank' => $dataSertifikat->hspq_a_kn_rank,
                'persen' => $dataSertifikat->hspq_a_kn_persen,
                'ket' => $dataSertifikat->hspq_a_kn_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_a_kn_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_a_kn_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Sikap Emosi Stabil",
                'rank' => $dataSertifikat->hspq_c_kn_rank,
                'persen' => $dataSertifikat->hspq_c_kn_persen,
                'ket' => $dataSertifikat->hspq_c_kn_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_c_kn_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_c_kn_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' =>  "Faktor Sikap Bergairah",
                'rank' => $dataSertifikat->hspq_d_kn_rank,
                'persen' => $dataSertifikat->hspq_d_kn_persen,
                'ket' => $dataSertifikat->hspq_d_kn_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_d_kn_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_d_kn_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Sikap Dominasi",
                'rank' => $dataSertifikat->hspq_e_kn_rank,
                'persen' => $dataSertifikat->hspq_e_kn_persen,
                'ket' => $dataSertifikat->hspq_e_kn_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_e_kn_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_e_kn_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Sikap Keceriaan",
                'rank' => $dataSertifikat->hspq_f_kn_rank,
                'persen' => $dataSertifikat->hspq_f_kn_persen,
                'ket' => $dataSertifikat->hspq_f_kn_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_f_kn_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_f_kn_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Sikap Taat Peraturan",
                'rank' => $dataSertifikat->hspq_g_kn_rank,
                'persen' => $dataSertifikat->hspq_g_kn_persen,
                'ket' => $dataSertifikat->hspq_g_kn_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_g_kn_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_g_kn_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Sikap Lembut Hati / Peka",
                'rank' => $dataSertifikat->hspq_h_kn_rank,
                'persen' => $dataSertifikat->hspq_h_kn_persen,
                'ket' => $dataSertifikat->hspq_h_kn_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_h_kn_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_h_kn_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Sikap Pemberani",
                'rank' => $dataSertifikat->hspq_i_kn_rank,
                'persen' => $dataSertifikat->hspq_i_kn_persen,
                'ket' => $dataSertifikat->hspq_i_kn_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_i_kn_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_i_kn_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Sikap Menarik Diri",
                'rank' => $dataSertifikat->hspq_j_kn_rank,
                'persen' => $dataSertifikat->hspq_j_kn_persen,
                'ket' => $dataSertifikat->hspq_j_kn_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_j_kn_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_j_kn_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Sikap Ketakutan",
                'rank' => $dataSertifikat->hspq_o_kn_rank,
                'persen' => $dataSertifikat->hspq_o_kn_persen,
                'ket' => $dataSertifikat->hspq_o_kn_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_o_kn_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_o_kn_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Sikap Mandiri",
                'rank' => $dataSertifikat->hspq_q2_kn_rank,
                'persen' => $dataSertifikat->hspq_q2_kn_persen,
                'ket' => $dataSertifikat->hspq_q2_kn_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_q2_kn_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_q2_kn_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' => "Faktor Sikap Disiplin",
                'rank' => $dataSertifikat->hspq_q3_kn_rank,
                'persen' => $dataSertifikat->hspq_q3_kn_persen,
                'ket' => $dataSertifikat->hspq_q3_kn_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_q3_kn_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_q3_kn_aspek_negatif_di_ungkap,
            ],
            (object)   [
                'nama' =>  "Faktor Sikap Tegang",
                'rank' => $dataSertifikat->hspq_q4_kn_rank,
                'persen' => $dataSertifikat->hspq_q4_kn_persen,
                'ket' => $dataSertifikat->hspq_q4_kn_keterangan,
                'positif_diungkap' => $dataSertifikat->hspq_q4_kn_aspek_positif_di_ungkap,
                'negatif_diungkap' => $dataSertifikat->hspq_q4_kn_aspek_negatif_di_ungkap,
            ],
        ];

        // Asc sort
        usort($aspekKepribadianRank, fn ($a, $b) => $a->rank > $b->rank);


        $item = $aspekKepribadianRank;
        return $item;  //array yang sudah diurutkan berdasarkan rank
    }

    // ARSIP

    // usort($aspekKepribadianRank, fn ($a, $b) => strcmp($a['rank'], $b['rank']));

    // usort($aspekKepribadianRank, function ($first, $second) {
    //     return strtolower($first['rank']) > strtolower($second['rank']);
    // });

    // $item = $aspekKepribadianRank[0]['ket'];
}
