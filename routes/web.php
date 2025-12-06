<?php

use App\Http\Controllers\PpdbController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('homepage');
})->name('home');


/*
|--------------------------------------------------------------------------
| Auth (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';


/*
|--------------------------------------------------------------------------
| Dashboard (WAJIB untuk Breeze)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('home');
})->middleware('auth')->name('dashboard');


/*
|--------------------------------------------------------------------------
| PPDB PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('daftar')->name('daftar.')->group(function () {

    Route::get('/', [PpdbController::class, 'step1'])->name('sekarang');

    Route::get('/step1', [PpdbController::class, 'step1View'])->name('step1');
    Route::post('/step1', [PpdbController::class, 'step1Submit'])->name('step1.submit');

    Route::get('/step2', [PpdbController::class, 'step2View'])->name('step2');
    Route::post('/step2', [PpdbController::class, 'step2Submit'])->name('step2.submit');

    Route::get('/step3', [PpdbController::class, 'step3View'])->name('step3');

    Route::post('/store', [PpdbController::class, 'store'])->name('store');

    Route::get('/success/{id}', [PpdbController::class, 'showSuccess'])->name('success');
});


/*
|--------------------------------------------------------------------------
| Konfirmasi Publik
|--------------------------------------------------------------------------
*/
Route::get('/konfirmasi/{no_pendaftaran}', [PpdbController::class, 'konfirmasi'])
    ->name('ppdb.konfirmasi')
    ->where('no_pendaftaran', 'PPDB-[A-Z0-9-]+');

Route::get('/konfirmasi', function () {
    return view('ppdb.konfirmasi-form');
})->name('ppdb.konfirmasi.form');

Route::post('/konfirmasi', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'no_pendaftaran' => 'required|string|max:50'
    ]);

    return redirect()->route('ppdb.konfirmasi', $request->no_pendaftaran);
})->name('ppdb.konfirmasi.submit');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::get('/registrations', [AdminController::class, 'index'])
            ->name('registrations.index');

        Route::get('/registrations/{id}', [AdminController::class, 'show'])
            ->name('registrations.show');

        Route::post('/registrations/{id}/approve', [AdminController::class, 'approve'])
            ->name('registrations.approve');

        Route::post('/registrations/{id}/reject', [AdminController::class, 'reject'])
            ->name('registrations.reject');

        Route::get('/export', [AdminController::class, 'export'])
            ->name('export');
    });


/*
|--------------------------------------------------------------------------
| Admin shortcut
|--------------------------------------------------------------------------
*/
Route::get('/admin', function () {
    return Auth::check() && Auth::user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('login');
});
