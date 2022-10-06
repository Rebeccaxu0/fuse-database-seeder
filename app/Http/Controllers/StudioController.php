<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExportStudioActivityRequest;
use App\Models\Artifact;
use App\Models\ChallengeVersion;
use App\Models\Level;
use App\Models\Package;
use App\Models\Studio;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudioController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Studio::class, 'studio');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Full-page Livewire component - see App\Http\Livewire\Admin\StudioPage
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->flash();
        $validated = $request->validate([
            'name' => 'required|studios|max:255',
        ]);

        return redirect(route('admin.studios.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function show(Studio $studio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function edit(Studio $studio)
    {
        return view('admin.studio.edit', [
            'packages' => Package::all()->sortBy('name'),
            'studio' => $studio,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Studio $studio)
    {
        $studio->update([
            'name' => $request->name,
        ]);
        $studio->package()->associate($request->package);
        $studio->save();

        return redirect(route('admin.studios.index', ['school' => $studio->school->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Studio $studio)
    {
        $school_id = $studio->school->id;
        $studio->delete();
        return redirect(route('admin.studios.index', ['school' => $school_id]));
    }

    /**
     * Switch the active studio for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function switch(Request $request, Studio $studio)
    {
        $this->authorize('switch', $studio);

        $user = Auth::user();
        $user->activeStudio()->associate($studio);
        $user->save();
        Log::channel('fuse_activity_log')
            ->info('current_studio_change', [
                'user' => $user,
                'studio' => $studio,
            ]);

        return redirect(request()->header('Referer'));
    }

    public function exportActivity(ExportStudioActivityRequest $request, Studio $studio)
    {
        $validated = $request->validated();
        $start = $validated['from_date'] . ' 00:00:00';
        $end = $validated['to_date'] . ' 23:59:59';
        // $studioUsers = $studio->users;
        // $studioUsersIds = $studioUsers->pluck('id')->all();
        // $levels = Level::with(['levelable', 'levelable.levels'])
        //     ->whereHasMorph('levelable', [ChallengeVersion::class])
        //     ->get();
        // $artifacts = Artifact::with('level', 'level.levelable', 'level.levelable.levels', 'users')
        //     ->whereBetween('created_at', [$start, $end])
        //     ->whereHas('users', function (Builder $query) use ($studioUsersIds) {
        //         $query->whereIn('id', $studioUsersIds);
        //     })
        //     ->get();
        // $result = DB::table('activity_log')
        //     ->whereBetween('created_at', [$start, $end])
        //     ->whereIn('user_id', $studioUsersIds)
        //     ->orderBy('created_at')
            // ->chunk(500, function ($activity) use ($studioUsers, $artifacts, $levels) {
            //     foreach ($activity as $act) {
            //         $user = $studioUsers->find($act->user_id);
            //         $artifactNotes = $team = $totalLevels = '';
            //         if ($level = $levels->find($act->level_id)) {
            //             $totalLevels = $level->levelable->levels->count();
            //         }
            //         if ($act->artifact_id) {
            //             $totalLevels = 1;
            //             $artifact = $artifacts->find($act->artifact_id);
            //             $artifactNotes = $artifact->notes;
            //             if ($artifact->users->count() > 1) {
            //                 $team = $artifact->users
            //                     ->except($act->user_id)
            //                     ->pluck('full_name')
            //                     ->join(',', ' and ');
            //             }
            //         }
            //         $cols = [
            //             $user->name,
            //             $user->full_name,
            //             $user->email,
            //             $act->created_at,
            //             $act->activity_type,
            //             $act->challenge_title,
            //             $act->level_number,
            //             $totalLevels,
            //             $act->artifact_name,
            //             $act->artifact_url,
            //             $artifactNotes,
            //             $team,
            //         ];
            //         if ($act->level_id) {
            //         dd($cols);
            //         }
            //     }
            // });
            // ->get();
            // ->dd();
            // dd($result);

        $filenamePrefix = Auth::user()->isAdmin() || Auth::user()->isSuperFacilitator()
            ? $studio->school->name . '_'
            : '';
        $filenameUnsafe = $filenamePrefix . "{$studio->name}_{$validated['from_date']}_to_{$validated['to_date']}";
        $filename = preg_replace('/[^a-z0-9]+/', '-', strtolower($filenameUnsafe)) . '.csv';
        return response()->streamDownload(
            function () use ($start, $end, $studio) {
                $handle = fopen('php://output', 'w');
                $cols = [
                    __('User Name'),
                    __('Full Name'),
                    __('Email'),
                    __('Date'),
                    // Valid activity types are Level (Start/Save/Complete),
                    // Sign In, Sign Out, Added to Studio, Removed from Studio
                    __('Activity Type'),
                    __('Challenge'),
                    __('Level Number'),
                    __('Total Levels'),
                    __('Artifact Title'),
                    __('Artifact URL'),
                    __('Artifact Notes'),
                    __('Team Members'),
                ];
                fputcsv($handle, $cols);
                // This is demonstration code to show how to properly stream large CSV
                // files.
                // TODO: query offline Athena logs directly.
                // For now, query tightly-bound activity_log and get more info as needed.
                $studioUsers = $studio->users;
                $studioUsersIds = $studioUsers->pluck('id')->all();
                $levels = Level::with(['levelable', 'levelable.levels'])
                ->whereHasMorph('levelable', [ChallengeVersion::class])
                ->get();
                $artifacts = Artifact::with('level', 'level.levelable', 'level.levelable.levels', 'users')
                    ->whereBetween('created_at', [$start, $end])
                    ->whereHas('users', function (Builder $query) use ($studioUsersIds) {
                        $query->whereIn('id', $studioUsersIds);
                    })
                    ->get();
                DB::table('activity_log')
                    ->whereBetween('created_at', [$start, $end])
                    ->whereIn('user_id', $studioUsersIds)
                    ->orderBy('created_at')
                    ->chunk(500, function ($activity) use ($handle, $studioUsers, $artifacts, $levels) {
                        foreach ($activity as $act) {
                            $user = $studioUsers->find($act->user_id);
                            $artifactNotes = $team = $totalLevels = '';
                            if ($level = $levels->find($act->level_id)) {
                                $totalLevels = $level->levelable->levels->count();
                            }
                            if ($act->artifact_id) {
                                $totalLevels = 1;
                                $artifact = $artifacts->find($act->artifact_id);
                                if ($level = $levels->find($act->level_id)) {
                                    $totalLevels = $level->levelable->levels->count();
                                }
                                $artifactNotes = $artifact->notes;
                                if ($artifact->users->count() > 1) {
                                    $team = $artifact->users
                                        ->except($act->user_id)
                                        ->pluck('full_name')
                                        ->join(',', ' and ');
                                }
                            }
                            $cols = [
                                $user->name,
                                $user->full_name,
                                $user->email,
                                $act->created_at,
                                $act->activity_type,
                                $act->challenge_title,
                                $act->level_number,
                                $totalLevels,
                                $act->artifact_name,
                                $act->artifact_url,
                                $artifactNotes,
                                $team,
                            ];
                            fputcsv($handle, $cols);
                        }
                    });

                fclose($handle);
            },
            $filename
        );
    }
}
