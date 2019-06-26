<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pmtrecord extends Model
{
    //
    protected $table = 'PR_PmtRec';

    protected $primaryKey = 'idPR_PmtRec';
    protected $connection = 'sqlsrv2';
    public $timestamps = false;
}
