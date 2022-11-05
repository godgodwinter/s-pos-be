<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class adminPegawaiController extends Controller
{
    public function index(Request $request)
    {
        $items = Pegawai::get();
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

        $user = Pegawai::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'nomeridentitas' => $request->nomeridentitas,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success'    => true,
            'data'    => $items,
        ], 200);
    }

    public function edit(Pegawai $item)
    {
        return response()->json([
            'success'    => true,
            'data'    => $item,
        ], 200);
    }
    public function update(Pegawai $item, Request $request)
    {

        //set validation
        $validator = Validator::make($request->all(), [
            'nama'   => 'required',
        ]);
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        Pegawai::where('id', $item->id)
            ->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'username' => $request->username,
                'nomeridentitas' => $request->nomeridentitas,
                'password' => Hash::make($request->password),
                'updated_at' => date("Y-m-d H:i:s")
            ]);

        return response()->json([
            'success'    => true,
            'message'    => 'Data berhasil di update!',
        ], 200);
    }
    public function destroy(Pegawai $item)
    {

        Pegawai::destroy($item->id);
        return response()->json([
            'success'    => true,
            'message'    => 'Data berhasil di hapus!',
        ], 200);
    }
    public function forceDestroy($item)
    {

        // User::destroy($item->id);
        Pegawai::where('id', $item)->forceDelete();
        return response()->json([
            'success'    => true,
            'message'    => 'Data berhasil di hapus!',
        ], 200);
    }
}
