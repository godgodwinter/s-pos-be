<?php

use App\Http\Controllers\admin\adminAdministratorController;
use App\Http\Controllers\admin\adminApiprobkController;
use App\Http\Controllers\admin\adminApiprobkServerController;
use App\Http\Controllers\admin\adminBuletinController;
use App\Http\Controllers\admin\adminCatatanKasusSiswaController;
use App\Http\Controllers\admin\adminCatatanPengembanganDiriController;
use App\Http\Controllers\admin\adminCatatanPrestasiSiswaController;
use App\Http\Controllers\admin\adminSekolahGuruBkController;
use App\Http\Controllers\admin\adminKataBijakController;
use App\Http\Controllers\admin\adminKecerdasanMajemukController;
use App\Http\Controllers\admin\adminKelasController;
use App\Http\Controllers\admin\adminKlasifikasiAkademisController;
use App\Http\Controllers\admin\adminOwnerController;
use App\Http\Controllers\admin\adminPaketController;
use App\Http\Controllers\admin\adminPembimbingLapanganController;
use App\Http\Controllers\admin\adminPembimbingSekolahController;
use App\Http\Controllers\admin\adminPenangananDeteksiMasalahController;
use App\Http\Controllers\admin\adminPendaftaranPrakerinController;
use App\Http\Controllers\admin\adminPendaftaranPrakerinDetailController;
use App\Http\Controllers\admin\adminPendaftaranPrakerinListController;
use App\Http\Controllers\admin\adminProsesController;
use App\Http\Controllers\admin\adminReferensiStudiController;
use App\Http\Controllers\admin\adminSekolahBkController;
use App\Http\Controllers\admin\adminSekolahController;
use App\Http\Controllers\admin\adminSekolahKelasController;
use App\Http\Controllers\admin\adminSekolahSiswaController;
use App\Http\Controllers\admin\adminSekolahWaliKelasController;
use App\Http\Controllers\admin\adminSettingsController;
use App\Http\Controllers\admin\adminSiswaController;
use App\Http\Controllers\admin\adminTapelController;
use App\Http\Controllers\admin\adminTempatPklController;
use App\Http\Controllers\admin\adminTerapisKarakterPositifController;
use App\Http\Controllers\admin\adminUjianBankSoalAspekController;
use App\Http\Controllers\admin\adminUjianBankSoalController;
use App\Http\Controllers\admin\adminUjianCetakController;
use App\Http\Controllers\admin\adminUjianHasilController;
use App\Http\Controllers\admin\adminUjianKategoriController;
use App\Http\Controllers\admin\adminUjianPaketSoalController;
use App\Http\Controllers\admin\adminUjianPaketsoalKategoriController;
use App\Http\Controllers\admin\adminUjianProsesController;
use App\Http\Controllers\admin\adminUjianProsesKelasController;
use App\Http\Controllers\admin\adminUjianRekapPenilaianController;
use App\Http\Controllers\admin\adminUjianResetController;
use App\Http\Controllers\admin\adminYayasanController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



