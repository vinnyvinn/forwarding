<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class AgencyApproval extends ESLModel
{
    protected  $fillable = ['user_id','quotation_id','quotation_action','remarks'];
}
