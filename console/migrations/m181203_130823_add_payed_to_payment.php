<?php

use yii\db\Migration;

/**
 * Class m181203_130823_add_payed_to_payment
 */
class m181203_130823_add_payed_to_payment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('payment', 'payed', $this->decimal(14, 2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('payment', 'payed');
    }
}
