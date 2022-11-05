<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kelas extends Model
{
    public $table = "kelas";

    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'nama',
        'sekolah_id',
        'walikelas_id',
        'bk_id',
    ];

    public function sekolah()
    {
        return $this->belongsTo('App\Models\sekolah');
    }
    public function walikelas()
    {
        return $this->belongsTo('App\Models\walikelas');
    }
    public function bk()
    {
        return $this->belongsTo('App\Models\bk');
    }
    public function siswa()
    {
        return $this->hasMany('App\Models\Siswa');
    }
}
