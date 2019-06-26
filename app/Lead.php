<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Lead extends ESLModel
{
    protected  $fillable = ['name','contact_person','phone',
        'email','telephone','address','location'];

    public function quotation()
    {
        return $this->hasMany(Quotation::class, 'lead_id','id');
    }
}
