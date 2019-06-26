<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 2/11/18
 * Time: 6:19 AM
 */

namespace Esl\Repository;


use App\Quotation;

class QuotationRepo
{
    public static function make()
    {
        return new  self;
    }

    public function changeStatus($quotation_id, $status)
    {
        Quotation::findOrFail($quotation_id)->update(['status' => $status]);

        return true;
    }
}