<?php

use App\Http\Controllers\ArtifactController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\ChallengeVersionController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\FacilitatorAnnouncementsController;
use App\Http\Controllers\FacilitatorChallengesController;
use App\Http\Controllers\FacilitatorCommentsController;
use App\Http\Controllers\FacilitatorSettingsController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\LTIPlatformController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Facilitator\StudioActivityPage;
use App\Http\Livewire\Facilitator\StudioMembershipPage;
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
    return redirect()->intended('dashboard');
});

Route::middleware(['auth:sanctum', 'hasActiveStudio', 'verified'])->group(function () {
    Route::impersonate();

    Route::put('studios/{studio}/switch', [StudioController::class, 'switch'])->name('switch_studio');

    /*
    |------------------------------------------------------------------------
    | student routes
    |------------------------------------------------------------------------
    */
    Route::name('student.')
        ->group(function () {
            Route::get(
                'challenges', [ChallengeVersionController::class, 'student_index']
                )->name('challenges');
            Route::get(
                'challenge/{challengeVersion:slug}/level/{level:level_number}',
                [LevelController::class, 'show']
                )->name('level');
            Route::get('dashboard', function () {
                return view('student.dashboard');
            })->name('dashboard');
            Route::get(
                'help_finder', [ChallengeVersionController::class, 'student_help_finder']
                )->name('help_finder');
            Route::get(
                'mystuff', [ArtifactController::class, 'my_stuff_index']
                )->name('my_stuff');
        });

    /*
    |------------------------------------------------------------------------
    | facilitator routes
    |------------------------------------------------------------------------
    */
    Route::prefix('facilitator')
        ->name('facilitator.')
        ->group(function () {
            Route::redirect('/', 'facilitator/people')->name('index');
            Route::get('people', StudioMembershipPage::class)->name('people');
            Route::get('activity', StudioActivityPage::class)->name('activity');
            Route::get('activity/export/{studio}', [StudioController::class, 'exportActivity'])->name('activity-export');
            Route::get(
                'challenges', [FacilitatorChallengesController::class, 'index']
                )->name('challenges');
            Route::get(
                'comments', [FacilitatorCommentsController::class, 'index']
                )->name('comments');
            Route::get(
                'settings', [FacilitatorSettingsController::class, 'index'])->name('settings');
            Route::get(
                'announcements', [FacilitatorAnnouncementsController::class, 'index']
                )->name('announcements');
        });
    Route::get('support', function () {
        return '<h1>' . __('TODO') . '</h1>';
    })->name('support');

    /*
    |------------------------------------------------------------------------
    | admin routes
    |------------------------------------------------------------------------
    */
    Route::view('admin', 'admin.index')->name('admin');
    /*Route::get('admin.schools.addstudios', [SchoolController::class]);*/
    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::post('schools/{school}/addstudios', [SchoolController::class, 'addstudios'])->name('schools.addstudios');
            Route::get('schools/{school}/createstudios', [SchoolController::class, 'createstudios'])->name('schools.createstudios');
            Route::post('packages/{package}/copy', [PackageController::class, 'copy'])->name('packages.copy');
            Route::resource('packages', PackageController::class);
            Route::resource('districts', DistrictController::class);
            Route::resource('schools', SchoolController::class);
            Route::resource('studios', StudioController::class);
            Route::resource('challenges', ChallengeController::class);
            Route::resource('lti_platforms', LTIPlatformController::class);
            Route::resource('users', UserController::class);
            Route::get('users/online', [UserController::class, 'onlineStatus'])->name('users.online');
        });
    });