Route::post('/admin/auth/login', [AuthController::class, 'login'])->name('admin.auth.login');
// Route::post('/admin/auth/register', [AuthController::class, 'register'])->name('admin.auth.register');
// Route::middleware('api')->group(function () {
Route::middleware('auth:api')->group(function () {



    Route::post('/admin/apiprobk/store ', [adminApiprobkController::class, 'store']);
    Route::get('/admin/apiprobk/all', [adminApiprobkController::class, 'all']);
    Route::post('/admin/apiprobk/upload', [adminApiprobkController::class, 'upload']);
    Route::post('/admin/apiprobk/api_backup ', [adminApiprobkController::class, 'api_backup']);
    Route::post('/admin/apiprobk/api_backup_deteksi ', [adminApiprobkController::class, 'api_backup_deteksi']);
    Route::post('/admin/apiprobk/sinkron ', [adminApiprobkController::class, 'sinkron']);
    Route::post('/admin/apiprobk/gagal ', [adminApiprobkController::class, 'gagal']);
    Route::post('/admin/apiprobk/reset ', [adminApiprobkController::class, 'reset']);


    Route::post('/admin/apiprobk/api_backup/update/{sertifikat} ', [adminApiprobkController::class, 'api_backup_update']);
    Route::post('/admin/apiprobk/api_backup_deteksi/update/{deteksi}', [adminApiprobkController::class, 'api_backup_deteksi_update']);
    Route::post('/admin/apiprobk/sinkron/update ', [adminApiprobkController::class, 'sinkron_update']);


    //
    Route::get('/admin/apiprobk/kelas/{kelas}', [adminApiprobkController::class, 'getListKelas']); //ambil data list siswa perkelas


    //menu-portofolio
    Route::post('/admin/auth/logout', [AuthController::class, 'logout'])->name('admin.auth.logout');
    Route::post('/admin/auth/refresh', [AuthController::class, 'refresh'])->name('admin.auth.refresh');
    Route::post('/admin/auth/me', [AuthController::class, 'me'])->name('admin.auth.me');

    Route::get('/admin/settings/get', [adminSettingsController::class, 'index'])->name('admin.settings.get');


    Route::get('/admin/klasifikasi', [adminKlasifikasiAkademisController::class, 'index']);
    Route::post('/admin/klasifikasi', [adminKlasifikasiAkademisController::class, 'store']);
    Route::get('/admin/klasifikasi/{item}', [adminKlasifikasiAkademisController::class, 'edit']);
    Route::put('/admin/klasifikasi/{item}', [adminKlasifikasiAkademisController::class, 'update']);
    Route::delete('/admin/klasifikasi/{item}', [adminKlasifikasiAkademisController::class, 'destroy']);

    Route::get('/admin/referensi', [adminReferensiStudiController::class, 'index']);
    Route::post('/admin/referensi', [adminReferensiStudiController::class, 'store']);
    Route::get('/admin/referensi/{item}', [adminReferensiStudiController::class, 'edit']);
    Route::put('/admin/referensi/{item}', [adminReferensiStudiController::class, 'update']);
    Route::delete('/admin/referensi/{item}', [adminReferensiStudiController::class, 'destroy']);

    Route::get('/admin/buletinpsikologi', [adminBuletinController::class, 'index']);
    Route::post('/admin/buletinpsikologi', [adminBuletinController::class, 'store']);
    Route::get('/admin/buletinpsikologi/{item}', [adminBuletinController::class, 'edit']);
    Route::put('/admin/buletinpsikologi/{item}', [adminBuletinController::class, 'update']);
    Route::delete('/admin/buletinpsikologi/{item}', [adminBuletinController::class, 'destroy']);

    Route::get('/admin/terapis', [adminTerapisKarakterPositifController::class, 'index']);
    Route::post('/admin/terapis', [adminTerapisKarakterPositifController::class, 'store']);
    Route::get('/admin/terapis/{item}', [adminTerapisKarakterPositifController::class, 'edit']);
    Route::put('/admin/terapis/{item}', [adminTerapisKarakterPositifController::class, 'update']);
    Route::delete('/admin/terapis/{item}', [adminTerapisKarakterPositifController::class, 'destroy']);
    // penanganandeteksimasalah
    Route::get('/admin/penanganandeteksimasalah/masterdeteksi', [adminPenangananDeteksiMasalahController::class, 'masterdeteksi']);
    Route::get('/admin/penanganandeteksimasalah/masterdeteksi/{item}', [adminPenangananDeteksiMasalahController::class, 'masterdeteksi_id']);
    Route::post('/admin/penanganandeteksimasalah/masterdeteksi/{item}', [adminPenangananDeteksiMasalahController::class, 'masterdeteksi_store']);
    // Route::put('/admin/penanganandeteksimasalah/masterdeteksi/{item}', [adminPenangananDeteksiMasalahController::class, 'masterdeteksi_update']);
    Route::delete('/admin/penanganandeteksimasalah/masterdeteksi/{item}', [adminPenangananDeteksiMasalahController::class, 'masterdeteksi_destroy']);
    // penanganandeteksimasalah


    Route::get('/admin/katabijak', [adminKataBijakController::class, 'index']);
    Route::post('/admin/katabijak', [adminKataBijakController::class, 'store']);
    Route::get('/admin/katabijak/{item}', [adminKataBijakController::class, 'edit']);
    Route::put('/admin/katabijak/{item}', [adminKataBijakController::class, 'update']);
    Route::delete('/admin/katabijak/{item}', [adminKataBijakController::class, 'destroy']);


    Route::get('/admin/katabijak/{item}/detail', [adminKataBijakController::class, 'katabijakdetail_get']);
    Route::post('/admin/katabijak/{item}/detail', [adminKataBijakController::class, 'katabijakdetail_store']);
    Route::get('/admin/katabijak/{item}/detail/{id}', [adminKataBijakController::class, 'katabijakdetail_edit']);
    Route::put('/admin/katabijak/{item}/detail/{id}', [adminKataBijakController::class, 'katabijakdetail_update']);
    Route::delete('/admin/katabijak/{item}/detail/{id}', [adminKataBijakController::class, 'katabijakdetail_destroy']);


    // Route::get('/admin/datasekolah', [adminSekolahController::class, 'datasekolah']);


    Route::get('/admin/paket', [adminPaketController::class, 'index']);
    Route::get('/admin/paket/{paket}', [adminPaketController::class, 'detail']);



    Route::get('/admin/kecerdasanmajemuk', [adminKecerdasanMajemukController::class, 'index']);
    Route::post('/admin/kecerdasanmajemuk', [adminKecerdasanMajemukController::class, 'store']);
    Route::get('/admin/kecerdasanmajemuk/{item}', [adminKecerdasanMajemukController::class, 'edit']);
    Route::put('/admin/kecerdasanmajemuk/{item}', [adminKecerdasanMajemukController::class, 'update']);
    Route::delete('/admin/kecerdasanmajemuk/{item}', [adminKecerdasanMajemukController::class, 'destroy']);




    Route::get('/admin/owner', [adminOwnerController::class, 'index']);
    Route::post('/admin/owner', [adminOwnerController::class, 'store']);
    Route::get('/admin/owner/{item}', [adminOwnerController::class, 'edit']);
    Route::put('/admin/owner/{item}', [adminOwnerController::class, 'update']);
    Route::delete('/admin/owner/{item}', [adminOwnerController::class, 'destroy']);


    Route::get('/admin/administrator', [adminAdministratorController::class, 'index']);
    Route::post('/admin/administrator', [adminAdministratorController::class, 'store']);
    Route::get('/admin/administrator/{item}', [adminAdministratorController::class, 'edit']);
    Route::put('/admin/administrator/{item}', [adminAdministratorController::class, 'update']);
    Route::delete('/admin/administrator/{item}', [adminAdministratorController::class, 'destroy']);


    Route::get('/admin/yayasan', [adminYayasanController::class, 'index']);
    Route::post('/admin/yayasan', [adminYayasanController::class, 'store']);
    Route::get('/admin/yayasan/{item}', [adminYayasanController::class, 'edit']);
    Route::put('/admin/yayasan/{item}', [adminYayasanController::class, 'update']);
    Route::delete('/admin/yayasan/{item}', [adminYayasanController::class, 'destroy']);

    Route::get('/admin/yayasan/{yayasan}/detail', [adminYayasanController::class, 'detail']);
    Route::get('/admin/yayasan/{yayasan}/detail/getsekolah', [adminYayasanController::class, 'detail_getsekolah']);
    Route::post('/admin/yayasan/{yayasan}/detail', [adminYayasanController::class, 'detail_store']);
    Route::delete('/admin/yayasan/{yayasan}/detail/{item}', [adminYayasanController::class, 'detail_destroy']);

    // MENU-SEKOLAH-SUBMENU

    // Route::post('/admin/fungsi/terapis/perkalimat', [adminTerapisKarakterPositifController::class, 'perkalimat']);

    Route::get('/admin/sertifikat/{siswa}', [adminSekolahSiswaController::class, 'sertifikat']);
    // Route::get('/admin/datahasildeteksi/{siswa}/terapis', [adminSekolahSiswaController::class, 'terapis']);
    Route::get('/admin/deteksi/{siswa}', [adminSekolahSiswaController::class, 'deteksi']);
    // Route::get('/admin/datahasildeteksi/{siswa}/penanganan', [adminSekolahSiswaController::class, 'penanganan']);

    Route::get('/admin/datasiswa/{siswa}/minatbakat', [adminSekolahSiswaController::class, 'dataMinatbakat']);
    Route::post('/admin/datasiswa/{siswa}/minatbakat', [adminSekolahSiswaController::class, 'dataMinatbakatStore']);
    Route::get('/admin/datasiswa/{siswa}/penjurusan', [adminSekolahSiswaController::class, 'dataPenjurusan']);
    Route::post('/admin/datasiswa/{siswa}/penjurusan', [adminSekolahSiswaController::class, 'dataPenjurusanStore']);


    Route::post('/admin/datasekolah/{sekolah}/siswa/generateakun', [adminSekolahSiswaController::class, 'generateakun']);
    Route::post('/admin/datasekolah/{sekolah}/siswa/generateakunforceall', [adminSekolahSiswaController::class, 'generateakunforceall']);

    Route::put('/admin/siswa/{siswa}/pindahkelas', [adminSekolahSiswaController::class, 'pindahkelas']);
    Route::get('/admin/datasekolah/{sekolah}/siswa', [adminSekolahSiswaController::class, 'index']); //ganti
    Route::post('/admin/datasekolah/{sekolah}/siswa', [adminSekolahSiswaController::class, 'store']);
    Route::get('/admin/datasekolah/{sekolah}/siswa/{item}', [adminSekolahSiswaController::class, 'edit']);
    Route::put('/admin/datasekolah/{sekolah}/siswa/{item}', [adminSekolahSiswaController::class, 'update']);
    Route::delete('/admin/datasekolah/{sekolah}/siswa/{item}', [adminSekolahSiswaController::class, 'destroy']);
    Route::delete('/admin/datasekolah/{sekolah}/siswa/{item}/forceDestroy', [adminSekolahSiswaController::class, 'forceDestroy']);




    Route::get('/admin/datasekolah/{sekolah}/walikelas', [adminSekolahWaliKelasController::class, 'index']);
    Route::post('/admin/datasekolah/{sekolah}/walikelas', [adminSekolahWaliKelasController::class, 'store']);
    Route::get('/admin/datasekolah/{sekolah}/walikelas/{item}', [adminSekolahWaliKelasController::class, 'edit']);
    Route::put('/admin/datasekolah/{sekolah}/walikelas/{item}', [adminSekolahWaliKelasController::class, 'update']);
    Route::delete('/admin/datasekolah/{sekolah}/walikelas/{item}', [adminSekolahWaliKelasController::class, 'destroy']);

    Route::get('/admin/datasekolah/{sekolah}/bk', [adminSekolahBkController::class, 'index']);
    Route::post('/admin/datasekolah/{sekolah}/bk', [adminSekolahBkController::class, 'store']);
    Route::get('/admin/datasekolah/{sekolah}/bk/{item}', [adminSekolahBkController::class, 'edit']);
    Route::put('/admin/datasekolah/{sekolah}/bk/{item}', [adminSekolahBkController::class, 'update']);
    Route::delete('/admin/datasekolah/{sekolah}/bk/{item}', [adminSekolahBkController::class, 'destroy']);

    Route::get('/admin/datasekolah/{sekolah}/gurubk', [adminSekolahGuruBkController::class, 'index']);
    Route::post('/admin/datasekolah/{sekolah}/gurubk', [adminSekolahGuruBkController::class, 'store']);
    Route::get('/admin/datasekolah/{sekolah}/gurubk/{item}', [adminSekolahGuruBkController::class, 'edit']);
    Route::put('/admin/datasekolah/{sekolah}/gurubk/{item}', [adminSekolahGuruBkController::class, 'update']);
    Route::delete('/admin/datasekolah/{sekolah}/gurubk/{item}', [adminSekolahGuruBkController::class, 'destroy']);


    Route::get('/admin/datasekolah/{sekolah}/catatankasussiswa/siswa', [adminCatatanKasusSiswaController::class, 'siswa']);
    Route::get('/admin/datasekolah/{sekolah}/siswa/{siswa}/catatankasussiswa', [adminCatatanKasusSiswaController::class, 'index']);
    Route::post('/admin/datasekolah/{sekolah}/siswa/{siswa}/catatankasussiswa', [adminCatatanKasusSiswaController::class, 'store']);
    Route::get('/admin/datasekolah/{sekolah}/siswa/{siswa}/catatankasussiswa/{item}', [adminCatatanKasusSiswaController::class, 'edit']);
    Route::put('/admin/datasekolah/{sekolah}/siswa/{siswa}/catatankasussiswa/{item}', [adminCatatanKasusSiswaController::class, 'update']);
    Route::delete('/admin/datasekolah/{sekolah}/siswa/{siswa}/catatankasussiswa/{item}', [adminCatatanKasusSiswaController::class, 'destroy']);


    Route::get('/admin/datasekolah/{sekolah}/catatanpengembangandiri/siswa', [adminCatatanPengembanganDiriController::class, 'siswa']);
    Route::get('/admin/datasekolah/{sekolah}/siswa/{siswa}/catatanpengembangandiri', [adminCatatanPengembanganDiriController::class, 'index']);
    Route::post('/admin/datasekolah/{sekolah}/siswa/{siswa}/catatanpengembangandiri', [adminCatatanPengembanganDiriController::class, 'store']);
    Route::get('/admin/datasekolah/{sekolah}/siswa/{siswa}/catatanpengembangandiri/{item}', [adminCatatanPengembanganDiriController::class, 'edit']);
    Route::put('/admin/datasekolah/{sekolah}/siswa/{siswa}/catatanpengembangandiri/{item}', [adminCatatanPengembanganDiriController::class, 'update']);
    Route::delete('/admin/datasekolah/{sekolah}/siswa/{siswa}/catatanpengembangandiri/{item}', [adminCatatanPengembanganDiriController::class, 'destroy']);

    Route::get('/admin/datasekolah/{sekolah}/catatanprestasisiswa/siswa', [adminCatatanPrestasiSiswaController::class, 'siswa']);
    Route::get('/admin/datasekolah/{sekolah}/siswa/{siswa}/catatanprestasisiswa', [adminCatatanPrestasiSiswaController::class, 'index']);
    Route::post('/admin/datasekolah/{sekolah}/siswa/{siswa}/catatanprestasisiswa', [adminCatatanPrestasiSiswaController::class, 'store']);
    Route::get('/admin/datasekolah/{sekolah}/siswa/{siswa}/catatanprestasisiswa/{item}', [adminCatatanPrestasiSiswaController::class, 'edit']);
    Route::put('/admin/datasekolah/{sekolah}/siswa/{siswa}/catatanprestasisiswa/{item}', [adminCatatanPrestasiSiswaController::class, 'update']);
    Route::delete('/admin/datasekolah/{sekolah}/siswa/{siswa}/catatanprestasisiswa/{item}', [adminCatatanPrestasiSiswaController::class, 'destroy']);

    // MENU-SEKOLAH-SUBMENU


    Route::post('/admin/proses/cleartemp ', [adminProsesController::class, 'clearTemp']);

    // MENU-IMPORT
    Route::post('/admin/proses/import/klasifikasi', [adminProsesController::class, 'importKlasifikasi']);
    Route::post('/admin/proses/import/buletin', [adminProsesController::class, 'importBuletin']);
    Route::post('/admin/proses/import/terapis', [adminProsesController::class, 'importTerapis']);
    Route::post('/admin/proses/import/penanganan', [adminProsesController::class, 'importPenanganan']);
    Route::post('/admin/proses/import/katabijak', [adminProsesController::class, 'importKatabijak']);


    // MENU-IMPORT

    //MENU EXPORT
    //MENU EXPORT
});

