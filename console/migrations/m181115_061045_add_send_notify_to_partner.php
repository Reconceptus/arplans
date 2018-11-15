<?php

use yii\db\Migration;

/**
 * Class m181115_061045_add_send_notify_to_partner
 */
class m181115_061045_add_send_notify_to_partner extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('partner', 'send_notify', $this->boolean()->defaultValue(0));
        $this->addColumn('request', 'partner_id', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('partner', 'send_notify');
        $this->dropColumn('request', 'partner_id');
    }

}
