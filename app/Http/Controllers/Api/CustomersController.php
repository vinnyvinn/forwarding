<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Lead;
use App\Vessel;
use Esl\helpers\Constants;
use Esl\Repository\CustomersRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomersController extends Controller
{
    public function searchCustomer(Request $request)
    {
        return response()->json(['customer_search' =>
            CustomersRepo::customerInit()
                ->searchCustomers($request->customer_search, 'Client')], Constants::STATUS_OK);
    }

    public function getVesselDetails(Request $request)
    {
        CustomersRepo::customerInit()->getCustomerVessels($request->customer_id);
    }

    public function addLead(Request $request)
    {
        Lead::create($request->all());
        return response()->json(['success'=>'Lead created successfully'], Constants::STATUS_OK);
    }

    public function getAllLeads()
    {
        return response()->json(['all_leads' => Lead::all()->toArray()],Constants::STATUS_OK);
    }

    public function getSingleLead($id)
    {
        return response()->json(['single_lead' => Lead::findOrFail($id)->toArray()],Constants::STATUS_OK);
    }

    public function getCustomers()
    {
        return response()->json(['customers' => Customer::all(['DCLink','Account',
            'Name','Contact_Person','Physical1','Telephone','EMail'])->toArray()],Constants::STATUS_OK);
    }

    public function getAllVessels()
    {
        return response()->json(['all_vessels' => Vessel::with(['lead'])->get()->toArray()],Constants::STATUS_OK);
    }

    public function getVesselDetail($id)
    {
        return response()->json(['single_vessel' => Vessel::findOrFail($id)->toArray()],Constants::STATUS_OK);
    }

    public function searchDms(Request $request)
    {
        return response()->json(['dms_search' =>
            CustomersRepo::customerInit()
                ->searchCustomers($request->dms, 'dms')], Constants::STATUS_OK);
    }
}
