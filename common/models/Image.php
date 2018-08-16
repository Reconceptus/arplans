<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 16:35
 */

namespace common\models;


use yii\base\Model;

class Image extends Model
{
    /**
     * Если директории не существует, то создает ее
     * @param $path
     */
    public static function createDirectory($path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0775, true);
        }
    }
}