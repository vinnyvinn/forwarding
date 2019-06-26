<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Voyage extends ESLModel
{
    protected $fillable = ['quotation_id','name','voyage_no','service_code','final_destination',
        'eta','vessel_arrived','time_allowed','laytime_start'];
}
