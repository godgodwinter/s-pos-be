<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\produk;
use App\Models\produk_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class adminProdukController extends Controller
{
    public function index(Request $request)
    {
        $items = produk::get();
        foreach ($items as $key => $item) {
            // $item->stok_tersedia = 0;
            $item->stok_tersedia = $this->fnPeriksaStokTersedia($item->id);
            $item->harga_beli_avg = $this->fnGetAvgHargaBeli($item->id);
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

        $slug = Str::slug($request->nama, '-');
        $user = produk::create([
            'nama' => $request->nama,
            'harga_jual_default' => $request->harga_jual_default,
            'slug' => $slug . "-" . date('YmdHis'),
            'satuan' => $request->satuan,
            'berat' => $request->berat,
        ]);

        return response()->json([
            'success'    => true,
            'data'    => $items,
        ], 200);
    }

    public function edit(produk $item)
    {
        return response()->json([
            'success'    => true,
            'data'    => $item,
        ], 200);
    }
    public function update(produk $item, Request $request)
    {

        //set validation
        $validator = Validator::make($request->all(), [
            'nama'   => 'required',
        ]);
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $slug = Str::slug($request->nama, '-');
        produk::where('id', $item->id)
            ->update([
                'nama' => $request->nama,
                'harga_jual_default' => $request->harga_jual_default,
                // 'slug' => $slug . "-" . date('YmdHis'),
                'satuan' => $request->satuan,
                'berat' => $request->berat,
                'updated_at' => date("Y-m-d H:i:s")
            ]);

        return response()->json([
            'success'    => true,
            'message'    => 'Data berhasil di update!',
        ], 200);
    }
    public function destroy(produk $item)
    {

        produk::destroy($item->id);
        return response()->json([
            'success'    => true,
            'message'    => 'Data berhasil di hapus!',
        ], 200);
    }
    public function forceDestroy($item)
    {

        // User::destroy($item->id);
        produk::where('id', $item)->forceDelete();
        return response()->json([
            'success'    => true,
            'message'    => 'Data berhasil di hapus!',
        ], 200);
    }

    public function fnPeriksaStokTersedia($produk_id)
    {
        $result = 0;
        // 1. ambil data produk_detail where produk_id
        // jumlahkan jml
        $getProdukDetail = produk_detail::where('produk_id', $produk_id)->sum('jml');
        $result = $getProdukDetail;
        // 2.ambil transaksi_detail where produk_id
        // jmlahkan jml
        //3. result = jml stok - jml terjual;
        return $result;
    }

    public function fnGetAvgHargaBeli($produk_id)
    {
        $result = 0;
        $totalHargaBeli = 0;
        $jmlProduk = 0;

        $getProdukDetail = produk_detail::where('produk_id', $produk_id)->get();
        foreach ($getProdukDetail as $produk) {
            // jml * harga_beli
            $totalHargaBeli += $produk->jml * $produk->harga_beli;
            $jmlProduk += $produk->jml;
        }
        if ($jmlProduk) {
            $result = $totalHargaBeli / $jmlProduk;
        }
        return $result;
    }
}
