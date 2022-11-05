<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class minatbakatdetail extends Model
{
    public $table = "minatbakatdetail";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];


    protected $guarded = [];

    public function minatbakat()
    {
        return $this->belongsTo('App\Models\minatbakat');
    }

    public function siswa()
    {
        return $this->belongsTo('App\Models\Siswa');
    }
}
