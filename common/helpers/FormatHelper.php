<?php

namespace common\helpers;


class FormatHelper
{
    /**
     * Делит массив на $numberOfParts частей
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
            if ($numberOfParts > $count && $keys==false) {
                for ($i=0;$i<$numberOfParts;$i++){
                    if(!isset($result[$i])){
                        $result[$i]=[];
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