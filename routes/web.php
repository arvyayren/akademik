<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('pengumuman', [App\Http\Controllers\IndexController::class, 'pengumuman']);
Route::post('pendaftaran', [App\Http\Controllers\IndexController::class, 'pendaftaran']);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resources([
    'master/guru' => App\Http\Controllers\Master\GuruController::class,
    'master/mapel' => App\Http\Controllers\Master\MapelController::class,
    'master/santri' => App\Http\Controllers\Master\SantriController::class,
    'transaksi/pengumuman' => App\Http\Controllers\Transaksi\PengumumanController::class,
]);

Route::post('status/pengumuman', [App\Http\Controllers\Transaksi\PengumumanController::class, 'status']);