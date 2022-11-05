<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class apiprobk_server extends Model
{
    public $table = "apiprobk_server";
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'link',
        'desc',
        'status',
    ];
}
