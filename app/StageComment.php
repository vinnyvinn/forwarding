<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class StageComment extends ESLModel
{
    protected $fillable = ['user_id','stage_id','comments'];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
