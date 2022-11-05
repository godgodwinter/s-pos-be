<?php

namespace App\Http\Controllers;

use App\Models\images;
use App\Models\kelas;
use App\Models\paket;
use App\Models\sekolah;
use App\Models\Siswa;
use App\Models\ujian_proses_kelas;
use App\Models\walikelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class AuthSiswaController extends Controller
{

    protected $me;
    protected $sekolah_id;
    public function __construct()
    {
        $this->me = $this->guard()->user();
        $s_id = $this->me ? $this->me->sekolah_id : 0;
        $sekolah = sekolah::where('id', $s_id)->first();
        $this->me = $this->guard()->user();
        $this->sekolah_id = $sekolah ? $sekolah->id : null;
        $this->kelas_id = $this->me ? $this->me->kelas_id : null;
        $this->middleware('auth:siswa', ['except' => ['login', 'register']]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|',
            'password' => 'required|string',
        ]);
        // return response()->json([
        //     // 'token' => $token,
        //     'token2' => 'aaa',
        //     'code' => 200,
        //     'token_type' => 'bearer',
        //     // 'expires_in' => $this->guard()->factory()->getTTL() * 1  //auto logout after 1 hour (default)
        // ]);
        $email = $request->email;
        // // $credentials = $request->only('email', 'password');
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
            'status_login' => 'Aktif',
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

        $user = Siswa::create([
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
        $getData = images::where('prefix', 'sekolah')->where('parrent_id', $this->sekolah_id);
        if ($getData->count() > 0) {
            $data = $getData->first();
            $listPhoto->logo = URL::to($data->photo);
            $listPhoto->user = URL::to($data->photo);
        }

        $getData = images::where('prefix', 'kepalasekolah')->where('parrent_id', $this->sekolah_id);
        if ($getData->count() > 0) {
            $data = $getData->first();
            $listPhoto->kepala = URL::to($data->photo);
        }
        $items = [];
        $identitas = $this->guard()->user();
        $identitas = Siswa::with('kelas')->where('id', $identitas->id)->first();
        $items['identitas'] = $identitas;
        $items['identitas']['photosekolah'] = null;
        $items['identitas']['photokepsek'] = null;
        $sekolah = sekolah::where('id', $identitas->sekolah_id)->first();
        $items['sekolah'] = $sekolah;
        $items['paket'] = paket::where('id', $sekolah->paket_id)->count() > 0 ? paket::where('id', $sekolah->paket_id)->first() : paket::first();
        $stats = [];
        $stats['kelas'] = kelas::where('sekolah_id', $sekolah->id)->count() > 0 ? kelas::where('sekolah_id', $sekolah->id)->count() : 0;
        $stats['siswa'] = Siswa::where('sekolah_id', $sekolah->id)->count() > 0 ? Siswa::where('sekolah_id', $sekolah->id)->count() : 0;
        $stats['walikelas'] = walikelas::where('sekolah_id', $sekolah->id)->count() > 0 ? walikelas::where('sekolah_id', $sekolah->id)->count() : 0;
        $items['stats'] = $stats;
        $items['identitas']['photo'] = $listPhoto;

        $items['identitas']['kelas_nama'] = $identitas->kelas ? $identitas->kelas->nama : null;
        return response()->json($items);
    }

    public function me_ujian()
    {
        $items = [];
        $getDataUjianProsesKelas = ujian_proses_kelas::where('kelas_id', $this->kelas_id)->where('status', 'Aktif')->get();
        $ujian = [];
        $identitas = (object)[];
        $getDataSekolah = sekolah::select('id', 'nama')->where('id', $this->sekolah_id)->first();
        $identitas->sekolah = $getDataSekolah;
        $getDataKelas = kelas::select('id', 'nama')->where('id', $this->kelas_id)->first();
        $identitas->kelas = $getDataKelas;
        $getDataSiswa = Siswa::select('id', 'nama', 'nomeridentitas')->where('id', $this->me->id)->first();
        $identitas->profile = $getDataSiswa;
        if ($identitas->sekolah) {
            $getPaket = paket::where('id', $identitas->sekolah->paket_id)->count() > 0 ? paket::where('id', $identitas->sekolah->paket_id)->first() : paket::first();
        } else {
            $getPaket = paket::first();
        }
        $identitas->paket = $getPaket;
        $items['identitas'] = $identitas;
        $items['kelas_id'] = $this->kelas_id;
        $items['ujian'] = $getDataUjianProsesKelas;
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
            'token2' => 'aaa',
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
        return Auth::guard('siswa');
    }
}
