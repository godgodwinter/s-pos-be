<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ujian_paketsoal extends Model
{
    public $table = "ujian_paketsoal";

    use SoftDeletes;
    use HasFactory;

    // protected $fillable = [
    //     'nama',
    //     'sekolah_id',
    //     'walikelas_id',
    // ];


    protected $guarded = [];

    // public function sekolah()
    // {
    //     return $this->belongsTo('App\Models\sekolah');
    // }
    public function ujian_paketsoal_kategori()
    {
        return $this->hasMany('App\Models\ujian_paketsoal_kategori');
    }
    public function kategori()
    {
        return $this->hasMany('App\Models\ujian_paketsoal_kategori');
    }
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($ujian_paketsoal) {
            $ujian_paketsoal->ujian_paketsoal_kategori()->delete();
        });
        // static::deleting(function ($sekolah) {
        //     $sekolah->walikelas()->delete();
        // });


        // static::deleting(function ($sekolah) {

        //     $getSiswa = Siswa::where('sekolah_id', $sekolah->id)->get();

        //     foreach ($getSiswa as $data) {

        //         $getSIswaDetail = siswadetail::where('siswa_id', $data->id)->get();

        //         foreach ($getSIswaDetail as $item) {
        //             apiprobk::where('id', $item->apiprobk_id)->update([
        //                 'sinkron' => 'belum',
        //                 'sinkron_tgl' => date("Y-m-d H:i:s"),
        //                 'updated_at' => date("Y-m-d H:i:s")
        //             ]);
        //         }
        //         // delete siswadetail
        //         siswadetail::where('siswa_id', $data->id)->delete();
        //     }

        //     $sekolah->siswa()->delete();
        // });
        // static::deleting(function ($sekolah) {
        //     $sekolah->gurubk()->delete();
        // });
    }
}
