<?php

namespace App\Http\Controllers;

use App\Models\HelpArticle;
use Illuminate\Http\Request;

class HelpArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $helpArticles = HelpArticle::paginate(20);
        return view('admin.helparticle.index', ['helpArticles' => $helpArticles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.helparticle.create');
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
            'name' => 'required|max:255',
            'body' => 'required',
        ]);

        HelpArticle::create([
            'name' => $validated['name'],
            'body' => $validated['body'],
        ]);

        return redirect(route('admin.helparticles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  HelpArticle  $helparticle
     * @return \Illuminate\Http\Response
     */
    public function show($helparticle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  HelpArticle  $helparticle
     * @return \Illuminate\Http\Response
     */
    public function edit(HelpArticle $helparticle)
    {
        return view('admin.helparticle.edit', ['helparticle' => $helparticle]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  HelpArticle  $helparticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HelpArticle $helparticle)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'body' => 'required',
        ]);

        $helparticle->update([
            'name' => $validated['name'],
            'body' => $validated['body'],
        ]);

        return redirect(route('admin.helparticles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  HelpArticle  $helparticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(HelpArticle $helparticle)
    {
        $helparticle->delete();
        return redirect(route('admin.helparticles.index'));
    }
}
