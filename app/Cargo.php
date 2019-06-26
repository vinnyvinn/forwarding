<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Cargo extends ESLModel
{
    protected $fillable = ['bl_no','cargo_name','vessel_name','location',
        'shipper','destination','shipping_line','entry_number','eta',
        'cargo_qty','cargo_weight','quotation_id','container_no','consignee_name','manifest'];

    public function quotation()
    {
        return $this->hasOne(Quotation::class, 'id', 'quotation_id');
    }
//
//    public function goodType()
//    {
//        return $this->hasOne(GoodType::class, 'id','good_type_id');
//    }
}







