<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use Illuminate\Support\Facades\Auth;

class FacilitatorStudioMembersController extends Controller
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
        return view('facilitator.people');
    }
}
