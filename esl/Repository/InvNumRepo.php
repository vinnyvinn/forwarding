<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 3/22/18
 * Time: 11:17 AM
 */

namespace Esl\Repository;


use App\BtbLine;
use App\InvNum;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Esl\helpers\Constants;
use Illuminate\Support\Facades\Auth;

class InvNumRepo
{
    public static function init()
    {
        return new self;
    }


    public function makeInvoice($invoiceData)
    {
 //dd($invoiceData);
        $invumID = InvNum::insertGetId(
            [
                //dclink
                'AccountID' => $invoiceData->customer->DCLink,
                'Address1' => $invoiceData->customer->Physical1,
                'Address2' => $invoiceData->customer->Physical2,
                'Address3' => $invoiceData->customer->Physical3,
                'Address4' => $invoiceData->customer->Physical3,
                'Address5' => $invoiceData->customer->Physical4,
                //extra fields
                'ucIDInvBLNo' => $invoiceData->cargo->bl_no,
                'ucIDInvVoyageNo' => $invoiceData->cargo->bl_no,
                'ucIDInvVessel'=> $invoiceData->cargo->vessel_name,
                'ucIDInvQty'=> $invoiceData->cargo->cargo_qty, //tonnes measurementv
                'ucIDInvConsignee'=> $invoiceData->cargo->consignee_name,
                'ucIDInvClientRef'=> $invoiceData->ctm_ref,
                'ucIDInvCheckedBy'=> $invoiceData->checkedBy->name,
                //end
                'Address6' => $invoiceData->customer->Physical5,
//            'DelMethodID',
                'DeliveryDate' => Carbon::now(),
//            'DeliveryNote',
                'Description' => 'Invoice ' , //po
                'DocFlag' => 0,
                'DocRepID' => 0,
                'DocState' => 1,
                'DocType' => 0, //5
                'DocVersion' => 1,
                'DueDate' => Carbon::now(),
//            'Email_Sent',
//            'ExtOrderNum',
                //from client TODO:client iccurency id
            'ForeignCurrencyID' => $invoiceData->customer->iCurrencyID == 1 ? 1 : 0,
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
                'InvNumber' => 'INV00'.(count(InvNum::all())+1), //LPO00
                //total invoice line
                'InvTotExcl' => $invoiceData->services->sum('total'), //KES
                'InvTotExclDEx' => $invoiceData->services->sum('total'),
                'InvTotIncl' => 0,
                'InvTotInclDEx' => ($invoiceData->services->sum('total') + 0),
                'InvTotInclExRounding' => $invoiceData->services->sum('total'),
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
                'OrdTotExcl' => $invoiceData->services->sum('total'),
                'OrdTotExclDEx' => $invoiceData->services->sum('total'),
                'OrdTotIncl' => ($invoiceData->services->sum('total') + 0),
                'OrdTotInclDEx' => ($invoiceData->services->sum('total') + 0),
                'OrdTotInclExRounding' => $invoiceData->services->sum('total'),
//            'OrdTotRounding',
                'OrdTotTax' => 0,
                'OrdTotTaxDEx' => 0,
                'OrderDate' => Carbon::now(),
//            'OrderNum',
//            'OrderPriorityID',
//            'OrderStatusID',
                'OrigDocID' => 0,
                'PAddress1' => $invoiceData->customer->Physical1,
                'PAddress2' => $invoiceData->customer->Physical2,
                'PAddress3' => $invoiceData->customer->Physical3,
                'PAddress4' => $invoiceData->customer->Physical4,
                'PAddress5' => $invoiceData->customer->Physical5,
                'PAddress6' => $invoiceData->customer->Physical5,
//            'POSAmntTendered',
//            'POSChange',
                'ProjectID' =>  $invoiceData->project_int, //UPDATE PROJECT ID
                'TaxInclusive' => 0,
//            'TillID',
                'bInvRounding' => 1,
//            'bIsDCOrder',
//            'bLinkedTemplate',
                'bTaxPerLine' => 1,
//            'bUseFixedPrices',
                'cAccountName' => $invoiceData->customer->Name, //VENDOR NAME
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
                'fExchangeRate' => CurrencyRepo::init()->exchangeRate(),
//            'fGrvSplitFixedAmntForeign',
//            'fInvDiscAmntExForeign',
//            'fInvDiscAmntForeign',
                'fInvTotExclDExForeign' => $invoiceData->services->sum('total'),
                'fInvTotExclForeign' => $invoiceData->services->sum('total'),
//            'fInvTotForeignRounding',
                'fInvTotInclDExForeign' => ($invoiceData->services->sum('total') + 0),
                'fInvTotInclForeign' => $invoiceData->services->sum('total') + 0,
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
                'fOrdTotExclDExForeign' => $invoiceData->services->sum('total'),
                'fOrdTotExclForeign' => $invoiceData->services->sum('total'),
//            'fOrdTotForeignRounding',
                'fOrdTotInclDExForeign' => $invoiceData->services->sum('total') + 0,
                'fOrdTotInclForeign' => $invoiceData->services->sum('total') + 0,
//            'fOrdTotInclForeignExRounding',
                'fOrdTotTaxDExForeign' => 0,
                'fOrdTotTaxForeign' => 0,
//            'fRefundAmount',
//            'fRefundAmountForeign',
//            'iDCBranchID',
//            'iDocEmailed',
//            'iDocPrinted',
//            'iEUNoTCID',
              'iINVNUMAgentID' => 1
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
            $invoicenum = 'INV00'.(count(InvNum::all())+1);
            

        self::makeInvoiceLines($invoiceData->services, $invumID);

        Mail::to(['email'=>'accounts@esl-eastafrica.com'])
            ->cc(Constants::EMAILS_CC)
            ->send(new \App\Mail\Invoice(['message'=>'Invoice number '.$invoicenum.
        ' has been created by ', ucwords(Auth::user()->name)], .'for Project Number' .$invoiceData->project_int .
                ' on '.Carbon::now()->format('d-M-y H:m').
                'FREIGHTWELL Invoice '.$invoicenum . ' Created'));

        alert()->success('Created','Created Successfully');

        return true;
    }

    private function makeInvoiceLines($services, $invumid)
    {

        foreach ($services as $service){

            BtbLine::insertGetId([
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
                'cDescription' => $service->name,
//            'cLineNotes',
//            'cLotNumber',
//            'cPromotionCode',
//            'cTradeinItem',
                'dDeliveryDate' => Carbon::now(),
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
                'fQtyDeliver'=>$service->total_units,
                'fQtyDeliverUR'=>$service->total_units,
                'fQtyForDelivery' => $service->total_units,
                'fQtyForDeliveryUR' => $service->total_units,
                //qty
                'fQtyLastProcess' => $service->total_units,
                'fQtyLastProcessLineTaxAmount' => 0,
                'fQtyLastProcessLineTaxAmountForeign'=>0,
                'fQtyLastProcessLineTaxAmountNoDisc' => 0,
                'fQtyLastProcessLineTaxAmountNoDiscForeign'=>0,
                'fQtyLastProcessLineTotExcl' => ($service->selling_price * $service->total_units),
                'fQtyLastProcessLineTotExclForeign' =>($service->selling_price * $service->total_units),
                'fQtyLastProcessLineTotExclNoDisc' => ($service->selling_price * $service->total_units),
                'fQtyLastProcessLineTotExclNoDiscForeign' => ($service->selling_price * $service->total_units),
                'fQtyLastProcessLineTotIncl' => ($service->selling_price * $service->total_units) + 0,
                'fQtyLastProcessLineTotInclForeign' => ($service->selling_price * $service->total_units) + 0,
                'fQtyLastProcessLineTotInclNoDisc' => ($service->selling_price * $service->total_units) + 0,
                'fQtyLastProcessLineTotInclNoDiscForeign' => ($service->selling_price * $service->total_units) + 0,
                'fQtyLastProcessUR' => $service->total_units,
                'fQtyLinkedUsed' => $service->total_units,
                'fQtyLinkedUsedUR' => $service->total_units,
                //qty
                'fQtyProcessed' => $service->total_units,
                'fQtyProcessedLineTaxAmount' => 0,
                'fQtyProcessedLineTaxAmountForeign' => 0,
                'fQtyProcessedLineTaxAmountNoDisc' => 0,
                'fQtyProcessedLineTaxAmountNoDiscForeign' => 0,
                'fQtyProcessedLineTotExcl' => ($service->selling_price * $service->total_units),
                'fQtyProcessedLineTotExclForeign' => ($service->selling_price * $service->total_units),
                'fQtyProcessedLineTotExclNoDisc' => ($service->selling_price * $service->total_units),
                'fQtyProcessedLineTotExclNoDiscForeign' => ($service->selling_price * $service->total_units),
                'fQtyProcessedLineTotIncl' => ($service->selling_price * $service->total_units) + 0,
                'fQtyProcessedLineTotInclForeign' =>($service->selling_price * $service->total_units) + 0 ,
                'fQtyProcessedLineTotInclNoDisc' => ($service->selling_price * $service->total_units) + 0,
                'fQtyProcessedLineTotInclNoDiscForeign' => ($service->selling_price * $service->total_units) + 0,
                'fQtyProcessedUR' => $service->total_units,
//            'fQtyReserved',
//            'fQtyReservedChange',
//            'fQtyReservedChangeUR',
//            'fQtyReservedUR',
//            'fQtyToProcess',
                'fQtyToProcessLineTaxAmount' =>0,
                'fQtyToProcessLineTaxAmountForeign' => 0,
                'fQtyToProcessLineTaxAmountNoDisc' => 0,
                'fQtyToProcessLineTaxAmountNoDiscForeign' => 0,
                'fQtyToProcessLineTotExcl' => ($service->selling_price * $service->total_units),
                'fQtyToProcessLineTotExclForeign' => ($service->selling_price * $service->total_units),
                'fQtyToProcessLineTotExclNoDisc' => ($service->selling_price * $service->total_units),
                'fQtyToProcessLineTotExclNoDiscForeign' => ($service->selling_price * $service->total_units),
                'fQtyToProcessLineTotIncl' => ($service->selling_price * $service->total_units) + 0,
                'fQtyToProcessLineTotInclForeign' => ($service->selling_price * $service->total_units) + 0,
                'fQtyToProcessLineTotInclNoDisc' => ($service->selling_price * $service->total_units) + 0,
                'fQtyToProcessLineTotInclNoDiscForeign' => ($service->selling_price * $service->total_units) + 0,
                'fQtyToProcessUR' => $service->total_units,
                //quantity
                'fQuantity' => $service->total_units,
                'fQuantityLineTaxAmount' => 0,
                'fQuantityLineTaxAmountForeign' => 0,
                'fQuantityLineTaxAmountNoDisc' => 0,
                'fQuantityLineTaxAmountNoDiscForeign' => 0,
                'fQuantityLineTotExcl' => ($service->selling_price * $service->total_units),
                'fQuantityLineTotExclForeign' => ($service->selling_price * $service->total_units),
                'fQuantityLineTotExclNoDisc' => ($service->selling_price * $service->total_units),
                'fQuantityLineTotExclNoDiscForeign' => ($service->selling_price * $service->total_units),
                'fQuantityLineTotIncl' => (($service->selling_price * $service->total_units) + 0),
                'fQuantityLineTotInclForeign' => ($service->selling_price * $service->total_units) + 0,
                'fQuantityLineTotInclNoDisc' => ($service->selling_price * $service->total_units) + 0,
                'fQuantityLineTotInclNoDiscForeign' => ($service->selling_price * $service->total_units) + 0,
                'fQuantityUR' => $service->total_units,
                'fTaxRate' => 0,
                'fUnitCost' =>$service->selling_price,
                'fUnitCostForeign' => $service->selling_price,
                //price single
                'fUnitPriceExcl' => $service->selling_price,
                'fUnitPriceExclForeign' => $service->selling_price,
//            'fUnitPriceExclForeignOrig',
//            'fUnitPriceExclOrig',
                'fUnitPriceIncl' => ($service->selling_price + 0),
                'fUnitPriceInclForeign' => $service->selling_price + 0,
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
                'iLineProjectID' => 1,
                'iLineRepID' => 1,
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
                'iStockCodeID' => $service->stock_link,
                'iTaxTypeID' => $service->tax_id,
//            'iUnitPriceOverrideReasonID',
//            'iUnitsOfMeasureCategoryID',
//            'iUnitsOfMeasureID',
//            'iUnitsOfMeasureStockingID',
//            'iWarehouseID',
            ]);

        }

        return true;
    }
}