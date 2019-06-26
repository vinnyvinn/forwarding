<?php

namespace App\Http\Controllers;

use App\GoodType;
use App\Lead;
use App\ServiceTax;
use App\TransportService;
use Esl\helpers\Constants;
use Esl\Repository\CurrencyRepo;
use Esl\Repository\CustomersRepo;
use Illuminate\Http\Request;

class CustomerRequestController extends Controller
{
    public function generateQuotation($quotation_type = 'import')
    {
        $services = TransportService::all();
        return view('transport.quotation.generate')
            ->withServices($services)
            ->withExrate(CurrencyRepo::init()->exchangeRate())
            ->withTaxs(ServiceTax::all()->sortBy('Description'))
            ->withType($quotation_type);

    }

    public function searchCustomer(Request $request)
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


}
