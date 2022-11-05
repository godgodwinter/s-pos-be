<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ujian_banksoal extends Model
{
    public $table = "ujian_banksoal";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];


    protected $guarded = [];

    public function ujian_kategori()
    {
        return $this->belongsTo('App\Models\ujian_kategori');
    }
    public function pilihanjawaban()
    {
        return $this->hasMany('App\Models\ujian_banksoal_pilihanjawaban', 'kode_soal', 'kode_soal');
    }
    // public function kelas()
    // {
    //     return $this->hasMany('App\Models\kelas');
    // }
}
