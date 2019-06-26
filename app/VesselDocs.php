<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class VesselDocs extends ESLModel
{
    protected $fillable = ['vessel_id','doc_path','name'];
}
