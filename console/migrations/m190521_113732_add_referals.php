<?php

use yii\db\Migration;

/**
 * Class m190521_113732_add_referals
 */
class m190521_113732_add_referals extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'is_referrer', $this->boolean()->defaultValue(0));
        $this->addColumn('user', 'referrer_id', $this->integer());
        $this->addForeignKey('fk_user_referrer', 'user', 'referrer_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_user_referrer', 'user');
        $this->dropColumn('user', 'is_referrer');
        $this->dropColumn('user', 'referrer_id');
    }
}
