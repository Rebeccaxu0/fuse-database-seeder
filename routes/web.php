<?php

use App\Http\Controllers\PackageController;
use App\Http\Controllers\DistrictController;
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
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
  /*
  |------------------------------------------------------------------------
  | student routes
  |------------------------------------------------------------------------
  */
  Route::get('/challenges', function () {
    return '<h1>' . __('TODO') . '</h1>';
  })->name('challenges');
  Route::get('/help_finder', function () {
    return '<h1>' . __('TODO') . '</h1>';
  })->name('help_finder');
  Route::get('/dashboard', function () {
    return view('dashboard');
  })->name('dashboard');
  Route::get('/mystuff', function () {
    return '<h1>' . __('TODO') . '</h1>';
  })->name('gallery');

  /*
  |------------------------------------------------------------------------
  | facilitator routes
  |------------------------------------------------------------------------
  */
  Route::get('/facilitator', function () {
    return '<h1>' . __('TODO') . '</h1>';
  })->name('facilitator');
  Route::get('/support', function () {
    return '<h1>' . __('TODO') . '</h1>';
  })->name('support');

  /*
  |------------------------------------------------------------------------
  | admin routes
  |------------------------------------------------------------------------
  */
  Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
    Route::get('/packages', [PackageController::class, 'index'])->name('packages');
    Route::prefix('package')
      ->name('package.')
      ->group(function() {
        Route::get('/add', [PackageController::class, 'create'])->name('add');
        Route::post('/add', [PackageController::class, 'store']);
        Route::get('/{package:id}', [PackageController::class, 'show'])->name('view');
        Route::get('/{package:id}/edit', [PackageController::class, 'edit'])->name('edit');
        Route::put('{package:id}/edit', [PackageController::class, 'update']);
        Route::delete('{package:id}/delete', [PackageController::class, 'destroy'])->name('delete');
      });
    Route::get('/districts', [DistrictController::class, 'index'])->name('districts');
  });
});
