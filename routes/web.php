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
Route::resource('jadwals', App\Http\Controllers\jadwalController::class);