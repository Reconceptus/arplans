<?php

use yii\db\Migration;

/**
 * Class m181122_104007_add_seo_fields
 */
class m181122_104007_add_seo_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $values = [
            ['collaboration', 'Сотрудничество', '/collaboration', 'seo title', 'collaboration_page_seo_title', '', ''],
            ['collaboration', 'Сотрудничество', '/collaboration', 'seo description', 'collaboration_page_seo_description', '', ''],
            ['collaboration', 'Сотрудничество', '/collaboration', 'seo keywords', 'collaboration_page_seo_keywords', '', ''],
            ['about', 'О компании', '/about', 'seo title', 'about_page_seo_title', '', ''],
            ['about', 'О компании', '/about', 'seo description', 'about_page_seo_description', '', ''],
            ['about', 'О компании', '/about', 'seo keywords', 'about_page_seo_keywords', '', ''],
            ['builder', 'Строители', '/builder', 'seo title', 'builder_page_seo_title', '', ''],
            ['builder', 'Строители', '/builder', 'seo description', 'builder_page_seo_description', '', ''],
            ['builder', 'Строители', '/builder', 'seo keywords', 'builder_page_seo_keywords', '', ''],
            ['village', 'Поселки', '/village', 'seo title', 'village_page_seo_title', '', ''],
            ['village', 'Поселки', '/village', 'seo description', 'village_page_seo_description', '', ''],
            ['village', 'Поселки', '/village', 'seo keywords', 'village_page_seo_keywords', '', ''],
            ['favorite', 'Избранное', '/shop/favorite', 'seo title', 'favorite_page_seo_title', '', ''],
            ['favorite', 'Избранное', '/shop/favorite', 'seo description', 'favorite_page_seo_description', '', ''],
            ['favorite', 'Избранное', '/shop/favorite', 'seo keywords', 'favorite_page_seo_keywords', '', ''],
            ['cart', 'Корзина', '/shop/cart', 'seo title', 'cart_page_seo_title', '', ''],
            ['cart', 'Корзина', '/shop/cart', 'seo description', 'cart_page_seo_description', '', ''],
            ['cart', 'Корзина', '/shop/cart', 'seo keywords', 'cart_page_seo_keywords', '', ''],
            ['free', 'Бесплатные проекты', '/compilation/free', 'seo title', 'free_page_seo_title', '', ''],
            ['free', 'Бесплатные проекты', '/compilation/free', 'seo description', 'free_page_seo_description', '', ''],
            ['free', 'Бесплатные проекты', '/compilation/free', 'seo keywords', 'free_page_seo_keywords', '', ''],
            ['new', 'Новинки', '/compilation/new', 'seo title', 'new_page_seo_title', '', ''],
            ['new', 'Новинки', '/compilation/new', 'seo description', 'new_page_seo_description', '', ''],
            ['new', 'Новинки', '/compilation/new', 'seo keywords', 'new_page_seo_keywords', '', ''],
            ['discount', 'Проекты со скидкой', '/compilation/discount', 'seo title', 'discount_page_seo_title', '', ''],
            ['discount', 'Проекты со скидкой', '/compilation/discount', 'seo description', 'discount_page_seo_description', '', ''],
            ['discount', 'Проекты со скидкой', '/compilation/discount', 'seo keywords', 'discount_page_seo_keywords', '', ''],
        ];
        Yii::$app->db->createCommand()->batchInsert('content_block', ['page', 'page_title', 'page_url', 'name', 'slug', 'text', 'language'], $values)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181122_104007_add_seo_fields cannot be reverted.\n";

        return false;
    }
}
