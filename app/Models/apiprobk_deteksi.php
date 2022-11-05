<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class apiprobk_deteksi extends Model
{
    public $table = "apiprobk_deteksi";
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'apiprobk_id',
        'no_induk',
        'nama',
        'umur',
        'jenis_kelamin',
        'sekolah',
        'kelas',
        'deteksi_total_persen',
        'deteksi_total_keterangan',
        'deteksi_eq_total_persen',
        'deteksi_eq_total_keterangan',
        'deteksi_sq_total_persen',
        'deteksi_sq_total_keterangan',
        'deteksi_scq_total_persen',
        'deteksi_scq_total_keterangan',
    ];
    public function apiprobk_deteksi_list()
    {
        return $this->hasMany('App\Models\apiprobk_deteksi_list');
    }
    public function apiprobk()
    {
        return $this->belongsTo('App\Models\apiprobk')->with('siswadetail');
    }
}
