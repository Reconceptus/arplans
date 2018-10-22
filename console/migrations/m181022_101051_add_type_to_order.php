<?php

use yii\db\Migration;

/**
 * Class m181022_101051_add_type_to_order
 */
class m181022_101051_add_type_to_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_order', 'type', $this->smallInteger(1)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_order', 'type');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181022_101051_add_type_to_order cannot be reverted.\n";

        return false;
    }
    */
}
