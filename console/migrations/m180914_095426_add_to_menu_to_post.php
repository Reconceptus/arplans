<?php

use yii\db\Migration;

/**
 * Class m180914_095426_add_to_menu_to_post
 */
class m180914_095426_add_to_menu_to_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('post', 'to_menu', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('post', 'to_menu');
    }
}
