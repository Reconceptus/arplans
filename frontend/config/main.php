<?php
$params = array_merge(
    require __DIR__.'/../../common/config/params.php',
    require __DIR__.'/../../common/config/params-local.php',
    require __DIR__.'/params.php',
    require __DIR__.'/params-local.php'
);

return [
    'id'                  => 'app-frontend',
    'name'                => 'Arplans',
    'sourceLanguage'      => 'ru',
    'language'            => 'ru',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'timeZone'            => 'Europe/Moscow',
    'components'          => [
        'reCaptcha'        => [
            'class'     => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
            'siteKeyV3' => $params['recaptchaSite3'],
            'siteKeyV2' => $params['recaptchaSite2'],
            'secretV3'  => $params['recaptchaSecret3'],
            'secretV2'  => $params['recaptchaSecret2'],
        ],
        'formatter'    => [
            'class'           => 'yii\i18n\Formatter',
            'defaultTimeZone' => 'Europe/Moscow',
            'timeZone'        => 'Europe/Moscow'
        ],
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager'   => [
            'enablePrettyUrl'     => true,
            'showScriptName'      => false,
            'enableStrictParsing' => true,
            'rules'               => [
                ['class' => 'yii\rest\UrlRule', 'pluralize' => false, 'controller' => 'api/item'],
                'collections'                                                    => 'site/collections',
                'about'                                                    => 'site/about',
                'collaboration'                                            => 'site/collaboration',
                'contacts'                                                 => 'site/contacts',
                'site/request'                                             => 'site/request',
                'site'                                                     => 'site',
                'admin'                                                    => 'shop/item',
                'shop/service/<slug:[a-zA-Z0-9\_\-]+>'                     => 'shop/service/view',
                'shop/download'                                            => 'shop/catalog/download',
                'shop/history'                                             => 'shop/catalog/history',
                'shop/favorite/add'                                        => 'shop/favorite/add',
                'shop/favorite/delete'                                     => 'shop/favorite/delete',
                'shop/favorite'                                            => 'shop/favorite/index',
                'shop/cart/delete'                                         => 'shop/cart/delete',
                'shop/cart/add'                                            => 'shop/cart/add',
                'shop/cart/promocode'                                      => 'shop/cart/promocode',
                'shop/cart/order'                                          => 'shop/cart/order',
                'shop/cart/change'                                         => 'shop/cart/change',
                'shop/cart'                                                => 'shop/cart/index',
                'shop/catalog'                                             => 'shop/catalog',
                'shop/selection/<slug:[a-zA-Z0-9\_\-]+>'                   => 'shop/compilation/selection',
                'shop/payment/<slug:[a-zA-Z0-9\_\-]+>'                     => 'shop/payment/<slug>',
                'shop/compilation/<slug:[a-zA-Z0-9\_\-]+>'                 => 'shop/compilation/<slug>',
                'shop/<category:[a-zA-Z0-9\_\-]+>/<slug:[a-zA-Z0-9\_\-]+>' => 'shop/catalog/view',
                'shop/<category:[a-zA-Z0-9\_\-]+>'                         => 'shop/catalog/index',
                'shop'                                                     => 'shop/catalog',

                'village'                         => 'partner/village/index',
                'village/add'                     => 'partner/village/add',
                'village/<slug:[a-zA-Z0-9\_\-]+>' => 'partner/village/view',
                'builder/download-price'          => 'partner/builder/download-price',
                'builder/<slug:[a-zA-Z0-9\_\-]+>' => 'partner/builder/view',
                'builder'                         => 'partner/builder/index',

                'blog/add-comment'             => 'blog/post/add-comment',
                'blog/search'                  => 'blog/post/search',
                'blog/index'                   => 'blog/post/index',
                'blog/test'                    => 'blog/post/test',
                'blog/<slug:[a-zA-Z0-9\_\-]+>' => 'blog/post/view',
                'blog'                         => 'blog/post/index',
                'page/<slug:[a-zA-Z0-9\_\-]+>' => 'blog/page/view',

                '<module:[a-zA-Z0-9\_\-]+>/<controller:[a-zA-Z0-9\_\-]+>/<action:[a-zA-Z0-9\_\-]+>'               => '<module>/<controller>/<action>',
                '<module:[a-zA-Z0-9\_\-]+>/<controller:[a-zA-Z0-9\_\-]+>'                                         => '<module>/<controller>',
                '<module:[a-zA-Z0-9\_\-]+>'                                                                       => '<module>',
                'admin/modules/<module:[a-zA-Z0-9\_\-]+>/<controller:[a-zA-Z0-9\_\-]+>/<action:[a-zA-Z0-9\_\-]+>' => '<module>/<controller>/<action>',
                'admin/modules/<module:[a-zA-Z0-9\_\-]+>/<controller:[a-zA-Z0-9\_\-]+>'                           => '<module>/<controller>',
                'shop',
                '/'                                                                                               => '/',
                '<controller:[a-zA-Z0-9\_\-]+>/<action:[a-zA-Z0-9\_\-]+>'                                         => '<controller>/<action>',
                '<controller:[a-zA-Z0-9\_\-]+>'                                                                   => '<controller>',
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
