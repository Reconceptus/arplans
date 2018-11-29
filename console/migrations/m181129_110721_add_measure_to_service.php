<?php

use yii\db\Migration;

/**
 * Class m181129_110721_add_measure_to_service
 */
class m181129_110721_add_measure_to_service extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_service', 'measure', $this->string(15)->defaultValue(''));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_service', 'measure');
    }
}
