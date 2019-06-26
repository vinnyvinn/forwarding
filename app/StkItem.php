<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class StkItem extends ESLModel
{
    protected $table = 'StkItem';
    protected $primaryKey = 'StockLink';
    protected $connection = 'sqlsrv2';
}
