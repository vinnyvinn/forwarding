<?php

namespace App\Http\Controllers;

use App\BtbLine;
use App\InvNum;
use App\PurchaseOrder;
use App\PurchaseOrderLine;
use App\Quotation;
use App\QuotationService;
use App\ServiceTax;
use App\StkItem;
use App\Supplier;
use Carbon\Carbon;
use Esl\helpers\Constants;
use Esl\Repository\CurrencyRepo;
use Esl\Repository\CustomersRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PurchaseOrderController extends Controller
{
    public function generatePo($quotation_id)
    {
        $year_now = new Carbon(Carbon::now());
        $po_count = PurchaseOrder::whereYear('created_at',$year_now->year)->count() +1;
        $quotation = Quotation::with(['services'])->find($quotation_id);

        $getSageItems = StkItem::where('ServiceItem',1)->get()->sortBy('Description_2');

        $getQuotationItems = [];

        foreach ($quotation->services as $service){
            if (!in_array($service->stock_link, $getQuotationItems)){
                array_push($getQuotationItems,$service->stock_link);
            }
        }
//        $getQuotationItems = StkItem::whereIn('StockLink', $getStkItemToExclude)->get();

        return view('po.generate-po')
            ->withPoNumber($po_count)
            ->withSservices($getSageItems)
            ->withQuotation($quotation)
            ->withQitem($getQuotationItems)
            ->withTaxs(ServiceTax::all()->sortBy('Description'))
            ->withExrate(CurrencyRepo::init()->exchangeRate());
    }

    public function searchSupplier(Request $request)
    {
        $search_result = CustomersRepo::customerInit()
            ->searchCustomers($request->search_item, 'Vendor');

        $output = "<ul>";
        foreach ($search_result as $item){

            $output .= '<li style="list-style-type:none;" 
            onclick="fillData('.$item->DCLink.')">'. ucwords($item->Name). ' | <b>Account Type</b> : ' . ($item->iCurrencyID == 1 ? 'USD' : 'KES') .
                '  <span><button class="btn btn-xs btn-primary"><i class="fa fa-check"></i></button></span></li>';
        }
        $output."</ul>";

        return Response(['output' => $output]);
    }

    public function showPurchaseOrder($purchase_order_id)
    {
        $purchaseOrder = PurchaseOrder::find($purchase_order_id);

        return view('po.preview')
            ->withPo($purchaseOrder);
    }

    public function getVendor($id)
    {
        return Response(['vendor'=>Supplier::findOrFail($id)]);
    }

    public function addPurchaseOrder(Request $request)
    {
        $now = Carbon::now();

        $purchaseOrder = PurchaseOrder::create([
            'user_id' => Auth::id(),
            'quotation_id' => $request->po_detail['quotation_id'],
            'project_id' => $request->po_detail['project_id'],
            'supplier_id' => $request->po_detail['supplier_id'],
            'input_currency' => $request->inputCur,
            'status' => Constants::PO_REQUEST,
            'po_date' => Carbon::parse($request->po_detail['po_date']),
            'po_no' => $request->po_detail['po_no'].'/'. $now->format('y')
        ]);

        $poLines = [];

        foreach ($request->polines as $poline){

            array_push($poLines, [
                'purchase_order_id' => $purchaseOrder->id,
                'description' => $poline['description'],
                'qty'  => $poline['qty'],
                'rate' => (float) $poline['rate'],
                'total_amount' => (float) $poline['total'],
                'created_at' => $now,
                'updated_at' => $now,
                'tax_code' => $poline['tax_code'],
                'stock_link' => $poline['stock_link'],
                'tax_description' => $poline['tax_description'],
                'tax_id' => $poline['tax_id'],
                'tax' => (float)$poline['tax']
            ]);
        }

        PurchaseOrderLine::insert($poLines);

        Mail::to(['email'=>'washington.mwamburi@freightwell.com'])
            ->cc(Constants::EMAILS_CC)
            ->send(new \App\Mail\PurchaseOrder(['message'=>'Purchase Order '.$purchaseOrder->po_no.
                ' has been created by '. ucwords(Auth::user()->name) .
                ' on '.Carbon::now()->format('d-M-y H:m').
                '. Kindly prepare view and act accordingly ','po_number' => $purchaseOrder->po_no,'po_id' => $purchaseOrder->id],
                'Purchase Order '. strtoupper($purchaseOrder->po_no) . ' created'));

        alert()->success('Purchase Order generated successfully','Success');

        return response(['dms' => $purchaseOrder->quotation->dms->id]);
    }

    public function makeInvoice($po)
    {
        $lines = $po->polines;
//
        $invumID = InvNum::insertGetId(
            [
                //dclink
                'AccountID' => $po->supplier->DCLink,
                'Address1' =>  mb_strimwidth( $po->supplier->Physical1, 0,35),
                'Address2' =>  mb_strimwidth($po->supplier->Physical2, 0, 35),
                'Address3' =>  mb_strimwidth($po->supplier->Physical3,0,35),
                'Address4' =>  mb_strimwidth($po->supplier->Physical3, 0,35),
                'Address5' =>  mb_strimwidth($po->supplier->Physical4, 0,35),
                //extra fields
                'ucIDInvBLNo' => mb_strimwidth($po->quotation->dms->bl_number,0,16),
                'ucIDInvVoyageNo' => null,
                'ucIDInvVessel' => null,
                'ucIDInvQty' => $po->quotation->dms->cargo_weight, //tonnes measurementv
                'ucIDInvConsignee' => mb_strimwidth($po->quotation->cargo->consignee_name, 0,16),
                'ucIDInvClientRef' => mb_strimwidth($po->quotation->dms->ctm_ref,0,16),
                //end
                'Address6' =>  mb_strimwidth($po->supplier->Physical5,0,35),
//            'DelMethodID',
                'DeliveryDate' => Carbon::now(),
//            'DeliveryNote',
                'Description' => 'Purchase Order ' , //po
                'DocFlag' => 0,
                'DocRepID' => 0,
                'DocState' => 1,
                'DocType' => 5, //5
                'DocVersion' => 1,
                'DueDate' => Carbon::now(),
//            'Email_Sent',
//            'ExtOrderNum',
                //from client TODO:client iccurency id
                'ForeignCurrencyID' => $po->supplier->iCurrencyID == 1 ? 1 : 0,
//            'GrvSplitFixedAmnt',
//            'GrvSplitFixedCost',
                'InvDate' => Carbon::now(),
//            'InvDisc',
//            'InvDiscAmnt',
//            'InvDiscAmntEx',
//            'InvDiscReasonID',
//            'InvNum_Checksum',
//            'InvNum_dCreatedDate',
//            'InvNum_dModifiedDate',
//            'InvNum_iBranchID',
//            'InvNum_iChangeSetID',
//            'InvNum_iCreatedAgentID',
//            'InvNum_iCreatedBranchID',
//            'InvNum_iModifiedAgentID',
//            'InvNum_iModifiedBranchID',
                'InvNumber' => 'LPO', //
                //total invoice line
                'InvTotExcl' => ( float) round($po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'),2), //KES
                'InvTotExclDEx' => ( float) round($po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'),2),
                'InvTotIncl' => ( float) round($po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'),2),
                'InvTotInclDEx' => ( float) round($po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'),2),
                'InvTotInclExRounding' => ( float) round($po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'),2),
//            'InvTotRounding',
                'InvTotTax' => 0,
                'InvTotTaxDEx' => 0,
//            'KeepAsideCollectionDate',
//            'KeepAsideExpiryDate',
//            'Message1',
//            'Message2',
//            'Message3',
//            'OrdDiscAmnt',
//            'OrdDiscAmntEx',
                'OrdTotExcl' => ( float) round($po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'),2),
                'OrdTotExclDEx' => ( float) round($po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'),2),
                'OrdTotIncl' => ( float) round($po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'),2),
                'OrdTotInclDEx' => ( float) round($po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'),2),
                'OrdTotInclExRounding' => ( float) round($po->supplier->iCurrencyID == 1 ? ($lines->sum('total_amount') * CurrencyRepo::init()->exchangeRate()) : $lines->sum('total_amount'),2),
//            'OrdTotRounding',
                'OrdTotTax' => 0,
                'OrdTotTaxDEx' => 0,
                'OrderDate' => Carbon::now(),
//            'OrderNum',
//            'OrderPriorityID',
//            'OrderStatusID',
                'OrigDocID' => 0,
                'PAddress1' => mb_strimwidth($po->supplier->Physical1,0,35),
                'PAddress2' => mb_strimwidth($po->supplier->Physical2,0,35),
                'PAddress3' => mb_strimwidth($po->supplier->Physical3,0,35),
                'PAddress4' => mb_strimwidth($po->supplier->Physical4,0,35),
                'PAddress5' => mb_strimwidth($po->supplier->Physical5,0,35),
                'PAddress6' => mb_strimwidth($po->supplier->Physical5,0,35),
//            'POSAmntTendered',
//            'POSChange',
                'ProjectID' => $po->quotation->project_int, //UPDATE PROJECT ID
                'TaxInclusive' => 0,
//            'TillID',
                'bInvRounding' => 1,
//            'bIsDCOrder',
//            'bLinkedTemplate',
                'bTaxPerLine' => 1,
//            'bUseFixedPrices',
                'cAccountName' => 'test', //VENDOR NAME
//            'cAuthorisedBy',
//            'cCellular',
//            'cClaimNumber',
//            'cContact',
//            'cEmail',
//            'cExcessAccCont1',
//            'cExcessAccCont2',
//            'cExcessAccName',
//            'cFax',
//            'cGIVNumber',
//            'cPolicyNumber',
//            'cSettlementTermInvMsg',
//            client pin number
//            'cTaxNumber',
//            'cTelephone',
//            'dIncidentDate',
//            'fAddChargeExclusive',
//            'fAddChargeExclusiveForeign',
//            'fAddChargeInclusive',
//            'fAddChargeInclusiveForeign',
//            'fAddChargeTax',
//            'fAddChargeTaxForeign',
//            'fDepositAmountForeign',
//            'fDepositAmountNew',
//            'fDepositAmountTotal',
//            'fDepositAmountTotalForeign',
//            'fDepositAmountUnallocated',
//            'fDepositAmountUnallocatedForeign',
//            'fExcessAmt',
//            'fExcessExclusive',
//            'fExcessInclusive',
//            'fExcessPct',
//            'fExcessTax',
                'fExchangeRate' => ( float) round(CurrencyRepo::init()->exchangeRate(),2),
//            'fGrvSplitFixedAmntForeign',
//            'fInvDiscAmntExForeign',
//            'fInvDiscAmntForeign',
                'fInvTotExclDExForeign' => ( float) round($po->supplier->iCurrencyID == 1 ? $lines->sum('total_amount') : null,2),
                'fInvTotExclForeign' => ( float) round($po->supplier->iCurrencyID == 1 ? $lines->sum('total_amount') : null,2),
//            'fInvTotForeignRounding',
                'fInvTotInclDExForeign' => ( float) round($po->supplier->iCurrencyID == 1 ? $lines->sum('total_amount') : null,2),
                'fInvTotInclForeign' => ( float) round($po->supplier->iCurrencyID == 1 ? $lines->sum('total_amount') : null,2),
//            'fInvTotInclForeignExRounding',
                'fInvTotTaxDExForeign' => 0,
                'fInvTotTaxForeign' => 0,
//            'fOrdAddChargeExclusive',
//            'fOrdAddChargeExclusiveForeign',
//            'fOrdAddChargeInclusive',
//            'fOrdAddChargeInclusiveForeign',
//            'fOrdAddChargeTax',
//            'fOrdAddChargeTaxForeign',
//            'fOrdDiscAmntExForeign',
//            'fOrdDiscAmntForeign',
                'fOrdTotExclDExForeign' =>  ( float) round($po->supplier->iCurrencyID == 1 ? $lines->sum('total_amount') : null,2),
                'fOrdTotExclForeign' =>  ( float) round($po->supplier->iCurrencyID == 1 ? $lines->sum('total_amount') : null,2),
//            'fOrdTotForeignRounding',
                'fOrdTotInclDExForeign' =>  ( float) round($po->supplier->iCurrencyID == 1 ? $lines->sum('total_amount') : null,2),
                'fOrdTotInclForeign' =>  ( float) round($po->supplier->iCurrencyID == 1 ? $lines->sum('total_amount') : null,2),
//            'fOrdTotInclForeignExRounding',
                'fOrdTotTaxDExForeign' => 0,
                'fOrdTotTaxForeign' => 0,
//            'fRefundAmount',
//            'fRefundAmountForeign',
//            'iDCBranchID',
//            'iDocEmailed',
//            'iDocPrinted',
//            'iEUNoTCID',
                'iINVNUMAgentID' => 1,
//            'iInsuranceState',
//            'iInvSettlementTermsID',
//            'iInvoiceSplitDocID',
//            'iLinkedDocID',
//            'iMergedDocID',
//            'iOpportunityID',
//            'iOrderCancelReasonID',
//            'iPOAuthStatus',
//            'iPOIncidentID',
//            'iProspectID',
//            'iSalesBranchID',
//            'iSupervisorID',
//            'imgOrderSignature'
            ]
        );

        self::makeInvoiceLines($lines = $po->polines, $invumID, $po);

        return $invumID;
    }

    public function approvePurchaseOrder($purchase_order_id)
    {
        $po = PurchaseOrder::find($purchase_order_id);
        $invnum_id = $this->makeInvoice($po);
        $po->invnum_id = $invnum_id;
        $po->status = Constants::PO_APPROVED;
        $po->approved_by = Auth::id();
        $po->save();

        $getStkItems = [];

        foreach ($po->quotation->services as $service){
            if (!in_array($service->stock_link, $getStkItems)){
                array_push($getStkItems,$service->stock_link);
            }
        }

        foreach ($po->polines as $poline){
            if (in_array($poline->stock_link,$getStkItems)){
                $poline->in_quotation = true;
                $poline->save();

                $qservice = QuotationService::where('stock_link',$poline->stock_link)->get();

                if (count($qservice) > 0){
                    $qservice = $qservice->first();
                    $qservice->buying_price = $qservice->buying_price + $poline->total_amount;
                    $qservice->save();
                }

            }
        }

        Mail::to(['email'=>'accounts@esl-eastafrica.com'])
            ->cc(Constants::EMAILS_CC)
            ->send(new \App\Mail\PurchaseOrder(['message'=>'Purchase Order '.$po->po_no.
        ' has been approved by '. ucwords(Auth::user()->name) .
                ' on '.Carbon::now()->format('d-M-y H:m').
                '. Kindly prepare in advance ','po_number' => $po->po_no,'po_id' => $po->id],
                'FREIGHTWELL Purchase Order '. strtoupper($po->po_no) . ' APPROVED'));

        alert()->success('Approved','Approved Successfully');

        return back();
    }

    public function disapprovePurchaseOrder($purchase_order_id)
    {
        $po = PurchaseOrder::find($purchase_order_id);
        $po->status = Constants::PO_DISAPPROVED;
        $po->approved_by = Auth::id();
        $po->save();

        alert()->success('Disapproved','Disapproved Successfully');

        return back();
    }

    private function makeInvoiceLines($lines, $invumid, $po)
    {

        $btblines = [];

        foreach ($lines as $line){

            array_push($btblines,[
//            '_btblInvoiceLines_Checksum',
//            '_btblInvoiceLines_dCreatedDate',
//            '_btblInvoiceLines_dModifiedDate',
//            '_btblInvoiceLines_iBranchID',
//            '_btblInvoiceLines_iChangeSetID',
//            '_btblInvoiceLines_iCreatedAgentID',
//            '_btblInvoiceLines_iCreatedBranchID',
//            '_btblInvoiceLines_iModifiedAgentID',
//            '_btblInvoiceLines_iModifiedBranchID',
                'bChargeCom' => 1,
//            'bIsLotItem',
//            'bIsSerialItem',
//            'bIsWhseItem',
//            'bPromotionApplied',
                'cDescription' => $line->description,
//            'cLineNotes',
//            'cLotNumber',
//            'cPromotionCode',
//            'cTradeinItem',
                'dDeliveryDate' => $line->created_at,
//            'dLotExpiryDate',
//            'fAddCost',
//            'fAddCostForeign',
//            'fHeight',
//            'fLength',
//            'fLineDiscount',
//            'fPromotionPriceExcl',
//            'fPromotionPriceIncl',
//            'fQtyChange',
//            'fQtyChangeLineTaxAmount',
//            'fQtyChangeLineTaxAmountForeign',
//            'fQtyChangeLineTaxAmountNoDisc',
//            'fQtyChangeLineTaxAmountNoDiscForeign',
//            'fQtyChangeLineTotExcl',
//            'fQtyChangeLineTotExclForeign',
//            'fQtyChangeLineTotExclNoDisc',
//            'fQtyChangeLineTotExclNoDiscForeign',
//            'fQtyChangeLineTotIncl',
//            'fQtyChangeLineTotInclForeign',
//            'fQtyChangeLineTotInclNoDisc',
//            'fQtyChangeLineTotInclNoDiscForeign',
//            'fQtyChangeUR',
                'fQtyDeliver'=>$line->qty,
                'fQtyDeliverUR'=>$line->qty,
                'fQtyForDelivery' => $line->qty,
                'fQtyForDeliveryUR' => $line->qty,
                //qty
                'fQtyLastProcess' => 0,
                'fQtyLastProcessLineTaxAmount' => 0,
                'fQtyLastProcessLineTaxAmountForeign'=>0,
                'fQtyLastProcessLineTaxAmountNoDisc' => 0,
                'fQtyLastProcessLineTaxAmountNoDiscForeign'=>0,
                'fQtyLastProcessLineTotExcl' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyLastProcessLineTotExclForeign' =>$po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyLastProcessLineTotExclNoDisc' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyLastProcessLineTotExclNoDiscForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyLastProcessLineTotIncl' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyLastProcessLineTotInclForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyLastProcessLineTotInclNoDisc' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyLastProcessLineTotInclNoDiscForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyLastProcessUR' => $line->qty,
                'fQtyLinkedUsed' => $line->qty,
                'fQtyLinkedUsedUR' => $line->qty,
                //qty
                'fQtyProcessed' => 0,
                'fQtyProcessedLineTaxAmount' => 0,
                'fQtyProcessedLineTaxAmountForeign' => 0,
                'fQtyProcessedLineTaxAmountNoDisc' => 0,
                'fQtyProcessedLineTaxAmountNoDiscForeign' => 0,
                'fQtyProcessedLineTotExcl' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyProcessedLineTotExclForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyProcessedLineTotExclNoDisc' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyProcessedLineTotExclNoDiscForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyProcessedLineTotIncl' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyProcessedLineTotInclForeign' =>$po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount ,
                'fQtyProcessedLineTotInclNoDisc' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyProcessedLineTotInclNoDiscForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyProcessedUR' => $line->qty,
//            'fQtyReserved',
//            'fQtyReservedChange',
//            'fQtyReservedChangeUR',
//            'fQtyReservedUR',
//            'fQtyToProcess',
                'fQtyToProcessLineTaxAmount' =>0,
                'fQtyToProcessLineTaxAmountForeign' => 0,
                'fQtyToProcessLineTaxAmountNoDisc' => 0,
                'fQtyToProcessLineTaxAmountNoDiscForeign' => 0,
                'fQtyToProcessLineTotExcl' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyToProcessLineTotExclForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyToProcessLineTotExclNoDisc' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyToProcessLineTotExclNoDiscForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyToProcessLineTotIncl' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyToProcessLineTotInclForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyToProcessLineTotInclNoDisc' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyToProcessLineTotInclNoDiscForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQtyToProcessUR' => $line->qty,
                //quantity
                'fQuantity' => $line->qty,
                'fQuantityLineTaxAmount' => 0,
                'fQuantityLineTaxAmountForeign' => 0,
                'fQuantityLineTaxAmountNoDisc' => 0,
                'fQuantityLineTaxAmountNoDiscForeign' => 0,
                'fQuantityLineTotExcl' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQuantityLineTotExclForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQuantityLineTotExclNoDisc' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQuantityLineTotExclNoDiscForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQuantityLineTotIncl' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQuantityLineTotInclForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQuantityLineTotInclNoDisc' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQuantityLineTotInclNoDiscForeign' => $po->supplier->iCurrencyID == 1 ? ($line->total_amount * CurrencyRepo::init()->exchangeRate()) : $line->total_amount,
                'fQuantityUR' => $line->qty,
                'fTaxRate' => 0,
                'fUnitCost' =>$po->supplier->iCurrencyID == 1 ? ($line->rate * CurrencyRepo::init()->exchangeRate()) : $line->rate,
                'fUnitCostForeign' => $po->supplier->iCurrencyID == 1 ? $line->rate : 0,
                //price single
                'fUnitPriceExcl' => $po->supplier->iCurrencyID == 1 ? ($line->rate * CurrencyRepo::init()->exchangeRate()) : $line->rate,
                'fUnitPriceExclForeign' => $po->supplier->iCurrencyID == 1 ? $line->rate : 0,
//            'fUnitPriceExclForeignOrig',
//            'fUnitPriceExclOrig',
                'fUnitPriceIncl' => $po->supplier->iCurrencyID == 1 ? ($line->rate * CurrencyRepo::init()->exchangeRate()) : $line->rate,
                'fUnitPriceInclForeign' => $po->supplier->iCurrencyID == 1 ? $line->rate : 0,
//            'fUnitPriceInclForeignOrig',
//            'fUnitPriceInclOrig',
//            'fWidth',
//            'iDeliveryMethodID',
//            'iDeliveryStatus',
//            'iGrvLineID',
                'iInvoiceID' => $invumid,
//            'iJobID',
//            'iLedgerAccountID',
//            'iLineDiscountReasonID',
//            'iLineDocketMode',
                'iLineID' => 1,
                'iLineProjectID' => null,
                'iLineRepID' => null,
//            'iLinkedLineID',
//            'iLotID',
//            'iMFPID',
                'iModule' => 0,
//            'iOrigLineID',
//            'iPieces',
//            'iPiecesDeliver',
//            'iPiecesForDelivery',
//            'iPiecesLastProcess',
//            'iPiecesLinkedUsed',
//            'iPiecesProcessed',
//            'iPiecesReserved',
//            'iPiecesToProcess',
//            'iPriceListNameID' => ,
//            'iReturnReasonID',
//            'iSOLinkedPOLineID',
//            'iSalesWhseID',
                //item id9
                'iStockCodeID' => $line->stock_link,
                'iTaxTypeID' => $line->tax_id,
//            'iUnitPriceOverrideReasonID',
//            'iUnitsOfMeasureCategoryID',
//            'iUnitsOfMeasureID',
//            'iUnitsOfMeasureStockingID',
//            'iWarehouseID',
            ]);

        }


        BtbLine::insert($btblines);

        return true;
    }
}
