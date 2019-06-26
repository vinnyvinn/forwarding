<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    //
    protected $table = 'PR_VoucherType';
    protected $primaryKey = 'DCLink';
    protected $connection = 'sqlsrv2';
    protected $fillable = ['iDeftStartNo'];
    public $timestamps = false;

}
