<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 08.08.2018
 * Time: 15:54
 */

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $roles array */

$this->title = "Роли";
$i = 0;
?>
<h1><?= $this->title ?></h1>
<?= Html::a('Add role', ['create'], ['class' => 'btn btn-admin add-big-button']) ?>
<table class="table table-striped table-bordered">
    <tr>
        <th>#</th>
        <th>Role name</th>
        <th>Code</th>
        <th></th>
    </tr>
    <? foreach ($roles as $code => $role): ?>
        <tr>
            <td style="width:40px">
                <?= ++$i ?>
            </td>
            <td>
                <?= $role->description ?>
            </td>
            <td><?= $code ?></td>
            <td style="width:50px">
                <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>',Url::to(['/admin/modules/users/role/update','role'=>$code]))?>
                <? if (!in_array($code, ['admin', 'user', 'guest'])): ?>
                    <?= Html::a('<span class="glyphicon glyphicon-trash"></span>',Url::to(['/admin/modules/users/role/delete','role'=>$code]),[
                            "data-method"=>"post",
                            "data-confirm"=>"Are you sure you want to delete this role?"
                    ])?>
                <? endif; ?>
            </td>
        </tr>
    <? endforeach ?>
</table>