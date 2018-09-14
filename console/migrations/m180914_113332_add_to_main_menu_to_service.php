<?php

use yii\db\Migration;

/**
 * Class m180914_113332_add_to_main_menu_to_service
 */
class m180914_113332_add_to_main_menu_to_service extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_service', 'to_main_menu', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_service', 'to_main_menu');
    }
}
