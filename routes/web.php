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
    Route::get('/packages/{package:slug}', [PackageController::class, 'show'])->name('package');
    Route::get('/addpackage', [PackageController::class, 'create'])->name('addpackage');
    Route::post('/addpackage', [PackageController::class, 'store']);
    Route::get('/{package:slug}/editpackage', [PackageController::class, 'edit'])->name('editpackage');
    Route::put('/{package:slug}/editpackage', [PackageController::class, 'update']);
    Route::delete('/packages/{package:slug}', [PAckageController::class, 'destroy']);
    
    Route::get('/districts', [DistrictController::class, 'index'])->name('districts');
  });
});
