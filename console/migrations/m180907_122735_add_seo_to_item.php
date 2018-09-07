<?php

use yii\db\Migration;

/**
 * Class m180907_122735_add_seo_to_item
 */
class m180907_122735_add_seo_to_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_item', 'seo_keywords', $this->string());
        $this->addColumn('shop_item', 'seo_description', $this->string());
        $this->addColumn('shop_item', 'seo_title', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_item', 'seo_keywords');
        $this->dropColumn('shop_item', 'seo_description');
        $this->dropColumn('shop_item', 'seo_title');
    }
}
