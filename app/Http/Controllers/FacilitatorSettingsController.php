<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Studio;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class FacilitatorSettingsController extends Controller
{
    public Studio $studio;

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = new DateTime();
        $announcements
            = Announcement::where('start_at', '<=', $now->format('Y-m-d h:m:s'))
                ->where('end_at', '>=', $now->format('Y-m-d h:m:s'))
                ->get();
        return view('facilitator.settings', [
            'announcements' => $announcements,
            'studio' => Auth::user()->activeStudio,
        ]);
    }

    /**
     * Update Studio Name.
     */
    public function updateStudioName(Request $request, Studio $studio)
    {
        Gate::allowIf(fn () => Auth::user()->deFactoStudios()->contains($studio));

        $validated = $request->validate(['name' => 'required|max:25']);

        $studio->name = $validated['name'];
        $studio->save();

        return redirect(route('facilitator.settings'));
    }
}
