<?php

namespace App\Http\Controllers;

use App\Stage;
use Illuminate\Http\Request;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stage.index')
            ->withStages(Stage::simplePaginate(25));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slag'] = str_slug($request->name);
        Stage::create($data);

        return redirect('/stages');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function show(Stage $stage)
    {
        return view('stage.show')
            ->withStage($stage)
            ->withComponents($stage->components);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function edit(Stage $stage)
    {
        return view('stage.edit')
            ->withStage($stage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stage $stage)
    {
        $stage->update($request->all());
        return redirect('/stages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stage  $stage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stage $stage)
    {
        $stage->delete();
        return redirect('/stages');
    }
}
