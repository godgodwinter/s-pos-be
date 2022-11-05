<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class siswadetail extends Model
{
    public $table = "siswadetail";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];

    protected $guarded = [];

    public function siswa()
    {
        return $this->belongsTo('App\Models\Siswa');
    }
    public function SiswaPublic()
    {
        return $this->belongsTo('App\Models\SiswaPublic', 'siswa_id', 'id');
    }

    public function apiprobk()
    {
        return $this->belongsTo('App\Models\apiprobk');
    }

    public function apiprobkwithsertifikat()
    {
        $result = $this->belongsTo('App\Models\apiprobk', 'apiprobk_id', 'id');
        $result->with('apiprobk_sertifikat');
        return $result;

        // ->with('apiprobk_sertifikat'); //bug terlalu banyak data
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($siswadetail) {

            apiprobk::where('id', $siswadetail->apiprobk_id)->update([
                'sinkron'     =>   'belum',
                'updated_at'  =>  date("Y-m-d H:i:s")
            ]);


            // kelas::where('id', $item->id)
            // ->update([
            //     'tingkatan'     =>   $request->tingkatan,
            //     'jurusan'     =>   $request->jurusan,
            //     'suffix'     =>   $request->suffix,
            //     'updated_at' => date("Y-m-d H:i:s")
            // ]);

        });
    }
}
