<?php

use yii\db\Migration;

/**
 * Class m190408_050458_add_region_to_request
 */
class m190408_050458_add_region_to_request extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('request', 'region', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('request', 'region');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190408_050458_add_region_to_request cannot be reverted.\n";

        return false;
    }
    */
}
