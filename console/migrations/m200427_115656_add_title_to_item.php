<?php

use yii\db\Migration;

/**
 * Class m200427_115656_add_title_to_item
 */
class m200427_115656_add_title_to_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_item', 'title', $this->string()->defaultValue(''));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_item', 'title');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200427_115656_add_title_to_item cannot be reverted.\n";

        return false;
    }
    */
}
