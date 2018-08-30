<?php

use yii\db\Migration;

/**
 * Handles the creation of table `config`.
 */
class m180830_065346_create_config_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('config', [
            'id'    => $this->primaryKey(),
            'name'  => $this->string(),
            'slug'  => $this->string(),
            'value' => $this->text()
        ]);

        $values = [
            ['Описание подборки бесплатных проектов', 'compilation_free_description', ''],
            ['Описание подборки новых проектов', 'compilation_new_description', ''],
            ['Описание подборки проектов со скидкой', 'compilation_discount_description', ''],
            ['Заголовок подборки бесплатных проектов', 'compilation_free_name', ''],
            ['Заголовок подборки новых проектов', 'compilation_new_name', ''],
            ['Заголовок подборки проектов со скидкой', 'compilation_discount_name', ''],
        ];

        Yii::$app->db->createCommand()->batchInsert('config', ['name', 'slug', 'description'], $values)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('config');
    }
}
