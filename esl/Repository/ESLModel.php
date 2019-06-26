<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 4/6/18
 * Time: 1:50 PM
 */

namespace Esl\Repository;


use Esl\Traits\EslTrait;
use Illuminate\Database\Eloquent\Model;

abstract class ESLModel extends Model
{
    use EslTrait;
}