<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class transaksi extends Model
{
    public $table = "transaksi";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];


    protected $guarded = [];

    public function transaksi_detail()
    {
        return $this->hasMany('App\Models\transaksi_detail');
    }
    public function Pegawai()
    {
        return $this->hasMany('App\Models\Pegawai', 'penanggungjawab', 'id');
    }
}
