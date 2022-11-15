<?php

namespace App\Http\Controllers\admin;

use App\Helpers\Fungsi;
use App\Http\Controllers\Controller;
use App\Models\produk_detail;
use App\Models\restok;
use App\Models\transaksi;
use App\Models\transaksi_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;


class adminLaporanController extends Controller
{
    protected $req;
    protected $kodetrans;
    public function index(Request $request)
    {
        $blnthn = $request->blnthn ? $request->blnthn : date('Y-m');
        $bln = $blnthn ? Carbon::parse($blnthn)->format('m') : date('m');
        $thn = $blnthn ? Carbon::parse($blnthn)->format('Y') : date('Y');
        $items = (object)[];
        $items->blnthn = $request->blnthn;
        $items->blnthn_view = $blnthn ? Fungsi::tanggalindobln($blnthn) : Fungsi::tanggalindobln(date('Y-m'));
        $items->jml_transaksi = 0;
        $items->jml_barang_terjual = 0;
        $items->jml_jenis_barang_terjual = 0;
        $items->total_pendapatan = 0;
        $items->detail = [];


        $getTransaksi = transaksi::with('transaksi_detail')
            ->whereMonth('tglbeli', $bln)
            ->whereYear('tglbeli', $thn)
            ->orderBy('tglbeli', 'desc')->orderBy('id', 'desc')
            ->get();

        $items->detail = $getTransaksi;
        $items->jml_transaksi = count($getTransaksi);

        $jml_barang_terjual = 0;
        $jml_jenis_barang_terjual = 0;
        foreach ($getTransaksi as $transaksi) {
            $jml_barang_terjual += transaksi_detail::where('transaksi_id', $transaksi->id)->sum('jml');
            $jml_jenis_barang_terjual = count($transaksi->transaksi_detail);
            $transaksi->jml_jenis_barang = count($transaksi->transaksi_detail);
            $sumJml = transaksi_detail::where('transaksi_id', $transaksi->id)->sum('jml');
            $transaksi->jml_barang = $sumJml;
        }

        $items->jml_barang_terjual = $jml_barang_terjual;
        $items->jml_jenis_barang_terjual = $jml_jenis_barang_terjual;


        $items->total_pendapatan = $getTransaksi->sum('total_bayar');

        //     foreach ($items as $item) {
        //         // $getBerapaProduk = produk_detail::select('produk_id')->distinct()->get();
        //         $item->jml_jenis_barang = count($item->transaksi_detail);
        //         $sumJml = transaksi_detail::where('transaksi_id', $item->id)->sum('jml');
        //         $item->jml_barang = $sumJml;
        //     }
        return response()->json([
            'success'    => true,
            'data'    => $items,
        ], 200);
    }
    public function restok(Request $request) // PENJUALAN
    {
        $blnthn = $request->blnthn ? $request->blnthn : date('Y-m');
        $bln = $blnthn ? Carbon::parse($blnthn)->format('m') : date('m');
        $thn = $blnthn ? Carbon::parse($blnthn)->format('Y') : date('Y');
        $items = (object)[];
        $items->blnthn = $request->blnthn;
        $items->blnthn_view = $blnthn ? Fungsi::tanggalindobln($blnthn) : Fungsi::tanggalindobln(date('Y-m'));
        $items->jml_transaksi = 0;
        $items->jml_barang = 0;
        $items->jml_jenis_barang = 0;
        $items->total_pendapatan = 0;
        $items->detail = [];


        $getRestok = restok::with('produk_detail')
            ->whereMonth('tglbeli', $bln)
            ->whereYear('tglbeli', $thn)
            ->orderBy('tglbeli', 'desc')->orderBy('id', 'desc')
            ->get();

        $items->detail = $getRestok;
        $items->jml_transaksi = count($getRestok);

        $jml_barang = 0;
        $jml_jenis_barang = 0;
        foreach ($getRestok as $restok) {
            $jml_barang += produk_detail::where('restok_id', $restok->id)->sum('jml');
            $jml_jenis_barang = count($restok->produk_detail);
            $restok->jml_jenis_barang = count($restok->produk_detail);
            $sumJml = produk_detail::where('restok_id', $restok->id)->sum('jml');
            $restok->jml_barang = $sumJml;
        }

        $items->jml_barang = $jml_barang;
        $items->jml_jenis_barang = $jml_jenis_barang;


        $items->total_pendapatan = $getRestok->sum('totalbayar');

        //     foreach ($items as $item) {
        //         // $getBerapaProduk = produk_detail::select('produk_id')->distinct()->get();
        //         $item->jml_jenis_barang = count($item->transaksi_detail);
        //         $sumJml = transaksi_detail::where('transaksi_id', $item->id)->sum('jml');
        //         $item->jml_barang = $sumJml;
        //     }
        return response()->json([
            'success'    => true,
            'data'    => $items,
        ], 200);
    }
    public function laba(Request $request)
    {
        $blnthn = $request->blnthn ? $request->blnthn : date('Y-m');
        $bln = $blnthn ? Carbon::parse($blnthn)->format('m') : date('m');
        $thn = $blnthn ? Carbon::parse($blnthn)->format('Y') : date('Y');
        $items = (object)[];
        $items->blnthn = $request->blnthn;
        $items->blnthn_view = $blnthn ? Fungsi::tanggalindobln($blnthn) : Fungsi::tanggalindobln(date('Y-m'));
        $items->jml_transaksi = $this->fnGetTransaksiJml($blnthn);
        $items->total_transaksi = $this->fnGetTransaksi($blnthn);
        $items->jml_restok =  $this->fnGetRestokJml($blnthn);
        $items->total_restok = $this->fnGetRestok($blnthn);
        $items->total_laba = $items->total_transaksi - $items->total_restok;
        $status = "";
        if ($items->total_laba > 0) {
            $status = "Untung";
        } elseif ($items->total_laba < 0) {
            $status = "Rugi";
        }
        $items->status = $status;
        $items->detail = [];

        return response()->json([
            'success'    => true,
            'data'    => $items,
        ], 200);
    }
    public function fnGetTransaksi($blnthn)
    {
        $bln = $blnthn ? Carbon::parse($blnthn)->format('m') : date('m');
        $thn = $blnthn ? Carbon::parse($blnthn)->format('Y') : date('Y');
        // 1.get data table transaksi,, total pada bulan blnthn
        $result = 0;

        $result = transaksi::with('transaksi_detail')
            ->whereMonth('tglbeli', $bln)
            ->whereYear('tglbeli', $thn)
            ->orderBy('tglbeli', 'desc')->orderBy('id', 'desc')
            ->sum('total_bayar');

        return $result;
    }
    public function fnGetRestok($blnthn)
    {
        $bln = $blnthn ? Carbon::parse($blnthn)->format('m') : date('m');
        $thn = $blnthn ? Carbon::parse($blnthn)->format('Y') : date('Y');
        // 1.get Data table restok  ,, total pada bulan blnthn
        $result = 0;

        $result = restok::with('produk_detail')
            ->whereMonth('tglbeli', $bln)
            ->whereYear('tglbeli', $thn)
            ->orderBy('tglbeli', 'desc')->orderBy('id', 'desc')
            ->sum('totalbayar');

        return $result;
    }

