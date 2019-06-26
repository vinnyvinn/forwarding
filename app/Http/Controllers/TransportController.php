<?php

namespace App\Http\Controllers;

use App\BillOfLanding;
use App\Lead;
use App\Quotation;
use App\Transport;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    public function index()
    {
        return view('transport.dashboard.dashboard')
            ->withQuotations([]);
    }

    public function transport()
    {
        $quotation = Quotation::with(['customer','user'])->get();

        return view('transport.transport.index')
            ->withQuotations($quotation);
    }

    public function addTransport($id)
    {
        $dms = BillOfLanding::with(['quote.services','contracts','contracts.slubs','remarks',
            'quote.docs','customer'])->findOrFail($id);

        return view('transport.transport.add-transport')
            ->withTransport($dms);
    }

    public function storeTransport(Request $request)
    {
        $data = $request->all();
        $data['depart'] = Carbon::parse($request->depart);

        Transport::create($data);

        return redirect('/dms/edit/'.$request->bill_of_landing_id);

    }
}
