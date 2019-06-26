<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Remarks extends ESLModel
{
    protected $fillable = ['user_id','remark_to','quotation_id','remark'];

    public function user()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }
}
