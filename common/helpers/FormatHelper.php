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
     * @param $array array
     * @param $numberOfParts integer
     * @param $keys bool
     * @return array
     */
    public static function divideArray($array, $numberOfParts = 2, $keys = false)
    {
        if ($array) {
            $count = count($array);
            $partSize = ceil($count / $numberOfParts);
            $result = array_chunk($array, $partSize, $keys);
            if ($numberOfParts > $count) {
                foreach ($result as $k => $v) {
                    if (!isset($result[$k])) {
                        $result[$k] = [];
                    }
                }
            }
            return $result;
        } else {
            $result = [];
            for ($i = 0; $i < $numberOfParts; $i++) {
                $result[$i] = [];
            }
            return $result;
        }
    }
}