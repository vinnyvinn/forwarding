<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Notification extends ESLModel
{
    protected $fillable = ['title','text','link','user_id','status','department_id'];
}
