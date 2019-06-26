<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Sof extends ESLModel
{
    protected $fillable = ['bill_of_landing_id','from','to','crane_working','remarks'];
}
