<?php

use App\Http\Controllers\MorePages;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PenugasanPenilaiController;
use Illuminate\Support\Facades\Route;


// Route::get('/', [function () {
//     return Inertia::render('welcome', [
//         'canRegister' => Features::enabled(Features::registration()),
//     ]);
// }])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [PenugasanPenilaiController::class, 'card'])->name('home');

    Route::get('/penilaian/view-score/{penugasan:uuid}', [PenilaianController::class, 'show'])->name('penilaian.show');

    Route::get('/penilaian/{penugasan:uuid}', [PenilaianController::class, 'create'])->name('penilaian.create');

    Route::post('/penilaian/store/{penugasan:uuid}', [PenilaianController::class, 'store'])->name('penilaian.store');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [MorePages::class, 'homeAdmin'])->name('dashboard');


    Route::get('/dashboard/penugasan-peer', [PenugasanPenilaiController::class, 'index'])->name('penugasan.index');
});

require __DIR__ . '/settings.php';
