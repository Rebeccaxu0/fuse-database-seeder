<?php

namespace App\Http\Controllers;

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
        // TODO: get list of Comments.

        return view('facilitator.comments', []);
    }
}
