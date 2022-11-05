<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class adminLabelController extends Controller
{
    // labellabel
    public function index(Request $request)
    {
        $items = label::get();
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

        $user = label::create([
            'nama' => $request->nama,
            'prefix' => "produk",
        ]);

        return response()->json([
            'success'    => true,
            'data'    => $items,
        ], 200);
    }

    public function edit(label $item)
    {
        return response()->json([
            'success'    => true,
            'data'    => $item,
        ], 200);
    }
    public function update(label $item, Request $request)
    {

        //set validation
        $validator = Validator::make($request->all(), [
            'nama'   => 'required',
        ]);
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        label::where('id', $item->id)
            ->update([
                'nama' => $request->nama,
                'updated_at' => date("Y-m-d H:i:s")
            ]);

        return response()->json([
            'success'    => true,
            'message'    => 'Data berhasil di update!',
        ], 200);
    }
    public function destroy(label $item)
    {

        label::destroy($item->id);
        return response()->json([
            'success'    => true,
            'message'    => 'Data berhasil di hapus!',
        ], 200);
    }
    public function forceDestroy($item)
    {

        // User::destroy($item->id);
        label::where('id', $item)->forceDelete();
        return response()->json([
            'success'    => true,
            'message'    => 'Data berhasil di hapus!',
        ], 200);
    }
}
