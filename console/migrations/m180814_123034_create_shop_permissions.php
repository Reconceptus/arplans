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
        $shop = $auth->createPermission('shop');
        $shop->description = 'Доступ к админке магазин';
        $auth->add($shop);

        $category = $auth->createPermission('shop_category');
        $category->description = 'Категории товаров';
        $auth->add($category);

        $item = $auth->createPermission('shop_item');
        $item->description = 'Товары';
        $auth->add($item);

        $catalog = $auth->createPermission('shop_catalog');
        $catalog->description = 'Фильтры';
        $auth->add($catalog);

        $order = $auth->createPermission('shop_order');
        $order->description = 'Заказы';
        $auth->add($order);

        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $shop);
        $auth->addChild($admin, $category);
        $auth->addChild($admin, $item);
        $auth->addChild($admin, $order);
        $auth->addChild($admin, $catalog);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
