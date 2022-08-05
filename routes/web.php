<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ArtifactController;
use App\Http\Controllers\CacheController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\ChallengeVersionController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\FacilitatorChallengesController;
use App\Http\Controllers\FacilitatorCommentsController;
use App\Http\Controllers\FacilitatorSettingsController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\LTIController;
use App\Http\Controllers\LTIPlatformController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Admin\MediaManagerPage;
use App\Http\Livewire\Admin\SchoolsPage;
use App\Http\Livewire\Admin\StudiosPage;
use App\Http\Livewire\Admin\UsersPage;
use App\Http\Livewire\Facilitator\StudioActivityPage;
use App\Http\Livewire\Facilitator\StudioMembershipPage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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

// If someone hits 'refresh' on /logout that's a GET request
Route::get('logout', function () {
    return redirect('/');
});

/*
|------------------------------------------------------------------------
| Registration routes
|------------------------------------------------------------------------
*/
// Guest Lobby.
Route::get('lobby-guest', fn () => view('auth.lobby-guest'))
    ->middleware(['guest:' . config('fortify.guard')])
    ->name('lobby-guest');

// Recreating Fortify registration routes.
// Route::get('register', [RegisteredUserController::class, 'create'])
//     ->middleware(['guest:' . config('fortify.guard')])
//     ->name('register');

Route::post('register', [RegisteredUserController::class, 'store'])
    ->middleware(['guest:' . config('fortify.guard')]);


/*
|------------------------------------------------------------------------
| LTI routes
|------------------------------------------------------------------------
 */
Route::prefix('lti')
    ->name('lti.')
    ->group(function () {
        Route::get('login', [LTIController::class, 'login'])->name('login');
        Route::get('launch', [LTIController::class, 'launch'])->name('launch');
    });


Route::middleware([
    'auth:sanctum',
    'alum',
    'hasActiveStudio',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('lobby-auth', function () {
        if (auth()->user()->deFactoStudios()->count() == 0) {
            return view('auth.lobby-auth');
        } else {
            return redirect()->intended('dashboard');
        }
    })->name('lobby-auth');
    Route::impersonate();

    Route::get('heartbeat', function () {
        return response()->noContent();
    });
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
                'idea/{idea}', [IdeaController::class, 'show']
            )->name('idea');
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
                'settings',
                [FacilitatorSettingsController::class, 'index']
            )->name('settings');
            Route::post(
                'settings/update-studio-name/{studio}',
                [FacilitatorSettingsController::class, 'updateStudioName']
            )->name('update_studio_name');
            Route::get('support', function () {
                Gate::allowIf(Auth::user()->isFacilitator());
                return view('facilitator.support');
            })
                ->name('support');
        });

    /*
    |------------------------------------------------------------------------
    | Super Facilitator routes
    |------------------------------------------------------------------------
     */
    Route::prefix('superfacilitator')
        ->name('superfacilitator.')
        ->group(function () {
            Route::get('studios', StudiosPage::class)->name('studios.index');
        });
    /*
    |------------------------------------------------------------------------
    | admin routes
    |------------------------------------------------------------------------
      */
    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/', function () {
                Gate::allowIf(Auth::user()->isAdmin());
                return view('admin.index');
            })->name('index');
            // Clear cache because, why not?
            Route::get('cache/clear_all', [CacheController::class, 'clearAll'])->name('cache.clearall');

            Route::resources([
                'announcements'     => AnnouncementController::class,
                'challenges'        => ChallengeController::class,
                'challengeversions' => ChallengeVersionController::class,
                'districts'         => DistrictController::class,
                'levels'            => LevelController::class,
                'ltiplatforms'      => LTIPlatformController::class,
                'media'             => MediaController::class,
                'packages'          => PackageController::class,
                'schools'           => SchoolController::class,
                'studios'           => StudioController::class,
                'users'             => UserController::class,
            ]);

            // ChallengeVersion
            Route::get('challengeversions/{challenge}/create', [ChallengeVersionController::class, 'create'])->name('challengeversions.create');

            // School
            Route::post('schools/{school}/addstudios', [SchoolController::class, 'addstudios'])->name('schools.addstudios');
            Route::get('schools/{school}/createstudios', [SchoolController::class, 'createstudios'])->name('schools.createstudios');

            // User
            Route::post('users/{user}/make-admin', [UserController::class, 'makeAdmin'])->name('users.makeAdmin');

            // Makin' Copies
            Route::post('challengeversions/{challengeversion}/copy', [ChallengeVersionController::class, 'copy'])->name('challengeversions.copy');
            Route::post('levels/{level}/copy', [LevelController::class, 'copy'])->name('levels.copy');
            Route::post('packages/{package}/copy', [PackageController::class, 'copy'])->name('packages.copy');

            // Livewire Full page
            Route::get('schools', SchoolsPage::class)->name('schools.index');
            Route::get('studios', StudiosPage::class)->name('studios.index');
            Route::get('users', UsersPage::class)->name('users.index');
            Route::get('media', MediaManagerPage::class)->name('media.index');
        });
});
