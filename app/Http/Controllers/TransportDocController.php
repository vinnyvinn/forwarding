<?php

namespace App\Http\Controllers;

use App\Quotation;
use App\TransportDoc;
use Illuminate\Http\Request;

class TransportDocController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transport.docs.index')
            ->withDocs(TransportDoc::simplePaginate(25));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transport.docs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TransportDoc::create($request->all());
        return redirect('/required-docs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TransportDoc  $transportDoc
     * @return \Illuminate\Http\Response
     */
    public function show(TransportDoc $transportDoc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TransportDoc  $transportDoc
     * @return \Illuminate\Http\Response
     */
    public function edit($transportDoc)
    {
        return view('transport.docs.edit')
            ->withDoc(TransportDoc::findOrFail($transportDoc));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TransportDoc  $transportDoc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $transportDoc)
    {
        TransportDoc::findOrFail($transportDoc)->update($request->all());
        return redirect('/required-docs');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TransportDoc  $transportDoc
     * @return \Illuminate\Http\Response
     */
    public function destroy($transportDoc)
    {
        TransportDoc::findOrFail($transportDoc)->delete();
        return redirect('/required-docs');
    }

    public function deleteDoc(Request $request)
    {
        $quotation = Quotation::findOrFail($request->quotation_id);

        $docsArray = json_decode($quotation->doc_ids, true);
        $doc_id = (int)$request->doc_id;
        foreach ($docsArray as $key => $doc){
            if ($doc['doc_id'] == $doc_id){
                unset($docsArray[$key]);
                $quotation->doc_ids = json_encode($docsArray);
                $quotation->save();
                break;
            }
        }

        return Response(json_encode(['success'=>'success']));
    }
}
