<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ujian_proses_kelas_siswa_kategori extends Model
{
    public $table = "ujian_proses_kelas_siswa_kategori";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];


    protected $guarded = [];

    public function ujian_proses_kelas_siswa()
    {
        return $this->belongsTo('App\Models\ujian_proses_kelas_siswa');
    }
    public function ujian_paketsoal_kategori()
    {
        return $this->belongsTo('App\Models\ujian_paketsoal_kategori');
    }
}
