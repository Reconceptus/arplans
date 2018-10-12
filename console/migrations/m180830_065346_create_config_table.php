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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('config');
    }
}
