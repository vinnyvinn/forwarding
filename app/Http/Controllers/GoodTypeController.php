<?php

namespace App\Http\Controllers;

use App\GoodType;
use Illuminate\Http\Request;

class GoodTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('good-types.index')
            ->withGoodtypes(GoodType::simplePaginate(25));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('good-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        GoodType::create($request->all());
        return redirect('/good-types');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GoodType  $goodType
     * @return \Illuminate\Http\Response
     */
    public function show(GoodType $goodType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GoodType  $goodType
     * @return \Illuminate\Http\Response
     */
    public function edit(GoodType $goodType)
    {
        return view('good-types.edit')
            ->withGoodtype($goodType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GoodType  $goodType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoodType $goodType)
    {
        $goodType->update($request->all());
        return redirect('/good-types');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GoodType  $goodType
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoodType $goodType)
    {
        $goodType->delete();
        return redirect('/good-types');
    }
}
