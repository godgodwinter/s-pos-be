<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ujian_paketsoal_kategori extends Model
{
    public $table = "ujian_paketsoal_kategori";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];


    protected $guarded = [];

    public function paket()
    {
        return $this->belongsTo('App\Models\ujian_paketsoal', 'ujian_paketsoal_id', 'id');
    }
    public function kategori()
    {
        return $this->belongsTo('App\Models\ujian_kategori', 'ujian_kategori_id', 'id');
    }
    public function soal()
    {
        return $this->hasMany('App\Models\ujian_paketsoal_soal', 'ujian_paketsoal_kategori_id', 'id')->with('pilihanjawaban');
    }
}
