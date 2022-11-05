<?php

namespace Tests\Feature;

use App\Helpers\Fungsi2;
use App\Helpers\Fungsi;
use App\Services\ApiprobkService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class ApiprobkServiceTest extends TestCase
{
    private ApiprobkService $apiprobkService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->apiprobkService = $this->app->make(ApiprobkService::class);
    }

    public function testApiprobkNotNull()
    {
        self::assertNotNull($this->apiprobkService);
    }

    public function testGetAll()
    {
        $result = $this->apiprobkService->getAll();
        self::assertNotNull($result);
    }
    // public function testSaveApiprobk()
    // {
    //     $nama = 'nama';
    //     $desc = 'desc';
    //     $photo = 'photo';
    //     $this->apiprobkService->saveApiprobk($nama, $desc, $photo);
    //     $result = $this->apiprobkService->getAll();
    //     self::assertNotNull($result);
    // }


    // public function testSaveApiprobk2()
    // {
    //     $request = [
    //         'nama' => 'nama',
    //         'desc' => 'desc',
    //         'photo' => 'photo',
    //     ];
    //     $this->apiprobkService->saveApiprobk2($request);
    //     $result = $this->apiprobkService->getAll();
    //     self::assertNotNull($result);
    // }

    public function testFungsi2()
    {
        $item = Fungsi2::rupiah(20000);
        // dd($item);
        self::assertEquals('Rp 20.000,00', $item);
        // self::assertEquals('Rp 20.000,00');
    }
}
