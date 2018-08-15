<?php

use yii\db\Migration;

/**
 * Class m180814_123034_create_shop_permissions
 */
class m180814_123034_create_shop_permissions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // создать разрешения
        $posts = $auth->createPermission('shop_category');
        $posts->description = 'Категории товаров';
        $auth->add($posts);

        $pages = $auth->createPermission('shop_item');
        $pages->description = 'Товары';
        $auth->add($pages);

        $adminPanel = $auth->createPermission('shop');
        $adminPanel->description = 'Доступ к админке магазин';
        $auth->add($adminPanel);

        $users = $auth->createPermission('shop_order');
        $users->description = 'Заказы';
        $auth->add($users);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       return true;
    }
}
