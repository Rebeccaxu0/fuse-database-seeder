<?php

namespace App\Http\Controllers;

use App\Models\Announcement;

class FacilitatorAnnouncementsController extends Controller
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
        $now = new \DateTime();
        $announcements
            = Announcement::where('start', '<=', $now->format('Y-m-d h:m:s'))
                ->where('end', '>=', $now->format('Y-m-d h:m:s'))
                ->get();
        return view('facilitator.announcements', ['announcements' => $announcements]);
    }
}
