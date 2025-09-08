<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Inspeksi\AparController;
use App\Http\Controllers\Inspeksi\ApatController;
use App\Http\Controllers\Inspeksi\FireAlarmController;
use App\Http\Controllers\Inspeksi\HydrantBoxController;
use App\Http\Controllers\Inspeksi\RumahPompaController;
use App\Http\Controllers\Inspeksi\P3kController;
use App\Http\Controllers\Inspeksi\PemeriksaanAparController;
use App\Http\Controllers\Inspeksi\PemeriksaanApatController;
use App\Http\Controllers\Inspeksi\PemeriksaanFireAlarmController;
use App\Http\Controllers\Inspeksi\PemeriksaanBoxHydrantController;
use App\Http\Controllers\Inspeksi\PemeriksaanRumahPompaController;
use App\Http\Controllers\Inspeksi\PemeriksaanP3kController;
use App\Http\Controllers\Inspeksi\PemakaianP3kController;
use App\Http\Controllers\Inspeksi\SaranController;
use App\Http\Controllers\Inspeksi\DokumenIkaController;

Route::get('/', fn () => view('welcome'))->name('welcome');

Route::prefix('pemeriksaan')->group(function () {
    Route::post('/store', [PemeriksaanAparController::class, 'store'])->name('pemeriksaan.store');
    Route::delete('/{id}', [PemeriksaanAparController::class, 'destroy'])->name('pemeriksaan.destroy');
    Route::get('/{id}/edit-form', [PemeriksaanAparController::class, 'editForm']);
    Route::put('/{id}', [PemeriksaanAparController::class, 'update'])->name('pemeriksaan.update');
});

