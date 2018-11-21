<?php

use yii\db\Migration;

/**
 * Class m181121_073735_add_email_to_village
 */
class m181121_073735_add_email_to_village extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('builder', 'email', $this->string());
        $this->addColumn('village', 'email', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('builder', 'email');
        $this->dropColumn('village', 'email');
    }
}
