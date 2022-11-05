<?php

namespace Tests\Feature;

use App\Helpers\Fungsi2;
use App\Services\hasilPsikologiService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class hasilPsikologiServiceTest extends TestCase
{
    private hasilPsikologiService $hasilPsikologiService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->hasilPsikologiService = $this->app->make(hasilPsikologiService::class);
    }
    // public function testFungsi2()
    // {
    //     $item = Fungsi2::rupiah(20000);
    //     // dd($item);
    //     self::assertEquals('Rp 20.000,00', $item);
    //     // self::assertEquals('Rp 20.000,00');
    // }



    // FIXED
    public function testSiswa()
    {
        $siswa_id = 1;
        $item = $this->hasilPsikologiService->getSiswa($siswa_id);
        // dd($item);
        // self::assertNotNull($item);
        self::assertEquals('RISKA AULIA NAZARINA', $item->nama);
    }


    public function testTerapis()
    {
        $siswa_id = 1;
        $item = $this->hasilPsikologiService->getTerapis($siswa_id);
        // dd($item);
        self::assertNotNull($item);
    }

    public function testKecerdasanMajemuk()
    {
        $siswa_id = 1;
        $item = $this->hasilPsikologiService->getKecerdasanMajemuk($siswa_id);
        // dd($item);
        self::assertNotNull($item);
    }


    public function testGetPenanganan()
    {
        $siswa_id = 11;
        $item = $this->hasilPsikologiService->getPenanganan($siswa_id);
        // dd($item);
        // self::assertNotNull($item);
        self::assertNotNull($item);
    }
    // public function testGetDeteksi()
    // {
    //     $siswa_id = 1;
    //     $item = $this->hasilPsikologiService->getDeteksi($siswa_id);
    //     dd($item);
    //     // self::assertNotNull($item);
    //     self::assertEquals('Christian siantar', $item->nama);
    // }
    // FIXED
    // public function testTerapis()
    // {
    //     $siswa_id = 1;
    //     $item = $this->hasilPsikologiService->getTerapis($siswa_id);

    //     self::assertNotNull($item);
    //     // self::assertEquals('Christian siantar', $item->nama);
    // }
    // public function testSertikat()
    // {
    //     $siswa_id = 1;
    //     $item = $this->hasilPsikologiService->getSertifikat($siswa_id);
    //     dd($item);

    //     self::assertNotNull($item);
    //     // self::assertEquals('Christian siantar', $item->nama);
    // }
    public function testGayaBelajar()
    {
        $siswa_id = 10;
        $item = $this->hasilPsikologiService->getGayaBelajar($siswa_id);
        // dd($item);
        self::assertNotNull($item);
        // self::assertEquals('Christian siantar', $item->nama);
    }

    public function testgetHasilPsikologiWithDetail()
    {
        $sekolah_id = 2;
        $item = $this->hasilPsikologiService->getHasilPsikologiWithDetail($sekolah_id);
        // dd($item);
        // self::assertNotNull($item);
        self::assertNotNull($item);
    }

    // // fixed full
    // public function testAspekKepribadian()
    // {
    //     $siswa_id = 1;
    //     $dataSertifikat = $this->hasilPsikologiService->getSertifikat($siswa_id);
    //     $getAspekKepribadian = $this->hasilPsikologiService->getAspekKepribadian($dataSertifikat);
    //     // dd($getAspekKepribadian);
    //     $getAspekKepribadianTerkuat = $this->hasilPsikologiService->getAnalisaKepribadianTerkuat($getAspekKepribadian);
    //     // dd($getAspekKepribadianTerkuat);
    //     $getPositifDiungkap = $this->hasilPsikologiService->getPositifDiungkap($getAspekKepribadianTerkuat);
    //     dd($getPositifDiungkap);
    //     $item = $getPositifDiungkap;

    //     self::assertNotNull($item);
    // }
    // //  fixed full
    // php artisan test
}
