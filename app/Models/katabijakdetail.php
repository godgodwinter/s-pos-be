<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class katabijakdetail extends Model
{
    public $table = "katabijakdetail";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];

    protected $guarded = [];

    // public function sekolah()
    // {
    //     return $this->belongsTo('App\Models\sekolah');
    // }

    public function katabijak()
    {
        return $this->belongsTo('App\Models\katabijak');
    }
}
