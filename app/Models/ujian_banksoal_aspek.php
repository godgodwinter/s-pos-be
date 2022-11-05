<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ujian_banksoal_aspek extends Model
{
    public $table = "ujian_banksoal_aspek";

    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'nama',
        'desc',
        'status',
        'tipe',
        'urutan',
    ];

    // public function sekolah()
    // {
    //     return $this->belongsTo('App\Models\sekolah');
    // }
}
