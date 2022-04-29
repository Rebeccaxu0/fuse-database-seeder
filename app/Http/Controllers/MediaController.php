<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $disp_count = 15;
        // $page = (int) $request->input('page') ?: 1;
        // $current_dir = $request->input('dir') ?: '';
        // $public = Storage::disk('public');
        // $s3_files = [];
        // $s3 = collect($public->files('/' . $current_dir));
        // $directories = $public->directories('/' . $current_dir);
        // $slice = $s3->slice(($page - 1) * $disp_count, $disp_count);
        // foreach ($slice as $file) {
        //     $s3_files[$file] = [
        //         'size' => $public->size($file),
        //         'lastModified' => date('Y-m-d', $public->lastModified($file)),
        //         'path' => $public->path($file),
        //         'url' => $public->url($file),
        //     ];
        // }
        // $paginator = new LengthAwarePaginator($s3_files, $s3->count(), $disp_count);

        $current_dir = '';
        $directories = [];
        $media = Media::inDirectory('public', $current_dir)
            ->orderBy('updated_at')
            ->paginate(15);
        return view('admin.files.index', [
            'directories' => $directories,
            'current_dir' => $current_dir,
            'media' => $media
        ]);
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
     * @param  \App\Http\Requests\StoreFileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFileRequest  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFileRequest $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }
}
