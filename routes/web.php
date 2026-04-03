<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Controllers\DataPesertaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendaftaranPesertaController;
use App\Http\Controllers\PrintController;


Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/form-pendaftaran', [PendaftaranPesertaController::class, 'show'])->name('form-pendaftaran');

Route::post('/form-pendaftaran', [PendaftaranPesertaController::class, 'store'])->name('form-pendaftaran.store');

Route::get('/auth/login', function () {
    return view('auth.login');
})->name(('admin.login'));

Route::post('/auth/login', [AuthController::class, 'login'])->name('admin.login.submit');

Route::middleware('auth', PreventBackHistory::class)->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/data-peserta', [DataPesertaController::class, 'index'])->name('admin.data-peserta');

    Route::delete('/admin/data-peserta/{id}', [DataPesertaController::class, 'destroy'])->name('admin.data-peserta.destroy');

    Route::put('/admin/data-peserta/{id}', [DataPesertaController::class, 'update'])->name('admin.data-peserta.update');

    Route::get('/admin/data-peserta/{id}/print', [PrintController::class, 'print'])->name('admin.data-peserta.print');

    Route::get('/admin/dashboard/download-pdf', [DashboardController::class, 'downloadSemua'])->name('admin.data-peserta.download');

    Route::get('/admin/data-admin', [AdminController::class, 'index'])->name('admin.data-admin');

    Route::post('/admin/data-admin', [AdminController::class, 'store'])->name('admin.data-admin.store');

    Route::put('/admin/data-admin/{id}', [AdminController::class, 'update'])->name('admin.data-admin.update');

    Route::delete('/admin/data-admin/{id}', [AdminController::class, 'destroy'])->name('admin.data-admin.destroy');

    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('admin.logout');
});
