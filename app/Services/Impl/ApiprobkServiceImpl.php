<?php

namespace App\Services\Impl;

use App\Models\Gurubk;
use App\Models\label;
use App\Services\ApiprobkService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiprobkServiceImpl implements ApiprobkService
{
    public function getAll()
    {
        return DB::table('apiprobk')->get();
    }

    public function saveApiprobk($nama, string $desc, string $photo): void
    {
        $data['nama'] = $nama;
        $data['desc'] = $desc;
        $data['photo'] = $photo;
        // dd($data);
        label::create($data);
    }

    public function saveApiprobk2(array $request): void
    {
        $data = $request;
        label::create($data);
    }
}
