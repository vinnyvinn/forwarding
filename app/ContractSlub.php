<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class ContractSlub extends ESLModel
{
    protected $fillable = ['contract_id','from','to','charges','t_round'];
}
