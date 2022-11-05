<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ujian_proses_kelas extends Model
{
    public $table = "ujian_proses_kelas";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];


    protected $guarded = [];

    public function ujian_proses()
    {
        return $this->belongsTo('App\Models\ujian_proses')->with('sekolah');
    }
    public function paketsoal()
    {
        return $this->belongsTo('App\Models\ujian_paketsoal')->with('ujian_paketsoal_kategori');
    }
    public function kelas()
    {
        return $this->belongsTo('App\Models\kelas');
    }
    public function ujian_proses_kelas_siswa()
    {
        return $this->belongsTo('App\Models\ujian_proses_kelas_siswa')->with('siswa');
    }
}
