<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 24.10.2018
 * Time: 15:45
 */

/* @var $models \common\models\Post[] */
?>
<?php if ($models): ?>
    <div class="home-about-menu">
        <div class="content content--lg">
            <ul class="home-about-menu--wrap">
                <?php foreach ($models as $model): ?>
                    <li>
                        <a href="/blog/<?= $model->slug ?>" class="home-about-menu--item">
                            <article>
                                <h4 class="title"><?= $model->name ?></h4>
                                <div class="subtitle"><?= $model->short_description ?></div>
                                <div class="read">
                                    <button class="btn-small" type="button">Читать</button>
                                </div>
                            </article>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>