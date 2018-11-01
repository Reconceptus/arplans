<?php

namespace frontend\widgets\youtube;

use yii\base\Widget;
use yii\helpers\ArrayHelper;

class Youtube extends Widget
{
    public $height;
    public $width;
    public $url;
    public $autoplay;
    public $repeat;
    public $controls;
    public $showInfo;

    public static function preview($params)
    {
        $code = self::videoLink($params['url']);
        $params = ArrayHelper::merge(['q' => '0'], $params);
        switch ($params['q']) {
            case 'mq':
                $name = 'mqdefault';
                break;
            case 'hg':
                $name = 'hdefault';
                break;
            case 'sd':
                $name = 'sddefault';
                break;
            case 'mx':
                $name = 'maxresefault';
                break;
            default:
                $name = $params['q'];
        }
        return '//img.youtube.com/vi/' . $code . '/' . $name . '.jpg';
    }

    public function run()
    {
        if ((int)$this->width === 0)
            $this->width = '100%';

        if ((int)$this->height === 0)
            $this->height = '100%';

        return $this->render(
            'youtube',
            [
                'width' => $this->width,
                'height' => $this->height,
                'autoplay' => $this->autoplay,
                'repeat' => $this->repeat,
                'controls'=>$this->controls,
                'showInfo'=>$this->showInfo,
                'url' => self::videoLink($this->url)
            ]
        );
    }

    private static function videoLink($url)
    {
        if (preg_match("#youtu.be/([0-9a-zA-Z\\-_]+)#", $url, $mat)) {
            $inp = $mat[1];
        } elseif (preg_match("#youtube.com/embed/([0-9a-zA-Z\\-_]+)#", $url, $mat)) {
            $inp = $mat[1];
        } elseif (preg_match("#\\?v=#", $url, $mat)) {
            $arr = explode("?v=", $url);
            if (sizeof($arr) >= 2) {
                $inp = preg_replace("#&.*#", "", $arr[1]);
            }
        } elseif (preg_match("#vimeo.com/([0-9a-zA-Z\\-_])+#", $url, $mat)) {
            $inp = $mat[1];
        }
        return $inp;
    }


}