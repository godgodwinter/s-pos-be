<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class masterdeteksi extends Model
{
    public $table = "masterdeteksi";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];

    protected $guarded = [];

    public function penanganandeteksimasalah()
    {
        return $this->hasMany('App\Models\penanganandeteksimasalah');
    }
}
