<?php
/* @var $model \common\models\User */
$str = '<?php
$params = [
    "server"=>"https://arplans.ru/api",
    "mainElement" => "#main",
    "token"=>"' . $model->access_token . '"
];';
echo $str;