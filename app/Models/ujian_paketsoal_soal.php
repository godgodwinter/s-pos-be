<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ujian_paketsoal_soal extends Model
{
    public $table = "ujian_paketsoal_soal";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];


    protected $guarded = [];

    public function pilihanjawaban()
    {
        return $this->hasMany('App\Models\ujian_paketsoal_soal_pilihanjawaban', 'ujian_paketsoal_soal_id', 'id');
    }
    public function cbt_pilihanjawaban()
    {
        return $this->hasMany('App\Models\ujian\pilihanjawaban', 'ujian_paketsoal_soal_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($ujian_paketsoal_soal) {
            $ujian_paketsoal_soal->pilihanjawaban()->delete();
        });
    }
}
