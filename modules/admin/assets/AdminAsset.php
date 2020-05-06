<?php

namespace modules\admin\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    public $publishOptions = [
        'forceCopy' => true
    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
    public $basePath = '@admin/assets';
    public $sourcePath = '@admin/assets';
    public $css = [
        'css/admin.css',
    ];
    public $js = [
        'js/script.js',
        'js/bootstrap.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}