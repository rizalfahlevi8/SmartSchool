<?php

use App\Http\Controllers\AbsensiController;
use Illuminate\Http\Request;
use App\Models\Data_angkatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\RaportController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InputNilaiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PeminjamanBarangController;
use App\Http\Controllers\EditPasswordController;
use App\Http\Controllers\JadwalMengajarController;
use App\Http\Controllers\KalenderAkademikController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\UserMoodleApi;
use App\Http\Controllers\NilaiMoodleController;
use App\Models\Absensi;
use App\Models\Akademik;
use App\Http\Controllers\UserMoodleController;
use App\Models\Peminjaman;


use App\Http\Controllers\KerjaSamaController;
// use App\Http\Controllers\UserController;
// use App\Models\Absensi;
// use App\Models\Akademik;

use App\Models\Tamu;
use App\Http\Controllers\TamuController;
use App\Models\Kerjasama;
// use App\Http\Controllers\KerjaSamaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/api/request-dd', function (Request $request) {
    $request->validate([
        'alamat.jalan' => 'required'
    ]);
    return dd($request->input('alamat'));
});
Route::get('/api/tes', function (Request $request) {
    // return view('test');
});

Route::get('/api/testing', function () {

    return Akademik::all();
});

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticating']);
});

Route::middleware(['auth'])->group(function () {
    // ==============[ L O G O U T ]===============
    Route::get('/logout', function () {
        Auth::logout(); // Melakukan logout pengguna saat ini
        return redirect('/')->with('toast_success', 'Anda telah berhasil logout.');
    })->name('logout');

    Route::post('/login/setRole', [LoginController::class, 'setRole'])->name('set_role');

    // ==============[ D A S H B O A R D ]===============
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ==============[ S T A T U S - T A M U ]===============
    Route::match(['post'], '/dashboard/{id}/terima', [DashboardController::class, 'terimaPesan'])->name('dashboard.terimaPesan');
    Route::match(['delete'], '/dashboard/{id}/hapus', [DashboardController::class, 'hapusPesan'])->name('dashboard.hapusPesan');
    // Route::delete('/dashboard/{id}', [DashboardController::class, 'hapusPesan'])->name('dashboard.hapusPesan');

    //edit password
    Route::get('/option/change-password', [EditPasswordController::class, 'index']);
    Route::post('/option/change-password/{user}', [EditPasswordController::class, 'ubah'])->name('option.change-password');
    Route::post('/edit-passwordsiswa/{id}', [EditPasswordController::class, 'ubahpwdsiswa']);
});

Route::middleware(['userRole:admin,guru'])->group(function () {
    Route::get('/akademik/jadwal-guru/{id}', [JadwalMengajarController::class, 'jadwalguru']);
    Route::get('/akademik/jadwal/cetak_pdf/{id_guru}', [JadwalMengajarController::class, 'cetakjadwalguru']);

    // input nilai
    Route::get('/data-inputnilai/{id}', [InputNilaiController::class, 'index']);
    Route::get('/data-nilai-atur/{id}/{smt}', [InputNilaiController::class, 'atur']);
    Route::get('/data-input-nilai/{idjadwal}/{idsiswa}/{idmapel}/{smt}', [InputNilaiController::class, 'input']);
    Route::post('/data-input-nilai-siswa/{idjadwal}/{idsiswa}/{idmapel}/{smt}', [InputNilaiController::class, 'store']);
    Route::get('/data-detail-nilai/{idjadwal}/{idsiswa}/{idmapel}/{smt}', [InputNilaiController::class, 'detail']);

    //input raport
    Route::get('/data-raport', [RaportController::class, 'index']);
    Route::get('/data-raport-input/{id}/{smt}', [RaportController::class, 'input']);
    Route::post('/tambahnilai', [RaportController::class, 'tambahnilai']);
    Route::get('/data-nilai-hapus/{id}', [RaportController::class, 'destroy']);
    Route::post('/data-raport-insert', [RaportController::class, 'store']);
    Route::get('/data-cetak-raport/{smt}/{id}', [RaportController::class, 'cetak']);

    //raport siswa
    Route::post('/data-raport-siswa/{id}', [RaportController::class, 'raportsiswa']);

    //jadwal siswa
    Route::get('/data-jadwal/{id}', [JadwalController::class, 'jadwalsiswa']);
    Route::get('/data-jadwalsiswa/cetak_pdf/{id}', [JadwalController::class, 'cetakjadwalsiswa']);

    Route::get('/data-raport-cetak-siswa/{id}/{smt}', [RaportController::class, 'cetakraportsiswa']);

    //kepsek
    Route::get('/data-pegawai-lihat', [PegawaiController::class, 'lihat']);
    Route::get('/data-guru-lihat', [GuruController::class, 'lihat']);
    Route::get('/data-jadwalmengajar-guru', [JadwalMengajarController::class, 'lihat']);
    Route::get('/data-jadwalmengajar-cek/{id}', [JadwalMengajarController::class, 'cekjadwal']);
    Route::get('/data-jadwal-cek', [JadwalController::class, 'lihat']);
    Route::get('/data-jadwal-cekjadwal/{id}', [JadwalController::class, 'cekjadwal']);

    //Nilai Moodle
    Route::get('/data-nilai-moodle/course-moodle', [NilaiMoodleController::class, 'getMoodleCourses']);
    Route::get('/data-nilai-moodle/course-moodle/nilai-course/{courseId}', [NilaiMoodleController::class, 'getGradeItems'])
    ->name('nilai-course');
    Route::get('/get-grade-items/{courseId}/{search?}', [NilaiMoodleController::class, 'getGradeItems'])->name('get.grade.items');

});


