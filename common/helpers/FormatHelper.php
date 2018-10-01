<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 14.09.2018
 * Time: 16:28
 */

namespace common\helpers;


class FormatHelper
{
    /**
     * Делит массив на 2 части
     * @param $array
     * @param $keys
     * @return array
     */
    public static function divideArray($array, $keys = false)
    {
        $count = count($array);
        $partSize = ceil($count / 2);
        if ($partSize > 0) {
            return array_chunk($array, $partSize, $keys);
        } else {
            return $array;
        }
    }
}