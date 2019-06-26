<?php

namespace App\Http\Controllers;

use App\CtmRemark;
use Illuminate\Http\Request;

class CtmRemarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CtmRemark  $ctmRemark
     * @return \Illuminate\Http\Response
     */
    public function show(CtmRemark $ctmRemark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CtmRemark  $ctmRemark
     * @return \Illuminate\Http\Response
     */
    public function edit(CtmRemark $ctmRemark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CtmRemark  $ctmRemark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CtmRemark $ctmRemark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CtmRemark  $ctmRemark
     * @return \Illuminate\Http\Response
     */
    public function destroy(CtmRemark $ctmRemark)
    {
        //
    }

    public function storeRemarrks(Request $request)
    {
        $data = $request->all();
        dd($request->all());
    }
}
