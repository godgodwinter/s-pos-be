<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\images;
use App\Models\label;
use App\Models\label_produk;
use App\Models\produk;
use App\Models\produk_detail;
use App\Models\transaksi_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class adminProdukController extends Controller
{
    public function index(Request $request)
    {
        $items = produk::get();
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
                $photo->link = URL::to($photo->photo);
            }
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

        $item->label = [];
        $item->photo = [];
        $item->label = label_produk::with('label')->where('produk_id', $item->id)->get();
        $labelSelected = [];
        foreach ($item->label as $label) {
            array_push($labelSelected, $label->label);
        }
        $item->labelSelected = $labelSelected;
        $item->photo = images::where('prefix', 'produk')->where('parrent_id', $item->id)->get();
        foreach ($item->photo as $photo) {
            $photo->link = URL::to($photo->photo);
        }

        $item->stok_tersedia = $this->fnPeriksaStokTersedia($item->id);
        $item->harga_beli_avg = $this->fnGetAvgHargaBeli($item->id);
        $item->stok_total = produk_detail::where('produk_id', $item->id)->sum('jml');
        $item->stok_terjual = transaksi_detail::where('produk_id', $item->id)->sum('jml');

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
    public function deletePhoto(produk $item, images $images)
    {

        // produk::destroy($item->id);
        images::where('id', $images->id)->forceDelete();

        $path = public_path($images->photo);
        // dd($path, File::exists($path));
        if (File::exists($path)) {
            File::delete($path);
        }
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


    public function updateLabel(produk $item, Request $request)
    {

        //set validation
        $validator = Validator::make($request->all(), [
            'labelSelected'   => 'required',
        ]);
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // $slug = Str::slug($request->nama, '-');
        // label_produk::where('id', $item->id)
        //     ->update([
        //         'nama' => $request->nama,
        //         'harga_jual_default' => $request->harga_jual_default,
        //         // 'slug' => $slug . "-" . date('YmdHis'),
        //         'satuan' => $request->satuan,
        //         'berat' => $request->berat,
        //         'updated_at' => date("Y-m-d H:i:s")
        //     ]);
        $labelSelected = $request->labelSelected;
        foreach ($labelSelected as  $label) {
            // dd($label["id"]);
            // periksa apakah label where produk_id $item->id belum ada
            $periksaToInsert = label_produk::where('produk_id', $item->id)
                ->where('label_id', $label["id"])
                ->count();
            // insert jika belum
            if ($periksaToInsert < 1) {
                label_produk::create([
                    'label_id' => $label["id"],
                    'produk_id' => $item->id,
                ]);
            }
        }

        // getSemua label where item->id
        $getSemuaLabelToDelete = label_produk::where('produk_id', $item->id)->get();

        foreach ($getSemuaLabelToDelete as $labelTersimpan) {
            $temp = 0;
            foreach ($labelSelected as $label) {
                if ($labelTersimpan->label_id == $label["id"]) {
                    $temp++;
                }
            }
            if ($temp == 0) {
                // delete
                label_produk::where('id', $labelTersimpan->id)->forceDelete();
            }
        }
        // jika label tidak ada maka hapus

        return response()->json([
            'success'    => true,
            'data' => $request->labelSelected,
            'message'    => 'Data berhasil di update!',
        ], 200);
    }


    public function uploadPhoto(produk $item, Request $request)
    {

        //set validation
        $validator = Validator::make($request->all(), [
            'file'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ]);
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $file = $request->file('file');
        // upload photo
        $path = 'uploads/images/produk';
        $file = $request->file('file');
        // $nama_file = rand() . $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $random = Uuid::uuid4()->toString();
        $nama_file = $item->id . '-' . $item->slug . $random . $ext;
        $file->move($path, $nama_file);
        $data['photo'] = $path . '/' . $nama_file;

        $getData = images::where('prefix', 'produk')->where('parrent_id', $item->id);
        // if ($getData->count() > 0) {
        //     $getData->update($data);
        // } else {
        $data['prefix'] = 'produk';
        $data['parrent_id'] = $item->id;
        $data['nama'] = $nama_file;
        images::create($data);
        // }


        return response()->json([
            'success'    => true,
            'data'    => $nama_file,
            'message'    => 'Data berhasil di update!',
        ], 200);
    }
}
