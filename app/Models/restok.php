<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class restok extends Model
{
    public $table = "restok";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];


    protected $guarded = [];

    public function produk_detail()
    {
        return $this->hasMany('App\Models\produk_detail')->with('produk');
    }
    public function Pegawai()
    {
        return $this->hasMany('App\Models\Pegawai', 'penanggungjawab', 'id');
    }
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($data) {
            // siswadetail::where('siswa_id', $siswa->id)->delete();

            // //update
            $getProdukDetail = produk_detail::where('restok_id', $data->id)->delete();

            // foreach ($getApiProBKId as $data) {
            //     apiprobk::where('id', $data->apiprobk_id)->update([
            //         'sinkron' => 'belum',
            //         'sinkron_tgl' => date("Y-m-d H:i:s"),
            //         'updated_at' => date("Y-m-d H:i:s")
            //     ]);
            //     // apiprobk::where('id', $data->apiprobk_id)->forceDelete();
            //     // apiprobk_deteksi::where('apiprobk_id', $data->apiprobk_id)->forceDelete();
            //     // apiprobk_sertifikat::where('apiprobk_id', $data->apiprobk_id)->forceDelete();
            // }

            // $siswa->siswadetail()->delete();
        });
    }
}
