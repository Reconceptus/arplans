<?php

use yii\db\Migration;

/**
 * Class m181009_064618_add_gabarites
 */
class m181009_064618_add_gabarites extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_item', 'exact_gab', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_item','exact_gab');
    }
}
