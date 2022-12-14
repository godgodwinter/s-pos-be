<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\produk_detail;
use App\Models\restok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class adminRestokController extends Controller
{
    protected $req;
    protected $kodetrans;
    public function index(Request $request)
    {
        $items = restok::with('produk_detail')
            ->orderBy('tglbeli', 'desc')->orderBy('id', 'desc')
            ->get();
        // $datas = [];
        foreach ($items as $item) {
            // $getBerapaProduk = produk_detail::select('produk_id')->distinct()->get();
            $item->jml_jenis_barang = count($item->produk_detail);
            $sumJml = produk_detail::where('restok_id', $item->id)->sum('jml');
            $item->jml_barang = $sumJml;
        }
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
        $this->kodetrans = Uuid::uuid4()->toString();
        DB::transaction(function () {
            $dataKeranjang = $this->req->dataKeranjang;
            //1.insert table restok and get invalid-feedback
            $data = restok::create([
                'namatoko' => $this->req->namatoko,
                'tglbeli' => $this->req->tglbeli,
                'penanggungjawab' => $this->req->penanggungjawab,
                'kodetrans' => $this->kodetrans,
            ]);
            if (count($dataKeranjang) > 0) {
                $totalbayar = 0;
                foreach ($dataKeranjang as $dk) {
                    // dd($dk['produk_id']);
                    $dataProduk = produk_detail::create([
                        'produk_id' => $dk['id'],
                        'harga_beli' => $dk['harga_beli_number'],
                        'jml' => $dk['jml'],
                        'restok_id' => $data->id,
                        // 'harga_' => $dk->harga_beli,
                    ]);
                    $total = $dk['jml'] * $dk['harga_beli_number'];
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
            'kodetrans' => $this->kodetrans,
            // 'thisReq' => $this->req->namatoko,
            // 'Request' => $request->namatoko,
            // 'jml' => count($request->dataKeranjang),
            // 'dataDetail' => count($request->dataKeranjang),
            'data'    => $items,
        ], 200);
    }
    public function detail(restok $item) //like edit
    {
        $data = restok::with('produk_detail')->where('id', $item->id)->first();
        $data->jml_jenis_barang = count($data->produk_detail);
        $sumJml = produk_detail::where('restok_id', $data->id)->sum('jml');
        $data->jml_barang = $sumJml;
        return response()->json([
            'success'    => true,
            'data'    => $data,
        ], 200);
    }
    public function destroy(restok $item)
    {

        restok::destroy($item->id);
        return response()->json([
            'success'    => true,
            'message'    => 'Data berhasil di hapus!',
        ], 200);
    }
}
