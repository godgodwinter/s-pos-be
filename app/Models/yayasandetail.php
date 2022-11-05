<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class yayasandetail extends Model
{
    public $table = "yayasandetail";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];

    protected $guarded = [];

    public function yayasan()
    {
        return $this->belongsTo('App\Models\yayasan');
    }

    public function sekolah()
    {
        return $this->belongsTo('App\Models\sekolah');
    }
}
