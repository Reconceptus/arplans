<?php

use frontend\widgets\flashes\Flashes;
use modules\admin\assets\AdminAsset;
use modules\admin\widgets\menu\Menu;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

AdminAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="row">
        <div class="container-fluid">
            <div class="col-sm-3 col-md-2 sidebar">
                <div class="sidebar-header">
                    <?= Html::a('<div class="logo"><img src="/svg/partials/logo.svg" alt="arplans" width="154" height="35"></div>', \yii\helpers\Url::to('/')) ?>
                </div>
                <?= Menu::widget() ?>
            </div>
            <div class="admin-content">
                <?= Flashes::widget() ?>
                <?= $content ?>
            </div>
        </div>
    </div>
</div>


<footer class="footer">
    <div class="admin-content">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
    </div>
    <div class="clearfix"></div>
</footer>

<div class="modal fade" id="setAlt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Установить подпись</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="alt" class="form-control-label">Подпись:</label>
                        <input type="text" class="form-control" id="alt">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-admin js-set-img-alt" data-path="shop/item">Сохранить</button>
            </div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