// AUTH DICONTROLLER
Route::get('/admin/datasekolah/{sekolah}/datasiswa/{kelas}', [adminSekolahSiswaController::class, 'index_perkelas']);

Route::get('/admin/sekolah', [adminSekolahController::class, 'index']);
Route::post('/admin/sekolah', [adminSekolahController::class, 'store']);
Route::get('/admin/sekolah/{item}', [adminSekolahController::class, 'edit']);
Route::put('/admin/sekolah/{item}', [adminSekolahController::class, 'update']);
Route::delete('/admin/sekolah/{item}', [adminSekolahController::class, 'destroy']);
Route::delete('/admin/sekolah/{sekolah}/forceDestroy', [adminSekolahController::class, 'forceDestroy']);


Route::get('/admin/datasekolah/{sekolah}/kelas', [adminSekolahKelasController::class, 'index']);
Route::post('/admin/datasekolah/{sekolah}/kelas', [adminSekolahKelasController::class, 'store']);
Route::get('/admin/datasekolah/{sekolah}/kelas/{item}', [adminSekolahKelasController::class, 'edit']);
Route::put('/admin/datasekolah/{sekolah}/kelas/{item}', [adminSekolahKelasController::class, 'update']);
Route::delete('/admin/datasekolah/{sekolah}/kelas/{item}', [adminSekolahKelasController::class, 'destroy']);
Route::delete('/admin/datasekolah/{sekolah}/kelas/{item}/forceDestroy', [adminSekolahKelasController::class, 'forceDestroy']);

