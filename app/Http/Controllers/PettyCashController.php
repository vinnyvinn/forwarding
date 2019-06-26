<?php

namespace App\Http\Controllers;

use App\PettyCash;
use App\Project;
use Carbon\Carbon;
use App\Voucher;
use App\CashRequest;
use App\Pmtrecord;
use Esl\helpers\Constants;
use Esl\Repository\UploadFileRepo;
use Esl\Repository\CashRequestRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PettyCashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $filepath = ' ';
        if ($request->has('file_path')){
            $filepath = UploadFileRepo::init()->upload($request->file_path);
        }

        PettyCash::create(
            [
                'quotation_id' => $request->quotation_id,
                'employee_number' => $request->employee_number,
                'user_id' => $request->user_id,
                'amount' => $request->amount,
                'currency_type' =>$request->currency_type,
                'vouchertype' => $request->vouchertype,
                'deadline' => Carbon::parse($request->deadline),
                'reason' => $request->reason,
                'file_path' => $filepath
            ]
        );

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PettyCash  $pettyCash
     * @return \Illuminate\Http\Response
     */
    public function show(PettyCash $pettyCash)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PettyCash  $pettyCash
     * @return \Illuminate\Http\Response
     */
    public function edit(PettyCash $pettyCash)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PettyCash  $pettyCash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PettyCash $pettyCash)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PettyCash  $pettyCash
     * @return \Illuminate\Http\Response
     */
    public function destroy(PettyCash $pettyCash)
    {
        //
    }

    public function approve($petty_cash_id, Request $request)
    {
        

        $pettyCash = PettyCash::with(['quotation'])->find($petty_cash_id);
        $pettyCash->status = 1;
        $pettyCash->save();
        $pettyCash->update(['status'=>1]);
        
        $project = Project::find($pettyCash->quotation->project_int);

        //insert to sage
       
        $cashrequ = new CashRequest();

         $from_sage=Voucher::where('iVoucherTypeID',$pettyCash->vouchertype)->first();
        
        $ref_no =$pettyCash->currency_type =='KSH' ? (strlen($from_sage->iDeftStartNo) <= $from_sage->iPad ? str_pad('KES', strlen($from_sage->iDeftStartNo), '0', STR_PAD_RIGHT) : 'KES') : '';
        $ref_no.=$pettyCash->currency_type =='USD' ? (strlen($from_sage->iDeftStartNo) <= $from_sage->iPad ?  str_pad('USD', strlen($from_sage->iDeftStartNo), '0', STR_PAD_RIGHT) : 'USD') : '';

        $cashrequ->Audit_No = 0;
        $cashrequ->bIsReceipt = 1;
        $cashrequ->iModule = 0;
        $cashrequ->iCustSuppGLAccId = 0;
        $cashrequ->iBankAccountID = 0;
        $cashrequ->iAPAccId = 0;
       $cashrequ->iARAccId = 0;
       $cashrequ->iGrpId = 0;
       $cashrequ->iTrAccId = $from_sage->iTrCodeId;
       $cashrequ->iARTrAccId = 0;
       $cashrequ->fAmount = $pettyCash->amount;
       $cashrequ->iTenderTypeId = 1;
       $cashrequ->dExtraDate = '';
       $cashrequ->TxDate = Carbon::now()->toDateTimeString();
       $cashrequ->Reference =  $ref_no.''.$from_sage->iDeftStartNo.''.$from_sage->cSuffix;
       $cashrequ->Description = '';
       $cashrequ->Username = '';
       $cashrequ->cChequeNo = '';
       $cashrequ->iBankLink = 0;
       $cashrequ->cBankBranch = '';
       $cashrequ->cBankRefNo = '';
       $cashrequ->cEFTAccountNo = '';
       $cashrequ->cAccountHolder = '';
       $cashrequ->cCardNo = '';
       $cashrequ->cCardType = '';
       $cashrequ->dCardExpiryDate = '';
       $cashrequ->cCardAuthCode = '';
       $cashrequ->bProcessUnprocessed = 'UnProcessed';
       $cashrequ->bApproved = 0;
       $cashrequ->cCabNo = '';
       $cashrequ->cOwnerLessee = '';
       $cashrequ->cCurrencySymbol = $pettyCash->currency_type =='KSH' ? 'KES' : '$';
       $cashrequ->fExchangeRate = 0;
       $cashrequ->fHomeAmount = $pettyCash->amount;
       $cashrequ->fForeignAmount = 0;
       $cashrequ->bIsHomeCurrency = 0;
       $cashrequ->iCurrencyLink = $pettyCash->currency_type =='KSH' ? '0' : '1';
       $cashrequ->iVoucherID = $pettyCash->vouchertype;
       $cashrequ->cNarrative = $pettyCash->reason;
       $cashrequ->fk_iProjectID = $pettyCash->quotation->project_int;
       $cashrequ->bSpiltTrans = 0;
       $cashrequ->cAccountPayee = '';
       $cashrequ->bPostDated = 0;
       $cashrequ->bPostDatedChqCancelled = 0;
       $cashrequ->bIsPrinted = '';
       $cashrequ->PR_PmtRec_iBranchID = 0;
       $cashrequ->iIncidentTypeId = 0;
       $cashrequ->iIncidentID = 0;
       $cashrequ->save();
       
       
        Voucher::where('iVoucherTypeID',$pettyCash->vouchertype)->update(['iDeftStartNo'=> $from_sage->iDeftStartNo+1]);
        
     $project_name = $project ? $project->ProjectName : 'Not Set';
        Mail::to(['email' => 'accounts@esl-eastafrica.com'])
            ->cc(Constants::EMAILS_CC)
            ->send(new \App\Mail\FundRequest([
                'message' => 'Approved, Kindly issue KES '.number_format($pettyCash->amount,2).' to '. ucwords($pettyCash->user->name).' for '.
                ucfirst($pettyCash->reason).'. Project Name '. $project_name, 'user' => Auth::user()->name], $project));

        alert()->success('Successfully approved','Success');

        return redirect()->back();
    }
}
