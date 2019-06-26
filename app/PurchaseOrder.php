<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends ESLModel
{
    protected $fillable = ['quotation_id','project_id','supplier_id','user_id','approved_by',
        'input_currency','invnum_id','status','po_date','po_no'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','DCLink');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class,'quotation_id','id');
    }

    public function polines()
    {
        return $this->hasMany(PurchaseOrderLine::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class,'approved_by','id');
    }
}
