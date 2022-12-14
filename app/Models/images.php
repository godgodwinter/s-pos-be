<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class images extends Model
{
    public $table = "images";

    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'nama',
        'prefix',
        'photo',
        'desc',
        'parrent_id',
        'status',
    ];

    // public function tapel()
    // {
    //     return $this->belongsTo('App\Models\tapel');
    //     return $this->belongsTo(User::class,'users_id','id');
    // }

}
