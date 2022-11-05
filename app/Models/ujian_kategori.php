<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ujian_kategori extends Model
{
    public $table = "ujian_kategori";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];


    protected $guarded = [];

    public function banksoal()
    {
        return $this->hasMany('App\Models\ujian_banksoal');
    }
    public function paketsoal()
    {
        return $this->hasMany('App\Models\ujian_paketsoal');
    }
    public function ujian_banksoal_aspek()
    {
        return $this->belongsTo('App\Models\ujian_banksoal_aspek');
    }
}
