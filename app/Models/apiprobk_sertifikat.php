<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class apiprobk_sertifikat extends Model
{
    public $table = "apiprobk_sertifikat";
    use SoftDeletes;
    use HasFactory;


    // protected $fillable = ['*'];
    // protected $fillable = array('*');
    protected $guarded = [];

    // $data = $request->except('_token');
    // $B2::create($data);
    public function apiprobk()
    {
        return $this->belongsTo('App\Models\apiprobk')->with('siswadetail');
    }
}
