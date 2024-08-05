<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\AntrianController;

Route::get('/', [AntrianController::class, 'index']);
Route::post('/ambil-antrian', [AntrianController::class, 'ambilAntrian'])->name('ambil.antrian');
Route::get('/cetak-antrian/{id}', [AntrianController::class, 'cetakAntrian'])->name('cetak.antrian');
