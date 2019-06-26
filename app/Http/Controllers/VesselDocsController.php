<?php

namespace App\Http\Controllers;

use App\VesselDocs;
use Esl\Repository\UploadFileRepo;
use Illuminate\Http\Request;

class VesselDocsController extends Controller
{
    public function upload(Request $request)
    {
        $path_file = UploadFileRepo::init()->upload($request->doc, 'documents/uploads/');

        VesselDocs::create([
            //this is quotation id
            'vessel_id' => $request->vessel_id,
            'name'=>$request->name,
            'doc_path' => $path_file]);

        return redirect()->back();
    }
}
