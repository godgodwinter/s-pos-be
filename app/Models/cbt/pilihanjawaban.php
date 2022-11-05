<?php

namespace App\Models\cbt;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pilihanjawaban extends Model
{
    public $table = "ujian_paketsoal_soal_pilihanjawaban";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];

    protected $hidden = [
        'skor',
    ];


    protected $guarded = [];

    // public function sekolah()
    // {
    //     return $this->belongsTo('App\Models\sekolah');
    // }
    // public function kelas()
    // {
    //     return $this->hasMany('App\Models\kelas');
    // }
}
