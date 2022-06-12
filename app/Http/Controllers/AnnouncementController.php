<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::all();
        return view('admin.announcement.index', ['announcements' => $announcements]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $announcement = new Announcement(['type' => 'new']);
        $nowDateTime = date('Y-m-d\TH:i');
        return view('admin.announcement.create', ['announcement' => $announcement, 'now' => $nowDateTime]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => [
                'required',
                Rule::in(['new', 'update', 'alert']),
            ],
            'url' => 'nullable|url',
            'message' => 'required|string',
            'start_at' => 'required|date_format:Y-m-d\TH:i',
            'end_at' => [
                'required',
                'date_format:Y-m-d\TH:i',
                'after:start_at',
            ],
        ]);

        Announcement::create([
            'type'     => $validated['type'],
            'url'      => $validated['url'],
            'body'     => $validated['message'],
            'start_at' => $validated['start_at'],
            'end_at'   => $validated['end_at'],
        ]);
        Cache::tags(['announcements'])->flush();

        return redirect(route('admin.announcements.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        $nowDateTime = date('Y-m-d\TH:i');
        return view('admin.announcement.edit', ['announcement' => $announcement, 'now' => $nowDateTime]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'type' => [
                'required',
                Rule::in(['new', 'update', 'alert']),
            ],
            'url' => 'nullable|url',
            'message' => 'required|string',
            'start_at' => 'required|date_format:Y-m-d\TH:i',
            'end_at' => [
                'required',
                'date_format:Y-m-d\TH:i',
                'after:start_at',
            ],
        ]);

        $announcement->update([
            'type'     => $validated['type'],
            'url'      => $validated['url'],
            'body'     => $validated['message'],
            'start_at' => $validated['start_at'],
            'end_at'   => $validated['end_at'],
        ]);
        Cache::tags(['announcements'])->flush();

        return redirect(route('admin.announcements.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        Cache::tags(['announcements'])->flush();

        return redirect(route('admin.announcements.index'));
    }
}
