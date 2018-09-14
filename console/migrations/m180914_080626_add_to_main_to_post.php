<?php

use yii\db\Migration;

/**
 * Class m180914_080626_add_to_main_to_post
 */
class m180914_080626_add_to_main_to_post extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('post', 'on_main', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('post', 'on_main');
    }
}
