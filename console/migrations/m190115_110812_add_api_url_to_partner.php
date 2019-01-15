<?php

use yii\db\Migration;

/**
 * Class m190115_110812_add_api_url_to_partner
 */
class m190115_110812_add_api_url_to_partner extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('partner', 'api_url', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('partner', 'api_url');
    }
}