Route::get('/admin/menuujian/banksoal', [adminUjianBankSoalController::class, 'index']);
Route::get('/admin/menuujian/menubanksoal/kategori/{ujian_kategori_id}', [adminUjianBankSoalController::class, 'kategori']);
Route::get('/admin/menuujian/menubanksoal/kategori/{ujian_kategori_id}/aktif', [adminUjianBankSoalController::class, 'kategori_aktif']);
Route::post('/admin/menuujian/banksoal', [adminUjianBankSoalController::class, 'store']);
Route::post('/admin/menuujian/banksoal/upload/pertanyaan', [adminUjianBankSoalController::class, 'uploadFilePertanyaan']); //upload audio file
Route::get('/admin/menuujian/banksoal/{item}', [adminUjianBankSoalController::class, 'edit']);
Route::put('/admin/menuujian/banksoal/{item}', [adminUjianBankSoalController::class, 'update']);
Route::delete('/admin/menuujian/banksoal/{item}', [adminUjianBankSoalController::class, 'destroy']);

Route::post('/admin/menuujian/datapaketsoal/seeder/{kategori}', [adminUjianBankSoalController::class, 'seederCreateSoal']);

Route::put('/admin/menuujian/menubanksoal/kategori/{ujian_banksoal_id}/updatestatus', [adminUjianBankSoalController::class, 'updatestatus']);

