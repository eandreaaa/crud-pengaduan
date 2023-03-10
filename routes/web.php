<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResponseController;
use App\Models\Report;

Route::get('/', [ReportController::class, 'index'])->name('home');
Route::get('/login', function() {
    return view('login');
})->name('login');

Route::post('/store',[ReportController::class, 'store'])->name('store');
Route::post('/auth', [ReportController::class, 'auth'])->name('auth');

//route utk admin dan petugas setelah login agar bisa logout
Route::middleware(['isLogin', 'CekRole:admin,petugas'])->group(function() {
    Route::get('/logout', [ReportController::class, 'logout'])->name('logout');
});

//route yg hny dapat diakses setelah login dan rolenya petugas
Route::middleware(['isLogin', 'CekRole:petugas'])->group(function() {
    Route::get('/petugas', [ReportController::class, 'petugas'])->name('data-petugas');
    // menampilkan form tambah atau ubah response
    // pake dinamis krn nnti kita mau ksh respons yg mana jadi berdasarkan report_id
    Route::get('/response/edit/{report_id}', [ResponseController::class, 'edit'])->name('respons');
    // kirim data response menggunakan patch, karena dia bisa berupa tambah data atau update data
    // pake patch krn biar bisa d ubah2
    Route::patch('/response/update/{report_id}', [ResponseController::class, 'update'])->name('update');
});

//route yg hny dpt diakses setelah login dan rolenya admin
Route::middleware(['isLogin', 'CekRole:admin'])->group(function(){
    Route::get('/data', [ReportController::class, 'data'])->name('data');
    Route::delete('/destroy/{id}',  [ReportController::class, 'destroy'])->name('destroy');
    Route::get('/export/pdf', [ReportController::class, 'createPDF'])->name('export-pdf');
    Route::get('/export/pdf/{id}', [ReportController::class, 'printPDF'])->name('print-pdf');
    Route::get('/export/excel', [ReportController::class, 'exportExcel'])->name('export-excel');
});