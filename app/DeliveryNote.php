<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class DeliveryNote extends ESLModel
{
    protected $fillable = ['bol_id','user_id','vehicle','driver','doc_path'];
}
