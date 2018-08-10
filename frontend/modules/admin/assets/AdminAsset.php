<?php
/**
 * Created by PhpStorm.
 * User: suhov.a.s
 * Date: 26.07.2018
 * Time: 9:46
 */

namespace frontend\modules\admin\assets;

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
        'js/script.js'
    ];
    public $depends = [
        'frontend\assets\AppAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}