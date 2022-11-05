<?php

namespace Tests\Feature;

use App\Helpers\Fungsi2;
use App\Helpers\Fungsi;
use App\Services\UjianService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class ujianServiceTest extends TestCase
{
    private UjianService $UjianService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->UjianService = $this->app->make(UjianService::class);
    }

    public function testGetAll()
    {
        $result = $this->UjianService->getAll();
        self::assertNotNull($result);
    }
}
