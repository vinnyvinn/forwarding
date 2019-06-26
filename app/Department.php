<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Department extends ESLModel
{
    protected  $fillable = ['name','description'];

}
