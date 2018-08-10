<?php

use yii\db\Migration;

/**
 * Class m180807_121730_create_pages
 */
class m180807_121730_create_pages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('page', [
            'id'         => $this->primaryKey()->unsigned(),
            'slug'       => $this->string(),
            'image'      => $this->string(),
            'name'        => $this->string()->notNull(),
            'text'        => $this->text()->notNull(),
            'title'       => $this->string(),
            'keywords'    => $this->string(),
            'description' => $this->string(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('page');
    }
}