Route::get('/admin/menuujian/kategori', [adminUjianKategoriController::class, 'index']);
Route::post('/admin/menuujian/kategori', [adminUjianKategoriController::class, 'store']);
Route::get('/admin/menuujian/kategori/{item}', [adminUjianKategoriController::class, 'edit']);
Route::put('/admin/menuujian/kategori/{item}', [adminUjianKategoriController::class, 'update']);
Route::delete('/admin/menuujian/kategori/{item}', [adminUjianKategoriController::class, 'destroy']);

// add ujian_paketsoal_id
Route::get('/admin/menuujian/menupaketsoal/{ujian_paketsoal_id}/kategori', [adminUjianPaketsoalKategoriController::class, 'index']);
Route::post('/admin/menuujian/menupaketsoal/{ujian_paketsoal_id}/kategori', [adminUjianPaketsoalKategoriController::class, 'store']);
Route::get('/admin/menuujian/menupaketsoal/{ujian_paketsoal_id}/kategori/{item}', [adminUjianPaketsoalKategoriController::class, 'edit']);
Route::put('/admin/menuujian/menupaketsoal/{ujian_paketsoal_id}/kategori/{item}', [adminUjianPaketsoalKategoriController::class, 'update']);
Route::delete('/admin/menuujian/menupaketsoal/{ujian_paketsoal_id}/kategori/{item}', [adminUjianPaketsoalKategoriController::class, 'destroy']);

