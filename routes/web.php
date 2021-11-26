<?php

use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\ChallengeVersionController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\FacilitatorActivityController;
use App\Http\Controllers\FacilitatorAnnouncementsController;
use App\Http\Controllers\FacilitatorChallengesController;
use App\Http\Controllers\FacilitatorCommentsController;
use App\Http\Controllers\FacilitatorSettingsController;
use App\Http\Controllers\FacilitatorStudioMembersController;
use App\Http\Controllers\LTIPlatformController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudioController;
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
  Route::get('/challenges', [ChallengeVersionController::class, 'student_index'])->name('challenges');
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
  Route::prefix('facilitator')
    ->name('facilitator.')
    ->group(function () {
      Route::redirect('/', 'facilitator/people')->name('index');
      Route::get('people', [FacilitatorStudioMembersController::class, 'index'])->name('people');
      Route::get('activity', [FacilitatorActivityController::class, 'index'])->name('activity');
      Route::get('challenges', [FacilitatorChallengesController::class, 'index'])->name('challenges');
      Route::get('comments', [FacilitatorCommentsController::class, 'index'])->name('comments');
      Route::get('settings', [FacilitatorSettingsController::class, 'index'])->name('settings');
      Route::get('announcements', [FacilitatorAnnouncementsController::class, 'index'])->name('announcements');
    });
  Route::get('/support', function () {
    return '<h1>' . __('TODO') . '</h1>';
  })->name('support');

  /*
  |------------------------------------------------------------------------
  | admin routes
  |------------------------------------------------------------------------
  */
  Route::view('/admin', 'admin.index')->name('admin');
  Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
      Route::resource('packages', PackageController::class);
      Route::resource('districts', DistrictController::class);
      Route::resource('schools', SchoolController::class);
      Route::resource('studios', StudioController::class);
      Route::resource('challenges', ChallengeController::class);
      Route::resource('lti_platforms', LTIPlatformController::class);
    });
});
