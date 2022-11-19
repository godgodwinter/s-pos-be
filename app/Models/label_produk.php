<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class label_produk extends Model
{
    public $table = "label_produk";

    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        // 'nama',
        // 'prefix',
        // 'photo',
        // 'desc',
        // 'parrent_id',
        'label_id',
        'produk_id',
        'status',
    ];

    public function label()
    {
        return $this->belongsTo('App\Models\label');
        // return $this->belongsTo(User::class,'users_id','id');
    }
}
