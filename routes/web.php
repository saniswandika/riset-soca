<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LaporanTamuController;
use App\Http\Controllers\FormTamuController;
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
});
// Route::post('/calendar', [App\Http\Controllers\CalendarController::class, 'index']);
Route::post('/events', [App\Http\Controllers\CalendarController::class, 'index']);
Route::resource('jadwals', App\Http\Controllers\jadwalController::class);
Route::resource('rekom-dtks', App\Http\Controllers\rekomDtksController::class);
Route::resource('suket-dtks', App\Http\Controllers\suketDtksController::class);
Route::resource('pengaduans', App\Http\Controllers\PengaduanController::class);
Route::resource('rekomendasi_pengangkatan_anaks', App\Http\Controllers\rekomendasi_pengangkatan_anakController::class);
Route::resource('rekomendasi_terdaftar_yayasans', App\Http\Controllers\rekomendasi_terdaftar_yayasanController::class);
Route::resource('rekomendasi_pub', App\Http\Controllers\rekomendasi_pengumpulan_undian_berhadiahController::class);
Route::resource('rekomendasi_bantuan_pendidikans', App\Http\Controllers\rekomendasi_bantuan_pendidikanController::class);
Route::resource('rekomendasi_rekativasi_pbi_jks', App\Http\Controllers\rekomendasi_rekativasi_pbi_jkController::class);
Route::resource('rekomendasi_admin_kependudukans', App\Http\Controllers\rekomendasi_admin_kependudukanController::class);
Route::resource('rekomendasi_rehabilitasi_sosials', App\Http\Controllers\rekomendasi_rehabilitasi_sosialController::class);
Route::resource('rekomendasi_terdaftar_dtks', App\Http\Controllers\rekomendasi_terdaftar_dtksController::class);
Route::resource('rekomendasi_biaya_perawatans', App\Http\Controllers\rekomendasi_biaya_perawatanController::class);
Route::resource('rekomendasi_keringanan_pbbs', App\Http\Controllers\rekomendasi_keringanan_pbbController::class);