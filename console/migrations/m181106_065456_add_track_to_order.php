<?php

use yii\db\Migration;

/**
 * Class m181106_065456_add_track_to_order
 */
class m181106_065456_add_track_to_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_order', 'track', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_order', 'track');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181106_065456_add_track_to_order cannot be reverted.\n";

        return false;
    }
    */
}
