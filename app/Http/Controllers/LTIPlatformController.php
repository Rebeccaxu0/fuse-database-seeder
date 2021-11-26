<?php

namespace App\Http\Controllers;

use App\Models\LTIPlatform;
use Illuminate\Http\Request;

class LTIPlatformController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->authorizeResource(LTIPlatform::class, 'lti_platform');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.lti_platform.index', ['lti_platform' => LTIPlatform::all()]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LTIPlatform  $lTIPlatform
     * @return \Illuminate\Http\Response
     */
    public function show(LTIPlatform $lTIPlatform)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LTIPlatform  $lTIPlatform
     * @return \Illuminate\Http\Response
     */
    public function edit(LTIPlatform $lTIPlatform)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LTIPlatform  $lTIPlatform
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LTIPlatform $lTIPlatform)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LTIPlatform  $lTIPlatform
     * @return \Illuminate\Http\Response
     */
    public function destroy(LTIPlatform $lTIPlatform)
    {
        //
    }
}
