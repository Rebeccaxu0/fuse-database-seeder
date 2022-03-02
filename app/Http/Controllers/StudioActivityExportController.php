<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudioActivityExportController extends Controller
{

    /**
     * Provide a csv-formatted direct download of student activity.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'studio_id' => ['required', 'integer'],
            'from_date' => ['required', 'date'],
            'to_date' => ['required', 'date'],
        ]);

        return response('Hello World', 200)
            ->header('Content-Disposition', 'attachment; filename="test.txt"');
        return view('facilitator.activity', ['students' => $students]);
    }

}
