<?php

use App\Http\Controllers\MorePages;
use App\Http\Controllers\NilaiKriteriaController;
use App\Http\Controllers\OutsourcingController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PenugasanPenilaiController;
use App\Http\Controllers\UserController;
use App\Models\NilaiKriteria;
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
    Route::get('/dashboard', [NilaiKriteriaController::class, 'rekaphasil'])->name('dashboard');

    Route::get('/dashboard/nilai-akhir/{outsourcing:uuid}', [OutsourcingController::class, 'nilaiAkhir'])->name('os.rekapaspekevaluator');
    Route::get('/dashboard/rekap-nilai/{outsourcing:uuid}', [OutsourcingController::class, 'rekapNilai'])->name('os.detailperaspek');
    Route::get('/dashboard/catatan-evaluator/{outsourcing:uuid}', [OutsourcingController::class, 'catatanEvaluator'])->name('os.catatanEvaluator');
    Route::get('/dashboard/nilai-perkriteria/{outsourcing:uuid}/{tipePenilai?}', [OutsourcingController::class, 'nilaiPerkriteria'])->name('os.nilaiPerkriteria');

    Route::get('/dashboard/ranking-skor', [OutsourcingController::class, 'ranking'])->name('os.ranking');

    Route::get('/dashboard/user-management/{user}', [UserController::class, 'index'])->name('user.index');

    Route::get('/dashboard/penugasan-peer', [PenugasanPenilaiController::class, 'index'])->name('penugasan.index');
    Route::post('/dashboard/penugasan-peer/store/{outsourcing:uuid}', [PenugasanPenilaiController::class, 'store'])->name('penugasan.store');
});

require __DIR__ . '/settings.php';
