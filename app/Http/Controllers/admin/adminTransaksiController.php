<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\produk_detail;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class adminTransaksiController extends Controller
{
    protected $req;
    public function index(Request $request)
    {
        $items = transaksi::with('transaksi_detail')->orderBy('tglbeli')->get();
        // $datas = [];
        // foreach ($items as $item) {
        //     // $getBerapaProduk = produk_detail::select('produk_id')->distinct()->get();
        //     $item->jml_jenis_barang = count($item->produk_detail);
        //     $sumJml = produk_detail::where('transaksi_id', $item->id)->sum('jml');
        //     $item->jml_barang = $sumJml;
        // }
        return response()->json([
            'success'    => true,
            'data'    => $items,
        ], 200);
    }
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'tglbeli'   => 'required',
        ]);

        // $items = 'Data berhasil di tambahkan';
        // // $data = $request->except('_token');
        // // apiprobk::create($data);

        // // $user = label::create([
        // //     'nama' => $request->nama,
        // //     'prefix' => "produk",
        // // ]);
        // $this->req = $request;
        // DB::transaction(function () {
        //     $dataKeranjang = $this->req->dataKeranjang;
        //     //1.insert table transaksi and get invalid-feedback
        //     $data = transaksi::create([
        //         'namatoko' => $this->req->namatoko,
        //         'tglbeli' => $this->req->tglbeli,
        //         'penanggungjawab' => $this->req->penanggungjawab,
        //     ]);
        //     if (count($dataKeranjang) > 0) {
        //         $totalbayar = 0;
        //         foreach ($dataKeranjang as $dk) {
        //             // dd($dk['produk_id']);
        //             $dataProduk = produk_detail::create([
        //                 'produk_id' => $dk['id'],
        //                 'harga_beli' => $dk['harga_beli_number'],
        //                 'jml' => $dk['jml'],
        //                 'transaksi_id' => $data->id,
        //                 // 'harga_' => $dk->harga_beli,
        //             ]);
        //             $total = $dk['jml'] * $dk['harga_beli_number'];
        //             $totalbayar += $total;
        //             // $data = produk_detail::create([
        //             //     'produk_id' => $dk->produk_id,
        //             //     'harga_beli' => $dk->harga_beli,
        //             //     'jml' => $dk->jml,
        //             //     'transaksi_id' => $data->id,
        //             //     // 'harga_' => $dk->harga_beli,
        //             // ]);
        //         }
        //     }

        //     transaksi::where('id', $data->id)
        //         ->update([
        //             'totalbayar' => $totalbayar,
        //             'updated_at' => date("Y-m-d H:i:s")
        //         ]);
        // });

        return response()->json([
            'success'    => true,
            // 'thisReq' => $this->req->namatoko,
            // 'Request' => $request->namatoko,
            // 'jml' => count($request->dataKeranjang),
            // 'dataDetail' => count($request->dataKeranjang),
            // 'data'    => $items,
        ], 200);
    }
    public function detail(transaksi $item) //like edit
    {
        $data = transaksi::with('transaksi_detail')->where('id', $item->id)->get();
        return response()->json([
            'success'    => true,
            'data'    => $data,
        ], 200);
    }
    public function destroy(transaksi $item)
    {

        transaksi::destroy($item->id);
        return response()->json([
            'success'    => true,
            'message'    => 'Data berhasil di hapus!',
        ], 200);
    }
}
