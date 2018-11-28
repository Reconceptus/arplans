<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 16.08.2018
 * Time: 16:35
 */

namespace common\models;


use Imagine\Image\Box;
use yii\base\Model;
use yii\imagine\Image as Im;

class Image extends Model
{
    /**
     * @return int
     */
    public static function getThumbMaxSize()
    {
        $size = intval(Config::getValue('item_img_thumb_max'));
        if ($size <= 0) {
            $size = 400;
        }
        return $size;
    }

    /**
     * @return int
     */
    public static function getCropWidth()
    {
        $width = intval(Config::getValue('item_img_crop_width'));
        if ($width <= 0) {
            $width = 1000;
        }
        return $width;
    }

    /**
     * @return int
     */
    public static function getCropHeight()
    {
        $height = intval(Config::getValue('item_img_crop_height'));
        if ($height <= 0) {
            $height = 750;
        }
        return $height;
    }

    /**
     * @param string $image
     * @param int $width
     * @param int $height
     * @param bool $clone
     * @param int $quality
     * @return string
     */
    public static function cropImage(string $image, int $width, int $height, bool $clone, int $quality = 90)
    {
        $pathArray = explode('/', $image);
        $fileName = end($pathArray);
        $path = str_replace($fileName, '', $image);
        $dir = \Yii::getAlias('@frontend/web') . $path;
        if (is_file($dir . $fileName)) {
            $newFileName = $clone ? $dir . $width . '_' . $height . '_' . $fileName : $dir . $fileName;
            $newReturnName = $clone ? $path . $width . '_' . $height . '_' . $fileName : $path . $fileName;
            Im::thumbnail($dir . $fileName, $width, $height)->save($newFileName, ['quality' => $quality]);
            return $newReturnName;
        } else {
            return '';
        }
    }

    /**
     * @param string $image
     * @param int $maxSize
     * @param bool $clone
     * @param int $quality
     * @return string
     */
    public static function thumbImage(string $image, int $maxSize, bool $clone, int $quality)
    {
        $pathArray = explode('/', $image);
        $fileName = end($pathArray);
        $path = str_replace($fileName, '', $image);
        $dir = \Yii::getAlias('@frontend/web') . $path;
        if (is_file($dir . $fileName)) {
            $photo = Im::getImagine()->open($dir . $fileName);
            $newFileName = $clone ? $dir . $maxSize . '_' . $fileName : $dir . $fileName;
            $newReturnName =  $clone ? $path . $maxSize . '_' . $fileName : $path . $fileName;
            $photo->thumbnail(new Box($maxSize, $maxSize))->save($newFileName, ['quality' => $quality]);
            return $newReturnName;
        } else {
            return '';
        }
    }
}