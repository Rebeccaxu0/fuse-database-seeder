<?php

use App\Http\Controllers\ArtifactController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\ChallengeVersionController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\FacilitatorAnnouncementsController;
use App\Http\Controllers\FacilitatorChallengesController;
use App\Http\Controllers\FacilitatorCommentsController;
use App\Http\Controllers\FacilitatorSettingsController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\LTIPlatformController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Admin\UsersPage;
use App\Http\Livewire\Admin\MediaManagerPage;
use App\Http\Livewire\Facilitator\StudioActivityPage;
use App\Http\Livewire\Facilitator\StudioMembershipPage;
use App\Models\ChallengeVersion;
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

    Route::get('heartbeat', function() { return response()->noContent(); });
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
            Route::post(
                'challenge/{challengeVersion:slug}/level/{level:level_number}/start',
                [LevelController::class, 'start']
                )->name('level_start');
            Route::post(
                'artifact',
                [ArtifactController::class, 'store']
                )->name('save_artifact');
            Route::get('dashboard', function () {
                return view('student.dashboard');
            })->name('dashboard');
            Route::get(
                'ideas', [IdeaController::class, 'index']
                )->name('ideas');
            Route::get(
                'help_finder', [ChallengeVersionController::class, 'student_help_finder']
                )->name('help_finder');
            Route::get(
                '{user}/mystuff', [ArtifactController::class, 'artifact_gallery']
                )->name('their_stuff');
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
            Route::get('activity/export/{studio}', [StudioController::class, 'exportActivity'])->name('export_activity');
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
    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resources([
                'challenges'    => ChallengeController::class,
                //'challengeversions'    => ChallengeVersionController::class,
                'districts'     => DistrictController::class,
                'lti_platforms' => LTIPlatformController::class,
                'media'         => MediaController::class,
                'packages'      => PackageController::class,
                'schools'       => SchoolController::class,
                'studios'       => StudioController::class,
                'users'         => UserController::class,
            ]);
                
            Route::post('schools/{school}/addstudios', [SchoolController::class, 'addstudios'])->name('schools.addstudios');
            Route::get('schools/{school}/createstudios', [SchoolController::class, 'createstudios'])->name('schools.createstudios');

            Route::post('packages/{package}/copy', [PackageController::class, 'copy'])->name('packages.copy');

            //manual recreation of Challenge Version resource routes
            //create, store require $challenge
            Route::get('challengeversions/{challenge}/create', [ChallengeVersionController::class, 'create'])->name('challengeversions.create');    
            Route::post('challengeversions/{challenge}', [ChallengeVersionController::class, 'store'])->name('challengeversions.store');

            Route::get('challengeversions/', [ChallengeVersionController::class, 'index'])->name('challengeversions.index'); 
            Route::get('challengeversions/{challengeversion}/edit', [ChallengeVersionController::class, 'edit'])->name('challengeversions.edit');
            Route::put('challengeversions/{challengeversion}', [ChallengeVersionController::class, 'update'])->name('challengeversions.update');
            Route::delete('challengeversions/{challengeversion}', [ChallengeVersionController::class, 'destroy'])->name('challengeversions.destroy');

            //manual recreation of Levels resource routes
            //create, store require a ChallengeVersion or Idea parent....!!
            Route::get('levels/create', [LevelController::class, 'create'])->name('levels.create');    
            Route::post('levels/', [LevelController::class, 'store'])->name('levels.store');
            
            Route::get('levels/', [LevelController::class, 'index'])->name('levels.index'); 
            Route::get('levels/{level}/edit', [LevelController::class, 'edit'])->name('levels.edit');
            Route::put('levels/{level}', [LevelController::class, 'update'])->name('levels.update');
            Route::delete('levels/{level}', [LevelController::class, 'destroy'])->name('levels.destroy');
            Route::post('levels/{level}/copy', [LevelController::class, 'copy'])->name('levels.copy');

            Route::get('users', UsersPage::class)->name('users.index');
            Route::get('media', MediaManagerPage::class)->name('media.index');
        });
    });

