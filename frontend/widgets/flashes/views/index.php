<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 13.08.2018
 * Time: 12:34
 */

?>
<?php foreach ($flashes as $type => $message): ?>
    <div class="alert alert-<?= $type ?>" role="alert"><?= $message ?></div>
<?php endforeach ?>
