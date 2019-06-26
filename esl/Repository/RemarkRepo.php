<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 2/11/18
 * Time: 6:34 AM
 */

namespace Esl\Repository;


use App\Remarks;

class RemarkRepo
{
    public static function make()
    {
        return new self;
    }

    public function remark(array  $remarkData)
    {
        Remarks::create($remarkData);
        return true;
    }

}