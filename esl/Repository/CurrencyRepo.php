<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 4/20/18
 * Time: 9:19 AM
 */

namespace Esl\Repository;


use Illuminate\Support\Facades\DB;

class CurrencyRepo
{
    public static function init()
    {
        return new self;
    }

    public function exchangeRate()
    {
        return DB::connection('sqlsrv2')->table('CurrencyHist')->get()->last()->fSellRate;
    }
}