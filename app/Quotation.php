<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Quotation extends ESLModel
{

   protected $guarded = [];

    public function pettyCash()
    {
        return $this->hasMany(PettyCash::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'DCLink','DCLink');
    }

    public function purchaseOrder()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function checkedBy()
    {
        return $this->hasOne(User::class,'id','checked_by');
    }
    public function approvedBy()
    {
        return $this->hasOne(User::class,'id','approved_by');
    }

    public function services()
    {
        return $this->hasMany(QuotationService::class,'quotation_id','id');
    }

    public function cargo()
    {
        return $this->hasOne(Cargo::class,'quotation_id','id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function remarks()
    {
        return $this->hasMany(Remarks::class, 'quotation_id','id');
    }

    public function docs()
    {
        return $this->hasMany(VesselDocs::class,'vessel_id','id');
    }

    public function dms()
    {
        return $this->hasOne(BillOfLanding::class,'quote_id','id');
    }
}
