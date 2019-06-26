<?php

namespace App\Http\Controllers;

use App\Cargo;
use App\Customer;
use App\Quotation;
use App\Vessel;
use App\Voyage;
use Carbon\Carbon;
use Esl\helpers\Constants;
use Esl\Repository\CustomersRepo;
use Esl\Repository\demoCd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customers.index')
            ->withCustomers(Customer::get());
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
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }

    public function ajaxSearch(Request $request)
    {
        $search_result = CustomersRepo::customerInit()
            ->searchCustomers($request->search_item, 'Client');

        $output = "";
        foreach ($search_result as $item){

            $output .= '<tr>'.
                '<td>'. ucwords($item->Name).'</td>'.
                '<td>'.ucfirst($item->Contact_Person).'</td>'.
                '<td>'.$item->Account.'</td>'.
                '<td>'.$item->Telephone.'</td>'.
                '</tr>';
        }

        return Response(['output' => $output]);
    }

    public function searchCustomer(Request $request)
    {
        $search_result = CustomersRepo::customerInit()
            ->searchCustomers($request->search_item, 'Client');

        $output = "<ul>";
        foreach ($search_result as $item){

            $output .= '<li style="list-style-type:none;" 
            onclick="fillData('.$item->DCLink.')">'. ucwords($item->Name). '  <span><button class="btn btn-xs btn-primary"><i class="fa fa-check"></i></button></span></li>';
        }
        $output."</ul>";

        return Response(['output' => $output]);
    }

    public function getCustomer($id)
    {
        return Response(['customer'=>Customer::findOrFail($id)]);
    }

    public function vesselDetails(Request $request)
    {
        $vessels = Vessel::where('name', $request->name)
            ->where('lead_id', $request->lead_id)->get();
        if (!$vessels->isEmpty()){
            $vessel = $vessels->last();
            $vessel->update($request->all());
            return Response(['success' => ['vessel_name' => $vessel->name,
                'grt' => ($vessel->grt + $vessel->consignee_good), 'loa' => $vessel->loa,
                'port' => $vessel->port_of_loading]]);
        }

        $vessel = Vessel::create($request->all());

        $quote = Quotation::create(['user_id'=>Auth::user()->id,'discharge_rate' => $request->discharge_rate, 'lead_id' => $request->lead_id, 'vessel_id' => $vessel->id,
            'status' => Constants::LEAD_QUOTATION_PENDING]);

        return Response(['success' => ['redirect' => url('/quotation/'.$quote->id)]]);
    }

    public function cargoDetails(Request $request)
    {
        $data = $request->all();
        $data['manifest_number'] = count(Cargo::all()).'/'.Date('Y');
        $data['seal_no'] = count(Cargo::all()).'/'.Date('Y');
        Cargo::create($data);

        return Response(['success' => ['url' => url('/')]]);
    }

    public function voyageDetails(Request $request)
    {
        $data = $request->all();
        $data['eta'] = Carbon::parse($request->eta);
        $data['vessel_arrived'] = Carbon::parse($request->vessel_arrived);
        Voyage::create($data);

        return Response(['success' => ['redirect' => url('/quotation/'.$request->quotation_id)]]);
    }

    public function updateCargoDetails(Request $request)
    {
        Cargo::findOrFail($request->cargo_id)->update($request->all());
        return Response(['success' => ['url' => url('/')]]);
    }

    public function deleteCargo(Request $request)
    {
        Cargo::findOrFail($request->item_id)->delete();
        return Response(['success' => ['url' => url('/')]]);
    }
}
