<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class produk_detail extends Model
{
    public $table = "produk_detail";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];


    protected $guarded = [];

    public function produk()
    {
        return $this->belongsTo('App\Models\produk');
    }
    public function restok()
    {
        return $this->belongsTo('App\Models\restok');
    }
}
