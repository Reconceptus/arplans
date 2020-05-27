<?php
?>
<div class="sharing ">
    <div class="title">Поделиться</div>
    <ul>
        <li>
            <a href="https://www.facebook.com/sharer.php?u=<?= Yii::$app->request->getAbsoluteUrl() ?>"
               class="ico ico-fb">
                <svg xmlns="http://www.w3.org/2000/svg">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-fb"/>
                </svg>
            </a>
        </li>
        <li>
            <a href="https://vk.com/share.php?url=<?= Yii::$app->request->getAbsoluteUrl() ?>" class="ico ico-vk">
                <svg xmlns="http://www.w3.org/2000/svg">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-vk"/>
                </svg>
            </a>
        </li>
        <li>
            <a href="https://connect.ok.ru/offer?url=<?= Yii::$app->request->getAbsoluteUrl() ?>" class="ico ico-ok">
                <svg xmlns="http://www.w3.org/2000/svg">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-ok"/>
                </svg>
            </a>
        </li>
        <li>
            <a href="http://pinterest.com/pin/create/button/?url=<?= Yii::$app->request->getAbsoluteUrl() ?>" class="pin-it-button">
                <img border="0" src="/images/pint.svg" title="Pin It" />
            </a>
        </li>
    </ul>
</div>
