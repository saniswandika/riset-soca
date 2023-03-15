<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LaporanTamuController;
use App\Http\Controllers\PengaduanController;
use app\Models\Pengaduan;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\FormTamuController;
use App\Http\Controllers\PengaturanWilayahController;
use App\Http\Controllers\DependantDropdownController;
use Symfony\Component\HttpKernel\Profiler\Profile;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/formulir', [App\Http\Controllers\FormTamuController::class, 'index'])->name('FormTamu.index');
Route::post('/formulir/store', [App\Http\Controllers\FormTamuController::class, 'store'])->name('FormTamu.store');
Route::get('/tableTamu', [App\Http\Controllers\FormTamuController::class, 'public'])->name('public');
Route::post('/tableTamu/{id}', [App\Http\Controllers\FormTamuController::class, 'edit'])->name('FormTamu.edit');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('roles', RoleController::class);

Route::group(['middleware' => ['auth']], function() {
    // Route::resource('students', StudentController::class);
    Route::post('/tamu/{id}', [App\Http\Controllers\FormTamuController::class, 'destroy'])->name('tamu.destroy');
    // Route::resource('tamu', FormTamuController::class);
    Route::resource('laporanTamu', LaporanTamuController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('profile', ProfileController::class);
    Route::post('profilepassword', [ProfileController::class, 'password_action'])->name('password.action');
    Route::post('profilenama', [ProfileController::class, 'name_action'])->name('nama.action');
    Route::post('profileemail', [ProfileController::class, 'email_action'])->name('email.action');
});
//wilayah
Route::post('/get-kota', [PengaturanWilayahController::class, 'getKota'])->name('getKota');
Route::get('/kecamatan/getByRegency/{regencyId}', [PengaturanWilayahController::class, 'getKecamatanByRegency']);
Route::get('/kelurahan/getByRegency/{kelurahanId}', [PengaturanWilayahController::class, 'getKelurahanByRegency']);
Route::get('/Pengaturan_wilayah', [PengaturanWilayahController::class, 'listwilayah'])->name('Pengaturan_wilayah');
Route::get('/tambah-wilayah', [PengaturanWilayahController::class, 'create'])->name('rubahwilayah');
Route::get('/status/update', [PengaturanWilayahController::class, 'updateStatus'])->name('users.update.status');
Route::post('/add-wilayah', [PengaturanWilayahController::class, 'store'])->name('add_wilayah.store');
//tutup wilayah
// Route::post('/calendar', [App\Http\Controllers\CalendarController::class, 'index']);
Route::post('/events', [App\Http\Controllers\CalendarController::class, 'index']);
Route::resource('jadwals', App\Http\Controllers\jadwalController::class);
Route::resource('rekom-dtks', App\Http\Controllers\rekomDtksController::class);
Route::resource('suket-dtks', App\Http\Controllers\suketDtksController::class);
Route::resource('pengaduans', App\Http\Controllers\PengaduanController::class);
Route::resource('rekomendasi_pengangkatan_anaks', App\Http\Controllers\rekomendasi_pengangkatan_anakController::class);
Route::resource('pengaduans', App\Http\Controllers\PengaduanController::class);
Route::resource('rekomendasi_terdaftar_yayasans', App\Http\Controllers\rekomendasi_terdaftar_yayasanController::class);
Route::resource('rekomendasi_pub', App\Http\Controllers\rekomendasi_pengumpulan_undian_berhadiahController::class);
Route::resource('rekomendasi_bantuan_pendidikans', App\Http\Controllers\rekomendasi_bantuan_pendidikanController::class);
Route::resource('rekomendasi_rekativasi_pbi_jks', App\Http\Controllers\rekomendasi_rekativasi_pbi_jkController::class);
Route::resource('rekomendasi_admin_kependudukans', App\Http\Controllers\rekomendasi_admin_kependudukanController::class);
Route::resource('rekomendasi_rehabilitasi_sosials', App\Http\Controllers\rekomendasi_rehabilitasi_sosialController::class);
Route::resource('rekomendasi_terdaftar_dtks', App\Http\Controllers\rekomendasi_terdaftar_dtksController::class);
Route::resource('rekomendasi_biaya_perawatans', App\Http\Controllers\rekomendasi_biaya_perawatanController::class);
Route::resource('rekomendasi_keringanan_pbbs', App\Http\Controllers\rekomendasi_keringanan_pbbController::class);


Route::get('getdata', [PengaduanController::class, 'draft'])->name('getdata');
Route::get('diproses', [PengaduanController::class, 'diproses'])->name('diproses');
Route::get('dikembalikan', [PengaduanController::class, 'dikembalikan'])->name('dikembalikan');
Route::get('/selesai', [PengaduanController::class, 'selesai'])->name('selesai');
Route::get('/prelistDTKS', [PengaduanController::class, 'prelistDTKS'])->name('prelist_DTKS');
Route::get('/prelistPage', [PengaduanController::class, 'prelistPage'])->name('prelistPage');
// Route::get('/pengaduans/create', [PengaduanController::class, 'create'])->name('pengaduans.create');
Route::get('/pengaduans/search', [PengaduanController::class, 'search'])->name('pengaduans.search');
Route::get('/pengaduans/{pengaduan}/delete', [PengaduanController::class, 'destroy'])->name('pengaduans.delet2');
// Route::get('/pengaduans/destroy', [PengaduanController::class, 'destroy'])->name('pengaduans.destroy');
Route::get('/cek-id/{Nik}', function($Nik) {
    $found = false;
    $table2 = DB::table('dtks')->where('Nik', $Nik)->first(); 
    if ($table2) {
        $found = true;
        $Id_DTKS = $table2->Id_DTKS; // Ambil data nama jika ID ditemukan
    }
    return response()->json([
        'found' => $found,
        'Id_DTKS' => $Id_DTKS
    ]);
});
