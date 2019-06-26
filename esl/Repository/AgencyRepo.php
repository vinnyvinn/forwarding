<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 2/11/18
 * Time: 6:12 AM
 */

namespace Esl\Repository;


use App\AgencyApproval;

class AgencyRepo
{
    public static function make()
    {
        return new self;
    }

    public function quotationApproval(array $data)
    {
        AgencyApproval::create($data);

        return true;
    }
}