<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 2/13/18
 * Time: 1:11 PM
 */

namespace Esl\Repository;


class UploadFileRepo
{
    public static function init()
    {
        return new self;
    }

    public function upload($file, $folder = 'uploads')
    {
        $name = time().'.'.$file->getClientOriginalExtension();

        $file->move(public_path($folder),$name);

        return $folder.'/'.$name;
    }
}