<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class CargoImage extends ESLModel
{
    protected $fillable = ['bill_of_landing_id','image_path'];
}
