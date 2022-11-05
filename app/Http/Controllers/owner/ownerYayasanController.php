<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\kelas;
use App\Models\paket;
use App\Models\sekolah;
use App\Models\Siswa;
use App\Models\Yayasan;
use App\Models\yayasandetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ownerYayasanController extends Controller
{
    protected $identitas;
    protected $me;
    protected $mySekolahId;
    protected $mySekolah;
    protected $getPkaetDefault;
    // construct
    public function __construct()
    {
        $this->identitas = $this->guard()->user();
        $this->me =  $this->identitas; //siswa
        $this->mySekolah = null;  //sekolah
        $this->mySekolahId = null;  //sekolah_id
        $this->getPkaetDefault = paket::first();
    }
    public function guard()
    {
        return Auth::guard('owner');
    }

    public function index(Request $request)
    {
        $items = Yayasan::with('yayasandetail')->get();
        foreach ($items as $key => $item) {
            $items[$key]->jml_sekolah = yayasandetail::where('yayasan_id', $item->id)->count();
        }
        return response()->json([
            'success'    => true,
            'data'    => $items,
        ], 200);
    }

    public function detail(Yayasan $yayasan, Request $request)
    {
        // $items = yayasandetail::with('yayasan')->with('sekolah')->where('yayasan_id', $yayasan->id)->get();

        $items = sekolah::whereIn('id', function ($query) use ($yayasan) {
            $query->select('sekolah_id')
                ->from('yayasandetail')
                ->where('yayasan_id', $yayasan->id)
                ->where('deleted_at', null);
        })->get();
        foreach ($items as $key => $item) {
            $items[$key]->paket_nama = $item->paket ? $item->paket->nama : $this->getPkaetDefault->nama;
            $items[$key]->jml_siswa = Siswa::where('sekolah_id', $item->id)->count();
            $items[$key]->jml_kelas = kelas::where('sekolah_id', $item->id)->count();
        }
        return response()->json([
            'success'    => true,
            'data'    => $items,
        ], 200);
    }
}
