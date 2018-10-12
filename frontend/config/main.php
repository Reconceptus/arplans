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
            'parsers'   => [
                'application/json' => 'yii\web\JsonParser',
            ],
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
            'enablePrettyUrl'     => true,
            'showScriptName'      => false,
            'enableStrictParsing' => true,
            'rules'               => [
                ['class' => 'yii\rest\UrlRule', 'pluralize' => false, 'controller' => 'api/item'],
                'about'                                                    => 'site/about',
                'site'                                                     => 'site',
                'admin'                                                    => 'blog/page',
                'shop/service/<slug:[a-zA-Z0-9\_\-]+>'                     => 'shop/service/view',
                'shop/download'                                            => 'shop/catalog/download',
                'shop/history'                                             => 'shop/catalog/history',
                'shop/favorite/add'                                        => 'shop/favorite/add',
                'shop/favorite/delete'                                     => 'shop/favorite/delete',
                'shop/favorite'                                            => 'shop/favorite/index',
                'shop/cart/delete'                                         => 'shop/cart/delete',
                'shop/cart/add'                                            => 'shop/cart/add',
                'shop/cart/order'                                          => 'shop/cart/order',
                'shop/cart/change'                                         => 'shop/cart/change',
                'shop/cart'                                                => 'shop/cart/index',
                'shop/compilation/<slug:[a-zA-Z0-9\_\-]+>'                 => 'shop/compilation/<slug>',
                'shop/<category:[a-zA-Z0-9\_\-]+>/<slug:[a-zA-Z0-9\_\-]+>' => 'shop/catalog/view',
                'shop/<category:[a-zA-Z0-9\_\-]+>'                         => 'shop/catalog/index',
                'shop'                                                     => 'shop/catalog',
                'shop/catalog'                                             => 'shop/catalog',

                'village'                         => 'partner/village/index',
                'village/<slug:[a-zA-Z0-9\_\-]+>' => 'partner/village/view',
                'builder/<slug:[a-zA-Z0-9\_\-]+>' => 'partner/builder/view',
                'builder'                         => 'partner/builder/index',

                'blog/add-comment'             => 'blog/post/add-comment',
                'blog/search'                  => 'blog/post/search',
                'blog/index'                   => 'blog/post/index',
                'blog/test'                    => 'blog/post/test',
                'blog/<slug:[a-zA-Z0-9\_\-]+>' => 'blog/post/view',
                'blog'                         => 'blog/post/index',

                '<module:[a-zA-Z0-9\_\-]+>/<controller:[a-zA-Z0-9\_\-]+>/<action:[a-zA-Z0-9\_\-]+>'               => '<module>/<controller>/<action>',
                '<module:[a-zA-Z0-9\_\-]+>/<controller:[a-zA-Z0-9\_\-]+>'                                         => '<module>/<controller>',
                '<module:[a-zA-Z0-9\_\-]+>'                                                                       => '<module>/blog',
                '<slug:[a-zA-Z0-9\_\-]+>'                                                                         => 'page/view',
                'admin/modules/<module:[a-zA-Z0-9\_\-]+>/<controller:[a-zA-Z0-9\_\-]+>/<action:[a-zA-Z0-9\_\-]+>' => '<module>/<controller>/<action>',
                'admin/modules/<module:[a-zA-Z0-9\_\-]+>/<controller:[a-zA-Z0-9\_\-]+>'                           => '<module>/<controller>',
                'shop',
                '/'                                                                                               => '/'
            ],
        ],
    ],
    'modules'             => [
        'admins'  => [
            'class' => 'modules\admin\Module',
        ],
        'shop'    => [
            'class' => 'modules\shop\Module',
        ],
        'partner' => [
            'class' => 'modules\partner\Module',
        ],
        'blog'    => [
            'class' => 'modules\blog\Module',
        ],
        'users'   => [
            'class' => 'modules\users\Module',
        ],
        'api'     => [
            'class' => 'modules\api\v1\Module',
        ],
    ],
    'params'              => $params,
];
