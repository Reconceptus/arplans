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
        '//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,latin-ext',
        '//fonts.googleapis.com/css?family=PT+Sans&amp;subset=cyrillic,cyrillic-ext,latin-ext'
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
