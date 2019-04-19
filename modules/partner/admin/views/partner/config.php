<?php
/* @var $model \common\models\User */
$str = '<?php
$params = [
    "server"=>"https://arplans.ru/api",
    "mainElement" => "#main",
    "token"=>"' . $model->access_token . '"
];';

Yii::$app->response->sendContentAsFile($str, 'config.php', ['mimeType'=>'text/php']);