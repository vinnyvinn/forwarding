<?php

namespace App\Http\Controllers;

use App\Lead;
use App\Quotation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('dashboard.dashboard')
            ->withQuotations(Quotation::simplePaginate(25));
    }
}
