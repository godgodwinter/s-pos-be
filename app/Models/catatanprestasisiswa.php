<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class catatanprestasisiswa extends Model
{
    public $table = "catatanprestasisiswa";

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
        return $this->belongsTo('App\Models\Siswa');
    }
}
