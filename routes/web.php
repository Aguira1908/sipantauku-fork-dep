<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenerimaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TargetController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Tanpa Login)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('dashboard-password');
});

Route::get('/dashboard-password', function () {
    return view('dashboard-password');
});

Route::post('/dashboard-password', function (Request $request) {

    if ($request->password == 'UPTDPPRDKutim') {

        session([
            'dashboard_access' => true
        ]);

        return redirect('/');
    }

    return back()->with('error','Password salah.');

});

Route::get('/', [DashboardController::class, 'index'])
    ->middleware('dashboard.password');

Route::get('/laporan', [LaporanController::class, 'index']);
Route::get('/laporan/download', [LaporanController::class, 'download']);


/*
|--------------------------------------------------------------------------
| DASHBOARD LOGIN (Redirect Setelah Login)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect('/admin');
})->middleware(['auth'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Harus Login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/admin', [AdminController::class, 'index']);


    /*
    |--------------------------------------------------------------------------
    | PENERIMAAN
    |--------------------------------------------------------------------------
    */

    Route::get('/tambah', [PenerimaanController::class, 'create']);
    Route::post('/simpan', [PenerimaanController::class, 'store']);

    Route::get('/edit/{id}', [PenerimaanController::class, 'edit']);
    Route::post('/update/{id}', [PenerimaanController::class, 'update']);

    Route::get('/hapus/{id}', [PenerimaanController::class, 'destroy']);


    /*
    |--------------------------------------------------------------------------
    | BAGIAN
    |--------------------------------------------------------------------------
    */

    Route::get('/bagian', [BagianController::class, 'index']);

    Route::post('/bagian/simpan', [BagianController::class, 'store']);

    Route::get('/bagian/edit/{id}', [BagianController::class, 'edit']);
    Route::post('/bagian/update/{id}', [BagianController::class, 'update']);

    Route::get('/bagian/hapus/{id}', [BagianController::class, 'destroy']);


    /*
    |--------------------------------------------------------------------------
    | TARGET
    |--------------------------------------------------------------------------
    */

    Route::get('/target', [TargetController::class, 'index']);

    Route::post('/target/simpan', [TargetController::class, 'store']);

    Route::get('/target/hapus/{id}', [TargetController::class, 'destroy']);


    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| API
|--------------------------------------------------------------------------
*/

Route::get('/api/penerimaan', function () {
    return \App\Models\Penerimaan::with('bagian')->latest()->get();
});


/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
