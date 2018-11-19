<?php

use yii\db\Migration;

/**
 * Class m181119_095503_add_content
 */
class m181119_095503_add_content extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $values = [
            ['main', 'Главная', '/', 'Описание внизу', 'main_page_description', '', ''],
            ['favorite', 'Избранное', '/shop/favorite', 'Описание внизу', 'favorite_description', '', ''],
            ['cart', 'Корзина', '/shop/cart', 'Описание внизу', 'cart_description', '', ''],
            ['village', 'Поселки', '/village', 'Описание внизу', 'village_index_description', '', ''],
            ['builder', 'Строители', '/builder', 'Описание внизу', 'builder_index_description', '', ''],
        ];
        Yii::$app->db->createCommand()->batchInsert('content_block', ['page', 'page_title', 'page_url', 'name', 'slug', 'text', 'language'], $values)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
