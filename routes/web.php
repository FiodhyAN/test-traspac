<?php

use App\Http\Controllers\PegawaiController;
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

Route::get('/', function () {
    return view('login');
});

Route::get('/soal1', [PegawaiController::class, 'index']);
Route::post('/addUnit', [PegawaiController::class, 'addUnit']);
Route::get('/getUnit', [PegawaiController::class, 'getUnit']);
Route::post('/addPegawai', [PegawaiController::class, 'addPegawai']);
Route::get('/pegawaiTable', [PegawaiController::class, 'pegawaiTable']);

Route::get('/soal2', function () {
    return view('soal.soal2');
});
