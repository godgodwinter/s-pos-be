<?php

namespace App\Http\Controllers\tanpalogin;

use App\Http\Controllers\Controller;
use App\Models\images;
use App\Models\label_produk;
use App\Models\produk;
use App\Models\produk_detail;
use App\Models\transaksi_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class guestKatalogController extends Controller
{
    public function index()
    {
        $items = produk::orderBy('nama', 'asc')
            ->get();
        foreach ($items as $key => $item) {
            // $item->stok_tersedia = 0;
            $item->stok_tersedia = $this->fnPeriksaStokTersedia($item->id);
            $item->harga_beli_avg = $this->fnGetAvgHargaBeli($item->id);
            $item->stok_total = produk_detail::where('produk_id', $item->id)->sum('jml');
            $item->stok_terjual = transaksi_detail::where('produk_id', $item->id)->sum('jml');



            $item->label = label_produk::with('label')->where('produk_id', $item->id)->get();
            $labelSelected = [];
            foreach ($item->label as $label) {
                array_push($labelSelected, $label->label);
            }
            $item->labelSelected = $labelSelected;
            $item->photo = images::where('prefix', 'produk')->where('parrent_id', $item->id)->get();
            foreach ($item->photo as $photo) {
                // $photo->link = URL('/') . "/" . $photo->photo;
                $photo->link = URL::to($photo->photo);
            }
        }
        return response()->json([
            'success'    => true,
            'data'    => $items,
        ], 200);
    }

    public function cari(Request $request)
    {
        $items = produk::where('nama', 'like', '%' . $request->cari . '%')
            ->orderBy('nama', 'asc')
            ->get();
        foreach ($items as $key => $item) {
            // $item->stok_tersedia = 0;
            $item->stok_tersedia = $this->fnPeriksaStokTersedia($item->id);
            $item->harga_beli_avg = $this->fnGetAvgHargaBeli($item->id);
            $item->stok_total = produk_detail::where('produk_id', $item->id)->sum('jml');
            $item->stok_terjual = transaksi_detail::where('produk_id', $item->id)->sum('jml');


            $item->label = label_produk::with('label')->where('produk_id', $item->id)->get();
            $labelSelected = [];
            foreach ($item->label as $label) {
                array_push($labelSelected, $label->label);
            }
            $item->labelSelected = $labelSelected;
            $item->photo = images::where('prefix', 'produk')->where('parrent_id', $item->id)->get();
        }
        return response()->json([
            'success'    => true,
            'data'    => $items,
        ], 200);
    }

    public function edit(produk $item)
    {
        $data = produk::where('id', $item->id)->first();

        $data->stok_tersedia = $this->fnPeriksaStokTersedia($data->id);
        $data->harga_beli_avg = $this->fnGetAvgHargaBeli($data->id);
        $data->stok_total = produk_detail::where('produk_id', $data->id)->sum('jml');
        $data->stok_terjual = transaksi_detail::where('produk_id', $data->id)->sum('jml');


        $item->label = label_produk::with('label')->where('produk_id', $item->id)->get();
        $labelSelected = [];
        foreach ($item->label as $label) {
            array_push($labelSelected, $label->label);
        }
        $item->labelSelected = $labelSelected;
        $item->photo = images::where('prefix', 'produk')->where('parrent_id', $item->id)->get();
        foreach ($item->photo as $photo) {
            $photo->link = URL('/') . "/" . $photo->photo;
        }
        return response()->json([
            'success'    => true,
            'data'    => $data,

        ], 200);
    }
    public function fnPeriksaStokTersedia($produk_id)
    {
        $result = 0;
        // 1. ambil data produk_detail where produk_id
        // jumlahkan jml
        $getProdukDetail = produk_detail::where('produk_id', $produk_id)->sum('jml');
        // $result = $getProdukDetail;
        // 2.ambil transaksi_detail where produk_id
        $getTerjual = transaksi_detail::where('produk_id', $produk_id)->sum('jml');
        $result = $getProdukDetail - $getTerjual;
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
