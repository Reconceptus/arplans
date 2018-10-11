<?php

use yii\db\Migration;

/**
 * Class m181011_135449_add_columns_in_filter_to_catalog
 */
class m181011_135449_add_columns_in_filter_to_catalog extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_catalog', 'columns_in_filter', $this->smallInteger(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_catalog', 'columns_in_filter');
    }
}
