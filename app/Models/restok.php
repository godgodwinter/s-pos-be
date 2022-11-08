<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class restok extends Model
{
    public $table = "restok";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];


    protected $guarded = [];

    public function produk_detail()
    {
        return $this->hasMany('App\Models\produk_detail')->with('produk');
    }
    public function Pegawai()
    {
        return $this->hasMany('App\Models\Pegawai', 'penanggungjawab', 'id');
    }
}
