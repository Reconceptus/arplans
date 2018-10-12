<?php

use yii\db\Migration;

/**
 * Class m181012_084836_content_block
 */
class m181012_083657_content_block extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('content_block', [
            'id'         => $this->primaryKey()->unsigned(),
            'page'       => $this->string(),
            'page_title' => $this->string(),
            'page_url'   => $this->string(),
            'slug'       => $this->string(),
            'text'       => $this->text(),
            'language'   => $this->string(6)
        ]);
        $this->createIndex('U_content_block_slug', 'content_block', 'slug', true);
        $values = [
            ['free', 'Бесплатные проекты', '/compilation/free', 'Описание подборки бесплатных проектов', 'compilation_free_description', '', 'ru'],
            ['new', 'Новинки', '/compilation/new', 'Описание подборки новых проектов', 'compilation_new_description', '', 'ru'],
            ['discount', 'Проекты со скидкой', '/compilation/discount', 'Описание подборки проектов со скидкой', 'compilation_discount_description', '', 'ru'],
            ['free', 'Бесплатные проекты', '/compilation/free', 'Заголовок подборки бесплатных проектов', 'compilation_free_name', '', 'ru'],
            ['new', 'Новинки', '/compilation/new', 'Заголовок подборки новых проектов', 'compilation_new_name', '', 'ru'],
            ['discount', 'Проекты со скидкой', '/compilation/discount', 'Заголовок подборки проектов со скидкой', 'compilation_discount_name', '', 'ru'],
            ['about', 'О компании', '/about', 'Заголовок страницы', 'about_title', 'Мы больше чем архитекторы зданий! Мы архитекторы вашей новой жизни в доме вашей мечты! Воспользуйтесь нашим опытом для шага вперед.', 'ru'],
            ['about', 'О компании', '/about', 'Изображение', 'about_main_image', '', ''],
            ['contacts', 'Контакты', '/contacts', 'Горячая линия', 'hot_line', '8 (800) 200-17-14', ''],
            ['contacts', 'Контакты', '/contacts', 'Телефон', 'phone', '+7 (903) 825-07-96', ''],
            ['contacts', 'Контакты', '/contacts', 'Email', 'email', 'arplans@yandex.ru', ''],
            ['contacts', 'Контакты', '/contacts', 'Вконтакте', 'vk', '', ''],
            ['contacts', 'Контакты', '/contacts', 'Facebook', 'fb', '', ''],
            ['contacts', 'Контакты', '/contacts', 'Instagram', 'instagram', '', ''],
            ['contacts', 'Контакты', '/contacts', 'Главный офис', 'main_office_address', '', ''],
        ];
        Yii::$app->db->createCommand()->batchInsert('content_block', ['name', 'slug', 'value'], $values)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('content_block');
    }
}
