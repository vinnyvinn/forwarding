<?php

namespace App\Http\Controllers;

use App\StageComponent;
use Illuminate\Http\Request;

class StageComponentController extends Controller
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
        $data = $request->all();
        $data['required'] = $request->required == 'true' ? true : false;
        $data['notification'] = $request->required == 'true' ? true : false;

        $jsondata = $request->components != null ? explode(',',$request->components) : null;

        $data['components'] = ($jsondata == null ? null : json_encode($jsondata));

        $item = StageComponent::create($data);

        return Response(['success' => '<tr>'.
                                    '<td>'.ucwords($item->name).'</td>'.
                                    '<td>'. ucfirst($item->description) .'</td>'.
                                    '<td>'. $item->type .'</td>'.
                                    '<td>'. ($request->required == "true" ? "Yes" : "No") .'</td>'.
                                    '<td>'. ($request->notification == "true" ? "Yes" : "No") .'</td>'.
                                    '<td>'. ($request->timing) .' Mins</td>'.
                                    '<td>'. ($item->components != null ? implode(",",json_decode($item->components)) : $item->components ).'</td>'.
                                    '<td>'.
                                        '<form action="'.route('stage-components.destroy', $item->id) .'" method="post">'.
                                           csrf_field() .' <br>'.method_field("DELETE").
                                            '<button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>'.
                                       ' </form>'.
                                    '</td>'.
                                '</tr>']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StageComponent  $stageComponent
     * @return \Illuminate\Http\Response
     */
    public function show(StageComponent $stageComponent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StageComponent  $stageComponent
     * @return \Illuminate\Http\Response
     */
    public function edit(StageComponent $stageComponent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StageComponent  $stageComponent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StageComponent $stageComponent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StageComponent  $stageComponent
     * @return \Illuminate\Http\Response
     */
    public function destroy(StageComponent $stageComponent)
    {
        $stageComponent->delete();
        return redirect()->back();
    }
}
