<?php

namespace App\Http\Controllers;

use App\Models\Artifact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArtifactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a customized listing of the resource for students.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function artifact_gallery(User $user = null)
    {
        $artifacts = $user->artifacts()->paginate(12);
        return view('student.my_stuff', ['artifacts' => $artifacts, 'studio' => $user->activeStudio]);
    }

    /**
     * Display a customized listing of the resource for students.
     *
     * @return \Illuminate\Http\Response
     */
    public function my_stuff_index()
    {
        return $this->artifact_gallery(Auth::user());
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
        //
      dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function show(Artifact $artifact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function edit(Artifact $artifact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artifact $artifact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Artifact  $artifact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artifact $artifact)
    {
        //
    }
}
