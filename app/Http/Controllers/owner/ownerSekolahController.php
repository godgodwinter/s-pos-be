<?php

namespace App\Http\Controllers\owner;

use App\Http\Controllers\Controller;
use App\Models\kelas;
use App\Models\paket;
use App\Models\sekolah;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ownerSekolahController extends Controller
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
        $items = sekolah::with('paket')->get();
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


    public function updatestatus(Sekolah $item, Request $request)
    {

        //set validation
        $validator = Validator::make($request->all(), [
            'status'   => 'required',
        ]);
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        Sekolah::where('id', $item->id)
            ->update([
                'status' => $request->status,
                'updated_at' => date("Y-m-d H:i:s")
            ]);

        $items = 'Data berhasil diupdate';
        return response()->json([
            'success'    => true,
            'data'    => $items,
        ], 200);
    }

    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama'   => 'required',
        ]);

        $items = 'Data berhasil di tambahkan';
        // $data = $request->except('_token');
        // apiprobk::create($data);

        $data = $request->except('_token');
        sekolah::create($data);

        return response()->json([
            'success'    => true,
            'data'    => $items,
        ], 200);
    }

    public function edit(sekolah $item)
    {
        $item = sekolah::with('paket')->where('id', $item->id)->first();
        return response()->json([
            'success'    => true,
            'data'    => $item,
        ], 200);
    }
    public function update(sekolah $item, Request $request)
    {

        //set validation
        $validator = Validator::make($request->all(), [
            'nama'   => 'required',
        ]);
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $data = $request->except('_token');
        // sekolah::create($data);

        $sekolah = sekolah::find($item->id);
        $sekolah->update($data);

        return response()->json([
            'success'    => true,
            'message'    => 'Data berhasil di update!',
        ], 200);
    }
    public function destroy(sekolah $item)
    {

        sekolah::destroy($item->id);
        return response()->json([
            'success'    => true,
            'message'    => 'Data berhasil di hapus!',
        ], 200);
    }
}
