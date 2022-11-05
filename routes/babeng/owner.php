<?php

use App\Http\Controllers\admin\adminApiprobkController;
use App\Http\Controllers\admin\adminBuletinController;
use App\Http\Controllers\admin\adminCatatanKasusSiswaController;
use App\Http\Controllers\admin\adminCatatanPengembanganDiriController;
use App\Http\Controllers\admin\adminCatatanPrestasiSiswaController;
use App\Http\Controllers\admin\adminKataBijakController;
use App\Http\Controllers\admin\adminKecerdasanMajemukController;
use App\Http\Controllers\admin\adminKlasifikasiAkademisController;
use App\Http\Controllers\admin\adminOwnerController;
use App\Http\Controllers\admin\adminPaketController;
use App\Http\Controllers\admin\adminPenangananDeteksiMasalahController;
use App\Http\Controllers\admin\adminProsesController;
use App\Http\Controllers\admin\adminReferensiStudiController;
use App\Http\Controllers\admin\adminSekolahBkController;
use App\Http\Controllers\admin\adminSekolahController;
use App\Http\Controllers\admin\adminSekolahGuruBkController;
use App\Http\Controllers\admin\adminSekolahKelasController;
use App\Http\Controllers\admin\adminSekolahSiswaController;
use App\Http\Controllers\admin\adminSekolahWaliKelasController;
use App\Http\Controllers\admin\adminTerapisKarakterPositifController;
use App\Http\Controllers\admin\adminUjianBankSoalController;
use App\Http\Controllers\admin\adminUjianKategoriController;
use App\Http\Controllers\admin\adminYayasanController;
use App\Http\Controllers\AuthOwnerController;
use App\Http\Controllers\owner\ownerHasilPsikologiController;
use App\Http\Controllers\owner\ownerSekolahController;
use App\Http\Controllers\owner\ownerYayasanController;
use Illuminate\Support\Facades\Route;



