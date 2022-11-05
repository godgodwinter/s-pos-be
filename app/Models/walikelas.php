<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class walikelas extends Model
{
    public $table = "walikelas";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];


    protected $guarded = [];

    public function sekolah()
    {
        return $this->belongsTo('App\Models\sekolah');
    }
    public function kelas()
    {
        return $this->hasMany('App\Models\kelas');
    }
}
