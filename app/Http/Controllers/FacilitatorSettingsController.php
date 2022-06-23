<?php

namespace App\Http\Controllers;

use App\Models\Studio;
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
        return view('facilitator.settings', ['studio' => Auth::user()->activeStudio]);
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