Route::post('/owner/auth/login', [AuthOwnerController::class, 'login']);
Route::middleware('auth:owner')->group(function () {


    Route::post('/owner/apiprobk/store ', [adminApiprobkController::class, 'store']);
    Route::get('/owner/apiprobk/all', [adminApiprobkController::class, 'all']);
    Route::post('/owner/apiprobk/upload', [adminApiprobkController::class, 'upload']);
    Route::post('/owner/apiprobk/api_backup ', [adminApiprobkController::class, 'api_backup']);
    Route::post('/owner/apiprobk/api_backup_deteksi ', [adminApiprobkController::class, 'api_backup_deteksi']);
    Route::post('/owner/apiprobk/sinkron ', [adminApiprobkController::class, 'sinkron']);
    Route::post('/owner/apiprobk/gagal ', [adminApiprobkController::class, 'gagal']);
    Route::post('/owner/apiprobk/reset ', [adminApiprobkController::class, 'reset']);
    Route::post('/owner/proses/cleartemp ', [adminProsesController::class, 'clearTemp']);


    // Route::post('/siswa/auth/register', [AuthSiswaController::class, 'register'])->name('siswa.auth.register');
    Route::post('/owner/auth/logout', [AuthOwnerController::class, 'logout']);
    Route::post('/owner/auth/refresh', [AuthOwnerController::class, 'refresh']);
    Route::post('/owner/auth/me', [AuthOwnerController::class, 'me']);


    Route::get('/owner/sekolah', [ownerSekolahController::class, 'index']);
    Route::post('/owner/sekolah', [ownerSekolahController::class, 'store']);
    Route::get('/owner/sekolah/{item}', [adminSekolahController::class, 'edit']);
    Route::put('/owner/sekolah/{item}', [ownerSekolahController::class, 'update']);
    Route::delete('/owner/sekolah/{item}', [ownerSekolahController::class, 'destroy']);
    Route::post('/owner/sekolah/{item}/updatestatus', [ownerSekolahController::class, 'updatestatus']); //update status

    Route::get('/owner/yayasan', [ownerYayasanController::class, 'index']);;
    Route::post('/owner/yayasan', [adminYayasanController::class, 'store']);
    Route::get('/owner/yayasan/{item}', [adminYayasanController::class, 'edit']);
    Route::put('/owner/yayasan/{item}', [adminYayasanController::class, 'update']);
    Route::delete('/owner/yayasan/{item}', [adminYayasanController::class, 'destroy']);

    Route::get('/owner/yayasan/{yayasan}/detail', [ownerYayasanController::class, 'detail']);
    Route::get('/owner/yayasan/{yayasan}/detail/getsekolah', [adminYayasanController::class, 'detail_getsekolah']);
    Route::post('/owner/yayasan/{yayasan}/detail', [adminYayasanController::class, 'detail_store']);
    Route::delete('/owner/yayasan/{yayasan}/detail/{item}', [adminYayasanController::class, 'detail_destroy']);

    Route::get('/owner/klasifikasi', [adminKlasifikasiAkademisController::class, 'index']);
    Route::post('/owner/klasifikasi', [adminKlasifikasiAkademisController::class, 'store']);
    Route::get('/owner/klasifikasi/{item}', [adminKlasifikasiAkademisController::class, 'edit']);
    Route::put('/owner/klasifikasi/{item}', [adminKlasifikasiAkademisController::class, 'update']);
    Route::delete('/owner/klasifikasi/{item}', [adminKlasifikasiAkademisController::class, 'destroy']);

    Route::get('/owner/referensi', [adminReferensiStudiController::class, 'index']);
    Route::post('/owner/referensi', [adminReferensiStudiController::class, 'store']);
    Route::get('/owner/referensi/{item}', [adminReferensiStudiController::class, 'edit']);
    Route::put('/owner/referensi/{item}', [adminReferensiStudiController::class, 'update']);
    Route::delete('/owner/referensi/{item}', [adminReferensiStudiController::class, 'destroy']);

    Route::get('/owner/buletinpsikologi', [adminBuletinController::class, 'index']);
    Route::post('/owner/buletinpsikologi', [adminBuletinController::class, 'store']);
    Route::get('/owner/buletinpsikologi/{item}', [adminBuletinController::class, 'edit']);
    Route::post('/owner/buletinpsikologi/{item}', [adminBuletinController::class, 'update']);
    Route::delete('/owner/buletinpsikologi/{item}', [adminBuletinController::class, 'destroy']);

    Route::get('/owner/terapis', [adminTerapisKarakterPositifController::class, 'index']);
    Route::post('/owner/terapis', [adminTerapisKarakterPositifController::class, 'store']);
    Route::get('/owner/terapis/{item}', [adminTerapisKarakterPositifController::class, 'edit']);
    Route::put('/owner/terapis/{item}', [adminTerapisKarakterPositifController::class, 'update']);
    Route::delete('/owner/terapis/{item}', [adminTerapisKarakterPositifController::class, 'destroy']);
    // penanganandeteksimasalah
    Route::get('/owner/penanganandeteksimasalah/masterdeteksi', [adminPenangananDeteksiMasalahController::class, 'masterdeteksi']);
    Route::get('/owner/penanganandeteksimasalah/masterdeteksi/{item}', [adminPenangananDeteksiMasalahController::class, 'masterdeteksi_id']);
    Route::post('/owner/penanganandeteksimasalah/masterdeteksi/{item}', [adminPenangananDeteksiMasalahController::class, 'masterdeteksi_store']);
    // Route::put('/admin/penanganandeteksimasalah/masterdeteksi/{item}', [adminPenangananDeteksiMasalahController::class, 'masterdeteksi_update']);
    Route::delete('/owner/penanganandeteksimasalah/masterdeteksi/{item}', [adminPenangananDeteksiMasalahController::class, 'masterdeteksi_destroy']);
    // penanganandeteksimasalah


    Route::get('/owner/katabijak', [adminKataBijakController::class, 'index']);
    Route::post('/owner/katabijak', [adminKataBijakController::class, 'store']);
    Route::get('/owner/katabijak/{item}', [adminKataBijakController::class, 'edit']);
    Route::put('/owner/katabijak/{item}', [adminKataBijakController::class, 'update']);
    Route::delete('/owner/katabijak/{item}', [adminKataBijakController::class, 'destroy']);


    Route::get('/owner/katabijak/{item}/detail', [adminKataBijakController::class, 'katabijakdetail_get']);
    Route::post('/owner/katabijak/{item}/detail', [adminKataBijakController::class, 'katabijakdetail_store']);
    Route::get('/owner/katabijak/{item}/detail/{id}', [adminKataBijakController::class, 'katabijakdetail_edit']);
    Route::put('/owner/katabijak/{item}/detail/{id}', [adminKataBijakController::class, 'katabijakdetail_update']);
    Route::delete('/owner/katabijak/{item}/detail/{id}', [adminKataBijakController::class, 'katabijakdetail_destroy']);





    Route::get('/owner/kecerdasanmajemuk', [adminKecerdasanMajemukController::class, 'index']);
    Route::post('/owner/kecerdasanmajemuk', [adminKecerdasanMajemukController::class, 'store']);
    Route::get('/owner/kecerdasanmajemuk/{item}', [adminKecerdasanMajemukController::class, 'edit']);
    Route::put('/owner/kecerdasanmajemuk/{item}', [adminKecerdasanMajemukController::class, 'update']);
    Route::delete('/owner/kecerdasanmajemuk/{item}', [adminKecerdasanMajemukController::class, 'destroy']);


    Route::get('/owner/owner', [adminOwnerController::class, 'index']);
    Route::post('/owner/owner', [adminOwnerController::class, 'store']);
    Route::get('/owner/owner/{item}', [adminOwnerController::class, 'edit']);
    Route::put('/owner/owner/{item}', [adminOwnerController::class, 'update']);
    Route::delete('/owner/owner/{item}', [adminOwnerController::class, 'destroy']);

    // submenu sekolah

    Route::get('/owner/hasilpsikologi/detail/{siswa}', [ownerHasilPsikologiController::class, 'detail']);
    Route::get('/owner/hasilpsikologi/kecerdasanmajemuk/{siswa}', [ownerHasilPsikologiController::class, 'kecerdasanmajemuk']);
    // Route::get('/owner/hasilpsikologi/withdetail/{sekolah_id}', [ownerHasilPsikologiController::class, 'withdetail']);
    Route::get('/owner/hasilpsikologi/withdetail/{kelas}/kelas', [ownerHasilPsikologiController::class, 'withdetail_perkelas']);



    // Route::get('/owner/datasekolah/{sekolah}/datasiswa/withsertifikat', [adminSekolahSiswaController::class, 'withsertifikat']);

    Route::post('/owner/datasekolah/{sekolah}/siswa/generateakun', [adminSekolahSiswaController::class, 'generateakun']);
    Route::post('/owner/datasekolah/{sekolah}/siswa/generateakunforceall', [adminSekolahSiswaController::class, 'generateakunforceall']);
    Route::post('/owner/datasekolah/{sekolah}/siswa/generateakunforceall/delete', [adminSekolahSiswaController::class, 'generateakunforceallDelete']);

    Route::get('/owner/datasekolah/{sekolah}/siswa/generateakun/list', [adminSekolahSiswaController::class, 'generateakunList']);
    Route::post('/owner/datasekolah/{sekolah}/siswa/generateakun/persiswa/{siswa}', [adminSekolahSiswaController::class, 'generateakunPerSiswa']);

    Route::put('/owner/siswa/{siswa}/pindahkelas', [adminSekolahSiswaController::class, 'pindahkelas']);
    Route::get('/owner/datasekolah/{sekolah}/siswa', [adminSekolahSiswaController::class, 'index']);
    Route::post('/owner/datasekolah/{sekolah}/siswa', [adminSekolahSiswaController::class, 'store']);
    Route::get('/owner/datasekolah/{sekolah}/siswa/{item}', [adminSekolahSiswaController::class, 'edit']);
    Route::put('/owner/datasekolah/{sekolah}/siswa/{item}', [adminSekolahSiswaController::class, 'update']);
    Route::delete('/owner/datasekolah/{sekolah}/siswa/{item}', [adminSekolahSiswaController::class, 'destroy']);

    Route::get('/owner/datasekolah/{sekolah}/kelas', [adminSekolahKelasController::class, 'index']);
    Route::post('/owner/datasekolah/{sekolah}/kelas', [adminSekolahKelasController::class, 'store']);
    Route::get('/owner/datasekolah/{sekolah}/kelas/{item}', [adminSekolahKelasController::class, 'edit']);
    Route::put('/owner/datasekolah/{sekolah}/kelas/{item}', [adminSekolahKelasController::class, 'update']);
    Route::delete('/owner/datasekolah/{sekolah}/kelas/{item}', [adminSekolahKelasController::class, 'destroy']);



    Route::get('/owner/datasekolah/{sekolah}/walikelas', [adminSekolahWaliKelasController::class, 'index']);
    Route::post('/owner/datasekolah/{sekolah}/walikelas', [adminSekolahWaliKelasController::class, 'store']);
    Route::get('/owner/datasekolah/{sekolah}/walikelas/{item}', [adminSekolahWaliKelasController::class, 'edit']);
    Route::put('/owner/datasekolah/{sekolah}/walikelas/{item}', [adminSekolahWaliKelasController::class, 'update']);
    Route::delete('/owner/datasekolah/{sekolah}/walikelas/{item}', [adminSekolahWaliKelasController::class, 'destroy']);


    Route::get('/owner/datasekolah/{sekolah}/bk', [adminSekolahBkController::class, 'index']);
    Route::post('/owner/datasekolah/{sekolah}/bk', [adminSekolahBkController::class, 'store']);
    Route::get('/owner/datasekolah/{sekolah}/bk/{item}', [adminSekolahBkController::class, 'edit']);
    Route::put('/owner/datasekolah/{sekolah}/bk/{item}', [adminSekolahBkController::class, 'update']);
    Route::delete('/owner/datasekolah/{sekolah}/bk/{item}', [adminSekolahBkController::class, 'destroy']);

    Route::get('/owner/datasekolah/{sekolah}/gurubk', [adminSekolahGuruBkController::class, 'index']);
    Route::post('/owner/datasekolah/{sekolah}/gurubk', [adminSekolahGuruBkController::class, 'store']);
    Route::get('/owner/datasekolah/{sekolah}/gurubk/{item}', [adminSekolahGuruBkController::class, 'edit']);
    Route::put('/owner/datasekolah/{sekolah}/gurubk/{item}', [adminSekolahGuruBkController::class, 'update']);
    Route::delete('/owner/datasekolah/{sekolah}/gurubk/{item}', [adminSekolahGuruBkController::class, 'destroy']);


    Route::get('/owner/datasekolah/{sekolah}/catatankasussiswa/siswa', [adminCatatanKasusSiswaController::class, 'siswa']);
    Route::get('/owner/datasekolah/{sekolah}/siswa/{siswa}/catatankasussiswa', [adminCatatanKasusSiswaController::class, 'index']);
    Route::post('/owner/datasekolah/{sekolah}/siswa/{siswa}/catatankasussiswa', [adminCatatanKasusSiswaController::class, 'store']);
    Route::get('/owner/datasekolah/{sekolah}/siswa/{siswa}/catatankasussiswa/{item}', [adminCatatanKasusSiswaController::class, 'edit']);
    Route::put('/owner/datasekolah/{sekolah}/siswa/{siswa}/catatankasussiswa/{item}', [adminCatatanKasusSiswaController::class, 'update']);
    Route::delete('/owner/datasekolah/{sekolah}/siswa/{siswa}/catatankasussiswa/{item}', [adminCatatanKasusSiswaController::class, 'destroy']);


    Route::get('/owner/datasekolah/{sekolah}/catatanpengembangandiri/siswa', [adminCatatanPengembanganDiriController::class, 'siswa']);
    Route::get('/owner/datasekolah/{sekolah}/siswa/{siswa}/catatanpengembangandiri', [adminCatatanPengembanganDiriController::class, 'index']);
    Route::post('/owner/datasekolah/{sekolah}/siswa/{siswa}/catatanpengembangandiri', [adminCatatanPengembanganDiriController::class, 'store']);
    Route::get('/owner/datasekolah/{sekolah}/siswa/{siswa}/catatanpengembangandiri/{item}', [adminCatatanPengembanganDiriController::class, 'edit']);
    Route::put('/owner/datasekolah/{sekolah}/siswa/{siswa}/catatanpengembangandiri/{item}', [adminCatatanPengembanganDiriController::class, 'update']);
    Route::delete('/owner/datasekolah/{sekolah}/siswa/{siswa}/catatanpengembangandiri/{item}', [adminCatatanPengembanganDiriController::class, 'destroy']);

    Route::get('/owner/datasekolah/{sekolah}/catatanprestasisiswa/siswa', [adminCatatanPrestasiSiswaController::class, 'siswa']);
    Route::get('/owner/datasekolah/{sekolah}/siswa/{siswa}/catatanprestasisiswa', [adminCatatanPrestasiSiswaController::class, 'index']);
    Route::post('/owner/datasekolah/{sekolah}/siswa/{siswa}/catatanprestasisiswa', [adminCatatanPrestasiSiswaController::class, 'store']);
    Route::get('/owner/datasekolah/{sekolah}/siswa/{siswa}/catatanprestasisiswa/{item}', [adminCatatanPrestasiSiswaController::class, 'edit']);
    Route::put('/owner/datasekolah/{sekolah}/siswa/{siswa}/catatanprestasisiswa/{item}', [adminCatatanPrestasiSiswaController::class, 'update']);
    Route::delete('/owner/datasekolah/{sekolah}/siswa/{siswa}/catatanprestasisiswa/{item}', [adminCatatanPrestasiSiswaController::class, 'destroy']);



    Route::post('/owner/myprofile/update', [AuthOwnerController::class, 'myprofileupdate']);
    Route::post('/owner/myprofile/updatepassword', [AuthOwnerController::class, 'myProfileUpdatePassword']);
    Route::post('/owner/myprofile/upload/logo', [AuthOwnerController::class, 'uploadLogo']);
    Route::get('/owner/myprofile/upload/getphoto', [AuthOwnerController::class, 'getPhoto']);

    Route::get('/owner/paket', [adminPaketController::class, 'index']);
    Route::get('/owner/paket/{paket}', [adminPaketController::class, 'detail']);

    //


    Route::get('/owner/menuujian/banksoal', [adminUjianBankSoalController::class, 'index']);
    Route::post('/owner/menuujian/banksoal', [adminUjianBankSoalController::class, 'store']);
    Route::get('/owner/menuujian/banksoal/{item}', [adminUjianBankSoalController::class, 'edit']);
    Route::put('/owner/menuujian/banksoal/{item}', [adminUjianBankSoalController::class, 'update']);
    Route::delete('/owner/menuujian/banksoal/{item}', [adminUjianBankSoalController::class, 'destroy']);
});
