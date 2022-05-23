<?php

namespace App\Http\Controllers;

use App\Models\Artifact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

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
        $studioUsers = Auth::user()->activeStudio->users->pluck('id');
        $artifacts = Artifact::whereHas(
            'team', function (Builder $query) use ($studioUsers) {
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
