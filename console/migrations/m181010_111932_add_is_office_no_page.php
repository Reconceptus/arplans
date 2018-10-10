<?php

use yii\db\Migration;

/**
 * Class m181010_111932_add_is_office_no_page
 */
class m181010_111932_add_is_office_no_page extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('village', 'is_office', $this->boolean());
        $this->addColumn('village', 'no_page', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('village', 'is_office');
        $this->dropColumn('village', 'no_page');
    }
}
