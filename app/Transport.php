<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Transport extends ESLModel
{
    protected $fillable = ['bill_of_landing_id','driver_name','feu','teu','lcl','truck_no',
        'container_reg','tonne','buying','cost','depart','arrival','return','turn_around'];
}