    public function fnGetTransaksiJml($blnthn)
    {
        $bln = $blnthn ? Carbon::parse($blnthn)->format('m') : date('m');
        $thn = $blnthn ? Carbon::parse($blnthn)->format('Y') : date('Y');
        // 1.get data table transaksi,, total pada bulan blnthn
        $result = 0;

        $result = transaksi::with('transaksi_detail')
            ->whereMonth('tglbeli', $bln)
            ->whereYear('tglbeli', $thn)
            ->orderBy('tglbeli', 'desc')->orderBy('id', 'desc')
            ->get();

        return count($result);
    }
    public function fnGetRestokJml($blnthn)
    {
        $bln = $blnthn ? Carbon::parse($blnthn)->format('m') : date('m');
        $thn = $blnthn ? Carbon::parse($blnthn)->format('Y') : date('Y');
        // 1.get Data table restok  ,, total pada bulan blnthn
        $result = 0;

        $result = restok::with('produk_detail')
            ->whereMonth('tglbeli', $bln)
            ->whereYear('tglbeli', $thn)
            ->orderBy('tglbeli', 'desc')->orderBy('id', 'desc')
            ->get();

        return count($result);
    }
    public function fnGetSemuaTransaksi($blnthn) // cari total transaksi minus apa plus
    {
        // 1. $pemasukan get Data fnPemasukan wher blnthn
        // 2. $pengeluaran get Data fnPengeluaran wher blnthn
        // 3. $totalTransaksi = $pengeluaran-$pemasukan;
    }

    public function fnGetAvgHargaProdukBeli($produk_id) //total
    {
        // 1. $avgHargaBeli=ambil data rata-rata harga beli
    }
    public function fnGetAvgHargaProdukTerjual($produk_id) //total
    {
        // 1. $avgHargaBeli=ambil data rata-rata harga beli
    }
    public function fnGetLaba($produk_id) //total
    {
        // 1. $avgHargaBeli=ambil data rata-rata harga beli
        // 2. $avgHargaTerjual= ambil rata-rata harga terjual
        // 3. $totalLaba= $avgHargaTerjual-$avgHargaBeli
    }

    public function fnGetLabaHargaBlnThn($produk_id, $blnthn) //total
    {
        // 1. $avgHargaBeli
        // 2. $avgHargaTerjualBlnThn= ambil rata-rata harga terjual pada blnthn
        // 3. $totalLaba= $avgHargaTerjualBlnThn-$avgHargaBeli
    }
}
