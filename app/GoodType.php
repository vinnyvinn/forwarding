<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class GoodType extends ESLModel
{
    protected  $fillable = ['name','description','uom'];
}
