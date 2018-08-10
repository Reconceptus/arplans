<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 26.07.2018
 * Time: 16:02
 */


$flashes = Yii::$app->session->getAllFlashes();
foreach ($flashes as $type => $message): ?>
    <div class="alert alert-<?= $type ?>" role="alert"><?= $message ?></div>
<?php endforeach ?>