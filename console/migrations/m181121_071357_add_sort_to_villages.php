<?php

use yii\db\Migration;

/**
 * Class m181121_071357_add_sort_to_villages
 */
class m181121_071357_add_sort_to_villages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('village', 'sort', $this->integer());
        $this->addColumn('builder', 'sort', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('village', 'sort');
        $this->dropColumn('builder', 'sort');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181121_071357_add_sort_to_villages cannot be reverted.\n";

        return false;
    }
    */
}
