<?php

use yii\db\Migration;

/**
 * Class m181024_121236_add_columns_to_posts
 */
class m181024_121236_add_columns_to_posts extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('post', 'short_description', $this->string());
        $this->addColumn('post', 'on_main_top', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('post','short_description');
        $this->dropColumn('post','on_main_top');
    }
}