Route::prefix('inspeksi')->group(function () {

    Route::controller(AparController::class)->prefix('apar')->group(function () {
        Route::get('/', 'index')->name('apar.index');
        Route::get('/{id_apar}', 'show')->name('apar.show');
        Route::get('/{id_apar}/inspeksi', 'create')->name('apar.inspeksi');
        Route::get('/{id_apar}/hasil', 'hasil')->name('apar.hasil');
        Route::post('/store', 'store')->name('apar.store');
    });

    Route::controller(ApatController::class)->prefix('apat')->group(function () {
        Route::get('/', 'index')->name('apat.index');
        Route::get('/{id_apat}', 'show')->name('apat.show');
        Route::get('/{id_apat}/inspeksi', 'create')->name('apat.inspeksi');
        Route::get('/{id_apat}/hasil', 'hasil')->name('apat.hasil');
        Route::post('/store', 'store')->name('apat.store');
    });

    Route::controller(PemeriksaanApatController::class)->prefix('apat')->group(function () {
        Route::post('/store-pemeriksaan', 'store')->name('pemeriksaan-apat.store');
        Route::put('/{id}/update', 'update')->name('pemeriksaan-apat.update');
        Route::delete('/{id}', 'destroy')->name('pemeriksaan-apat.destroy');
        Route::get('/{id}/edit-form', 'editForm')->name('pemeriksaan-apat.edit-form');
    });

    Route::controller(FireAlarmController::class)->prefix('fire-alarm')->group(function () {
        Route::get('/', 'index')->name('fire_alarm.index');
        Route::get('/{id_firealarm}', 'show')->name('fire_alarm.show');
        Route::get('/{id_firealarm}/inspeksi', 'create')->name('fire_alarm.inspeksi');
        Route::get('/{id_firealarm}/hasil', 'hasil')->name('fire_alarm.hasil');
        Route::post('/store', 'store')->name('fire_alarm.store');
    });

    Route::controller(PemeriksaanFireAlarmController::class)->prefix('pemeriksaan-fire-alarm')->group(function () {
        Route::post('/store', 'store')->name('pemeriksaan-fire_alarm.store');
        Route::put('/{id}/update', 'update')->name('pemeriksaan-fire_alarm.update');
        Route::delete('/{id}', 'destroy')->name('pemeriksaan-fire_alarm.destroy');
        Route::get('/{id}/edit-form', 'editForm')->name('pemeriksaan-fire_alarm.edit-form');
    });
    
    Route::controller(HydrantBoxController::class)->prefix('hydrant-box')->group(function () {
        Route::get('/', 'index')->name('boxhydrant.index');
        Route::get('/{id_boxhydrant}', 'show')->name('boxhydrant.show');
        Route::get('/{id_boxhydrant}/inspeksi', 'create')->name('boxhydrant.inspeksi');
        Route::get('/{id_boxhydrant}/hasil', 'hasil')->name('boxhydrant.hasil');
        Route::post('/store', 'store')->name('boxhydrant.store');
    });

    Route::controller(PemeriksaanBoxHydrantController::class)->prefix('pemeriksaan-box-hydrant')->group(function () {
        Route::post('/store', 'store')->name('pemeriksaan-boxhydrant.store');
        Route::put('/{id}/update', 'update')->name('pemeriksaan-box-hydrant.update');
        Route::delete('/{id}', 'destroy')->name('pemeriksaan-boxhydrant.destroy');
        Route::get('/{id}/edit-form', 'editForm')->name('pemeriksaan-box-hydrant.edit-form');
    });

    Route::controller(RumahPompaController::class)->prefix('rumah-pompa')->group(function () {
        Route::get('/', 'index')->name('rumah_pompa.index');
        Route::get('/{id_rumah}', 'show')->name('rumah_pompa.show');
        Route::get('/{id_rumah}/inspeksi', 'create')->name('rumah_pompa.inspeksi');
        Route::get('/{id_rumah}/hasil', 'hasil')->name('rumah_pompa.hasil');
        Route::post('/store', 'store')->name('rumah_pompa.store');
    });

    Route::controller(PemeriksaanRumahPompaController::class)->prefix('pemeriksaan-rumah-pompa')->group(function () {
        Route::post('/store', 'store')->name('pemeriksaan-rumahpompa.store');
        Route::put('/{id}/update', 'update')->name('pemeriksaan-rumahpompa.update');
        Route::delete('/{id}', 'destroy')->name('pemeriksaan-rumahpompa.destroy');
        Route::get('/{id}/edit-form', 'editForm')->name('pemeriksaan-rumahpompa.edit-form');
    });




    Route::controller(P3kController::class)->prefix('kotak-p3k')->group(function () {
        Route::get('/', 'index')->name('p3k.index');
        Route::get('/{id_p3k}', 'show')->name('p3k.show');
        Route::get('/{id_p3k}/inspeksi', 'create')->name('p3k.inspeksi');
        Route::get('/{id_p3k}/hasil', 'hasil')->name('p3k.hasil');
        Route::get('/{id_p3k}/pemakaian', 'pemakaian')->name('p3k.pemakaian');
        Route::get('/{id_p3k}/hasilpemakaian', 'hasilpemakaian')->name('p3k.hasilpemakaian');
        Route::post('/store', 'store')->name('p3k.store');
    });

    Route::controller(PemeriksaanP3kController::class)->prefix('pemeriksaan-p3k')->group(function () {
        Route::get('/{id}/detail', 'getDetail')->name('pemeriksaan-p3k.detail');
        Route::get('/{id}/edit-form', 'getEditForm')->name('pemeriksaan-p3k.edit-form'); 
        Route::post('/store', 'store')->name('pemeriksaan-p3k.store');
        Route::put('/{id}', 'update')->name('pemeriksaan-p3k.update');
        Route::delete('/{id}', 'destroy')->name('pemeriksaan-p3k.destroy');
    });

    Route::controller(PemakaianP3kController::class)->prefix('pemakaian-p3k')->group(function () {
        Route::post('/store', 'storePemakaian')->name('pemakaian-p3k.store');
        Route::put('/{id}/update', 'update')->name('pemakaian-p3k.update');
        Route::delete('/{id}', 'destroy')->name('pemakaian-p3k.destroy');
        Route::get('/{id}/edit-form', 'editForm')->name('pemakaian-p3k.edit-form');

        Route::get('/{id_p3k}/available-months', 'getAvailableMonths')->name('pemakaian-p3k.available-months');
        Route::post('/edit-sequential', 'editSequentialForm')->name('pemakaian-p3k.edit-sequential');
        Route::put('/{id}/update-step', 'updateStep')->name('pemakaian-p3k.update-step');
    });

    Route::resource('saran', SaranController::class)->except(['show']);
    Route::get('/saran/hasil', [SaranController::class, 'hasil'])->name('saran.hasil');    
    });

    Route::prefix('inspeksi')->name('inspeksi.')->group(function () {
        Route::get('/dokumen/hasil', [DokumenIkaController::class, 'hasil'])->name('dokumen.hasil');
        Route::get('/dokumen/create', [DokumenIkaController::class, 'create'])->name('dokumen.create');
        Route::post('/dokumen', [DokumenIkaController::class, 'store'])->name('dokumen.store');
        Route::get('/dokumen/{id}/edit', [DokumenIkaController::class, 'edit'])->name('dokumen.edit');
        Route::put('/dokumen/{id}', [DokumenIkaController::class, 'update'])->name('dokumen.update');
        Route::delete('/dokumen/{id}', [DokumenIkaController::class, 'destroy'])->name('dokumen.destroy');
    });
    
    

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
