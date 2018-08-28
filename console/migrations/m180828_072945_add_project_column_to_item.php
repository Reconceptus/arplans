<?php

use yii\db\Migration;

/**
 * Class m180828_072945_add_project_column_to_item
 */
class m180828_072945_add_project_column_to_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_item', 'project', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('shop_item','project');
    }
}
