<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class CtmRemark extends ESLModel
{
    protected $fillable = ['ctm_id','remark'];
}
