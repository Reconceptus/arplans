<?php

/**
 * Created by PhpStorm.
 * User: borod
 * Date: 15.10.2018
 * Time: 17:47
 */

use modules\shop\models\RefRequest;

/* @var $model RefRequest */
?>

<p>Поступил новый запрос на вывод средств</p>
<p>Пользователь: <?=$model->referrer->username?></p>
<p>Сумма: <?=$model->amount?></p>
<p>Комментарий: <?=$model->info?></p>