<?php

namespace App\Http\Controllers;

use App\CargoImage;
use Esl\Repository\UploadFileRepo;
use Illuminate\Http\Request;

class CargoImageController extends Controller
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
     * @param  \App\CargoImage  $cargoImage
     * @return \Illuminate\Http\Response
     */
    public function show(CargoImage $cargoImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CargoImage  $cargoImage
     * @return \Illuminate\Http\Response
     */
    public function edit(CargoImage $cargoImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CargoImage  $cargoImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CargoImage $cargoImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CargoImage  $cargoImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(CargoImage $cargoImage)
    {
        //
    }

    public function upload(Request $request)
    {
        $path_file = UploadFileRepo::init()->upload($request->images, 'documents/uploads/');
        CargoImage::create([
            'bill_of_landing_id' => $request->bill_of_landing_id,
            'image_path'=>$path_file]);

        return redirect()->back();
    }
}
