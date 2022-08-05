<?php

namespace App\Http\Controllers;

use App\Models\Artifact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class FacilitatorCommentsController extends Controller
{
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
        $user = Auth::user();
        Gate::allowIf($user->isAdmin() || $user->isFacilitator() || $user->isSuperFacilitator());
        $studioUsers = Auth::user()->activeStudio->users->pluck('id');
        $artifacts = Artifact::whereHas(
            'users', function (Builder $query) use ($studioUsers) {
                $query->whereIn('user_id', $studioUsers);
            })
            ->has('comments')
            ->paginate(12);
        return view('facilitator.comments', [
            'artifacts' => $artifacts,
            'studio' => Auth::user()->activeStudio,
        ]);
    }
}
