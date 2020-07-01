<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<?php if (in_array($exception->statusCode, [404, 403], true)): ?>
    <div class="section">
        <div class="bg-head--error gradient">
            <div class="content content--sm">
                <h1 class="title"><?=$exception->statusCode?></h1>
                <h2 class="subtitle"><?=$message?></h2>
                <h3 class="subtitle">вернитесь <a href="/">на главную</a></h3>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="site-error">

        <h1><?= Html::encode($this->title) ?></h1>

        <div class="alert alert-danger">
            <?= nl2br(Html::encode($message)) ?>
        </div>

        <p>
            The above error occurred while the Web server was processing your request.
        </p>
        <p>
            Please contact us if you think this is a server error. Thank you.
        </p>

    </div>
<?php endif; ?>