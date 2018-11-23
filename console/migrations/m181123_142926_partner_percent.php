<?php

use yii\db\Migration;

/**
 * Class m181123_142926_partner_percent
 */
class m181123_142926_partner_percent extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_order', 'partner_percent', $this->decimal(14, 2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_order', 'partner_percent');
    }
}