Route::delete('/admin/menuujian/menupaketsoal/menukategori/soal/{item}', [adminUjianPaketsoalKategoriController::class, 'destroy_soal']); //delet paketsoal soal

Route::post('/admin/menuujian/menupaketsoal/soal/{ujian_paketsoal_kategori_id}', [adminUjianPaketsoalKategoriController::class, 'store_soal']);


Route::get('/admin/menuujian/paketsoal', [adminUjianPaketSoalController::class, 'index']);
Route::post('/admin/menuujian/paketsoal', [adminUjianPaketSoalController::class, 'store']);
Route::get('/admin/menuujian/paketsoal/{item}', [adminUjianPaketSoalController::class, 'edit']);
Route::put('/admin/menuujian/paketsoal/{item}', [adminUjianPaketSoalController::class, 'update']);
Route::delete('/admin/menuujian/paketsoal/{item}', [adminUjianPaketSoalController::class, 'destroy']);

// UNTUK UJIAN DAN REKAP

Route::get('/admin/ujian_banksoal_aspek', [adminUjianBankSoalAspekController::class, 'index']);
Route::get('/admin/ujian_banksoal_aspek_tanpa_all', [adminUjianBankSoalAspekController::class, 'index_tanpa_all']);
Route::post('/admin/ujian_banksoal_aspek', [adminUjianBankSoalAspekController::class, 'store']);
Route::get('/admin/ujian_banksoal_aspek/{item}', [adminUjianBankSoalAspekController::class, 'edit']);
Route::put('/admin/ujian_banksoal_aspek/{item}', [adminUjianBankSoalAspekController::class, 'update']);
Route::delete('/admin/ujian_banksoal_aspek/{item}', [adminUjianBankSoalAspekController::class, 'destroy']);



