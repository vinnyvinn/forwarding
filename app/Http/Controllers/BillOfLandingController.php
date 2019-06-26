<?php

namespace App\Http\Controllers;

use App\BillOfLanding;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class BillOfLandingController extends Controller
{
    public function index()
    {
        return view('blading.index');
    }

    public function edit($id)
    {
        $bl = BillOfLanding::with(['vessel','quote.services','customer','cargo'])->findOrFail($id);


    }

    public function test()
    {
        $pdf = PDF::loadView('home');
        return $pdf->download('invoice.pdf');
//        return view('home');
    }
}
