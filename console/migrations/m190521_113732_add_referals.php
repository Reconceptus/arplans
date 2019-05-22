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
        $this->addColumn('user', 'is_refer', $this->boolean());
        $this->addColumn('user', 'inviter_id', $this->integer());
        $this->addForeignKey('fk_user_inviter', 'user', 'inviter_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_user_inviter', 'user');
        $this->dropColumn('user', 'is_refer');
        $this->dropColumn('user', 'inviter_id');
    }
}
