<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class transaksi_detail extends Model
{
    public $table = "transaksi_detail";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];


    protected $guarded = [];

    public function transaksi()
    {
        return $this->belongsTo('App\Models\transaksi');
    }
    public function produk()
    {
        return $this->belongsTo('App\Models\produk');
    }
}
