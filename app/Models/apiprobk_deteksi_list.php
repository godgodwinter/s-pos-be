<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class apiprobk_deteksi_list extends Model
{
    public $table = "apiprobk_deteksi_list";
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'apiprobk_deteksi_id',
        'deteksi_nama',
        'deteksi_score',
        'deteksi_keterangan',
        'deteksi_rank',
    ];
    // public function apiprobk()
    // {
    //     return $this->belongsTo('App\Models\apiprobk');
    // }
    public function apiprobk_deteksi()
    {
        return $this->belongsTo('App\Models\apiprobk_deteksi');
    }
}