//==========================================================================================
Route::middleware(['userRole:admin,wakasek'])->group(function () {
    // Pengumuman
    Route::get('/dashboard/buat-pengumuman', [PengumumanController::class, 'create'])->name('buat-pengumuman');
    Route::post('/dashboard/buat-pengumuman', [PengumumanController::class, 'store']);
    Route::get('/dashboard/hapus-pengumuman/{pengumuman}', [PengumumanController::class, 'destroy']);
    Route::put('/dashboard/update-pengumuman/{pengumuman}', [PengumumanController::class, 'update'])->name('update-pengumuman');

    Route::get('/administrasi/users', [UserController::class, 'index'])->name('user_management');
    Route::post('/administrasi/users/{user}', ['UserController', 'update']);
});

//==========================================================================================
Route::middleware(['userRole:admin,wakasek'])->group(function () {
    // Daftar Barang
    Route::get('/sarana/barang', [BarangController::class, 'index'])->name('barang_main');
    Route::get('/sarana/barang-tambah', [BarangController::class, 'create'])->name('tambah-barang');
    Route::post('/sarana/barang-tambah', [BarangController::class, 'store']);
    Route::get('/sarana/barang-update/{barang}', [BarangController::class, 'edit'])->name('update-barang');
    Route::put('/sarana/barang-update/{barang}', [BarangController::class, 'update']);
    Route::get('/sarana/barang-hapus/{barang}', [BarangController::class, 'destroy'])->name('hapus-barang');
    // Ruang
    Route::get('/sarana/ruang', [RuangController::class, 'index'])->name('ruang_main');
    Route::post('/sarana/ruang-tambah', [RuangController::class, 'store'])->name('tambah-ruang');
    Route::put('/sarana/ruang-update', [RuangController::class, 'update'])->name('update-ruang');
    Route::get('/sarana/ruang-hapus/{ruang}', [RuangController::class, 'destroy'])->name('hapus-ruang');
    // Inventaris
    Route::get('/sarana/inventaris', [InventarisController::class, 'index'])->name('inventaris_main');
    Route::get('atur-barang/{id}', [InventarisController::class, 'aturBarang'])->name('atur-barang');
    Route::post('/store-inventaris/{id}', [InventarisController::class, 'store'])->name('store-inventaris');
    Route::get('/delete-inventaris/{id}', [InventarisController::class, 'destroy'])->name('delete-inventaris');
    Route::get('/search-barang', [InventarisController::class, 'search'])->name('search-barang');
    Route::get('/get-barang-detail-by-name', [InventarisController::class, 'getDetailByName'])->name('get-barang-detail-by-name');
    Route::get('/get-all-barang', [InventarisController::class, 'getAllBarang'])->name('get-all-barang');

    Route::get('/administrasi/users', [UserController::class, 'index'])->name('user_management');
    Route::patch('/administrasi/users/{user}', [UserController::class, 'update']);

    // ==============[ D a t a - K a l e n d e r - A k a d e m i k ]===============
    Route::get('/akademik/kalender/index', [KalenderAkademikController::class, 'index'])->name('calendar.index');
    Route::post('/akademik/kalender', [KalenderAkademikController::class, 'store'])->name('calendar.store');
    Route::patch('/akademik/kalender/update/{id}', [KalenderAkademikController::class, 'update'])->name('calendar.update');
    Route::delete('/akademik/kalender/destroy/{id}', [KalenderAkademikController::class, 'destroy'])->name('calendar.destroy');

    // User
    Route::get('/administrasi/users', [UserController::class, 'index'])->name('user_management');
    Route::patch('/administrasi/users/{user}', [UserController::class, 'update']);
    Route::put('/administrasi/users/reset/{user}', [UserController::class, 'reset']);
    Route::get('/administrasi/user/export', [UserController::class, 'export']);
    Route::get('/administrasi/users/import', [UserController::class, 'showImportForm'])->name('users.import.form');
    Route::post('/administrasi/users/import', [UserController::class, 'Import'])->name('users.import');


    //User Moodle
    Route::get('/administrasi/usermoodle', [UserMoodleApi::class, 'fetchApi']);
});
//==========================================================================================

