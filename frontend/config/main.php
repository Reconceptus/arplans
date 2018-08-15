<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id'                  => 'app-frontend',
    'name'                => 'Arplans',
    'sourceLanguage'      => 'ru',
    'language'            => 'ru',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components'          => [
        'request'      => [
            'csrfParam' => '_csrf-frontend',
        ],
        'authManager'  => [
            'class' => 'yii\rbac\DbManager',
        ],
        'user'         => [
            'identityClass'   => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie'  => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session'      => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
                'blog/add-comment'             => 'blog/add-comment',
                'blog/search'                  => 'blog/search',
                'blog/index'                   => 'blog/index',
                'blog/test'                    => 'blog/test',
                'blog/<slug:[a-zA-Z0-9\_\-]+>' => 'blog/view',
                'blog'                         => 'blog/index',
                'admin'                        => 'admin',
//                'admin/shop'                   => 'admin',
                'shop'                         => 'shop',
                'site'                         => 'site',
                '<slug:[a-zA-Z0-9\_\-]+>'      => 'page/view',
            ],
        ],
    ],
    'modules'             => [
        'admin' => [
            'class' => 'frontend\modules\admin\Admin',
        ],
        'shop'  => [
            'class' => 'frontend\modules\shop\Module',
        ],
    ],
    'params'              => $params,
];
