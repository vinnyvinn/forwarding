<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Contract extends ESLModel
{
    protected $fillable = ['company_name','contact','contract_type','value',
        'address','body','remarks','status','doc_path'];

    public function slubs()
    {
        return $this->hasMany(ContractSlub::class,'contract_id','id');
    }

}
