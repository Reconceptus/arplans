<?php

use yii\db\Migration;

/**
 * Class m181113_133303_add_back_image_to_partners
 */
class m181113_133303_add_back_image_to_partners extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('builder', 'back_image_id', $this->integer()->unsigned());
        $this->addColumn('village', 'back_image_id', $this->integer()->unsigned());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('builder', 'back_image_id');
        $this->dropColumn('village', 'back_image_id');
    }
}