Route::middleware(['userRole:admin,wakasek'])->group(function () {
    // ==============[ D a t a - G u r u ]===============
    Route::get('/administrasi/guru', [GuruController::class, 'index']);
    Route::get('/administrasi/guru-tambah', [GuruController::class, 'create']);
    Route::post('/administrasi/guru-tambah', [GuruController::class, 'store']);
    Route::get('/administrasi/guru-update/{guru}', [GuruController::class, 'edit']);
    Route::put('/administrasi/guru-update/{guru}', [GuruController::class, 'update']);
    Route::get('/administrasi/guru-hapus/{guru}', [GuruController::class, 'destroy']);
    Route::get('/userguru/export', [GuruController::class, 'export']);

    // ==============[ D a t a - S i s w a ]===============
    Route::get('/administrasi/siswa', [SiswaController::class, 'index'])->name('siswa_main');
    Route::get('/administrasi/siswa-tambah', [SiswaController::class, 'create']);
    Route::post('/administrasi/siswa-tambah', [SiswaController::class, 'store']);
    Route::get('/administrasi/siswa-update/{siswa}', [SiswaController::class, 'edit']);
    Route::put('/administrasi/siswa-update/{siswa}', [SiswaController::class, 'update']);
    Route::get('/administrasi/siswa-keluar', [SiswaController::class, 'out_page'])->name('siswa_out');
    Route::put('/administrasi/siswa-keluar/{siswa}', [SiswaController::class, 'out']);
    Route::get('/administrasi/siswa-hapus/{siswa}', [SiswaController::class, 'destroy']);
    Route::get('/usersiswa/export', [SiswaController::class, 'export']);
    // ==============[ D a t a - P e g a w a i ]===============
    Route::get('/administrasi/pegawai', [PegawaiController::class, 'index']);
    Route::get('/administrasi/pegawai-tambah', [PegawaiController::class, 'create']);
    Route::post('/administrasi/pegawai-tambah', [PegawaiController::class, 'store']);
    Route::get('/administrasi/pegawai-update/{id}', [PegawaiController::class, 'edit']);
    Route::put('/administrasi/pegawai-update/{id}', [PegawaiController::class, 'update']);
    Route::get('/administrasi/pegawai-hapus/{id}', [PegawaiController::class, 'destroy']);

    // ==============[ D a t a - M a p e l ]===============
    Route::get('/akademik/mapel', [MapelController::class, 'index'])->name('mapel_main');
    Route::post('/akademik/mapel-tambah', [MapelController::class, 'store']);
    Route::put('/akademik/mapel-update/{mapel}', [MapelController::class, 'update']);
    Route::get('/akademik/mapel-hapus/{mapel}', [MapelController::class, 'destroy']);

    // ==============[ D a t a - K e l a s ]===============
    Route::get('/sarana/kelas', [KelasController::class, 'index'])->name('kelas_main');
    Route::post('/sarana/kelas-tambah', [KelasController::class, 'store'])->name('tambah_kelas');
    Route::put('/sarana/kelas-update/{kelas}', [KelasController::class, 'update'])->name('update_kelas');
    Route::get('/sarana/kelas-hapus/{kelas}', [KelasController::class, 'destroy'])->name('hapus_kelas');

    // ==============[ D a t a - J a d w a l ]===============
    Route::get('/akademik/jadwal', [JadwalController::class, 'showJadwalAdmin']);
    Route::get('/akademik/jadwal-kelas/{kelas}', [JadwalController::class, 'jadwalKelas']);
    Route::post('/akademik/jadwal-kelas/{kelas}', [JadwalController::class, 'jadwalKelas']);

    Route::post('/akademik/jadwal-tambah', [JadwalController::class, 'store']);
    Route::put('/akademik/jadwal-update/{detail_jadwal}', [JadwalController::class, 'update']);
    Route::get('/akademik/jadwal-hapus/{id}', [JadwalController::class, 'destroy']);
    Route::get('/akademik/jadwal/cetak_pdf/{id}', [JadwalController::class, 'cetak']);

    Route::get('/akademik/jadwalmengajar', [JadwalMengajarController::class, 'index']);
    Route::get('/akademik/jadwalmengajar-atur/{id}', [JadwalMengajarController::class, 'atur']);
    Route::get('/akademik/jadwalmengajar-cek/{id}', [JadwalMengajarController::class, 'cek']);
    Route::post('/akademik/jadwalmengajar-insert', [JadwalMengajarController::class, 'store']);
    Route::put('/akademik/jadwalmengajar-update/{id}', [JadwalMengajarController::class, 'update']);
    Route::get('/akademik/jadwalmengajar-hapus/{id}', [JadwalMengajarController::class, 'destroy']);
    Route::get('/akademik/jadwalmengajar/cetak_pdf/{id}', [JadwalMengajarController::class, 'cetak']);

    // ==============[ D a t a - R a p o r t ]===============
    Route::get('/akademik/raport-admin', [RaportController::class, 'index']);
    Route::get('/akademik/raport-angkatan/{angkatan}', [RaportController::class, 'showRaportAngkatan']);
    Route::get('/akademik/raport-cetak/{id}/{smt}', [RaportController::class, 'cetakraport']);
    Route::post('/akademik/raport-update/{id_siswa}', [RaportController::class, 'update_nilai_raport']);

    // ==============[ D a t a - R a p o r t ]===============
    Route::get('/akademik/absensi', [AbsensiController::class, 'index']);
    Route::get('/akademik/absensi/{akademik}/{kelas}', [AbsensiController::class, 'showKelasAbsensi']);
    Route::post('/akademik/absensi/{akademik}/{kelas}', [AbsensiController::class, 'showKelasAbsensi']);
    Route::post('/api/akademik/absensi-update/{absensi}', [AbsensiController::class, 'apiUpdateAbsensi'])->name('api.update-absensi');

    // ==============[ D a t a - P e m i n j a m a n ]===============
    Route::get('/data-peminjaman', [PeminjamanController::class, 'index']);
    Route::get('/data-peminjaman-history', [PeminjamanController::class, 'history']);
    Route::get('/peminjaman-hapus/{id}', [PeminjamanController::class, 'destroy']);
    Route::post('/peminjaman-tambah', [PeminjamanController::class, 'store']);
    Route::put('/peminjaman-update', [PeminjamanController::class, 'update']);

     // ==============[ D a t a - T a m u ]===============
     Route::get('/data-tamu', [TamuController::class, 'index']);
     Route::get('/tamu', [TamuController::class, 'create']);
     Route::post('/tamu', [TamuController::class, 'kirim']);
     Route::get('/tamu-edit/{id}', [TamuController::class, 'edit']);
     Route::put('/tamu-edit/{id}', [TamuController::class, 'update']);
     Route::get('/tamu-delete/{tamu}', [TamuController::class, 'delete']);
     // Route::get('/get-guru-username', 'TamuController@create')->name('get_guru_user');
     Route::get('/get-username-by-role/{role}', [TamuController::class, 'getUsernamesByRole']);
     // Route::get('/search-by-username/{username}', [TamuController::class, 'searchByUsername']);
     
     // ==============[ D a t a - K e r j a s a m a ]===============
     Route::get('/mou',[KerjaSamaController::class, 'lihat']);
     Route::get('/add-mou', [KerjaSamaController::class, 'create']);
     Route::post('/add-mou', [KerjaSamaController::class, 'store']);
     Route::get('/edit-mou/{id}', [KerjaSamaController::class, 'edit']);
     Route::put('/edit-mou/{id}', [KerjaSamaController::class, 'update']);
     Route::get('/delete-mou/{kerjasama}', [KerjaSamaController::class, 'destroy']);
     // file
    //  Route::get('/storage/kerjasama/file/{file}', [KerjaSamaController::class, 'viewfile'])->name('viewfile');  

    Route::get('/peminjaman-confirm/{id}', [PeminjamanController::class, 'confirm']);
    Route::get('/peminjaman-approve/{peminjaman}', [PeminjamanController::class, 'approve']);
    Route::get('/peminjaman-decline/{peminjaman}', [PeminjamanController::class, 'decline']);

    // ==============[ D a t a - P e m i n j a m a n B a r a n g]===============
    Route::get('/data-peminjaman-barang', [PeminjamanBarangController::class, 'index'])->name('peminjamanBarang.index');
    Route::post('/data-peminjaman-barang', [PeminjamanBarangController::class, 'store'])->name('peminjamanBarang.store');
    Route::put('/data-peminjaman-barang', [PeminjamanBarangController::class, 'update'])->name('peminjamanBarang.update');
    Route::get('/data-peminjaman-barang-hapus/{id}', [PeminjamanBarangController::class, 'destroy'])->name('peminjamanBarang.destroy');
    Route::get('/data-peminjaman-barang-history', [PeminjamanBarangController::class, 'history']);
    Route::get('/data-peminjaman-barang-confirm/{id}', [PeminjamanBarangController::class, 'confirm']);
    Route::get('/data-peminjaman-barang-approve/{peminjaman}', [PeminjamanBarangController::class, 'approve']);
    Route::get('/data-peminjaman-barang-decline/{peminjaman}', [PeminjamanBarangController::class, 'decline']);

    // ==============[ D a t a - A b s e n s i]===============
    Route::get('/akademik/absensi/admin', [AbsensiController::class, 'showAbsensiAdmin']);
    Route::get('/get_kelas', [KelasController::class, 'getKelas']);
    Route::get('/get_siswa', [SiswaController::class, 'getSiswaKelasAbsensi']);
    Route::get('/get_guru', [GuruController::class, 'getGuru']);
    Route::get('/get_gurunames', [GuruController::class, 'getGuruNames']);
    Route::get('/api/events-from-database', [AbsensiController::class, 'getEventsFromDatabase']);
    Route::delete('/api/delete-absensi/{id}', [AbsensiController::class, 'deleteAbsensi']);
    Route::put('/api/update-absensi/{id}', [AbsensiController::class, 'updateAbsensi']);  
    Route::get('/get_siswaadmin', [SiswaController::class, 'getSiswaByKelas']);
    Route::post('/akademik/absensi/postAbsensi', [AbsensiController::class, 'storeAdmin'])->name('absensi.storeAdmin');
    Route::get('/getIdUserByNama', [AbsensiController::class, 'getIdUserByNama'])->name('getIdUserByNama');

});
//======================== G U R U =========================================================
Route::middleware(['userRole:guru'])->group(function () {
    Route::get('/akademik/absensi/guru', [AbsensiController::class, 'showAbsensiGuru'])->name('absensi.showAbsensiGuru');
    Route::put('/api/update-absensi-guru/{id}', [GuruController::class, 'updateAbsensi']);
});

