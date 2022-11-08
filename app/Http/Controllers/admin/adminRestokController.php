<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\produk_detail;
use App\Models\restok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class adminRestokController extends Controller
{
    protected $req;
    public function index(Request $request)
    {
        $items = restok::with('produk_detail')->orderBy('tglbeli')->get();
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

        // $user = label::create([
        //     'nama' => $request->nama,
        //     'prefix' => "produk",
        // ]);
        $this->req = $request;
        DB::transaction(function () {
            $dataKeranjang = $this->req->dataKeranjang;
            //1.insert table restok and get invalid-feedback
            $data = restok::create([
                'namatoko' => $this->req->namatoko,
                'tglbeli' => $this->req->tglbeli,
                'penanggungjawab' => $this->req->penanggungjawab,
            ]);
            if (count($dataKeranjang) > 0) {
                $totalbayar = 0;
                foreach ($dataKeranjang as $dk) {
                    // dd($dk['produk_id']);
                    $dataProduk = produk_detail::create([
                        'produk_id' => $dk['produk_id'],
                        'harga_beli' => $dk['harga_beli'],
                        'jml' => $dk['jml'],
                        'restok_id' => $data->id,
                        // 'harga_' => $dk->harga_beli,
                    ]);
                    $total = $dk['jml'] * $dk['harga_beli'];
                    $totalbayar += $total;
                    // $data = produk_detail::create([
                    //     'produk_id' => $dk->produk_id,
                    //     'harga_beli' => $dk->harga_beli,
                    //     'jml' => $dk->jml,
                    //     'restok_id' => $data->id,
                    //     // 'harga_' => $dk->harga_beli,
                    // ]);
                }
            }

            restok::where('id', $data->id)
                ->update([
                    'totalbayar' => $totalbayar,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
        });

        return response()->json([
            'success'    => true,
            // 'thisReq' => $this->req->namatoko,
            // 'Request' => $request->namatoko,
            // 'jml' => count($request->dataKeranjang),
            // 'dataDetail' => count($request->dataKeranjang),
            'data'    => $items,
        ], 200);
    }
}
