<?php

namespace App;

use Esl\Repository\ESLModel;
use Illuminate\Database\Eloquent\Model;

class Supplier extends ESLModel
{
    protected $table = 'Vendor';
    protected $connection = 'sqlsrv2';
    protected $primaryKey = 'DCLink';


}