Route::middleware(['userRole:siswa'])->group(function () {
    Route::get('/akademik/absensi/siswa', [AbsensiController::class, 'showAbsensiSiswa'])->name('absensi.showAbsensiSiswa');
    Route::put('/api/update-absensi-siswa/{id}', [SiswaController::class, 'updateAbsensi']);

});

Route::middleware(['userRole:siswa,guru'])->group(function () {
    //jadwal pelajaran
    Route::post('/akademik/absensi/siswaguruPostAbsensi', [AbsensiController::class, 'store'])->name('absensi.store');
    Route::post('/absensi/checkAndFillAbsentData', [AbsensiController::class, 'checkAndFillAbsentData'])->name('absensi.checkAndFillAbsentData');
});

Route::middleware(['userRole:siswa,admin'])->group(function () {
    //jadwal pelajaran
    Route::get('/akademik/jadwal-siswa/{id}', [JadwalController::class, 'jadwalsiswa']);

   


});

Route::middleware(['userRole:siswa,admin'])->group(function () {
    Route::get('/akademik/raport-siswa/{jenis_raport}', [RaportController::class, 'show_raport']);
    Route::get('/akademik/jadwal-siswa', [JadwalController::class, 'showJadwalSiswa']);
    Route::get('/akademik/raport/{jenis_nilai}/{siswa}', [RaportController::class, 'show']);
});

//==========================================================================================
    // ==============[ D a f t a r - T a m u ]===============

    Route::get('showTamuByUser/{username}', [DashboardController::class, 'showTamuByUser']);

    Route::get('/get-username-by-role/{role}', [TamuController::class, 'getUsernamesByRole']);
    Route::get('/daftar-tamu', [TamuController::class, 'daftar'])->name('daftar-tamu'); 
    Route::post('/datar-tamu', [TamuController::class, 'store'])->name('kirim-tamu');

Route::middleware(['userRole:siswa,guru,admin'])->group(function () {
    Route::get('/api/absensi/{id}', [AbsensiController::class, 'getAbsensiById']);
    Route::get('/api/siswa-by-user/{id_user}', [SiswaController::class, 'getSiswaByUser']);
    Route::get('/api/guru-by-user/{id_user}', [GuruController::class, 'getGuruByUser']);
});

