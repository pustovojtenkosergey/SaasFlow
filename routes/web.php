<?php

use App\Http\Controllers\FlowController;
use App\Http\Controllers\ParcelController;
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
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'parcels'], function () {
        Route::get('/create', [ParcelController::class, 'create'])->name('parcels.create');
        Route::post('/store', [ParcelController::class, 'store'])->name('parcels.store');;

        Route::get('/show/{parcel?}', [ParcelController::class, 'show'])->name('parcels.show');

        Route::get('/list', [ParcelController::class, 'index'])->name('parcels.list');
        Route::get('/list/fetch', [ParcelController::class, 'fetchParcels'])->name('parcels.list.fetch');
    });

    Route::get('/flow', [FlowController::class, 'index'])->name('flow.index');

});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
