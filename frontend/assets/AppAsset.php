<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
//    public $jsOptions = ['position' => \yii\web\View::POS_END];
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/styles.min.css',
        'css/common.css',
    ];
    public $js = [
//        'js/jquery.min.js',
        'js/owl.carousel.min.js',
        'js/wNumb.js',
        'js/nouislider.min.js',
        'js/jquery.mCustomScrollbar.concat.min.js',
        'js/jquery.fancybox.min.js',
        'js/jquery.validate.min.js',
        'js/main.min.js',
        'js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
