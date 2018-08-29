<?php

use yii\db\Migration;

/**
 * Class m180828_142113_add_show_in_basic_to_catalog
 */
class m180828_142113_add_show_in_basic_to_catalog extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_catalog', 'basic', $this->smallInteger(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_catalog', 'basic');
    }
}