//PROSES
Route::get('/admin/menuujian/proses', [adminUjianProsesController::class, 'index']);
Route::post('/admin/menuujian/proses', [adminUjianProsesController::class, 'store']);
Route::get('/admin/menuujian/proses/{item}', [adminUjianProsesController::class, 'edit']);
Route::put('/admin/menuujian/proses/{item}', [adminUjianProsesController::class, 'update']);
Route::delete('/admin/menuujian/proses/{item}', [adminUjianProsesController::class, 'destroy']);

Route::get('/admin/menuujian/proseskelas/{ujian_proses_id}/kelas', [adminUjianProsesKelasController::class, 'index']);
Route::post('/admin/menuujian/proseskelas/{ujian_proses_id}/kelas', [adminUjianProsesKelasController::class, 'store']);
Route::get('/admin/menuujian/proseskelas/kelas/{item}', [adminUjianProsesKelasController::class, 'edit']);
Route::put('/admin/menuujian/proseskelas/kelas/{item}', [adminUjianProsesKelasController::class, 'update']);
Route::delete('/admin/menuujian/proseskelas/kelas/{item}', [adminUjianProsesKelasController::class, 'destroy']);
//
Route::get('/admin/menuujian/proseskelas/{ujian_proses_id}/kelas/{kelas_id}', [adminUjianProsesKelasController::class, 'siswa_perkelas']);
Route::get('/admin/menuujian/proseskelas/{ujian_proses_id}/kelas/{kelas_id}/siswa/{siswa_id}', [adminUjianProsesKelasController::class, 'kategori_persiswa']);

// report hasil ujian
Route::get('/admin/menuujian/hasil/{ujian_proses_kelas_id}', [adminUjianHasilController::class, 'hasilujian']);
Route::get('/admin/menuujian/cetak/{ujian_proses_kelas_id}', [adminUjianCetakController::class, 'cetak_khs_perkelas']);
Route::get('/admin/menuujian/cetak_persoal/{ujian_proses_kelas_id}', [adminUjianCetakController::class, 'cetak_khs_perkelas_persoal']);



Route::post('/admin/menuujian/proesssiswa/{kelas_kategori_id}/reset_waktu', [adminUjianResetController::class, 'reset_waktu']);
Route::post('/admin/menuujian/proesssiswa/{kelas_kategori_id}/reset_all', [adminUjianResetController::class, 'reset_all']);

// dari admin
Route::get('/admin/datahasildeteksi/{siswa}/terapis', [adminSekolahSiswaController::class, 'terapis']);
Route::get('/admin/datahasildeteksi/{siswa}/penanganan', [adminSekolahSiswaController::class, 'penanganan']);
Route::post('/admin/fungsi/terapis/perkalimat', [adminTerapisKarakterPositifController::class, 'perkalimat']);

// Route::post('/admin/proses/export/datasiswa/{siswa}', [adminProsesController::class, 'exportDataSiswa']);
// Route::get('/admin/proses/export/datasiswa/{sekolah}/get', [adminProsesController::class, 'exportDataSiswaGet']);
Route::post('/admin/proses/export/datasiswa/{siswa}', [adminProsesController::class, 'exportDataSiswa']);
Route::get('/admin/proses/export/datasiswa/{sekolah}/kelas/{kelas}/get', [adminProsesController::class, 'exportDataSiswaGetPerkelas']);
// Route::get('/admin/proses/export/datasiswa/{sekolah}/get', [adminProsesController::class, 'exportDataSiswaGet']);

// Route::get('/admin/datasekolah/{sekolah}/datasiswa/withsertifikat', [adminSekolahSiswaController::class, 'withsertifikat']);
Route::get('/admin/datasekolah/datasiswa/withsertifikat/kelas/{kelas}', [adminSekolahSiswaController::class, 'withsertifikat_perkelas']);

// LINK SERVER WEB UJIAN LAMA
Route::get('/admin/apiprobk/server', [adminApiprobkServerController::class, 'index']);
Route::post('/admin/apiprobk/server', [adminApiprobkServerController::class, 'store']);
Route::get('/admin/apiprobk/server/{item}', [adminApiprobkServerController::class, 'edit']);
Route::put('/admin/apiprobk/server/{item}', [adminApiprobkServerController::class, 'update']);
Route::delete('/admin/apiprobk/server/{item}', [adminApiprobkServerController::class, 'destroy']);
Route::get('/admin/apiprobk/serveraktif', [adminApiprobkServerController::class, 'aktif']);
