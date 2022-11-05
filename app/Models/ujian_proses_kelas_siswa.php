<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ujian_proses_kelas_siswa extends Model
{
    public $table = "ujian_proses_kelas_siswa";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];


    protected $guarded = [];

    public function siswa()
    {
        return $this->belongsTo('App\Models\siswa');
    }
    public function ujian_proses_kelas()
    {
        return $this->belongsTo('App\Models\ujian_proses_kelas')
            ->with('ujian_proses')
            ->with('paketsoal');
    }
}
