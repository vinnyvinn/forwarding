<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class DmsComponent extends ESLModel
{
    protected  $fillable = ['bill_of_landing_id','remark','stage_component_id','doc_links','text','subchecklist'];

    public function scomponent()
    {
        return $this->hasOne(StageComponent::class,'id','stage_component_id');
    }

    public function dms()
    {
        return $this->belongsTo(BillOfLanding::class,'bill_of_landing_id','id');
    }
}
