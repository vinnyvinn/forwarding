<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 1/31/18
 * Time: 12:48 PM
 */

namespace Esl\Repository;

use App\BillOfLanding;
use App\Customer;
use App\Lead;
use App\Supplier;
use App\Vessel;
use Illuminate\Support\Facades\DB;

class CustomersRepo
{
    public static function customerInit()
    {
        return new self();
    }

    public function searchCustomers($searchItem, $table)
    {
        if ($table == 'Client'){
            $result = Customer::where('Name','like','%'.$searchItem.'%')
                ->orWhere('Contact_Person','like','%'.$searchItem.'%')
                ->get(['DCLink','Name','Account','Contact_Person','Telephone']);
            return $result;
        }

        elseif($table == 'Vendor'){
            $result = Supplier::where('Name','like','%'.$searchItem.'%')
                ->where('On_Hold', 0)
                ->orWhere('Contact_Person','like','%'.$searchItem.'%')
                ->get(['DCLink','Name','Account','Tax_Number','iCurrencyID','On_Hold','Contact_Person','Telephone']);
            return $result;
        }
        elseif ($table == 'leads'){
            $result = Lead::where('name','like','%'.$searchItem.'%')
                ->orWhere('contact_person','like','%'.$searchItem.'%')
                ->orWhere('phone','like','%'.$searchItem.'%')
                ->orWhere('email','like','%'.$searchItem.'%')
                ->orWhere('address','like','%'.$searchItem.'%')
                ->orWhere('location','like','%'.$searchItem.'%')
                ->get();
            return $result;
        }

        elseif ($table == 'dms'){

            return BillOfLanding::where('bl_number', 'like','%'.$searchItem.'%')
                ->get()->toArray();
        }
    }

    public function getCustomerCurrency($DCLink)
    {
        return (Customer::where('DCLink', $DCLink)->get()->first()->iCurrencyID) == 1 ? 'USD' : 'KSHS';
    }

    public function getCustomerVessels($customer_id)
    {
        return Vessel::where('lead_id', $customer_id)->get();
    }

    public function convertLeadToCustomer($data)
    {
        $data['Name'] = $data['name'];
        $data['Contact_Person'] = $data['contact_person'];
        $data['Telephone'] = $data['telephone'];
        $data['Physical1'] = $data['address'];
        $data['Physical2'] = $data['location'];
        $data['Email'] = $data['email'];


        $data['iCurrencyID'] = $data['currency'] == 1;
        $data['iAgeingTermID'] = 1;
        $data['bForCurAcc'] = $data['currency'] == 1;
        $data['AccountTerms'] = 1;

        unset($data['name'], $data['telephone'],$data['address'],$data['location'],
            $data['email'], $data['phone'],$data['contact_person'] );

       return Customer::create($data);
    }
}