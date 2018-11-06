<?php

use yii\db\Migration;

/**
 * Class m181106_083112_add_payment_status_to_order
 */
class m181106_083112_add_payment_status_to_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_order', 'payment_status', $this->smallInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_order', 'payment_status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181106_083112_add_payment_status_to_order cannot be reverted.\n";

        return false;
    }
    */
}
