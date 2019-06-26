<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CashRequest extends Model
{
    protected $table = 'PR_PmtRec';
    protected $primaryKey = 'idPR_PmtRec';
    protected $connection = 'sqlsrv2';
    public $timestamps = false;
    protected $fillable = ['Audit_No','bIsReceipt','iModule','iCustSuppGLAccId','iBankAccountID','iBankAccountID','iAPAccId','iARAccId','iGrpId','iTrAccId','iARTrAccId',
        'fAmount','iTenderTypeId','dExtraDate','TxDate','Reference','Description','Username','cChequeNo','iBankLink','cBankBranch','cBankRefNo','cEFTAccountNo','cAccountHolder',
        'cCardNo','cCardType','dCardExpiryDate','cCardAuthCode','bProcessUnprocessed','bApproved','cCabNo','cOwnerLessee','cCurrencySymbol','fExchangeRate',
        'fHomeAmount','fForeignAmount','bIsHomeCurrency','iCurrencyLink','iVoucherID','cNarrative','fk_iProjectID','bSpiltTrans','cAccountPayee','bPostDated','bPostDatedChqCancelled',
        'bIsPrinted','PR_PmtRec_iBranchID','iIncidentTypeId','iIncidentID'];

}
