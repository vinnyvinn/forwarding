<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class ServiceTax extends ESLModel
{
    protected $table = 'TaxRate';
    protected $connection = 'sqlsrv2';
    protected $primaryKey = 'idTaxRate';
    public $timestamps = false;

    protected $fillable = ['idTaxRate','Code','TaxRate','Description'];
}
