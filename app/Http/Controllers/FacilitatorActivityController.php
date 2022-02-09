<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class FacilitatorActivityController extends Controller
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
        $students = Auth::user()->activeStudio
            ->students()
            ->orderBy('name')
            ->get();

        return view('facilitator.activity', ['students' => $students]);
    }

}
