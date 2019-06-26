<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Customer extends ESLModel
{
    protected $table = 'Client';
    protected $primaryKey = 'DCLink';
    protected $connection = 'sqlsrv2';
    public $timestamps = false;

    protected $fillable = ['DCLink','Account','Physical1','iCurrencyID','Physical2','Email',
        'Contact_Person','Name','Telephone'];
}