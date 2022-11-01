<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\FlowController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PackageGroupController;
use Illuminate\Support\Facades\Redis;
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
    return redirect()->route('flow.index');
});

Route::middleware('auth')->group(function () {

    Route::group(['prefix' => 'packages'], function () {
        Route::get('/create', [PackageController::class, 'create'])->name('packages.create');
        Route::post('/', [PackageController::class, 'store'])->name('packages.store');;

        Route::get('/{package}', [PackageController::class, 'show'])->name('packages.show');
        Route::delete('/{package}', [PackageController::class, 'cancel'])->name('packages.cancel');

        Route::get('/', [PackageController::class, 'index'])->name('packages.list');
        Route::get('/list/fetch', [PackageController::class, 'fetchAll'])->name('packages.list.fetch');

        Route::get('/label/{trackNumber}', [LabelController::class, 'get'])->name('package.label.get');
        Route::get('/label/{trackNumber}/download', [LabelController::class, 'download'])->name('package.label.download');
    });

    Route::group(['prefix' => 'package_groups'], function () {
        Route::match(['get', 'post'],'/create', [PackageGroupController::class, 'create'])->name('package_groups.create');
    });

    Route::get('/flow', [FlowController::class, 'index'])->name('flow.index');

    Route::get('/contact/random', [ContactController::class, 'getRandomContact'])->name('contact.random');


});

require __DIR__.'/auth.php';
