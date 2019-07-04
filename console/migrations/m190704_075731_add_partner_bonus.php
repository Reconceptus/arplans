<?php

use yii\db\Migration;

/**
 * Class m190704_075731_add_partner_bonus
 */
class m190704_075731_add_partner_bonus extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('partner', 'bonus_total', $this->decimal(14, 2));
        $this->addColumn('partner', 'bonus_payed', $this->decimal(14, 2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('partner', 'bonus_total');
        $this->dropColumn('partner', 'bonus_payed');
    }
}
