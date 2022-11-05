<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaPublic extends Model
{
    public $table = "siswa";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];

    protected $hidden = [
        'password',
        'username',
        'email',
        'passworddefault',
        'remember_token',
    ];

    protected $guarded = [];


    public function siswadetail()
    {
        return $this->hasMany('App\Models\siswadetail')->with('apiprobk');
    }
    public function ortu()
    {
        return $this->belongsTo('App\Models\Ortu');
    }
}
