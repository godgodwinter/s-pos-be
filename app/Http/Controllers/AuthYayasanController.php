<?php

namespace App\Http\Controllers;

use App\Models\images;
use App\Models\kelas;
use App\Models\paket;
use App\Models\sekolah;
use App\Models\Siswa;
use App\Models\walikelas;
use App\Models\Yayasan;
use App\Models\yayasandetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class AuthYayasanController extends Controller
{
    protected $me;
    protected $mySekolahId;
    // construct
    public function __construct()
    {
        $this->me = $this->guard()->user();
        $this->mySekolahId = $this->me ? $this->me->sekolah_id : null;
        $this->middleware('auth:yayasan', ['except' => ['login', 'register']]);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|',
            'password' => 'required|string',
        ]);
        $email = $request->email;
        // $credentials = $request->only('email', 'password');
        // $credentials = [
        //     'email' => $email,
        //     'password' => $request->password,
        // ];
        // // dd($credentials);
        // if ($token = $this->guard()->attempt($credentials)) {
        //     return $this->respondWithToken($token);
        // }
        $credentials = [
            'username' => $email,
            'password' => $request->password,
            // 'status_login' => 'Aktif',
        ];
        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }
        // $credentials = [
        //     'nomeridentitas' => $email,
        //     'password' => $request->password,
        // ];
        // if ($token = $this->guard()->attempt($credentials)) {
        //     return $this->respondWithToken($token);
        // }


        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3',
        ]);

        $user = Yayasan::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'username' => $request->username,
            'nomeridentitas' => $request->nomeridentitas,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {

        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {

        $item = $this->me;
        $listPhoto = (object)[
            'logo' => '',
            'kepala' => '',
            'user' => ''
        ];
        $getData = images::where('prefix', 'yayasan')->where('parrent_id', $item->id);
        if ($getData->count() > 0) {
            $data = $getData->first();
            $listPhoto->logo = URL::to($data->photo);
            $listPhoto->user = URL::to($data->photo);
        }

        $getData = images::where('prefix', 'kepalayayasan')->where('parrent_id', $item->id);
        if ($getData->count() > 0) {
            $data = $getData->first();
            $listPhoto->kepala = URL::to($data->photo);
        }
        $items = [];
        $identitas = $this->guard()->user();
        $items['identitas'] = $identitas;
        $items['identitas']['photosekolah'] = null;
        $items['identitas']['photokepsek'] = null;
        $getSekolah = yayasandetail::where('yayasan_id', $identitas->id)->get();
        $sekolah = [];
        $jml_kelas = 0;
        $jml_siswa = 0;
        $jml_walikelas = 0;

        foreach ($getSekolah as $gs) {
            $s = sekolah::where('id', $gs->sekolah_id)->with('paket')->first();

            $s['paket_nama'] = $s->paket ? $s->paket->nama : 'Premium';
            $getJmlKelas = kelas::where('sekolah_id', $gs->id)->count() > 0 ? kelas::where('sekolah_id', $gs->id)->count() : 0;
            $s['jml_kelas'] = $getJmlKelas;
            $jml_kelas += $getJmlKelas;
            $getJmlSiswa = Siswa::where('sekolah_id', $gs->id)->count() > 0 ? Siswa::where('sekolah_id', $gs->id)->count() : 0;
            $s['jml_siswa'] = $getJmlSiswa;
            $jml_siswa += $getJmlSiswa;
            $getJmlWalikelas = walikelas::where('sekolah_id', $gs->id)->count() > 0 ? walikelas::where('sekolah_id', $gs->id)->count() : 0;
            $s['jml_walikelas'] = $getJmlWalikelas;
            $jml_siswa += $getJmlWalikelas;
            $sekolah[] = $s;
        }
        $identitas['jml_sekolah'] = count($sekolah);
        $identitas['jml_kelas'] = $jml_kelas;
        $identitas['jml_siswa'] = $jml_siswa;
        $identitas['jml_walikelas'] = $jml_walikelas;
        $items['sekolah'] = $sekolah;
        $stats = [];
        $items['stats'] = $stats;
        $items['identitas']['photo'] = $listPhoto;
        return response()->json($items);
    }


    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'code' => 200,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 1  //auto logout after 1 hour (default)
        ]);
    }
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('yayasan');
    }


    public function myprofileupdate(Request $request)
    {
        $item = $this->me;
        //set validation
        $validator = Validator::make($request->all(), [
            'nama'   => 'required',
        ]);
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $data = $request->except('_token', 'status');
        // sekolah::create($data);

        $yayasan = Yayasan::find($item->id);
        $yayasan->update($data);

        return response()->json([
            'success'    => true,
            'message'    => 'Data berhasil di update!',
            // 'data'    => $data,
            // 'sekolah'    => $sekolah,
            // 'item'    => $item,
        ], 200);
    }

    public function myProfileUpdatePassword(Request $request)
    {
        $item = $this->me;
        //set validation
        $validator = Validator::make($request->all(), [
            'password'   => 'required',
        ]);
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $data = $request->except('_token', 'status', 'password');
        // sekolah::create($data);
        $data['password'] = Hash::make($request->password);

        $yayasan = Yayasan::find($item->id);
        $yayasan->update($data);

        return response()->json([
            'success'    => true,
            'message'    => 'Data berhasil di update!',
            // 'data'    => $data,
            // 'gurubk'    => $gurubk,
            // 'password'    => $request->password,
        ], 200);
    }


    public function uploadLogo(Request $request)
    {

        // return response()->json([
        //     'success'    => true,
        //     'message'    => 'Data berhasil di update!',
        //     'data'    => $request->file('file')
        //     // 'sekolah'    => $sekolah,
        //     // 'item'    => $item,
        // ], 200);
        $item = $this->me;
        // set validation
        $validator = Validator::make($request->all(), [
            'file'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ]);
        // response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // upload photo
        $path = 'uploads/images/yayasan';
        $file = $request->file('file');
        // $nama_file = rand() . $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $nama_file = $item->id . '.' . $ext;
        $file->move($path, $nama_file);
        $data['photo'] = $path . '/' . $nama_file;

        $getData = images::where('prefix', 'yayasan')->where('parrent_id', $item->id);
        if ($getData->count() > 0) {
            $getData->update($data);
        } else {
            $data['prefix'] = 'yayasan';
            $data['parrent_id'] = $item->id;
            $data['nama'] = "Photo Yayasan";
            images::create($data);
        }

        return response()->json([
            'success'    => true,
            'message'    => 'Data berhasil di update!',
            'data'    => $nama_file,
            // 'sekolah'    => $sekolah,
            // 'item'    => $item,
        ], 200);
    }
    public function uploadKepala(Request $request)
    {
        $item = $this->me;
        // set validation
        $validator = Validator::make($request->all(), [
            'file'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ]);
        // response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // upload photo
        $path = 'uploads/images/kepalayayasan';
        $file = $request->file('file');
        // $nama_file = rand() . $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $nama_file = $item->id . '.' . $ext;
        $file->move($path, $nama_file);
        $data['photo'] = $path . '/' . $nama_file;

        $getData = images::where('prefix', 'kepalayayasan')->where('parrent_id', $item->id);
        if ($getData->count() > 0) {
            $getData->update($data);
        } else {
            $data['prefix'] = 'kepalayayasan';
            $data['parrent_id'] = $item->id;
            $data['nama'] = "Photo kepalayayasan";
            images::create($data);
        }

        return response()->json([
            'success'    => true,
            'message'    => 'Data berhasil di update!',
            'data'    => $nama_file,
            // 'sekolah'    => $sekolah,
            // 'item'    => $item,
        ], 200);
    }


    public function getPhoto(Request $request)
    {
        $item = $this->me;
        $listPhoto = (object)[
            'logo' => '',
            'kepala' => '',
            'user' => ''
        ];
        $getData = images::where('prefix', 'yayasan')->where('parrent_id', $item->id);
        if ($getData->count() > 0) {
            $data = $getData->first();
            $listPhoto->logo = URL::to($data->photo);
            $listPhoto->user = URL::to($data->photo);
        }

        $getData = images::where('prefix', 'kepalayayasan')->where('parrent_id', $item->id);
        if ($getData->count() > 0) {
            $data = $getData->first();
            $listPhoto->kepala = URL::to($data->photo);
        }
        return response()->json([
            'success'    => true,
            'message'    => 'Data berhasil di update!',
            'data'    => $listPhoto,
            'getData'    => $item->id,
        ], 200);
    }
}
