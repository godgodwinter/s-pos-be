<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class siswadetailForceDelete extends Model
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

            // apiprobk::where('id', $siswadetail->apiprobk_id)->update([
            //     'sinkron'     =>   'belum',
            //     'updated_at'  =>  date("Y-m-d H:i:s")
            // ]);

            apiprobk_sertifikat::where('apiprobk_id', $siswadetail->apiprobk_id)->forceDelete();
            apiprobk_deteksi_list::with('apiprobk_deteksi')
                ->whereHas(
                    'apiprobk_deteksi',
                    function ($query) use ($siswadetail) {
                        $query
                            ->where('apiprobk_id', $siswadetail->apiprobk_id);
                    }
                )
                ->forceDelete();
            apiprobk_deteksi::where('apiprobk_id', $siswadetail->apiprobk_id)->forceDelete();
            apiprobk::where('id', $siswadetail->apiprobk_id)->forceDelete();

            Siswa::where('id', $siswadetail->siswa_id)->forceDelete();

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
