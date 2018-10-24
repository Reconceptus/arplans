<?php

use yii\db\Migration;

/**
 * Class m181023_132622_add_partner_fields
 */
class m181023_132622_add_partner_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('partner', 'is_active', $this->boolean()->defaultValue(0));
        $this->addColumn('partner', 'is_deleted', $this->boolean()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('partner', 'is_active');
       $this->dropColumn('partner', 'is_deleted');
    }
}
