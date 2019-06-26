<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Stage extends ESLModel
{
    protected $fillable = ['name','type','slag','description'];

    public function sComments()
    {
        return $this->hasMany(StageComment::class, 'stage_id', 'id');
    }

    public function components()
    {
        return $this->hasMany(StageComponent::class, 'stage_id', 'id');
    }
}
